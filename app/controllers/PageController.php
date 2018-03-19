<?php

class PageController extends Controller {
    /**
     * Рендерит главную страницу
     */
    public function actionIndex() {
        (new Renderer())->render("index");
    }

    /**
     * Рендерит страницу теста
     */
    public function actionTest() {
        (new Renderer())->render("test");
    }
}