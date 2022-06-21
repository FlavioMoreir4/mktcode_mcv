<?php

namespace App\Http;

class Request {

    /**
    * Instancia do Router
    * @var Router
    */
    private $router;

    /**
     * Método HTTP da requisição
     * @var string
     */
    private $httpMethod;

    /**
     * URI da requisição
     * @var string
     */
    private $uri;

    /**
     * Dados da requisição ($_GET)
     * @var array
     */
    private $queryParams = [];

    /**
     * Dados da requisição ($_POST)
     * @var array
     */
    private $postVars = [];

    /**
     * Cabeçalho da requisição (headers)
     * @var array
     */
    private $headers = [];

    /**
    * Construtor da classe
    * @param string $httpMethod
    * @param string $uri
    * @param array $queryParams
    * @param array $postVars
    * @param array $headers
    * @return void
    */
    public function __construct($router) {
        $this->router = $router;
        $this->queryParams  = $_GET ?? [];
        $this->postVars     = $_POST ?? [];
        $this->headers      = getallheaders();
        $this->httpMethod   = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->uri          = $_SERVER['REQUEST_URI'] ?? '';
        $this->setUri();
    }

    /**
    * Método que define a URI da requisição
    * @param string $uri
    * @return void
    */
    private function setUri() {
        $xUri = explode('?', $_SERVER['REQUEST_URI'] ?? '');
        $this->uri = $xUri[0];
    }

    /**
    * Método que retorna istancia do objeto Router
    * @return Router
    */
    public function getRouter() {
        return $this->router;
    }

    /**
    * Retorna o método HTTP da requisição
    * @return string
    */
    public function getHttpMethod(): string {
        return $this->httpMethod;
    }

    /**
     * Retorna o URI da requisição
     * @return string
     */
    public function getUri(): string {
        return $this->uri;
        dd($this->uri);
    }
    
    /**
     * Retorna os cabeçalhos da requisição
     * @return array
     */
    public function getHeaders(): array {
        return $this->headers;
    }

    /**
     * Retorna os dados da requisição ($_GET)
     * @return array
     */
    public function getqueryParams(): array {
        return $this->queryParams;
    }

    /**
     * Retorna os dados da requisição ($_POST)
     * @return array
     */
    public function getPostVars(): array {
        return $this->postVars;
    }

}