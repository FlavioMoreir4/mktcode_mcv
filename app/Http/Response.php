<?php

namespace App\Http;

class Response {
    
        /**
        * Código de status da resposta
        * @var int
        */
        private $httpCode = 200;

        /**
        * Cabeçalho da resposta
        * @var array
        */
        private $headers = [];

        /**
        * Tipo de conteúdo da resposta
        */
        private $contentType = 'text/html';

        /**
        * Conteúdo da resposta
        * @var mixed string|array
        */
        private $content;

        /**
        * Construtor da classe
        * @param int $httpCode
        * @param mixed $content
        * @param string $contentType
        */
        public function __construct($httpCode, $content, $contentType = 'text/html') {
            $this->httpCode = $httpCode;
            $this->content = $content;
            $this->setContentType($contentType);
        }

        /**
        * Método que altera o contentType da resposta
        * @return string
        */
        public function setContentType($contentType) {
            $this->contentType = $contentType;
            $this->addHeader('Content-Type', $contentType);
        }

        /**
        * Método que adiciona um registro ao cabeçalho da resposta
        * @return string $key
        * @return string $value
        */
        public function addHeader($key, $value) {
            $this->headers[$key] = $value;
        }

        /**
        * Método que envia o cabeçalho da resposta
        * @return void
        */
        private function sendHeaders() {
            http_response_code($this->httpCode);
            foreach ($this->headers as $key => $value) {
                header($key . ': ' . $value);
            }
        }

        /**
        * Método que envia a resposta para o usuário
        * @return void
        */
        public function sendResponse() {
            $this->sendHeaders();
            switch ($this->contentType) {
                case 'text/html':
                    echo $this->content;
                    break;
                case 'application/json':
                    echo json_encode($this->content);
                    break;
            }
        }
}