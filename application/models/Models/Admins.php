<?php 

namespace Models;

class Admins{

    private $nome;
    private $login;
    private $email;
    private $password;

    function __construct() {
        $this->nome = "";
        $this->login = "";
        $this->email = "";
        $this->password = "";
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
     * login
     * @type varchar
     */
    public function getLogin() {
        return $this->login;
    }
    public function setLogin($login) {
        $this->login = $login;
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

}