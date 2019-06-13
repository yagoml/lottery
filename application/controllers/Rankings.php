<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Rankings
 *
 * @author Yago M. Laignier
 */
class Rankings extends CI_Controller {

    public function topJogadores() {
        $data['pagina'] = 'rankings/top_jogadores';
        $data['title'] = 'Top Jogadores';
        $data['breadCrumb'] = array(
                    0 => (object) array('section' => 'Início', 'link' => base_url()),
                    1 => (object) array('section' => $data['title'], 'link' => '')
        );
        $this->load->model('rankings_model');
        $data['topJogadores'] = $this->rankings_model->topJogadores();
        $this->load->view('index', $data);
    }

    public function topFaturamento() {
        $data['pagina'] = 'rankings/top_faturamento';
        $data['title'] = 'Top Faturamento';
        $data['breadCrumb'] = array(
                    0 => (object) array('section' => 'Início', 'link' => base_url()),
                    1 => (object) array('section' => $data['title'], 'link' => '')
        );
        $this->load->model('rankings_model');
        $data['topFaturamento'] = $this->rankings_model->topFaturamento();
        $this->load->view('index', $data);
    }

    public function topGanhadores() {
        $data['pagina'] = 'rankings/top_ganhadores';
        $data['title'] = 'Top Ganhadores';
        $data['breadCrumb'] = array(
                    0 => (object) array('section' => 'Início', 'link' => base_url()),
                    1 => (object) array('section' => $data['title'], 'link' => '')
        );
        $this->load->model('rankings_model');
        $data['topGanhadores'] = $this->rankings_model->topGanhadores();
        $this->load->view('index', $data);
    }

    public function topIndicacoes() {
        $data['pagina'] = 'rankings/top_indicacoes';
        $data['title'] = 'Top Indicações';
        $data['breadCrumb'] = array(
                    0 => (object) array('section' => 'Início', 'link' => base_url()),
                    1 => (object) array('section' => $data['title'], 'link' => '')
        );
        $this->load->model('rankings_model');
        $data['topIndicacoes'] = $this->rankings_model->topIndicacoes();
        $this->load->view('index', $data);
    }

    public function topNivel() {
        $data['pagina'] = 'rankings/top_nivel';
        $data['title'] = 'Top Nível';
        $data['breadCrumb'] = array(
                    0 => (object) array('section' => 'Início', 'link' => base_url()),
                    1 => (object) array('section' => $data['title'], 'link' => base_url(''))
        );
        $this->load->model('rankings_model');
        $data['topNivel'] = $this->rankings_model->topNivel();
        $this->load->view('index', $data);
    }

}
