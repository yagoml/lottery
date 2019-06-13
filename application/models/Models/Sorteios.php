<?php 

namespace Models;

class Sorteios{

    private $data_sorteio;
    private $bilhete_premiado;
    private $preco;
    private $premio;
    private $min_bilhetes;
    private $show_users;

    function __construct() {
        $this->data_sorteio = "0000-00-00 00:00";
        $this->bilhete_premiado = 0;
        $this->preco = 0;
        $this->premio = 0.00;
        $this->min_bilhetes = 0;
        $this->show_users = 0;
    }

    /**
     * data_sorteio
     * @type datetime
     */
    public function getData_sorteio() {
        return $this->data_sorteio;
    }
    public function setData_sorteio($data_sorteio) {
        $this->data_sorteio = $data_sorteio;
        return $this;
    }

    /**
     * bilhete_premiado
     * @type int
     */
    public function getBilhete_premiado() {
        return $this->bilhete_premiado;
    }
    public function setBilhete_premiado($bilhete_premiado) {
        $this->bilhete_premiado = $bilhete_premiado;
        return $this;
    }

    /**
     * preco
     * @type int
     */
    public function getPreco() {
        return $this->preco;
    }
    public function setPreco($preco) {
        $this->preco = $preco;
        return $this;
    }

    /**
     * premio
     * @type decimal
     */
    public function getPremio() {
        return $this->premio;
    }
    public function setPremio($premio) {
        $this->premio = $premio;
        return $this;
    }

    /**
     * min_bilhetes
     * @type int
     */
    public function getMin_bilhetes() {
        return $this->min_bilhetes;
    }
    public function setMin_bilhetes($min_bilhetes) {
        $this->min_bilhetes = $min_bilhetes;
        return $this;
    }

    /**
     * show_users
     * @type tinyint
     */
    public function getShow_users() {
        return $this->show_users;
    }
    public function setShow_users($show_users) {
        $this->show_users = $show_users;
        return $this;
    }

}