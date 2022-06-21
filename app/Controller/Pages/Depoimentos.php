<?php

namespace App\Controller\Pages;

use App\Utils\View;
use App\Model\Entity\Depoimentos as EntityDepoimento;
use App\Utils\Pagination;

class Depoimentos extends Page { 

    private static function getDepoimentosItem($request, &$obPagination) {
        $itens = '';

        $quantidadeTotal = EntityDepoimento::getDepoimentos(null, null, null, 'COUNT(*) AS qtd')->fetchObject()->qtd;
        
        $queryParams = $request->getqueryParams();
        $paginaAtual = $queryParams['p'] ?? 1;

        $obPagination = new Pagination($quantidadeTotal, $paginaAtual, 3);

        $results = EntityDepoimento::getDepoimentos(null, 'data DESC', $obPagination->getLimit());
        while($obDepoimento = $results->fetchObject(EntityDepoimento::class)) {
            $data = [
                'nome' => $obDepoimento->nome,
                'email' => $obDepoimento->email,
                'mensagem' => $obDepoimento->mensagem,
                'data' => date('d/m/Y H:i:s', strtotime($obDepoimento->data))
            ];
            $itens .=  View::render('pages/depoimentos/item', $data);
        }
        return $itens;
    }

    public static function getHome($request){
        $content =  View::render('pages/depoimentos', [
            "items" => self::getDepoimentosItem($request, $obPagination),
            "pagination" => parent::getPagination($request, $obPagination)
        ]);
        
        return self::getPage('Depoimentos', $content);
    }

    /**
     * Método responsável por cadastrar um novo depoimento
     * @var Request $request
     * @return string
    */
    public static function insertDepoimento($request){
        $postVars = $request->getPostVars();
        $obDepoimento = new EntityDepoimento();
        $obDepoimento->name = $postVars['nome'];
        $obDepoimento->email = $postVars['email'];
        $obDepoimento->depoimento = $postVars['depoimento'];
        $obDepoimento->cadastrar();
        return self::getHome($request);
    }
}
