<?php
use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(ComponentRegistrar::MODULE, 'Superterran_PhpServer', __DIR__);


if ((bool) getenv("PHPSERVER_BACKEND_ENABLE") == true) {

    if (! (bool) shell_exec("docker ps | grep ".getenv('PHPSERVER_PROJECT_NAME')."-db")) {
        
        shell_exec(
            "docker-compose --project-name ".getenv('PHPSERVER_PROJECT_NAME')." -f vendor/superterran/magento-phpserver/docker-compose.phpserver.yml up -d && sleep 3"
        );  

    }

    if (isset($GLOBALS['argv']) && isset($GLOBALS['argv'][1])) 
    {
        switch($GLOBALS['argv'][1])
        {
            case "configure":
                Superterran_PhpServer_Setup_Routine();
                exit;
            break;

            case "sql":
                if (! file_exists("app/etc/env.php"))
                {
                    Superterran_PhpServer_Sql_Routine();
                    exit;
                }
            break;

            case "import":
                if (! file_exists("app/etc/env.php"))
                {
                    Superterran_PhpServer_Sql_Routine("-i");
                    exit;
                }
            break;
        }
    }
}

function Superterran_PhpServer_Sql_Routine($flags = "-it", $params = "") {
    passthru(
        "docker exec $flags ".getenv('PHPSERVER_PROJECT_NAME')."-db-1 mysql "
    );
}


function Superterran_PhpServer_Setup_Routine() {
    passthru("php -d memory_limit=-1 bin/magento setup:install".
        " --base-url=http://".getenv("PHPSERVER_BASE_URL")."/".
        " --db-host=".getenv('PHPSERVER_DB_HOST').
        " --db-name=".getenv('PHPSERVER_DB_NAME').
        " --db-user=".getenv('PHPSERVER_DB_USER').
        " --db-password=".getenv('PHPSERVER_DB_PASS').
        " --admin-firstname=".getenv('PHPSERVER_ADMIN_FIRSTNAME').
        " --admin-lastname=".getenv('PHPSERVER_ADMIN_LASTNAME').
        " --admin-email=".getenv('PHPSERVER_ADMIN_EMAIL').
        " --admin-user=".getenv('PHPSERVER_ADMIN_USER').
        " --admin-password=".getenv('PHPSERVER_ADMIN_PASSWORD').
        " --language=".getenv('PHPSERVER_LANGUAGE').
        " --currency=".getenv('PHPSERVER_CURRENCY').
        " --timezone=".getenv('PHPSERVER_TIMEZONE').
        " --use-rewrites=".getenv('PHPSERVER_USE_REWRITES').
        " --search-engine=".getenv('PHPSERVER_SEARCH_ENGINE').
        " --elasticsearch-host=".getenv('PHPSERVER_ELASTICSEARCH_HOST').
        " --elasticsearch-port=".getenv('PHPSERVER_ELASTICSEARCH_PORT')
    );
}