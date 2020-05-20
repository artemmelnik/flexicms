<?php

namespace Console\Commands;

use Flexi\Config\Config;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportDatabase extends Command
{
    const SQL_DIR_PATH = 'databases/sql';

    protected static $defaultName = 'db:import';

    protected function configure()
    {
        $this->setDescription('Import database.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $config = Config::group('database');

        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=%s',
            $config['host'],
            $config['db_name'],
            $config['charset']
        );

        $pdo = new \PDO($dsn, $config['username'], $config['password']);

        $output->writeln([
            'Start import.'
        ]);

        $sql = scandir(self::SQL_DIR_PATH);

        foreach ($sql as $table) {
            if ($table === '.' || $table === '..') {
                continue;
            }

            $lines = file(self::SQL_DIR_PATH . '/' . $table);

            $tempLine = '';

            foreach ($lines as $line) {
                if (strpos($line, '--') === 0 || $line === '') {
                    continue;
                }

                $tempLine .= $line;

                if (substr(trim($line), -1, 1) === ';') {
                    // Perform the query

                    $sth = $pdo->prepare($tempLine);

                    $sth->execute([]);

                    $tempLine = '';
                }

                echo $line;
            }
        }

        $output->writeln(['Done.']);
    }
}
