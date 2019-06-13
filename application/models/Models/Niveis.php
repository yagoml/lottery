<?php 

namespace Models;

class Niveis{

    private $nivel;
    private $exp;

    function __construct() {
        $this->nivel = 0;
        $this->exp = 0;
    }

    /**
     * nivel
     * @type int
     */
    public function getNivel() {
        return $this->nivel;
    }
    public function setNivel($nivel) {
        $this->nivel = $nivel;
        return $this;
    }

    /**
     * exp
     * @type int
     */
    public function getExp() {
        return $this->exp;
    }
    public function setExp($exp) {
        $this->exp = $exp;
        return $this;
    }

}