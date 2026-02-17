<?php

namespace Console\Commands;

use Flexi\Config\Config;
use PDO;
use PDOException;
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

        $pdo = new PDO($dsn, $config['username'], $config['password']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }

    private function getSqlFiles()
    {
        if (!is_dir(self::SQL_DIR_PATH)) {
            throw new RuntimeException(sprintf('SQL directory "%s" does not exist.', self::SQL_DIR_PATH));
        }

        $scannedFiles = scandir(self::SQL_DIR_PATH);

        if ($scannedFiles === false) {
            throw new RuntimeException(sprintf('Cannot read SQL directory "%s".', self::SQL_DIR_PATH));
        }

        $sqlFiles = array_values(array_filter($scannedFiles, function ($item) {
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

        if ($lines === false) {
            throw new RuntimeException(sprintf('Cannot read SQL file "%s".', $filePath));
        }

        $statement = '';

        foreach ($lines as $line) {
            $trimmedLine = trim($line);

            if ($trimmedLine === '' || strpos($trimmedLine, '--') === 0) {
                continue;
            }

            $statement .= $line;

            if (substr($trimmedLine, -1) === ';') {
                $this->executeStatement($pdo, $statement, $filePath);
                $statement = '';
            }
        }

        if (trim($statement) !== '') {
            $this->executeStatement($pdo, $statement, $filePath);
        }
    }

    private function executeStatement(PDO $pdo, $statement, $filePath)
    {
        try {
            $pdo->exec($statement);
        } catch (PDOException $exception) {
            throw new RuntimeException(sprintf('Error in file "%s": %s', $filePath, $exception->getMessage()), 0, $exception);
        }
    }
}
