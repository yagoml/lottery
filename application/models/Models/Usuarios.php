<?php 

namespace Models;

class Usuarios{

    private $nome;
    private $cpf;
    private $xp;
    private $password;
    private $celular;
    private $email;
    private $saldo;
    private $bilhetes;
    private $patrocinador;
    private $data_cadastro;
    private $apelido;
    private $ultimo_login;

    function __construct() {
        $this->nome = "";
        $this->cpf = "";
        $this->xp = 0;
        $this->password = "";
        $this->celular = "";
        $this->email = "";
        $this->saldo = 0.00;
        $this->bilhetes = 0;
        $this->patrocinador = 0;
        $this->data_cadastro = "0000-00-00 00:00";
        $this->apelido = "";
        $this->ultimo_login = "0000-00-00 00:00";
    }

    /**
     * nome
     * @type varchar
     */
    public function getNome() {
        return $this->nome;
    }
    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    /**
     * cpf
     * @type varchar
     */
    public function getCpf() {
        return $this->cpf;
    }
    public function setCpf($cpf) {
        $this->cpf = $cpf;
        return $this;
    }

    /**
     * xp
     * @type int
     */
    public function getXp() {
        return $this->xp;
    }
    public function setXp($xp) {
        $this->xp = $xp;
        return $this;
    }

    /**
     * password
     * @type varchar
     */
    public function getPassword() {
        return $this->password;
    }
    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    /**
     * celular
     * @type varchar
     */
    public function getCelular() {
        return $this->celular;
    }
    public function setCelular($celular) {
        $this->celular = $celular;
        return $this;
    }

    /**
     * email
     * @type varchar
     */
    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
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
     * patrocinador
     * @type int
     */
    public function getPatrocinador() {
        return $this->patrocinador;
    }
    public function setPatrocinador($patrocinador) {
        $this->patrocinador = $patrocinador;
        return $this;
    }

    /**
     * data_cadastro
     * @type datetime
     */
    public function getData_cadastro() {
        return $this->data_cadastro;
    }
    public function setData_cadastro($data_cadastro) {
        $this->data_cadastro = $data_cadastro;
        return $this;
    }

    /**
     * apelido
     * @type varchar
     */
    public function getApelido() {
        return $this->apelido;
    }
    public function setApelido($apelido) {
        $this->apelido = $apelido;
        return $this;
    }

    /**
     * ultimo_login
     * @type datetime
     */
    public function getUltimo_login() {
        return $this->ultimo_login;
    }
    public function setUltimo_login($ultimo_login) {
        $this->ultimo_login = $ultimo_login;
        return $this;
    }

}