<?php

namespace app\services;

use app\models\Word;

class Renderer
{
    /**
     * @param String $view
     */
    public function render(String $view)
    {
        session_start();
        if ($_SESSION['word']) {
            $word = $_SESSION['word'];
            $_SESSION['word'] = null;
        }

        ob_start();
        include ROOT . "views/" . $view . ".php";
        $content = ob_get_clean();

        include ROOT . "views/layout.php";
    }
}