<?php 

namespace Models;

class Saldo_company{

    private $saldo;

    function __construct() {
        $this->saldo = 0.00;
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

}