<?php

namespace app\models;

use app\services\Db;
use app\services\StrGenerator;

class Word {
    private $lang = '';
    private $value = '';
    private $translate = [];

    /**
     * Записывает фразу и перевод в таблицы
     */
    public function record()
    {
        $value = $this->value;
        $translate = $this->translate[0];

        $generator = (new StrGenerator());

        $relId = $generator->generate();

        $enRow = Db::getConn()->query("SELECT * FROM en WHERE word = '$value'")->fetch_assoc();
        if ($enRow) {
            $enId = $enRow['id'];
        } else {
            $enId = $generator->generate();
            Db::getConn()->query("INSERT INTO en (id, word) VALUES ('$enId', '$value')");
        }

        $ruRow = Db::getConn()->query("SELECT * FROM ru WHERE word = '$translate'")->fetch_assoc();
        if ($ruRow) {
            $ruId = $ruRow['id'];
        } else {
            $ruId = $generator->generate();
            Db::getConn()->query("INSERT INTO ru (id, word) VALUES ('$ruId', '$translate')");
        }

        Db::getConn()->query("INSERT INTO relation (id, enId, ruId) VALUES ('$relId', '$enId', '$ruId')");
    }

    /**
     * Получает перевод слова из БД по значению
     */
    public function translate()
    {
        $value = $this->value;

        if ($this->lang == 'en') {
            $enRow = Db::getConn()->query("SELECT * FROM en WHERE word = '$value'")->fetch_assoc();
            $enId = $enRow['id'];

            $relationRows = Db::getConn()->query("SELECT * FROM relation WHERE enId = '$enId'");

            while ($relationRow = $relationRows->fetch_assoc()) {
                $ruId = $relationRow['ruId'];

                $ruRow = Db::getConn()->query("SELECT * FROM ru WHERE id = '$ruId'")->fetch_assoc();

                array_push($this->translate, $ruRow['word']);
            }
        }

        if ($this->lang == 'ru') {
            $ruRow = Db::getConn()->query("SELECT * FROM ru WHERE word = '$value'")->fetch_assoc();
            $ruId = $ruRow['id'];

            $relationRows = Db::getConn()->query("SELECT * FROM relation WHERE ruId = '$ruId'");

            while ($relationRow = $relationRows->fetch_assoc()) {
                $enId = $relationRow['enId'];

                $enRow = Db::getConn()->query("SELECT * FROM en WHERE id = '$enId'")->fetch_assoc();

                array_push($this->translate, $enRow['word']);
            }
        }
    }

    /**
     * Получает случайное слово из БД и переводит его
     */
    public function get()
    {
//        $count = Db::getConn()->query("SELECT COUNT(*) as count FROM en")->fetch_assoc();

        $word = Db::getConn()->query("SELECT * FROM en ORDER BY RAND()")->fetch_assoc();
        $this->value = $word['word'];

        $this->translate();
    }

    /**
     * @param string $lang
     */
    public function setLang(string $lang)
    {
        $this->lang = $lang;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value)
    {
        $this->value = $value;
    }

    /**
     * @param array $translate
     */
    public function setTranslate(array $translate)
    {
        $this->translate = $translate;
    }

    /**
     * @return string
     */
    public function getLang(): string
    {
        return $this->lang;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return array
     */
    public function getTranslate(): array
    {
        return $this->translate;
    }

}