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
    public static function render($view, $vars = []) {
        $contentView = self::getContentView($view);
        $vars = array_merge(self::$vars, $vars);
        $keys = array_map(function($key){
            return '{{' . $key . '}}';
        }, array_keys($vars));
        $values = array_values($vars);
        
        return str_replace($keys, $values, $contentView);
    }

}