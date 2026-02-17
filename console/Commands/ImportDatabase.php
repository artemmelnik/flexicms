<?php

namespace Console\Commands;

use Flexi\Config\Config;
use PDO;
use RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportDatabase extends Command
{
    const SQL_DIR_PATH = 'databases/sql';

    protected static $defaultName = 'db:import';

    protected function configure()
    {
        $this->setDescription('Import SQL files from databases/sql directory.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Start import.');

        try {
            $pdo = $this->createConnection();
            $sqlFiles = $this->getSqlFiles();

            foreach ($sqlFiles as $sqlFile) {
                $output->writeln(sprintf('Importing: %s', $sqlFile));
                $this->importFile($pdo, sprintf('%s/%s', self::SQL_DIR_PATH, $sqlFile));
            }
        } catch (\Throwable $exception) {
            $output->writeln(sprintf('<error>Import failed: %s</error>', $exception->getMessage()));

            return Command::FAILURE;
        }

        $output->writeln('Done.');

        return Command::SUCCESS;
    }

    private function createConnection()
    {
        $config = Config::group('database');

        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=%s',
            $config['host'],
            $config['db_name'],
            $config['charset']
        );

        return new PDO($dsn, $config['username'], $config['password']);
    }

    private function getSqlFiles()
    {
        $sqlFiles = array_values(array_filter(scandir(self::SQL_DIR_PATH), function ($item) {
            return $item !== '.' && $item !== '..' && pathinfo($item, PATHINFO_EXTENSION) === 'sql';
        }));

        sort($sqlFiles);

        if (empty($sqlFiles)) {
            throw new RuntimeException('No SQL files found in databases/sql directory.');
        }

        return $sqlFiles;
    }

    private function importFile(PDO $pdo, $filePath)
    {
        $lines = file($filePath);
        $statement = '';

        foreach ($lines as $line) {
            $trimmedLine = trim($line);

            if ($trimmedLine === '' || strpos($trimmedLine, '--') === 0) {
                continue;
            }

            $statement .= $line;

            if (substr($trimmedLine, -1) === ';') {
                $pdo->exec($statement);
                $statement = '';
            }
        }
    }
}
