<?php
require __DIR__ . '/../vendor/autoload.php';
use App\Utils\Environment;
use App\Utils\Database;
use App\Utils\View;

Environment::load(__DIR__.'/../');

date_default_timezone_set(getenv('TIME_ZONE'));

Database::config(
    getenv('DB_HOST'),
    getenv('DB_NAME'),
    getenv('DB_USER'),
    getenv('DB_PASS'),
    getenv('DB_PORT')
);

define('URL' , getenv('URL'));
function dd($var, $exit = true) {
    echo '<pre>';
    print_r($var);
    echo '</pre>';
    if ($exit) {
        exit;
    }
}

View::init([
    'title' => 'MVC',
    'description' => 'MVC Framework',
    'URL' => URL
]);