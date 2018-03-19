<?php

class WordController extends Controller {
    /**
     * Направляет новое слово на запись
     */
    protected function actionRecord() {
        if (($_POST['en'] != '') && ($_POST['ru'] != '')) {
            $word = new Word();
            $word->setValue($_POST['en']);
            $word->setTranslate([$_POST['ru']]);

//            $word->record();

        } else {
            $this->redirect('/');
        }
    }
}