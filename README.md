# magento-phpserver

This magento2 modules provides a series of `bin/magento` commands to manage php's built in webserver for a high-performance local instance for development. This also provides database and elasticsearch through a docker composition that it tries to manage for you. 

The major advantage to this approach for local development is that `php` is not containerized, it is instead running directly on the "bare-metal". This means that Magento runs _natively_ on the hardware unlocking the full speed potential, and avoids all the docker volume woes in MacOS which make even simple tasks a real hassle. This setup does not use `mutagen`, nor does it rely on volume mounting of any kind for the codebase.

## Installation

This works like an ordinary magento module, but it requires `php`, `docker` and `docker-compose`.

The author also uses `direnv` to manage the environment variables required for use, check out `.envrc.sample` for defaults.

```bash
    brew install php@8.1 direnv
```

You can install the `magento-phpserver` package through composer...

```bash
    composer require --dev superterran/magento-phpserver
    cp vendor/superterran/magento-phpserver/.envrc.sample .envrc && direnv allow
```

## Setting Up Magento

Once installed, run `bin/magneto` to trigger the database and elasticsearch services. These launch as a background process. 

```bash
    bin/magento configure
```

`configure` will trigger `setup:install`. Magento's `setup:install` and create `config.php` and `env.php`. This process isn't destructive to existing data. 

In the future, this step will also request a path to a mysql dump for import.

## Usage

Once configured, you should find that `bin/magento` commands will run in your local session. To open a local webserver for local development, simply do the following:

```bash
    bin/magento serve
```

This will provide a URL (see the `.envrc`) where you can pull up the site in a browser. As php is running "bare-metal" any file-system changes you make will be immediate. To shutdown the backend, simply run:

```bash
    bin/magneto down
```

# PHP Concurrency

With somtething like homebrew or phpbrew, this tool can be used between Magento projects with different php versions. 

```bash
    brew install php@7.4 # let's bring in php 7.4 
    brew link php@7.4 # let's use it system-wide, useful for magento-cloud-cli

    brew install php@8.1.6 # we want to build our sites using the latest version of php
    cd path/to/8.1-based-project/webroot
```

set `PHPSERVER_PHP_VERSION=8.1.6` in .envrc and run `direnv allow` to update session variables

```bash
    composer install && bin/magento # commands run in php 8.1! 
```

You can still usee global php services written for older versions, such as:

```bash
    cd ~
    magento-cloud login # runs without warnings in the system-wide 7.4 version
```


# Contributions

Contributions are welcome! Open an issue if you have a problem or a suggestion, or feel free to fork and open a PR!
