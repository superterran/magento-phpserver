<?php
    namespace Superterran\PhpServer\Console\Command;

    use Symfony\Component\Console\Command\Command;
    use Symfony\Component\Console\Input\InputInterface;
    use Symfony\Component\Console\Input\InputOption;
    use Symfony\Component\Console\Output\OutputInterface;

    /**
     * Class SomeCommand
     */
    class Install extends Command
    {
        /**
         * @inheritDoc
         */
        protected function configure()
        {
            $this->setName('phpserver:magento:install');
            $this->setDescription('installs magento onto system');
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
            Superterran_PhpServer_Setup_Routine();
        }
    }
