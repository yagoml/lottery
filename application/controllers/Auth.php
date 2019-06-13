<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function index() {
        if (!$this->session->userdata('user')) {
            $data['pagina'] = 'usuarios/login';
            $data['title'] = 'Entrar';
            $data['breadCrumb'] = array(
                0 => (object) array('section' => 'Início', 'link' => base_url()),
                1 => (object) array('section' => $data['title'], 'link' => '')
            );
            $this->load->view('index', $data);
        } else {
            redirect();
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect();
    }

    public function login() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $captcha_data = $this->input->post('g-recaptcha-response');

        $this->load->model('login_model');
        $login = $this->login_model->checkUsr($email, $password, $captcha_data);

        if (isset($login['id'])) {
            $this->session->set_userdata(array('user' => $login));
            $this->login_model->lastLogin($login['id']);
            echo json_encode(array('url' => base_url('usuarios/conta')));
        } else {
            echo json_encode($login);
        }
    }

}
