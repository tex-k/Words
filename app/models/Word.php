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

    public function record() {

        $value = $this->value;
        $translate = $this->translate[0];

        $generator = (new StrGenerator());

        $idEn = $generator->generate();
        $idRu = $generator->generate();
        $idRel = $generator->generate();

        Db::getConn()->query("INSERT INTO en (id, word) VALUES ('$idEn', '$value')");
        Db::getConn()->query("INSERT INTO ru (id, word) VALUES ('$idRu', '$translate')");
        Db::getConn()->query("INSERT INTO relation (id, enId, ruId) VALUES ('$idRel', '$idEn', '$idRu')");
    }
}