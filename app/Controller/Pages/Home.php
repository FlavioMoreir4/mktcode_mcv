<?php

namespace App\Controller\Pages;

use App\Utils\View;
use App\Model\Entity\Organization;

class Home extends Page { 

    public static function getHome(){
        $organization = new Organization();
        $data = [
            'title' => 'Home',
            'content' => '<h1>Home</h1>',
        ];
        $content =  View::render('pages/home', $data);
        
        return self::getPage($data['title'], $content);
    }
}
