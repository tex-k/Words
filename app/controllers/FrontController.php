<?php

namespace app\controllers;

//use app\controllers\PageController;
//use app\controllers\WordController;

class FrontController extends Controller {
    /**
     * Определяет, какому контроллеру передать управление
     */
    protected function actionIndex() {
        if (isset($_GET['c'])) {
            $controller = ucfirst($_GET['c']) . 'Controller';

            if (!file_exists(ROOT . 'controllers/' . $controller . '.php')) {
                $controller = 'PageController';
            }
        } else {
            $controller = 'PageController';
        }

        $controller = 'app\controllers\\' . $controller;

        (new $controller())->run();
    }
}