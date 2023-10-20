<?php
function put()
{
    echo '<input type="hidden" name="_method" value="PUT">';
}

function errorValidate($args)
{
    if (isset($_SESSION['errors'][$args])) {
        echo "<div class=\"text-danger\">
        {$_SESSION['errors'][$args]}</div>";
    }
}

function isInvalid($args)
{
    if (isset($_SESSION['errors'][$args])) {
        echo "is-invalid";
    }
}

function oldValue($args)
{
    if (isset($_SESSION['old'][$args])) {
        echo "value=\"{$_SESSION['old'][$args]}\"";
    }
}

function dd($args)
{
    var_dump($args);
    die;
}

function includeView($dir, $data = [])
{
    extract($data);
    include ROOT . "/resources/views/{$dir}";
}
