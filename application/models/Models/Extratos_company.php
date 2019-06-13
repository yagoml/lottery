<?php 

namespace Models;

class Extratos_company{

    private $valor;
    private $saldo;
    private $data;
    private $operacao;

    function __construct() {
        $this->valor = 0.00;
        $this->saldo = 0.00;
        $this->data = "0000-00-00 00:00";
        $this->operacao = "";
    }

    /**
     * valor
     * @type decimal
     */
    public function getValor() {
        return $this->valor;
    }
    public function setValor($valor) {
        $this->valor = $valor;
        return $this;
    }

    /**
     * saldo
     * @type decimal
     */
    public function getSaldo() {
        return $this->saldo;
    }
    public function setSaldo($saldo) {
        $this->saldo = $saldo;
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
     * operacao
     * @type varchar
     */
    public function getOperacao() {
        return $this->operacao;
    }
    public function setOperacao($operacao) {
        $this->operacao = $operacao;
        return $this;
    }

}