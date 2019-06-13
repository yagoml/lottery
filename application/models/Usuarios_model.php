<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

    public function insert($formData) {
        $errors = RN\UsuariosRN::validateUser($formData);
        if (!$errors) {
            unset($formData['aceite']);
            unset($formData['conf_password']);
            unset($formData['captcha_data']);

            $formData['password'] = sha1($formData['password']);
            $formData['xp'] = 0;
            $formData['saldo'] = 0;
            $formData['bilhetes'] = 0;
            $formData['data_cadastro'] = date('Y-m-d H:i:s', time());

            $this->db->insert('usuarios', $formData);

            $data = array(
                'user' => $formData['email'],
                'class' => 'success',
                'msg' => 'Usuário cadastrado com sucesso. Ative a conta confirmando o e-mail que enviamos. Obrigado!'
            );
        } else {
            $data = array(
                'class' => 'danger',
                'msg' => '<u>Não foi possivel efetuar o cadastro. Erro(s) encontrado(s):</u><br><br><b>' . $errors . '</b>'
            );
        }

        return $data;
    }

    public function checkExists($table, $field, $value) {
        return $this->db->get_where($table, array($field => $value))->result();
    }

    public function checkExistsEdit($table, $field, $value, $idField, $idEdit) {
        return $this->db->query("SELECT * FROM $table WHERE $field = $value AND $idField != $idEdit")->result();
    }

    public function delete($id) {
        $this->load->model('usuarios_model', '', TRUE);
        $preUsr = $this->db->get_where('cliente', ['id_cliente' => $id])->result_array();

        if (count($preUsr) > 0) {
            $user = $preUsr[0];
            $this->usuarios_model->delete($id);

            $data = array(
                'id' => $id,
                'nome' => $user['nome_cliente'],
                'page' => 'usuarios/list_clients',
                'class' => 'alert-success',
                'clients' => $users = $this->db->get('cliente')->result(),
                'msg' => 'Cliente: <b><u>' . $id . ' - ' . $user['nome_cliente'] . '</u></b> deletado com sucesso !'
            );
        } else {
            $data = array(
                'page' => 'usuarios/list_clients',
                'clients' => $users = $this->db->get('cliente')->result()
            );
        }
        $this->load->view('main_view', $data);
    }

    public function getIndicados($filter) {
        return $this->db->query("SELECT * FROM usuarios U, niveis N WHERE N.nivel = (SELECT nivel FROM niveis WHERE exp <= U.xp order by exp DESC LIMIT 1) AND U.patrocinador =" . (int) $filter['where'] . (isset($filter['start']) ? ' LIMIT ' . $filter['start'] . ', ' . $filter['limit'] : ''))->result();
    }

    public function getGanhos($id) {
        $user = Repository\Usuarios::getUsuario($id);
        $user->ganhos = $this->db->query('SELECT SUM(premio) AS ganhos FROM sorteios S, bilhetes B WHERE S.bilhete_premiado = B.id_bilhete AND B.usuarios_id = ' . (int) $id)->row()->ganhos;
        $this->load->model("bank_model");
        $user->ganhos = $user->ganhos ? $user->ganhos : 0;
        $comissoes = $this->bank_model->getTotalComissoes($id);
        $user->ganhos += $comissoes ? $comissoes : 0;
        return $user;
    }

    public function addExp($userId, $exp) {
        try {
            $this->db->query("UPDATE usuarios SET xp = (xp + " . $exp . ") WHERE id_usuario = " . (int) $userId);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function usuariosJson($apelido) {
        return $this->db->query("SELECT id_usuario, apelido FROM usuarios WHERE apelido like '%" . (string) $apelido . "%' ORDER BY nome ASC")->result();
    }

    public function usuariosJsonById($id) {
        return $this->db->query("SELECT id_usuario, apelido FROM usuarios WHERE id_usuario = " . (int) $id)->row();
    }

    public function ganhadoresJson($apelido) {
        return $this->db->query("SELECT DISTINCT u.id_usuario, u.apelido FROM sorteios s, bilhetes b, usuarios u WHERE u.apelido like '%" . (string) $apelido . "%' AND s.bilhete_premiado = b.id_bilhete AND b.usuarios_id = u.id_usuario ORDER BY nome ASC")->result();
    }

    public function onlineUsers() {
        $expira_em = 5; //DEFINE EM MINUTOS A EXPIRAÇÃO DO ACESSO DO USUARIO
        $sessao = session_id();
        $ip = $_SERVER['REMOTE_ADDR'];
        $tempo_on = date('Y-m-d H:i:s');
        $tempo_fim = date('Y-m-d H:i:s', mktime(date('H'), date('i') - $expira_em, date('s'), date('m'), date('d'), date('Y')));

        $this->db->query("DELETE FROM usuarios_online WHERE tempo <= '$tempo_fim'");

//ONLINES
        return $this->db->query("SELECT id_usuario FROM usuarios_online")->num_rows();
    }

    public function onlineGuests() {
        $expira_em = 5; //DEFINE EM MINUTOS A EXPIRAÇÃO DO ACESSO DO USUARIO
        $tempo_fim = date('Y-m-d H:i:s', mktime(date('H'), date('i') - $expira_em, date('s'), date('m'), date('d'), date('Y')));

        $this->db->query("DELETE FROM visitantes WHERE tempo <= '$tempo_fim'");

//ONLINES
        return $this->db->query("SELECT id FROM visitantes")->num_rows();
    }

    public function expBar($userId) {
        $user = Repository\Usuarios::getUsuario($userId);
        $userNivel = Repository\Usuarios::getUserNivel($userId);
        $currentLevel = $this->db->query("SELECT * FROM niveis WHERE nivel = " . $userNivel)->row();
        $nextLevel = $this->db->query("SELECT * FROM niveis WHERE nivel = " . $userNivel . " + 1")->row();
        $expNeedle = $nextLevel->exp - $currentLevel->exp;
        return ($user->xp - $currentLevel->exp) / $expNeedle * 100;
    }

    public function enviarEdicao($data) {
        $errors = \RN\UsuariosRN::validateEditionUser($data);
        if (!$errors) {
            $data['id_usuario'] = $this->session->userdata('user')['id'];
            $data['auth'] = sha1(rand(1, 99999) . time());
            $data['data'] = date('Y-m-d H:i:s', time());
            $data['password'] = $data['password'] ? sha1($data['password']) : '';
            unset($data['oldPassword']);
            unset($data['conf_password']);
            unset($data['g-recaptcha-response']);

            $this->db->insert('pre_edicao_usuarios', $data);

            echo json_encode(array('class' => 'success', 'msg' => 'Solicitação concluída. Para efetivar as alterações, confirme a solicitação enviada ao seu e-mail.'));

            $msg = 'Foram solicitadas alterações na sua conta <b>' . \Repository\Config_system::titulo() . '</b>:<br><br>';
            $msg .= 'Nome: <b>' . $data['nome'] . '</b><br>';
            $msg .= 'Celular: <b>' . $data['celular'] . '</b><br>';
            $msg .= $data['password'] ? 'Senha: ********<br>' : '';
            $msg .= '<br>Solicitação: <b>' . date('d/m/Y H:i', strtotime($data['data'])) . '</b><br><br>';
            $msg .= 'Você confirma as alterações?<br>';
            $msg .= '<div style="margin: 20px;"><a style="padding: 10px; color: #fff; background-color: #c9302c; border-color: #761c19;" title="Cancelar" href="' . base_url('usuarios/cancelarEdicao?user=' . $data['id_usuario'] . '&auth=' . $data['auth']) . '">Não</a> <a style="padding: 10px; color: #fff; background-color: #449d44; border-color: #255625;" title="Confirmar" href="' . base_url('usuarios/confirmarEdicao?user=' . $data['id_usuario'] . '&auth=' . $data['auth']) . '">Sim</a></div>';
            $msg .= '* Se não foi você, clique em <u>Não</u> e altere sua senha o mais breve possível.';

            $this->load->model('email_model');
            $this->email_model->sendEmail(array('subject' => 'Alteração na sua Conta', 'to' => \Repository\Usuarios::getUsuario($data['id_usuario'])->email, 'msg' => $msg));
        } else {
            echo json_encode(array(
                'class' => 'danger',
                'msg' => '<u>Não foi possivel efetuar a solicitação. Erro(s) encontrado(s):</u><br><br><b>' . $errors . '</b>'
            ));
        }
    }

    public function completarCadastro($data) {
        $errors = \RN\UsuariosRN::validateCompletCadastro($data);
        if (!$errors) {
            $data['id_usuario'] = $this->session->userdata('user')['id'];
            $data['auth'] = sha1(rand(1, 99999) . time());
            $data['data'] = date('Y-m-d H:i:s', time());

            unset($data['g-recaptcha-response']);

            $this->db->insert('completa_cadastro', $data);

            echo json_encode(array('class' => 'success', 'msg' => 'Solicitação concluída. Para efetivar as alterações, confirme a solicitação enviada ao seu e-mail.'));

            $msg = 'Foram solicitadas alterações na sua conta <b>' . \Repository\Config_system::titulo() . '</b>:<br><br>';
            $msg .= 'Completar cadastro com:<br>';
            $msg .= 'CPF: <b>' . $data['cpf'] . '</b><br>';
            $msg .= 'Celular: <b>' . $data['celular'] . '</b><br>';
            $msg .= '<br>Solicitação: <b>' . date('d/m/Y H:i', strtotime($data['data'])) . '</b><br><br>';
            $msg .= 'Você confirma as alterações?<br>';
            $msg .= '<div style="margin: 20px;"><a style="padding: 10px; color: #fff; background-color: #c9302c; border-color: #761c19;" title="Cancelar" href="' . base_url('usuarios/cancelCompCadastro?user=' . $data['id_usuario'] . '&auth=' . $data['auth']) . '">Não</a> <a style="padding: 10px; color: #fff; background-color: #449d44; border-color: #255625;" title="Confirmar" href="' . base_url('usuarios/completarCadastro?user=' . $data['id_usuario'] . '&auth=' . $data['auth']) . '">Sim</a></div>';
            $msg .= '* Se não foi você, clique em <u>Não</u> e altere sua senha o mais breve possível.';

            $this->load->model('email_model');
            $this->email_model->sendEmail(array('subject' => 'Alteração na sua Conta', 'to' => \Repository\Usuarios::getUsuario($data['id_usuario'])->email, 'msg' => $msg));
        } else {
            echo json_encode(array(
                'class' => 'danger',
                'msg' => '<u>Não foi possivel efetuar a solicitação. Erro(s) encontrado(s):</u><br><br><b>' . $errors . '</b>'
            ));
        }
    }

    public function confirmarEdicao() {
        $request = $this->input->get();
        $preData = $this->db->query("SELECT * FROM pre_edicao_usuarios WHERE id_usuario = " . (int) $request['user'] . " and auth = " . $this->db->escape($request['auth']))->row();
        if ($preData) {
            unset($preData->id_usuario);
            unset($preData->auth);
            unset($preData->data);
            $this->db->delete('pre_edicao_usuarios', array('id_usuario' => (int) $request['user']));
            $this->db->where('id_usuario', (int) $request['user'])->update('usuarios', $preData);
            $data = array('msg' => 'Alterações concluídas com sucesso!');
            $data['pagina'] = 'usuarios/confirmation';
            $data['breadCrumb'] = array(
                0 => (object) array('section' => 'Início', 'link' => base_url()),
                1 => (object) array('section' => 'Confirmação', 'link' => '')
            );
            if ($preData->password) {
                // destruir sessão daqele usuario especifico
            }
            $this->load->view('index', $data);
        } else {
            redirect(base_url());
        }
    }

    public function confCompletarCadastro() {
        $request = $this->input->get();
        $preData = $this->db->query("SELECT * FROM completa_cadastro WHERE id_usuario = " . (int) $request['user'] . " and auth = " . $this->db->escape($request['auth']))->row();
        if ($preData) {
            unset($preData->id_usuario);
            unset($preData->auth);
            unset($preData->data);
            $this->db->delete('completa_cadastro', array('id_usuario' => (int) $request['user']));
            $this->db->where('id_usuario', (int) $request['user'])->update('usuarios', $preData);
            $data = array('msg' => 'Dados completados com sucesso!');
            $data['pagina'] = 'usuarios/confirmation';
            $data['breadCrumb'] = array(
                0 => (object) array('section' => 'Início', 'link' => base_url()),
                1 => (object) array('section' => 'Confirmação', 'link' => '')
            );

            $this->load->view('index', $data);
        } else {
            redirect(base_url());
        }
    }

    public function cancelarEdicao() {
        $request = $this->input->get();
        $data = $this->db->query("SELECT * FROM pre_edicao_usuarios WHERE id_usuario = " . (int) $request['user'] . " and auth = " . $this->db->escape($request['auth']))->row();
        if ($data) {
            $this->db->delete('pre_edicao_usuarios', array('id_usuario' => (int) $request['user']));

            $data = array('msg' => 'Alterações canceladas com sucesso!');
            $data['pagina'] = 'usuarios/confirmation';
            $data['breadCrumb'] = array(
                0 => (object) array('section' => 'Início', 'link' => base_url()),
                1 => (object) array('section' => 'Confirmação', 'link' => '')
            );
            $this->load->view('index', $data);
        } else {
            redirect(base_url());
        }
    }

    public function cancelCompCadastro() {
        $request = $this->input->get();
        $data = $this->db->query("SELECT * FROM completa_cadastro WHERE id_usuario = " . (int) $request['user'] . " and auth = " . $this->db->escape($request['auth']))->row();
        if ($data) {
            $this->db->delete('completa_cadastro', array('id_usuario' => (int) $request['user']));

            $data = array('msg' => 'Alterações canceladas com sucesso!');
            $data['pagina'] = 'usuarios/confirmation';
            $data['breadCrumb'] = array(
                0 => (object) array('section' => 'Início', 'link' => base_url()),
                1 => (object) array('section' => 'Confirmação', 'link' => '')
            );
            $this->load->view('index', $data);
        } else {
            redirect(base_url());
        }
    }

}
