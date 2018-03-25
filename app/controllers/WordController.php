<?php

namespace app\controllers;

use app\models\Word;

class WordController extends Controller
{
    /**
     * Направляет новое слово на запись в БД
     */
    protected function actionRecord()
    {
        if (($_POST['en'] != '') && ($_POST['ru'] != '')) {
            $word = new Word();
            $word->setValue($_POST['en']);
            $word->setTranslate([$_POST['ru']]);

            $word->record();
        }

        $this->redirect('/');
    }

    /**
     * Получает перевод слова из БД
     */
    protected function actionTranslate()
    {
        if ($_POST['en'] != '') {
            $word = new Word();
            $word->setLang('en');
            $word->setValue($_POST['en']);

            $word->translate();

            session_start();
            $_SESSION['wordEn'] = $word;
        }

        if ($_POST['ru'] != '') {
            $word = new Word();
            $word->setLang('ru');
            $word->setValue($_POST['ru']);

            $word->translate();

            session_start();
            $_SESSION['wordRu'] = $word;
        }

        $this->redirect('/');
    }

    /**
     * Получает случайное словои из БД
     */
    protected function actionGet()
    {
        $word = new Word();
        $word->setLang('en');

        $word->get();

        session_start();
        $_SESSION['wordEn'] = $word;

        $this->redirect('/?c=page&a=test');
    }
}