<?php

namespace App\Model\Entity;

use App\Utils\Database;

class Depoimentos {

    /**
    * @var int
    */
    public $id;

    /**
    * @var string
    */
    public $name;

    /**
    * @var string
    */
    public $email;

    /**
    * @var string
    */
    public $depoimento;

    /**
    * @var string
    */
    public $data;

    /**
     * Método responsável por cadastrar um novo depoimento
     * @var boolean
     */
    public function cadastrar() {
        $this->data = date('Y-m-d H:i:s');
        $this->id = (new Database('depoimentos'))->insert([
            'nome'          => $this->name,
            'email'         => $this->email,
            'mensagem'    => $this->depoimento,
            'data'          => $this->data
        ]);
        return true;
    }

    /**
    * Método responsável por retornar depoimentos
    * @param string $where
    * @param string $order
    * @param string $limit
    * @return PDOStatement
    */

    public static function getDepoimentos($where = null, $order = null, $limit = null, $fields = '*') {
        return (new Database('depoimentos'))->select($where, $order, $limit, $fields);
    }

}