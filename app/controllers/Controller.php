<?php

class Controller {
    public function run() {
        (new Renderer())->render("layout");
    }
}