<?php 

namespace Models;

class Vendas{

    private $bilhetes;
    private $data;
    private $metodo_pgto;

    function __construct() {
        $this->bilhetes = 0;
        $this->data = "0000-00-00 00:00";
        $this->metodo_pgto = "";
    }

    /**
     * bilhetes
     * @type int
     */
    public function getBilhetes() {
        return $this->bilhetes;
    }
    public function setBilhetes($bilhetes) {
        $this->bilhetes = $bilhetes;
        return $this;
    }

    /**
     * data
     * @type datetime
     */
    public function getData() {
        return $this->data;
    }
    public function setData($data) {
        $this->data = $data;
        return $this;
    }

    /**
     * metodo_pgto
     * @type varchar
     */
    public function getMetodo_pgto() {
        return $this->metodo_pgto;
    }
    public function setMetodo_pgto($metodo_pgto) {
        $this->metodo_pgto = $metodo_pgto;
        return $this;
    }

}