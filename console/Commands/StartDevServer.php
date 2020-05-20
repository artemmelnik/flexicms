<?php

namespace Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StartDevServer extends Command
{
    protected static $defaultName = 'server:start';

    protected function configure()
    {
        $this->setDescription('Dev server.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(['Dev server is running...']);

        $result = shell_exec('php -S localhost:8000');

        $output->writeln([
            $result
        ]);
    }
}
