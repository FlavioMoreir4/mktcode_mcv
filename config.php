<?php
define('URL' , 'http://localhost/mvc');
function dd($var, $exit = true) {
    echo '<pre>';
    print_r($var);
    echo '</pre>';
    if ($exit) {
        exit;
    }
}