<?php

class Renderer {
    /**
     * @param String $view
     */
    public function render(String $view) {
        ob_start();
        include ROOT . "/views/" . $view . ".php";
        $content = ob_get_clean();

        include ROOT . "/views/layout.php";
    }
}