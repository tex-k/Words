<?php

namespace app\controllers;

use app\models\Word;

class WordController extends Controller {
    /**
     * Направляет новое слово на запись
     */
    protected function actionRecord() {
        if (($_POST['en'] != '') && ($_POST['ru'] != '')) {
            $word = new Word();
            $word->setValue($_POST['en']);
            $word->setTranslate([$_POST['ru']]);

            $word->record();

            $this->redirect('/');
        } else {
            $this->redirect('/');
        }
    }
}