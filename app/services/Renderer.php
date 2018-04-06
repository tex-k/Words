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
        if ($_SESSION['wordEn']) {
            $wordEn = $_SESSION['wordEn'];
            $_SESSION['wordEn'] = null;
        }
        if ($_SESSION['wordRu']) {
            $wordRu = $_SESSION['wordRu'];
            $_SESSION['wordRu'] = null;
        }
        if ($_SESSION['words']) {
            $words = $_SESSION['words'];
            $_SESSION['words'] = null;
        }

        ob_start();
        include ROOT . "views/" . $view . ".php";
        $content = ob_get_clean();

        include ROOT . "views/layout.php";
    }
}