<?php

namespace Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class StartDevServer extends Command
{
    protected static $defaultName = 'server:start';

    protected function configure()
    {
        $this
            ->setDescription('Start local PHP development server.')
            ->addOption('host', null, InputOption::VALUE_OPTIONAL, 'Server host', '127.0.0.1')
            ->addOption('port', null, InputOption::VALUE_OPTIONAL, 'Server port', '8000');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $host = (string) $input->getOption('host');
        $port = (string) $input->getOption('port');

        $output->writeln(sprintf('Starting dev server at http://%s:%s', $host, $port));
        $output->writeln('Press Ctrl+C to stop server.');

        $address = sprintf('%s:%s', $host, $port);
        passthru(sprintf('php -S %s index.php', escapeshellarg($address)), $statusCode);

        return $statusCode === 0 ? Command::SUCCESS : Command::FAILURE;
    }
}
