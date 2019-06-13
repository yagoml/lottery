<?php

namespace Repository;

class Gadgets {

    public static function companyStats() {
        $ci = &get_instance();
        $ci->load->model('admin_model');
        $ci->load->model('sorteios_model');
        $data['company'] = $ci->admin_model->statsCompany();
        $ci->load->view('admin/painel/company_stats_gadget', $data);
    }
    public static function userStats() {
        $ci = &get_instance();
        $ci->load->model('usuarios_model');
        $data['user'] = $ci->usuarios_model->getGanhos($ci->session->userdata['user']['id']);
        $data['expBar'] = $ci->usuarios_model->expBar($data['user']->id_usuario);
        $ci->load->view('usuarios/painel/user_stats_gadget', $data);
    }
    public static function userBar() {
        $ci = &get_instance();
        $ci->load->model('usuarios_model');
        $data['user'] = $ci->usuarios_model->getGanhos($ci->session->userdata['user']['id']);
        $ci->load->view('usuarios/painel/user_bar', $data);
    }

}
