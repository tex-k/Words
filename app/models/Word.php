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

        $enId = $this->findIfExists('en', $value, $generator);
        $ruId = $this->findIfExists('ru', $translate, $generator);

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
        $word = Db::getConn()->query("SELECT * FROM en ORDER BY RAND()")->fetch_assoc();
        $this->value = $word['word'];

        $this->translate();
    }

    /**
     * Вспомогательная функция проверяет есть ли в таблице записываемое слово
     * @param string $table
     * @param string $value
     * @param StrGenerator $generator
     * @return string
     */
    private function findIfExists(string $table, string $value, StrGenerator $generator)
    {
        $row = Db::getConn()->query("SELECT * FROM $table WHERE word = '$value'")->fetch_assoc();
        if ($row) {
            $id = $row['id'];
        } else {
            $id = $generator->generate();
            Db::getConn()->query("INSERT INTO $table (id, word) VALUES ('$id', '$value')");
        }

        return $id;
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