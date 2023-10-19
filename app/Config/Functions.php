<?php
function put()
{
    echo '<input type="hidden" name="_method" value="PUT">';
}

function errorValidate($args)
{
    if (isset($_SESSION['errors'][$args])) {
        echo "<div class=\"invalid-feedback\">
        {$_SESSION['errors'][$args]}</div>";
    }
}

function oldValue($args)
{
    if (isset($_SESSION['old'][$args])) {
        echo "value=\"{$_SESSION['old'][$args]}\"";
    }
}
