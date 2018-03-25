<?php

namespace app\controllers;

use app\models\Word;

class WordController extends Controller
{
    /**
     * Создаёт объект слова и направляет его на запись
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

    protected function actionTranslate()
    {
        if ($_POST['en'] != '') {
            $word = new Word();
            $word->setLang('en');
            $word->setValue($_POST['en']);

            $word->get();

            session_start();
            $_SESSION['wordEn'] = $word;
        }

        if ($_POST['ru'] != '') {
            $word = new Word();
            $word->setLang('ru');
            $word->setValue($_POST['ru']);

            $word->get();

            session_start();
            $_SESSION['wordRu'] = $word;
        }

        $this->redirect('/');
    }
}