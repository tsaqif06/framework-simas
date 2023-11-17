<?php

class ServeCommand
{
    public function run($arguments)
    {
        $port = isset($arguments[0]) ? $arguments[0] : 4000;
        $this->startServer($port);
    }

    protected function startServer($port)
    {
        $yellow = "\033[1;33m";
        $url = "http://localhost:$port";

        output("Server is running on {$yellow}{$url}\n", "blue");

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            exec("start $url");
        } else {
            exec("xdg-open $url");
        }

        try {
            exec("php -S localhost:$port -t public");
        } catch (\PDOException $e) {
            output("❌ Error: " . $e->getMessage(), "red");
        }
    }
}
