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

    public static function getPagination($request, $obPagination){
        $pages = $obPagination->getPages();

        if(count($pages) <= 1) return '';

        $links = '';

        $url = $request->getRouter()->getCurrentUrl();

        $queryParams = $request->getqueryParams();

        foreach($pages as $page){

            $queryParams['p'] = $page['page'];

            $link = $url.'?'.http_build_query($queryParams);

            $links .= View::render('pages/pagination/link', [
                'page' => $page['page'],
                'link' => $link,
                'active' => $page['current'] ? 'active' : ''
            ]);
        }
        return View::render('pages/pagination/box', [
            'links' => $links
        ]);
    }
}