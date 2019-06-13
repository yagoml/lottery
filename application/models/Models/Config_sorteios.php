<?php 

namespace Models;

class Config_sorteios{

    private $preco_bilhete;
    private $mult_bilhete;
    private $mult_premio;
    private $mult_bonus_xp_bilhetes;
    private $mult_bonus_xp_premio;
    private $desc_arrecadado;

    function __construct() {
        $this->preco_bilhete = 0.00;
        $this->mult_bilhete = 0;
        $this->mult_premio = 0;
        $this->mult_bonus_xp_bilhetes = 0;
        $this->mult_bonus_xp_premio = 0.00;
        $this->desc_arrecadado = 0;
    }

    /**
     * preco_bilhete
     * @type decimal
     */
    public function getPreco_bilhete() {
        return $this->preco_bilhete;
    }
    public function setPreco_bilhete($preco_bilhete) {
        $this->preco_bilhete = $preco_bilhete;
        return $this;
    }

    /**
     * mult_bilhete
     * @type int
     */
    public function getMult_bilhete() {
        return $this->mult_bilhete;
    }
    public function setMult_bilhete($mult_bilhete) {
        $this->mult_bilhete = $mult_bilhete;
        return $this;
    }

    /**
     * mult_premio
     * @type int
     */
    public function getMult_premio() {
        return $this->mult_premio;
    }
    public function setMult_premio($mult_premio) {
        $this->mult_premio = $mult_premio;
        return $this;
    }

    /**
     * mult_bonus_xp_bilhetes
     * @type int
     */
    public function getMult_bonus_xp_bilhetes() {
        return $this->mult_bonus_xp_bilhetes;
    }
    public function setMult_bonus_xp_bilhetes($mult_bonus_xp_bilhetes) {
        $this->mult_bonus_xp_bilhetes = $mult_bonus_xp_bilhetes;
        return $this;
    }

    /**
     * mult_bonus_xp_premio
     * @type decimal
     */
    public function getMult_bonus_xp_premio() {
        return $this->mult_bonus_xp_premio;
    }
    public function setMult_bonus_xp_premio($mult_bonus_xp_premio) {
        $this->mult_bonus_xp_premio = $mult_bonus_xp_premio;
        return $this;
    }

    /**
     * desc_arrecadado
     * @type int
     */
    public function getDesc_arrecadado() {
        return $this->desc_arrecadado;
    }
    public function setDesc_arrecadado($desc_arrecadado) {
        $this->desc_arrecadado = $desc_arrecadado;
        return $this;
    }

}