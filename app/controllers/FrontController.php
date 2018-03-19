<?php

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

        (new $controller())->run();
    }
}