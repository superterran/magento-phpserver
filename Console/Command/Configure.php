<?php
    namespace Superterran\PhpServer\Console\Command;

    use Symfony\Component\Console\Command\Command;
    use Symfony\Component\Console\Input\InputInterface;
    use Symfony\Component\Console\Input\InputOption;
    use Symfony\Component\Console\Output\OutputInterface;

    /**
     * Class SomeCommand
     */
    class Configure extends Command
    {
        /**
         * @inheritDoc
         */
        protected function configure()
        {
            $this->setName('phpserver:magento:configure');
            $this->setDescription('configures db for local development');
            $this->setAliases(['configure']);
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
            shell_exec("php bin/magento setup:store-config:set --base-url='http://".getenv('PHPSERVER_BASE_URL')."/'");
        }
    }
