<?php

namespace App\Http;

use \Closure;
use \Exception;

class Router {

    /**
    * URL da requisição
    * @var string
    */
    private $url = '';

    /**
    * Prefixo da requisição
    * @var string
    */
    private $prefix = '';

    /**
    * Índice de rotas
    * @var array
    */
    private $routes = [];

    /**
    * Instância do objeto Request
    * @var Request
    */
    private $request;

    /**
    * Construtor da classe
    * @param string $url
    */
    public function __construct($url = '') {
        $this->request  = new Request();
        $this->url      = $url;
        $this->setPrefix();
    }

    /**
    * Método que define o prefixo da requisição
    * @return void
    */
    private function setPrefix() {
        $parseUrl = parse_url($this->url);
        $this->prefix = $parseUrl['path'] ?? '';
    }

    /**
    * Método que adiciona uma rota na classe
    * @param string $method
    * @param string $route
    * @param array $params
    * @return void
    */
    public function addRoute($method, $route, $params = []) {
        foreach ($params as $key => $value) {
            if($value instanceof Closure) {
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }
        $params['variables'] = [];
        $patternVariable = '{(.*?)}';
        
        if(preg_match_all($patternVariable, $route, $matches)) {
            $route = preg_replace($patternVariable, '(.*?)', $route);
            $params['variables'] = $matches[1];
        }
        $patternRoute = '/^'.str_replace('/', '\/', $route).'$/';

        $this->routes[$patternRoute][$method] = $params;
    }



    /**
     * Método que retorna a URI sem o prefixo
     * @return string
    */
    private function getUri() {
        $uri = $this->request->getUri();
        $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];
        // dd($xUri);
        return end($xUri);
    }

    /**
    * Método que retorna os dados da rota
    * @return array
    */
    private function getRoute() {
        $uri = $this->getUri();
        $httpMethod = $this->request->getHttpMethod();
        foreach ($this->routes as $patternRoute => $methods) {
            if(preg_match($patternRoute, $uri, $matches)) {
                if(isset($methods[$httpMethod])) {
                    unset($matches[0]);
                    $keys = $methods[$httpMethod]['variables'];
                    $methods[$httpMethod]['variables'] = array_combine($keys, $matches);
                    $methods[$httpMethod]['variables']['request'] = $this->request;
                    // dd($methods[$httpMethod]);
                    return $methods[$httpMethod];
                }
                throw new Exception('Método não permitido', 405);
            }
            // throw new Exception('Url não encontrada', 404);
        }
    }

    /**
    * Método que executa a rota da requisição
    * @return Response
    */   
    public function run(){
        try {
            $route = $this->getRoute();
            if(!isset($route['controller'])) {
                throw new Exception('A URL não pode ser processada', 500);
            }
            // dd($route);
            $args = [];
            return call_user_func_array($route['controller'], $args);
        } catch (Exception $e) {
            return new Response($e->getCode(), $e->getMessage());
        }
    }

    /**
    * Método que define rota GET
    * @param string $route
    * @param string $params
    * @return void
    */
    public function get($route, $params = []) {
        $this->addRoute('GET', $route, $params);
    }

    /**
    * Método que define rota POST
    * @param string $route
    * @param string $params
    * @return void
    */
    public function post($route, $params = []) {
        $this->addRoute('POST', $route, $params);
    }

    /**
    * Método que define rota PUT
    * @param string $route
    * @param string $params
    * @return void
    */
    public function put($route, $params = []) {
        $this->addRoute('PUT', $route, $params);
    }

    /**
    * Método que define rota DELETE
    * @param string $route
    * @param string $params
    * @return void
    */
    public function delete($route, $params = []) {
        $this->addRoute('DELETE', $route, $params);
    }

}
