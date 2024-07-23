<?php

namespace FrameworkSimas\Config;

class View
{
    public static function setView(string $folder, $data = [])
    {
        extract($data);
        require __DIR__ . "../../../resources/views/$folder.php";
    }
}


