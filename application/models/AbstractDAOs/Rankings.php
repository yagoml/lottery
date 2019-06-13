<?php

namespace AbstractDAOs;

defined('BASEPATH') OR exit('No direct script access allowed');

class Rankings {

    private $topNivel;
    private $topFaturamento;
    private $topGanhadores;
    private $topIndicacoes;
    private $topJogadores;

    public function __construct() {
        $this->topNivel = new \stdClass();
        $this->topFaturamento = new \stdClass();
        $this->topGanhadores = new \stdClass();
        $this->topIndicacoes = new \stdClass();
        $this->topJogadores = [];
    }

    public function getTopNivel() {
        return $this->topNivel;
    }

    public function setTopNivel($topNivel) {
        $this->topNivel = $topNivel;
        return $this;
    }

    public function getTopFaturamento() {
        return $this->topFaturamento;
    }

    public function setTopFaturamento($topFaturamento) {
        $this->topFaturamento = $topFaturamento;
        return $this;
    }

    public function getTopGanhadores() {
        return $this->topGanhadores;
    }

    public function setTopGanhadores($topGanhadores) {
        $this->topGanhadores = $topGanhadores;
        return $this;
    }

    public function getTopIndicacoes() {
        return $this->topIndicacoes;
    }

    public function setTopIndicacoes($topIndicacoes) {
        $this->topIndicacoes = $topIndicacoes;
        return $this;
    }

    public function getTopJogadores() {
        return $this->topJogadores;
    }

    public function setTopJogadores($topJogadores) {
        $this->topJogadores = $topJogadores;
        return $this;
    }

}
