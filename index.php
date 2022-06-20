<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config.php';
use App\Http\Router;
use App\Utils\View;

View::init([
    'title' => 'MVC',
    'description' => 'MVC Framework',
    'URL' => URL
]);

$obRouter = new Router(URL);
include __DIR__ . '/routes/pages.php';
$obRouter->run()->sendResponse();