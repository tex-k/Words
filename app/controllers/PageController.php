<?php

namespace app\controllers;

use app\services\Renderer;

class PageController extends Controller {
    /**
     * Рендерит главную страницу
     */
    protected function actionIndex() {
        (new Renderer())->render("index");
    }

    /**
     * Рендерит страницу теста
     */
    protected function actionTest() {
        (new Renderer())->render("test");
    }
}