<?php

use Dotenv\Dotenv;

require_once __DIR__ . "/../../vendor/autoload.php";
$dotenv = Dotenv::createImmutable(__DIR__ . "/../../");
$dotenv->load();

class MigrateCommand
{
    protected $db;

    public function run($argument)
    {
        $conn = "{$_ENV['DB_DRIVER']}:host={$_ENV['DB_HOST']}:{$_ENV['DB_PORT']}";
        $this->db = new PDO($conn, $_ENV['DB_USER'], $_ENV['DB_PASS']);
        $this->startMigrate();
    }

    protected function startMigrate()
    {
        $red = "\033[0;31m";
        $green = "\033[0;32m";
        $yellow = "\033[1;33m";
        $blue = "\033[0;34m";
        $reset = "\033[0m";

        try {
            $conn = "{$_ENV['DB_DRIVER']}:host={$_ENV['DB_HOST']}:{$_ENV['DB_PORT']}";
            $tempDb = new PDO($conn, $_ENV['DB_USER'], $_ENV['DB_PASS']);
            $tempDb->exec("DROP DATABASE IF EXISTS {$_ENV['DB_NAME']}");
            $tempDb->exec("CREATE DATABASE {$_ENV['DB_NAME']}");
            $tempDb = null;

            $this->db->exec("USE {$_ENV['DB_NAME']}");

            $sql = file_get_contents(__DIR__ . "/../../database/{$_ENV['DB_NAME']}.sql");
            $this->db->exec($sql);
            output("✔ database in {$yellow}/database/{$_ENV['DB_NAME']}.sql{$blue} has been successfully migrated", "blue");
        } catch (\PDOException $e) {
            output("❌ Error: " . $e->getMessage(), "red");
        }
    }
}
