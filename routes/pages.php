<?php
use App\Http\Response;
use App\Controller\Pages;

$obRouter->get('/', [
    function(){
        return new Response(200, Pages\Home::getHome());
    }
]);

$obRouter->get('/test', [
    function(){
        return new Response(200, Pages\Home::getHome());
    }
]);

$obRouter->get('/pagina/{id}', [
    function($id){
        return new Response(200, 'Pagina ' . $id);
    }
]);