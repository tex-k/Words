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
        session_start();
        if ($_SESSION['words']) {
            (new Renderer())->render("index");
        } else {
            $this->redirect('/?c=word&a=last');
        }
    }

    /**
     * Рендерит страницу теста
     */
    protected function actionTest()
    {
        if ($_GET['p']) {
            $lang = $_GET['p'];
        } else {
            $lang = '';
            $this->actionError();
        }

        session_start();
        if ($_SESSION['wordEn'] || $_SESSION['wordRu']) {
            (new Renderer())->render("test");
        } else {
            $this->redirect('/?c=word&a=get&p=' . $lang);
        }
    }

    /**
     * Рендерит страницу ошибки
     */
    protected function actionError()
    {
        (new Renderer())->render("error");
    }
}