<?php

use Dotenv\Dotenv;
use Ifsnop\Mysqldump\Mysqldump;

require_once __DIR__ . "/../../vendor/autoload.php";
$dotenv = Dotenv::createImmutable(__DIR__ . "/../../");
$dotenv->load();

class ExportdbCommand
{
    protected $db;

    public function run($argument)
    {
        $conn = "{$_ENV['DB_DRIVER']}:host={$_ENV['DB_HOST']}:{$_ENV['DB_PORT']};dbname={$_ENV['DB_NAME']}";
        $this->db = new PDO($conn, $_ENV['DB_USER'], $_ENV['DB_PASS']);
        $this->startExport();
    }

    protected function startExport()
    {
        $yellow = "\033[1;33m";

        $outputFilePath = __DIR__ . "/../../database/{$_ENV['DB_NAME']}.sql";
        $dump = new Mysqldump("mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}", "{$_ENV['DB_USER']}", "{$_ENV['DB_PASS']}");

        try {
            $dump->start($outputFilePath);
            output("✔ database export successful. file saved to {$yellow}/database/{$_ENV['DB_NAME']}.sql\n", "blue");
        } catch (\PDOException $e) {
            output("❌ Error: " . $e->getMessage(), "red");
        }
    }
}
