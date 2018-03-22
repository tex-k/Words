<?php

namespace app\services;

use app\models\Word;

class Renderer {
    /**
     * @param String $view
     * @param Word $word
     */
    public function render(String $view, Word $word = null) {
        ob_start();
        include ROOT . "views/" . $view . ".php";
        $content = ob_get_clean();

        include ROOT . "views/layout.php";
    }
}