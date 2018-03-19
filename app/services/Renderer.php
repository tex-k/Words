<?php

class Renderer {
    /**
     * @param String $view
     */
    public function render(String $view) {
        include ROOT . "/views/" . $view . ".php";
    }
}