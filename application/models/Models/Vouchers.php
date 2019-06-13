<?php 

namespace Models;

class Vouchers{

    private $voucher;
    private $descricao;
    private $bilhetes;
    private $validade;
    private $usuario;
    private $usado;
    private $ativo;

    function __construct() {
        $this->voucher = "";
        $this->descricao = "";
        $this->bilhetes = 0;
        $this->validade = "0000-00-00 00:00";
        $this->usuario = 0;
        $this->usado = "0000-00-00 00:00";
        $this->ativo = 0;
    }

    /**
     * voucher
     * @type char
     */
    public function getVoucher() {
        return $this->voucher;
    }
    public function setVoucher($voucher) {
        $this->voucher = $voucher;
        return $this;
    }

    /**
     * descricao
     * @type varchar
     */
    public function getDescricao() {
        return $this->descricao;
    }
    public function setDescricao($descricao) {
        $this->descricao = $descricao;
        return $this;
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
     * validade
     * @type datetime
     */
    public function getValidade() {
        return $this->validade;
    }
    public function setValidade($validade) {
        $this->validade = $validade;
        return $this;
    }

    /**
     * usuario
     * @type int
     */
    public function getUsuario() {
        return $this->usuario;
    }
    public function setUsuario($usuario) {
        $this->usuario = $usuario;
        return $this;
    }

    /**
     * usado
     * @type datetime
     */
    public function getUsado() {
        return $this->usado;
    }
    public function setUsado($usado) {
        $this->usado = $usado;
        return $this;
    }

    /**
     * ativo
     * @type tinyint
     */
    public function getAtivo() {
        return $this->ativo;
    }
    public function setAtivo($ativo) {
        $this->ativo = $ativo;
        return $this;
    }

}