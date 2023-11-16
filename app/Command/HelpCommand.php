<?php

class HelpCommand
{
    public function run($arguments)
    {
        $this->startHelp();
    }

    protected function startHelp()
    {
        $red = "\033[0;31m";
        $green = "\033[0;32m";
        $yellow = "\033[1;33m";
        $blue = "\033[0;34m";
        $reset = "\033[0m";

        echo "
{$yellow}to run your project to the web server : $reset
{$blue}    php aquasun serve [port]\n $reset
{$yellow}to migrate database file in /database directory : $reset
{$blue}    php aquasun migrate $reset
        ";
    }
}
