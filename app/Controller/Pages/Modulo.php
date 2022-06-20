<?php

namespace App\Controller\Pages;

use App\Utils\View;
use App\Model\Entity\Organization;

class Modulo extends Page { 

    public static function getHome(){
        $organization = new Organization();
        $data = [
            'title' => 'Home',
            'content' => '<h1>Home</h1>',
        ];
        $content =  View::render('pages/modulo_aula', $data);
        
        return self::getPage($data['title'], $content);
    }
}
