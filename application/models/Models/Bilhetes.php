<?php 

namespace Models;

class Bilhetes{

    private $numero;
    private $sorteios_id;
    private $usuarios_id;

    function __construct() {
        $this->numero_sorteio = 0;
        $this->sorteios_id = 0;
        $this->usuarios_id = 0;
    }

    /**
     * numero
     * @type int
     */
    public function getNumero() {
        return $this->numero_sorteio;
    }
    public function setNumero($numero) {
        $this->numero_sorteio = $numero;
        return $this;
    }

    /**
     * sorteios_id
     * @type int
     */
    public function getSorteios_id() {
        return $this->sorteios_id;
    }
    public function setSorteios_id($sorteios_id) {
        $this->sorteios_id = $sorteios_id;
        return $this;
    }

    /**
     * usuarios_id
     * @type int
     */
    public function getUsuarios_id() {
        return $this->usuarios_id;
    }
    public function setUsuarios_id($usuarios_id) {
        $this->usuarios_id = $usuarios_id;
        return $this;
    }

}