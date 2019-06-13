<?php

namespace AbstractDAOs;

defined('BASEPATH') OR exit('No direct script access allowed');

class Sorteios {

    private $inscritos;
    private $bilhetesGanhador;
    private $bilhetesSorteio;
    private $estatisticas;
    private $sorteiosConcluidos;
    private $sorteiosDisponiveis;
    private $sorteioConcluido;
    private $sorteioDisponivel;
    private $sorteado;
    private $busca;

    public function __construct() {
        $this->inscritos = new \stdClass();
        $this->bilhetesGanhador = new \stdClass();
        $this->bilhetesSorteio = new \stdClass();
        $this->estatisticas = new \stdClass();
        $this->sorteiosConcluidos = new \stdClass();
        $this->busca = new \stdClass();
        $this->sorteiosDisponiveis = new \stdClass();
        $this->sorteioConcluido = new \stdClass();
        $this->sorteioDisponivel = new \stdClass();
        $this->sorteado = array();
    }

    public function getInscritos() {
        return $this->inscritos;
    }

    public function setInscritos($inscritos) {
        $this->inscritos = $inscritos;
        return $this;
    }

    public function qtdTicketsUser() {
        return $this->bilhetesGanhador;
    }

    public function setBilhetesGanhador($bilhetesGanhador) {
        $this->bilhetesGanhador = $bilhetesGanhador;
        return $this;
    }

    public function getBilhetesSorteio() {
        return $this->bilhetesSorteio;
    }

    public function setBilhetesSorteio($bilhetesSorteio) {
        $this->bilhetesSorteio = $bilhetesSorteio;
        return $this;
    }

    public function getestatisticas() {
        return $this->estatisticas;
    }

    public function setestatisticas($estatisticas) {
        $this->estatisticas = $estatisticas;
        return $this;
    }

    public function getSorteiosConcluidos() {
        return $this->sorteiosConcluidos;
    }

    public function setSorteiosConcluidos($sorteiosConcluidos) {
        $this->sorteiosConcluidos = $sorteiosConcluidos;
        return $this;
    }

    public function getSorteiosDisponiveis() {
        return $this->sorteiosDisponiveis;
    }

    public function setSorteiosDisponiveis($sorteiosDisponiveis) {
        return $this->sorteiosDisponiveis = $sorteiosDisponiveis;
    }

    public function getSorteioConcluido() {
        return $this->sorteioConcluido;
    }

    public function setSorteioConcluido($sorteioConcluido) {
        return $this->sorteioConcluido = $sorteioConcluido;
    }

    public function getSorteioDisponivel() {
        return $this->sorteioDisponivel;
    }

    public function setSorteioDisponivel($sorteioDisponivel) {
        return $this->sorteioDisponivel = $sorteioDisponivel;
    }

    public function getSorteado() {
        return $this->sorteado;
    }

    public function setSorteado($sorteado) {
        $this->sorteado = $sorteado;
        return $this;
    }

    public function getbusca() {
        return $this->busca;
    }

    public function setbusca($busca) {
        $this->busca = $busca;
        return $this;
    }

}