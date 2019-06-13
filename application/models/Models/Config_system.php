<?php 

namespace Models;

class Config_system{

    private $titulo;

    function __construct() {
        $this->titulo = "";
    }

    /**
     * titulo
     * @type varchar
     */
    public function getTitulo() {
        return $this->titulo;
    }
    public function setTitulo($titulo) {
        $this->titulo = $titulo;
        return $this;
    }

}