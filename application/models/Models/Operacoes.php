<?php 

namespace Models;

class Operacoes{

    private $nome;
    private $tipo;

    function __construct() {
        $this->nome = "";
        $this->tipo = "";
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
     * tipo
     * @type char
     */
    public function getTipo() {
        return $this->tipo;
    }
    public function setTipo($tipo) {
        $this->tipo = $tipo;
        return $this;
    }

}