<?php 

namespace Models;

class Percent_comissoes{

    private $ordem;
    private $niveis;
    private $cod_comissao;
    private $percent;

    function __construct() {
        $this->ordem = 0;
        $this->niveis = "";
        $this->cod_comissao = "";
        $this->percent = 0;
    }

    /**
     * ordem
     * @type int
     */
    public function getOrdem() {
        return $this->ordem;
    }
    public function setOrdem($ordem) {
        $this->ordem = $ordem;
        return $this;
    }

    /**
     * niveis
     * @type varchar
     */
    public function getNiveis() {
        return $this->niveis;
    }
    public function setNiveis($niveis) {
        $this->niveis = $niveis;
        return $this;
    }

    /**
     * cod_comissao
     * @type varchar
     */
    public function getCod_comissao() {
        return $this->cod_comissao;
    }
    public function setCod_comissao($cod_comissao) {
        $this->cod_comissao = $cod_comissao;
        return $this;
    }

    /**
     * percent
     * @type int
     */
    public function getPercent() {
        return $this->percent;
    }
    public function setPercent($percent) {
        $this->percent = $percent;
        return $this;
    }

}