<?php

namespace FrameworkSimas\Config;

class Controller
{
    public function view(string $folder, $data = [])
    {
        return View::setView($folder, $data);
    }
}
