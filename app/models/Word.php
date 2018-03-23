<?php

namespace app\models;

use app\services\Db;
use app\services\StrGenerator;

class Word {
    private $lang = '';
    private $value = '';
    private $translate = [];

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

    /**
     * Записывает фразу и перевод в таблицы
     */
    public function record()
    {
        $value = $this->value;
        $translate = $this->translate[0];

        $generator = (new StrGenerator());

        $ruId = $generator->generate();
        $relId = $generator->generate();

        $result = Db::getConn()->query("SELECT * FROM en WHERE word = '$value'");
        if ($result) {
            $enId = $result->fetch_assoc()['id'];
        } else {
            $enId = $generator->generate();
            Db::getConn()->query("INSERT INTO en (id, word) VALUES ('$enId', '$value')");
        }

        Db::getConn()->query("INSERT INTO ru (id, word) VALUES ('$ruId', '$translate')");
        Db::getConn()->query("INSERT INTO relation (id, enId, ruId) VALUES ('$relId', '$enId', '$ruId')");
    }

    public function get()
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
    }
}