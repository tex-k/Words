<?php

namespace app\controllers;

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

    /**
     * Дефолтный вариант - переход на главную
     */
    protected function actionIndex() {
        $this->redirect('/');
    }

    public function redirect(string $url) {
        header('Location: ' . $url);
    }
}