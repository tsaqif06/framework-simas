<?php

class SymlinkCommand
{
    public function run($arguments)
    {
        $path = $_ENV['SYMLINK_PATH'] ?? 'public';
        $this->createSymlink($path);
    }

    protected function createSymlink($path)
    {
        $yellow = "\033[1;33m";

        $storagePath = __DIR__ . "/../../storage/app";
        $publicPath = __DIR__ . "/../../{$path}/storage";
        output("Creating symlink... \n", "blue");


        try {
            if (!file_exists($publicPath)) {
                if (defined('PHP_WINDOWS_VERSION_BUILD')) {
                    $output = null;
                    $returnVar = null;
                    exec("mklink /D \"{$publicPath}\" \"{$storagePath}\"", $output, $returnVar);
                    if ($returnVar === 0) {
                        output("Storage symlink created successfully in {$yellow}" . realpath($publicPath) . ".\n", "blue");
                    } else {
                        output("❌ Failed to create symlink using mklink command.\n", "red");
                    }
                } else {
                    symlink($storagePath, $publicPath);
                    output("Storage symlink created successfully in {$yellow}" . realpath($publicPath) . ".\n", "blue");
                }
            } else {
                output("❌ File already exist", "red");
            }
        } catch (\PDOException $e) {
            output("❌ Error: " . $e->getMessage(), "red");
        }
    }
}
