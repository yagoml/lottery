<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Rankings_model
 *
 * @author Yago M. Laignier
 */
class Rankings_model extends CI_Model {

    private $rankings;

    public function __construct() {
        $this->rankings = new \AbstractDAOs\Rankings();
        parent::__construct();
    }

    public function topNivel($limit = 0) {
        try {
            $query = 'SELECT *, N.nivel FROM usuarios U, niveis N WHERE N.nivel = (SELECT nivel FROM niveis WHERE exp <= U.xp ORDER BY exp DESC LIMIT 1) ORDER BY U.xp DESC';
            $query .= $limit != 0 ? " LIMIT $limit" : "";

            $this->rankings->setTopNivel($this->db->query($query)->result());
            return $this->rankings->getTopNivel();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function topFaturamento($limit = 0) {
        try {
            $premios = $this->db->query('SELECT U.id_usuario, U.apelido, N.nivel, SUM(S.premio) AS ganhos FROM (sorteios S, bilhetes B, usuarios U, niveis N) WHERE S.bilhete_premiado = B.id_bilhete AND B.usuarios_id = U.id_usuario AND N.nivel = (SELECT nivel FROM niveis WHERE EXP <= U.xp ORDER BY EXP DESC LIMIT 1) GROUP BY U.id_usuario ORDER BY ganhos DESC' . ($limit ? " LIMIT $limit" : ""))->result();
            $this->load->model('bank_model');
            $idsForam = array();

            foreach ($premios as &$topPremio) {
                $topPremio->ganhos += $this->bank_model->getTotalComissoes($topPremio->id_usuario);
                $idsForam[] = $topPremio->id_usuario;
            }
            
            $comissoes = $this->topComissoes($limit);
            foreach ($comissoes as $c => $comissao) {
                if (in_array($comissao->id_usuario, $idsForam)) {
                    unset($comissoes[$c]);
                }
            }

            if ($limit) {
                $topFaturamento = array_slice(array_merge($premios, $comissoes), 0, $limit);
            } else {
                $topFaturamento = array_merge($premios, $comissoes);
            }
            
            usort($topFaturamento, 'compareGanhos');

            $this->rankings->setTopFaturamento($topFaturamento);
            return $this->rankings->getTopFaturamento();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function topComissoes($limit = 0) {
        try {
            return $this->db->query("SELECT U.id_usuario, U.apelido, N.nivel, SUM(C.valor) AS ganhos FROM usuarios U, niveis N, comissoes C WHERE U.id_usuario = C.id_patrocinador AND N.nivel = (SELECT nivel FROM niveis WHERE EXP <= U.xp ORDER BY EXP DESC LIMIT 1) GROUP BY U.id_usuario ORDER BY ganhos DESC" . ($limit ? " LIMIT $limit" : ""))->result();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function topGanhadores($limit = 0) {
        try {
            $query = "SELECT *, count(S.bilhete_premiado) AS sorteios_ganhos FROM sorteios S, bilhetes B, usuarios U, 
niveis N WHERE S.bilhete_premiado = B.id_bilhete AND B.usuarios_id = U.id_usuario AND N.nivel = (SELECT nivel FROM niveis WHERE exp <= U.xp order by exp DESC LIMIT 1) group by U.id_usuario ORDER BY sorteios_ganhos DESC";
            $query .= $limit != 0 ? " LIMIT $limit" : "";

            $this->rankings->setTopGanhadores($this->db->query($query)->result());
            return $this->rankings->getTopGanhadores();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function topIndicacoes($limit = 0) {
        try {
            $query = 'SELECT *, count(U.patrocinador) AS indicacoes FROM usuarios U, usuarios I, niveis N WHERE U.patrocinador != 0 AND I.id_usuario = U.patrocinador AND N.nivel = (SELECT nivel FROM niveis WHERE exp <= I.xp order by exp DESC LIMIT 1) GROUP BY I.id_usuario ORDER BY indicacoes DESC ';
            $query .= $limit != 0 ? " LIMIT $limit" : "";

            $this->rankings->setTopIndicacoes($this->db->query($query)->result());
            return $this->rankings->getTopIndicacoes();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function topJogadores($limit = 0) {
        try {
            $query = 'SELECT *, count(*) as bilhetes FROM bilhetes GROUP BY usuarios_id ORDER BY bilhetes DESC';
            $query .= $limit != 0 ? " LIMIT $limit" : "";
            $bilhetes = $this->db->query($query)->result();
            $gamers = array();

            foreach ($bilhetes as $b => $bilhete) {
                $gamers[$b] = $this->db->get_where('usuarios', array('id_usuario' => $bilhete->usuarios_id))->row();
                $gamers[$b]->bilhetes = $bilhete->bilhetes;
                $gamers[$b]->nivel = Repository\Usuarios::getUserNivel($gamers[$b]->id_usuario);
            }
            $topJogadores = new \AbstractDAOs\Rankings();
            $topJogadores->setTopJogadores($gamers);
            return $topJogadores->getTopJogadores();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}
