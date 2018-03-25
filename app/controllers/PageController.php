<?php

namespace app\controllers;

use app\services\Renderer;

class PageController extends Controller
{
    /**
     * Рендерит главную страницу
     */
    protected function actionIndex()
    {
        (new Renderer())->render("index");
    }

    /**
     * Рендерит страницу теста
     */
    protected function actionTest()
    {
        session_start();
        if ($_SESSION['wordEn']) {
            (new Renderer())->render("test");
        } else {
            $this->redirect('/?c=word&a=get');
        }
    }
}