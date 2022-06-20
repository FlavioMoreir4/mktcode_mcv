<?php

namespace App\Utils;

class View {

    private static $vars = [];

    public static function init($vars = []) {
        self::$vars = $vars;
    }

    /**
     * Método responsável por retornar o conteúdo da view.
     * @param string $view
     * @return string
     */
    private static function getContentView($view) {
        $file = __DIR__ . '/../../resources/view/' . $view . '.php';
            return file_exists($file) ? file_get_contents($file) : '';
    }
    
    /**
     * Método para renderizar uma view
     * @param string $view
     * @param array $data
     * @return
     */
    public static function render($view, $data = []) {
        $contentView = self::getContentView($view);
        $data = array_merge(self::$vars, $data);

        $keys = array_map(function($key){
            return '{{' . $key . '}}';
        }, array_keys($data));
        
        $values = array_values($data);
        return str_replace($keys, $values, $contentView);
    }

}