<?php

namespace App\Controller\Pages;

use App\Utils\View;

class Page{

    public static function getPage($title, $content){
        $data = [
            'title' => $title,
            'content' => $content,
        ];
        return View::render('pages/page', $data);
    }
}