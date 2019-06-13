<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function index() {
        $this->load->view('index');
    }

    public function getIndexData() {
        $this->load->model('usuarios_model');
        $this->load->model('sorteios_model');
        $this->load->model('rankings_model');

        $data['sorteios'] = $this->sorteios_model->getSorteiosConcluidos();
        $data['estatisticas'] = $this->sorteios_model->estatisticas();

        $data['inscritos'] = count(\Repository\Usuarios::getUsuarios());
        $data['usuariosOnline'] = $this->usuarios_model->onlineUsers();
        $data['visitantes'] = $this->usuarios_model->onlineGuests();
        $data['topFaturamento'] = $this->rankings_model->topFaturamento(5);
        $data['topNivel'] = $this->rankings_model->topNivel(5);
        $data['topJogadores'] = $this->rankings_model->topJogadores(5);
        $data['topGanhadores'] = $this->rankings_model->topGanhadores(5);
        $data['topIndicacoes'] = $this->rankings_model->topIndicacoes(5);

        echo json_encode($data);
    }

}
