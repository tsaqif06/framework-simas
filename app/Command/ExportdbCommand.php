<?php

use Ifsnop\Mysqldump\Mysqldump;

require_once __DIR__ . "/../../vendor/autoload.php";

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
        output("Exporting database... \n", "blue");

        if (file_exists($outputFilePath)) {
            output("❓ File '{$outputFilePath}' already exists. Do you want to overwrite it? (y/n): ", "yellow");

            $confirmation = trim(fgets(STDIN));

            if (strtolower($confirmation) !== 'y') {
                output("❌ Database export aborted.\n", "red");
                return;
            }
        }



        try {
            $dump->start($outputFilePath);
            output("✔ Database export successful. file saved to {$yellow}/database/{$_ENV['DB_NAME']}.sql\n", "blue");
        } catch (\PDOException $e) {
            output("❌ Error: " . $e->getMessage(), "red");
        }
    }
}
