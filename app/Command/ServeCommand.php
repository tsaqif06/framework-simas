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
        $red = "\033[0;31m";
        $green = "\033[0;32m";
        $yellow = "\033[1;33m";
        $blue = "\033[0;34m";
        $reset = "\033[0m";

        echo "{$blue}Server is running on {$yellow}http://localhost:$port\n $reset";
        shell_exec("start explorer http://localhost:$port");
        try {
            exec("php -S localhost:$port -t public");
        } catch (\PDOException $e) {
            echo "{$red}❌ Error: " . $e->getMessage() . "$reset";
        }
    }
}
