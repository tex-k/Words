<?php

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

//    public function record() {
//        $conn = mysqli_connect('localhost', 'aleksey', '1234', 'words');
//
//        $value = $this->value;
//
//        $conn->query("INSERT INTO en (id, word) VALUES ('1', $value)");
//    }
}