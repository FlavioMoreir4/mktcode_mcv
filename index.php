<?php
require __DIR__ . '/vendor/autoload.php';
function dd($var) {
    echo '<pre>';
    print_r($var);
    echo '</pre>';
    exit;
}





// use App\Http\Router;
// use App\Utils\View;
// define('URL' , 'http://localhost/mvc');

// View::init([
//     'title' => 'MVC',
//     'description' => 'MVC Framework',
//     'URL' => URL
// ]);

// $obRouter = new Router(URL);
// include __DIR__ . '/routes/pages.php';
// $obRouter->run()->sendResponse();