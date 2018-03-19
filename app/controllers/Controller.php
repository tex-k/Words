<?php

class Controller {
    public function run() {
        if (isset($_GET['a'])) {
            $action = 'action' . ucfirst($_GET['a']);

            if (!method_exists($this, $action)) {
                $action = 'actionIndex';
            }
        } else {
            $action = 'actionIndex';
        }

        $this->$action();
    }
}