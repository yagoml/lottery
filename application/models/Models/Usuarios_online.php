<?php 

namespace Models;

class Usuarios_online{

    private $sessao;
    private $tempo;
    private $ip;

    function __construct() {
        $this->sessao = "";
        $this->tempo = "0000-00-00 00:00";
        $this->ip = "";
    }

    /**
     * sessao
     * @type text
     */
    public function getSessao() {
        return $this->sessao;
    }
    public function setSessao($sessao) {
        $this->sessao = $sessao;
        return $this;
    }

    /**
     * tempo
     * @type datetime
     */
    public function getTempo() {
        return $this->tempo;
    }
    public function setTempo($tempo) {
        $this->tempo = $tempo;
        return $this;
    }

    /**
     * ip
     * @type varchar
     */
    public function getIp() {
        return $this->ip;
    }
    public function setIp($ip) {
        $this->ip = $ip;
        return $this;
    }

}