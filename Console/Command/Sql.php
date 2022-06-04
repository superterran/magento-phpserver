<?php
    namespace Superterran\PhpServer\Console\Command;

    use Symfony\Component\Console\Command\Command;
    use Symfony\Component\Console\Input\InputInterface;
    use Symfony\Component\Console\Input\InputOption;
    use Symfony\Component\Console\Output\OutputInterface;

    /**
     * Class SomeCommand
     */
    class Sql extends Command
    {
        /**
         * @inheritDoc
         */
        protected function configure()
        {
            $this->setName('phpserver:sql');
            $this->setDescription('sql prompt');
            $this->setAliases(['sql']);
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
            Superterran_PhpServer_Sql_Routine("-it", getenv('PHPSERVER_DB_NAME'));
        }
    }
