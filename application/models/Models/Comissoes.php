<?php 

namespace Models;

class Comissoes{

    private $id_patrocinador;
    private $id_usuario;
    private $operacao;
    private $valor;
    private $data;

    function __construct() {
        $this->id_patrocinador = 0;
        $this->id_usuario = 0;
        $this->operacao = "";
        $this->valor = 0.00;
        $this->data = "0000-00-00 00:00";
    }

    /**
     * id_patrocinador
     * @type int
     */
    public function getId_patrocinador() {
        return $this->id_patrocinador;
    }
    public function setId_patrocinador($id_patrocinador) {
        $this->id_patrocinador = $id_patrocinador;
        return $this;
    }

    /**
     * id_usuario
     * @type int
     */
    public function getId_usuario() {
        return $this->id_usuario;
    }
    public function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
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

}