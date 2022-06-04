<?php
    namespace Superterran\PhpServer\Console\Command;

    use Symfony\Component\Console\Command\Command;
    use Symfony\Component\Console\Input\InputInterface;
    use Symfony\Component\Console\Input\InputOption;
    use Symfony\Component\Console\Output\OutputInterface;

    /**
     * Class SomeCommand
     */
    class BackendDown extends Command
    {
        /**
         * @inheritDoc
         */
        protected function configure()
        {
            $this->setName('phpserver:down');
            $this->setDescription('brings down the backend services');
            $this->setAliases(['down']);
            parent::configure();
        }

        /**
         * Execute the command
         *
         * @param InputInterface $input
         * @param OutputInterface $output
         *
         * @return null|int
         */
        protected function execute(InputInterface $input, OutputInterface $output)
        {
            shell_exec(
                "docker-compose --project-name ".getenv('PHPSERVER_PROJECT_NAME')." -f vendor/superterran/magento-phpserver/docker-compose.phpserver.yml down"
            );
        }
    }
