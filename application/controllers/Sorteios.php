<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sorteios extends CI_Controller {

    public function index() {
        $data['pagina'] = 'sorteios/prox_sorteios';
        $this->load->model('sorteios_model');
        $data['title'] = 'Loteria';
        $data['breadCrumb'] = array(
            0 => (object) array('section' => 'Início', 'link' => base_url()),
            1 => (object) array('section' => $data['title'], 'link' => '')
        );

        $this->load->model('paginator_model');
        $pagination = $this->paginator_model->ciPaginatorFiltered('sorteios_model', 'getSorteiosDisponiveis', 0, 9, 'sorteios/index', 2);
        $data['sorteios'] = $pagination['itens'];
        $data['links'] = $pagination['links'];

        $data['sorteio'] = \RN\SorteioRN::applyPremio($data['sorteios']);

        $this->load->view('index', $data);
    }

    public function roletas() {
        $data['pagina'] = 'sorteios/prox_sorteios';
        $this->load->model('sorteios_model');
        $data['title'] = 'Roletas';
        $data['breadCrumb'] = array(
            0 => (object) array('section' => 'Início', 'link' => base_url()),
            1 => (object) array('section' => $data['title'], 'link' => '')
        );

        $this->load->model('paginator_model');
        $pagination = $this->paginator_model->ciPaginatorFiltered('sorteios_model', 'getSorteiosDisponiveis', 1, 9, 'sorteios/index', 3);
        $data['sorteios'] = $pagination['itens'];
        $data['links'] = $pagination['links'];

        $data['sorteios'] = \RN\SorteioRN::applyPremio($data['sorteios']);

        $this->load->view('index', $data);
    }

    public function concluidos() {
        $data['pagina'] = 'sorteios/sorteios_concluidos';
        $tipo = $this->uri->segment(3) == 'loteria' ? 0 : 1;
        $this->load->model('sorteios_model');

        if ($this->input->get() || $this->input->post()) { // post pro ajax, get pra paginação
            $filters = $this->input->get() ? $this->input->get() : $this->input->post();
            if ($this->sorteios_model->fitroValidation($filters)) {
                $filters['tipo'] = $tipo;
                $data['sorteios'] = $this->sorteios_model->filtro($filters);
                $data['filtroInfo'] = $this->sorteios_model->filtroInfo($filters);
                $pagination = $this->sorteios_model->filtroPagination($filters);
            }
        } else {
            $this->load->model('paginator_model');
            $pagination = $this->paginator_model->ciPaginatorFilters('sorteios_model', 'getSorteiosConcluidos', ['show_users' => $tipo], 12, 'sorteios/concluidos/' . $tipo ? 'roletas' : 'loteria');
        }

        $data['sorteios'] = $pagination['itens'];
        $data['links'] = $pagination['links'];

        $data['title'] = $tipo ? 'Roletas Premiadas' : 'Tickets Premiados';
        $data['breadCrumb'] = array(
            0 => (object) array('section' => 'Início', 'link' => base_url()),
            1 => (object) array('section' => $data['title'], 'link' => '')
        );

        if (isset($filters)) {
            if ($this->input->get()) {
                $this->load->view('index', $data);
            } else {
                $data['filters'] = $filters;
                $result = array(
                    'view' => $this->load->view($data['pagina'] . '_view', $data, true),
                );
                $this->output->set_output(json_encode($result));
            }
        } else {
            $this->load->view('index', $data);
        }
    }

    public function sorteio() {
        $key = $this->input->post('key');
        if ($key == 'aewmlk') {
            $this->load->model('sorteios_model');
            $this->sorteios_model->sortear();
        }
    }

    public function concluido($sorteioId) {
        $this->load->model('sorteios_model');
        $data['title'] = 'Sorteio';
        $data['breadCrumb'] = array(
            0 => (object) array('section' => 'Início', 'link' => base_url()),
            1 => (object) array('section' => 'Sorteios Concluídos', 'link' => base_url('sorteios/concluidos')),
            2 => (object) array('section' => $data['title'], 'link' => '')
        );
        $data['sorteio'] = $this->sorteios_model->getSorteioConcluido($sorteioId);

        if ($data['sorteio']->id_sorteio) {
            $this->load->model('paginator_model');
            $pagination = $this->paginator_model->ciPaginatorFiltered('sorteios_model', 'inscritos', $sorteioId, 25, 'sorteios/concluido/' . $sorteioId, 4);

            $data['inscritos'] = $pagination['itens'];

            $data['links'] = $pagination['links'];

            $filter = ['where' => $sorteioId];
            $data['numInscritos'] = count($this->sorteios_model->inscritos($filter));

            if ($data['sorteio']->bilhete_premiado != 0) {
                $data['ganhouCom'] = $this->sorteios_model->qtdTicketsUser($data['sorteio']->id_sorteio, $data['sorteio']->id_usuario);
                $data['ticketPremiado'] = \Repository\Sorteios::getTicket($data['sorteio']->bilhete_premiado);
            }

            $data['pagina'] = 'sorteios/concluido';
            $this->load->view('index', $data);
        } else {
            redirect('sorteios/concluidos');
        }
    }

    public function disponivel($sorteioId) {
        $this->load->model('sorteios_model');
        $data['sorteio'] = $this->sorteios_model->getSorteioDisponivel($sorteioId);
        $data['title'] = $data['sorteio']->show_users ? 'Roletas' : 'Loteria';
        $data['breadCrumb'] = array(
            0 => (object) array('section' => 'Início', 'link' => base_url()),
            1 => (object) array('section' => $data['title'], 'link' => base_url('sorteios')),
            2 => (object) array('section' => $data['title'] . ' ' . $data['sorteio']->numero_sorteio, 'link' => '')
        );
        $this->load->model('paginator_model');

        if ($data['sorteio']->id_sorteio) {
            $data['pagina'] = 'sorteios/disponivel';

            $data['sorteio'] = current(\RN\SorteioRN::applyPremio(array($data['sorteio'])));

            $pagination = $this->paginator_model->ciPaginatorFiltered('sorteios_model', 'inscritos', $sorteioId, 25, 'sorteios/disponivel/' . $sorteioId, 4);

            $data['inscritos'] = $pagination['itens'];
            $data['links'] = $pagination['links'];

            if ($this->session->userdata('user')['id']) {
                if ($data['sorteio']->show_users) {
                    $data['qtdTicketsUser'] = $this->sorteios_model->qtdTicketsUser($data['sorteio']->id_sorteio, $this->session->userdata('user')['id']);
                } else {
                    $data['ticketsUser'] = $this->sorteios_model->getTicketsUser($data['sorteio']->id_sorteio, $this->session->userdata('user')['id']);
                    $data['qtdTicketsUser'] = $this->sorteios_model->qtdTicketsUser($data['sorteio']->id_sorteio, $this->session->userdata('user')['id']);
                }
            }

            $filter = ['where' => $sorteioId];
            $data['numInscritos'] = count($this->sorteios_model->inscritos($filter));

            $this->load->view('index', $data);
        } else {
            redirect('sorteios');
        }
    }

    public function participar() {
        if ($this->session->userdata('user')['id']) {
            $this->load->model('sorteios_model');
            $this->sorteios_model->addJogador($this->input->post('sorteio'));
        }
    }

    public function tickets() {
        if ($this->session->userdata('user')['id']) {
            $data['pagina'] = 'sorteios/tickets';
            $this->load->model('bank_model');
            $data['saldo'] = $this->bank_model->getSaldo($this->session->userdata('user')['id']);
            $data['title'] = 'Comprar Tickets';

            $data['breadCrumb'] = array(
                0 => (object) array('section' => 'Início', 'link' => base_url()),
                1 => (object) array('section' => $data['title'], 'link' => ''),
            );
        } else {
            redirect('auth');
        }

        $this->load->view('index', $data);
    }

    public function comprarTickets() {
        if ($this->session->userdata('user')['id']) {
            $this->load->model('bank_model');
            $this->bank_model->comprarTickets($this->session->userdata('user')['id'], $this->input->post('qtd'), $this->input->post());
        }
    }

    public function resultSorteio() {
        $this->load->model('sorteios_model');
        echo json_encode($this->sorteios_model->resultSorteio($this->input->post('idSorteio')));
    }

    public function infoSorteio() {
        $this->load->model('sorteios_model');
        $idSorteio = $this->input->post('idSorteio');
        $data['users'] = $this->sorteios_model->getUsersOfSorteio($idSorteio);
        $data['numSegments'] = count($data['users']);
        $data['rolette'] = array();
        $totalBilhetes = $this->sorteios_model->getTotalBilhetes($idSorteio);

        foreach ($data['users'] as $key => $user) {
            $percentUser = $user->bilhetes / $totalBilhetes * 100;
            $data['rolette'][] = array(
                'userId' => $user->id_usuario,
                'fillStyle' => RN\SorteioRN::random_color(),
                'textFillStyle' => '#FFFFFF',
                'text' => $user->apelido . ' (' . number_format($percentUser, 0, '.', '.') . '%)',
                'size' => RN\SorteioRN::winwheelPercentToDegrees($percentUser), // Note use of winwheelPercentToDegrees()
                'moreInfo' => '<p>' . $user->apelido . '</p>');
        }

        echo json_encode($data);
    }

    public function bilhetesRandom() {
        $this->load->model('sorteios_model');
        $idSorteio = $this->input->post('idSorteio');
        $idBilhete = $this->sorteios_model->getSorteioConcluido($idSorteio)->bilhete_premiado;
        $data['tickets'] = $this->sorteios_model->ticketsSorteio($idSorteio);
        $data['winnerTicket'] = $this->db->query("SELECT b.*, u.apelido FROM bilhetes b, usuarios u WHERE b.usuarios_id = u.id_usuario AND id_bilhete = " . $idBilhete)->row();
        echo json_encode($data);
    }

}
