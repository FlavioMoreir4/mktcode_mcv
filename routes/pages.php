<?php
use App\Http\Response;
use App\Controller\Pages;

$obRouter->get('/', [
    function(){
        return new Response(200, Pages\Home::getHome());
    }
]);

$obRouter->get('/modulo', [
    function(){
        return new Response(200, Pages\Modulo::getHome());
    }
]);

$obRouter->get('/depoimentos', [
    function($request){
        return new Response(200, Pages\Depoimentos::getHome($request));
    }
]);

$obRouter->POST('/depoimentos', [
    function($request){
        return new Response(200, Pages\Depoimentos::insertDepoimento($request));
    }
]);