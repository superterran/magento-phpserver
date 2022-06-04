<?php
    namespace Superterran\PhpServer\Console\Command;

    use Symfony\Component\Console\Command\Command;
    use Symfony\Component\Console\Input\InputInterface;
    use Symfony\Component\Console\Input\InputOption;
    use Symfony\Component\Console\Output\OutputInterface;

    /**
     * Class SomeCommand
     */
    class Serve extends Command
    {
        /**
         * @inheritDoc
         */
        protected function configure()
        {
            $this->setName('phpserver:serve');
            $this->setDescription('Runs a local php server and serves Magento');
            $this->setAliases(['serve']);
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
           shell_exec("php -S ".getenv('PHPSERVER_BASE_URL')." -t ./pub/ ./phpserver/router.php");

        }
    }
