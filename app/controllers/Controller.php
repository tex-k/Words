<?php

class Controller {
    public function run() {
        if (isset($_GET['a'])) {
            $action = 'action' . ucfirst($_GET['a']);
        } else {
            $action = 'actionIndex';
        }

        $this->$action();
    }
}