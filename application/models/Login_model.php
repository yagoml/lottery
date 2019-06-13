<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function checkUsr($email, $password, $captcha_data) {
        $errors = \RN\UsuariosRN::validaLogin($captcha_data, $email, $password);

        if (!$errors) {
            $usr = $this->db->get_where('usuarios', array('email' => $email, 'password' => sha1($password)))->row();
            $data = array(
                'id' => $usr->id_usuario,
                'email' => $usr->email,
                'nome' => $usr->nome,
                'apelido' => $usr->apelido,
                'nivel' => Repository\Usuarios::getUserNivel($usr->id_usuario)
            );
        } else {
            $data = array(
                'class' => 'danger',
                'msg' => '<u>Falha na Autenticação:</u><br><br><b>' . $errors . '</b>'
            );
        }
        return $data;
    }

    public function lastLogin($userId) {
        return $this->db->query("UPDATE usuarios SET ultimo_login = NOW() WHERE id_usuario = " . $userId);
    }

}
