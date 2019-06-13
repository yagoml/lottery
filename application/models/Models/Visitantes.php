<?php 

namespace Models;

class Visitantes{

    private $sessao;
    private $ip;
    private $tempo;

    function __construct() {
        $this->sessao = "";
        $this->ip = "";
        $this->tempo = "0000-00-00 00:00";
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

}