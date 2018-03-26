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
     * Делает перевод слова
     */
    protected function actionTranslate()
    {
        $this->makeTranslate('en');
        $this->makeTranslate('ru');

        $this->redirect('/');
    }

    /**
     * Получает случайное слово из БД
     */
    protected function actionGet()
    {
        if ($_GET['p'] == '') {
            $this->redirect('/?c=page&a=error');
        }

        $word = new Word();

        $word->get($_GET['p']);

        session_start();
        $_SESSION['word' . ucfirst($word->getLang())] = $word;

        $this->redirect('/?c=page&a=test&p=' . $word->getLang());
    }

    /**
     * Вспомогательная функция выполняет перевод с языка, передаваемого в качестве параметра
     * @param string $lang
     */
    private function makeTranslate(string $lang)
    {
        if ($_POST[$lang] != '') {
            $word = new Word();
            $word->setValue($_POST[$lang]);

            $word->translate($lang);

            session_start();
            $_SESSION['word' . ucfirst($lang)] = $word;
        }
    }
}