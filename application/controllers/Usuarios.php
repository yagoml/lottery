<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function index() {
        if (!$this->session->userdata('user')) {
            $data['pagina'] = 'usuarios/cadastro';
            $this->load->view('index', $data);
        } else {
            redirect('usuarios/conta');
        }
    }

    public function novo() {
        if (!$this->session->userdata('user')) {
            $data['pagina'] = 'usuarios/cadastro';
            $this->load->view('index', $data);
        } else {
            redirect();
        }
    }

    public function cadastro() {
        if ($this->session->userdata('user')) {
            $formData['nome'] = ucwords(strtolower($this->input->post('nome')));
            $formData['apelido'] = $this->input->post('apelido');
            $formData['password'] = $this->input->post('password');
            $formData['conf_password'] = $this->input->post('conf_password');
            $formData['email'] = $this->input->post('email');
            $formData['patrocinador'] = $this->input->post('patrocinador');
            $formData['aceite'] = $this->input->post('aceite');
            $formData['captcha_data'] = $this->input->post('g-recaptcha-response');

            $this->load->model('usuarios_model');
            echo json_encode($this->usuarios_model->insert($formData));
        } else {
            redirect();
        }
    }

    public function userSession() {
        if ($this->session->userdata('user')) {
            echo json_encode($this->session->userdata['user']);
        }
    }

    public function usuariosJson() {
        $this->load->model('usuarios_model');
        echo $this->input->get('search') ? json_encode($this->usuarios_model->usuariosJson($this->input->get('search'))) : json_encode(array());
    }

    public function usuariosJsonById() {
        $this->load->model('usuarios_model');
        echo $this->input->get('search') ? json_encode($this->usuarios_model->usuariosJsonById($this->input->get('search'))) : json_encode(array());
    }

    public function getUserNivelJson() {
        if ($this->session->userdata('user')) {
            $this->load->model('usuarios_model');
            $userId = $this->input->post('userId');
            $user = Repository\Usuarios::getUsuario($userId);
            $user->nivel = Repository\Usuarios::getUserNivel($user->id_usuario);
            echo $userId ? json_encode(['nivel' => $user->nivel]) : json_encode(array());
        }
    }

    public function ganhadoresJson() {
        $this->load->model('usuarios_model');
        echo $this->input->get('search') ? json_encode($this->usuarios_model->ganhadoresJson($this->input->get('search'))) : json_encode(array());
    }

    public function conta() {
        if ($this->session->userdata('user')) {
            $data['title'] = 'Minha Conta';
            $data['pagina'] = 'usuarios/painel/painel';
            $data['paginaInterna'] = 'usuarios/painel/main_view';
            $data['breadCrumb'] = array(
                0 => (object) array('section' => 'Início', 'link' => base_url()),
                1 => (object) array('section' => 'Minha Conta', 'link' => '')
            );
            $this->load->model('usuarios_model');

            $this->load->view('index', $data);
        } else {
            redirect();
        }
    }

    public function completar() {
        if ($this->session->userdata('user')) {
            $data['pagina'] = 'usuarios/painel/painel';
            $data['paginaInterna'] = 'usuarios/painel/completar_view';
            $data['breadCrumb'] = array(
                0 => (object) array('section' => 'Início', 'link' => base_url()),
                1 => (object) array('section' => 'Minha Conta', 'link' => base_url('usuarios/conta')),
                2 => (object) array('section' => 'Completar Cadastro', 'link' => '')
            );
            $this->load->model('usuarios_model');

            $this->load->view('index', $data);
        } else {
            redirect();
        }
    }

    public function meusSorteios() {
        if (isset($this->session->userdata('user')['id'])) {
            $data['pagina'] = 'usuarios/painel/painel';
            $data['paginaInterna'] = 'usuarios/painel/meus_sorteios_view';
            $data['breadCrumb'] = array(
                0 => (object) array('section' => 'Início', 'link' => base_url()),
                1 => (object) array('section' => 'Minha Conta', 'link' => base_url('usuarios/conta')),
                2 => (object) array('section' => 'Meus Sorteios', 'link' => '')
            );
            $this->load->model('usuarios_model');

            $this->load->model('sorteios_model');
            $data['meusSorteios'] = $this->sorteios_model->getUserSorteios($this->session->userdata('user')['id']);

            $this->load->view('index', $data);
        } else {
            redirect();
        }
    }

    public function editar() {
        if ($this->session->userdata('user')) {
            $data['pagina'] = 'usuarios/painel/painel';
            $data['paginaInterna'] = 'usuarios/painel/edit_view';
            $data['breadCrumb'] = array(
                0 => (object) array('section' => 'Início', 'link' => base_url()),
                1 => (object) array('section' => 'Minha Conta', 'link' => base_url('usuarios/conta')),
                2 => (object) array('section' => 'Editar', 'link' => '')
            );

            $data['userInfo'] = \Repository\Usuarios::getUsuario($this->session->userdata('user')['id']);

            $this->load->view('index', $data);
        } else {
            redirect();
        }
    }

    public function enviarEdicao() {
        if ($this->session->userdata('user')) {
            $this->load->model('usuarios_model');
            $this->usuarios_model->enviarEdicao($this->input->post());
        }
    }

    public function completarCadastro() {
        if ($this->input->get()) {
            $this->load->model('usuarios_model');
            $this->usuarios_model->confCompletarCadastro($this->input->get());
        } else {
            $this->usuarios_model->completarCadastro($this->input->post());
        }
    }

    public function confirmarEdicao() {
        $this->load->model('usuarios_model');
        $this->usuarios_model->confirmarEdicao($this->input->get());
    }

    public function cancelarEdicao() {
        $this->load->model('usuarios_model');
        $this->usuarios_model->cancelarEdicao($this->input->get());
    }

    public function cancelCompCadastro() {
        $this->load->model('usuarios_model');
        $this->usuarios_model->cancelCompCadastro($this->input->get());
    }

    public function extrato() {
        if ($this->session->userdata('user')) {
            $this->load->model('bank_model');
            if ($this->input->get()) {
                $data = $this->bank_model->extratoUser($this->input->get('startDate'), $this->input->get('endDate'), $this->input->get('g-recaptcha-response'));
            }

            $data['pagina'] = 'usuarios/painel/painel';
            $data['paginaInterna'] = 'usuarios/painel/extrato_view';
            $data['breadCrumb'] = array(
                0 => (object) array('section' => 'Início', 'link' => base_url()),
                1 => (object) array('section' => 'Minha Conta', 'link' => base_url('usuarios/conta')),
                2 => (object) array('section' => 'Extrato', 'link' => '')
            );
            $this->load->model('usuarios_model');

            $this->load->view('index', $data);
        } else {
            redirect();
        }
    }

    public function indicados() {
        if ($this->session->userdata('user')) {
            $data['pagina'] = 'usuarios/painel/painel';
            $data['paginaInterna'] = 'usuarios/painel/indicados_view';
            $data['breadCrumb'] = array(
                0 => (object) array('section' => 'Início', 'link' => base_url()),
                1 => (object) array('section' => 'Minha Conta', 'link' => base_url('usuarios/conta')),
                2 => (object) array('section' => 'Indicados', 'link' => '')
            );
            $this->load->model('usuarios_model');

            $this->load->model('paginator_model');
            $pagination = $this->paginator_model->ciPaginatorFiltered('usuarios_model', 'getIndicados', $this->session->userdata('user')['id'], 30, 'usuarios/indicados', 3);

            $data['indicados'] = $pagination['itens'];
            $data['links'] = $pagination['links'];

            $this->load->view('index', $data);
        } else {
            redirect();
        }
    }

    public function comissoes() {
        if ($this->session->userdata('user')) {
            $this->load->model('bank_model');

            if ($this->input->get()) {
                $data = $this->bank_model->comissoesUser($this->input->get('startDate'), $this->input->get('endDate'), $this->input->get('g-recaptcha-response'));
            }

            $data['pagina'] = 'usuarios/painel/painel';
            $data['paginaInterna'] = 'usuarios/painel/comissoes_view';
            $data['breadCrumb'] = array(
                0 => (object) array('section' => 'Início', 'link' => base_url()),
                1 => (object) array('section' => 'Minha Conta', 'link' => base_url('usuarios/conta')),
                2 => (object) array('section' => 'Comissões', 'link' => '')
            );
            $this->load->model('usuarios_model');

            $this->load->view('index', $data);
        } else {
            redirect();
        }
    }

    public function transfTickets() {
        if ($this->session->userdata('user')) {
            $data = $this->input->post();
            $this->load->model('bank_model');
            $this->bank_model->transfTickets($data);
        } else {
            redirect();
        }
    }

    public function confTransfTickets() {
        $this->load->model('bank_model');
        $this->bank_model->confTransfTickets($this->input->get());
    }

    public function cancelTransfTickets() {
        $this->load->model('bank_model');
        $this->bank_model->cancelTransfTickets($this->input->get());
    }

    public function transferencias() {
        if ($this->session->userdata('user')) {
            $this->load->model('bank_model');
            if ($this->input->get()) {
                $data = $this->bank_model->transfersUser($this->input->get('startDate'), $this->input->get('endDate'), $this->input->get('g-recaptcha-response'));
            }

            $data['pagina'] = 'usuarios/painel/painel';
            $data['paginaInterna'] = 'usuarios/painel/transfers_view';
            $data['breadCrumb'] = array(
                0 => (object) array('section' => 'Início', 'link' => base_url()),
                1 => (object) array('section' => 'Minha Conta', 'link' => base_url('usuarios/conta')),
                2 => (object) array('section' => 'Transferências', 'link' => '')
            );
            $this->load->model('usuarios_model');

            $this->load->view('index', $data);
        } else {
            redirect();
        }
    }

}
