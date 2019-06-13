<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bank_model extends CI_Model {

    public function getSaldo($userId) {
        return $this->db->get_where('usuarios', array('id_usuario' => $userId))->row()->saldo;
    }

    public function addSaldo($codOp, $userId, $valor) {
        $this->db->query("UPDATE usuarios SET saldo = saldo + (" . (double) $valor . ") WHERE id_usuario = " . (int) $userId);
        $this->addExtrato($codOp, $userId, $valor);
        return;
    }

    public function venda($userId, $bilhetes, $tipoPgto) {
        return $this->db->query("INSERT INTO vendas SET id_usuario = " . (int) $userId . ", bilhetes = " . (int) $bilhetes . ", data = NOW(), metodo_pgto = '" . $tipoPgto . "'");
    }

    public function removeSaldo($codOp, $userId, $valor) {
        $this->db->query("UPDATE usuarios SET saldo = saldo - (" . (double) $valor . ") WHERE id_usuario = " . (int) $userId);
        $this->addExtrato($codOp, $userId, $valor);
        return;
    }

    public function addComissao($userId, $codComissao, $valor) {
        $user = Repository\Usuarios::getUsuario($userId);
        $nivel = Repository\Usuarios::getUserNivel($user->patrocinador);
        $comissao = $this->calcComissao($codComissao, $valor, $nivel);
        $this->db->query("INSERT INTO comissoes(id_patrocinador, id_usuario, operacao, valor, data) VALUES(" . $user->patrocinador . ", " . $user->id_usuario . ", '" . $codComissao . "', " . $comissao . ", NOW())");
        $this->db->query("UPDATE usuarios SET saldo = (saldo + " . $comissao . ") WHERE id_usuario = " . $user->patrocinador);
        $this->addExtrato($codComissao, $user->patrocinador, $comissao);
        return $comissao;
    }

    public function getExtratos($filters) {
        return $this->db->query("SELECT * FROM extratos e, operacoes o WHERE usuarios_id = " . (int) $filters['userId'] . " AND e.operacao = o.codigo AND data >= '" . date('Y-m-d H:i:s', strtotime($filters['startDate'])) . "' AND data <= '" . date('Y-m-d H:i:s', strtotime($filters['endDate']) + 86399) . "' ORDER BY data ASC" . (isset($filters['start']) ? ' LIMIT ' . $filters["start"] . ', ' . $filters["limit"] : ''))->result();
    }

    public function addExtrato($codigoOp, $userId, $valor) {
        return $this->db->insert('extratos', array('usuarios_id' => $userId, 'valor' => $valor, 'operacao' => $codigoOp, 'saldo' => $this->getSaldo($userId), 'data' => date('Y-m-d H:i:s', time())));
    }

    public function extratoUser($startDate, $endDate, $captcha) {
        $errors = $this->input->get('per_page') ? RN\BankRN::validaDatasExtrato($startDate, $endDate) : RN\BankRN::validaDatasExtrato($startDate, $endDate, $captcha);

        if ($errors == '') {
            $data['startDate'] = str_replace('/', '-', $startDate);
            $data['endDate'] = str_replace('/', '-', $endDate);

            $this->load->model('paginator_model');
            $filters = array('userId' => $this->session->userdata('user')['id'], 'startDate' => $data['startDate'], 'endDate' => $data['endDate']);
            $pagination = $this->paginator_model->ciPaginatorFilters('bank_model', 'getExtratos', $filters, 25, 'usuarios/extrato?startDate=' . $filters['startDate'] . '&endDate=' . $filters['endDate']);

            $data['extratos'] = $pagination['itens'];
            $data['links'] = $pagination['links'];
        } else {
            $data = array(
                'class' => 'danger',
                'msg' => '<u>Não foi possivel consultar o extrato. Erro(s) encontrado(s):</u><br><br><b>' . $errors . '</b>'
            );
        }

        return $data;
    }

    public function getComissoes($filter) {
        return $this->db->query("SELECT c.*, u.*, o.nome AS nomeOp FROM comissoes c, usuarios u, operacoes o WHERE c.id_patrocinador = " . (int) $filter['userId'] . " AND c.id_usuario = u.id_usuario AND c.operacao = o.codigo AND c.data >= '" . date('Y-m-d H:i:s', strtotime($filter['startDate'])) . "' AND c.data <= '" . date('Y-m-d H:i:s', strtotime($filter['endDate']) + 86399) . "' ORDER BY c.data ASC" . (isset($filter['start']) ? ' LIMIT ' . $filter["start"] . ', ' . $filter["limit"] : ''))->result();
    }

    public function getTotalComissoes($userId) {
        return $this->db->query("SELECT SUM(valor) AS total FROM comissoes WHERE id_patrocinador = " . (int) $userId)->row()->total;
    }

    public function comissoesUser($startDate, $endDate, $captcha) {
        $errors = RN\BankRN::validaDatasExtrato($startDate, $endDate, $captcha);

        if (!$errors) {
            $data['startDate'] = str_replace('/', '-', $startDate);
            $data['endDate'] = str_replace('/', '-', $endDate);

            $this->load->model('paginator_model');
            $filters = array('userId' => $this->session->userdata('user')['id'], 'startDate' => $data['startDate'], 'endDate' => $data['endDate']);

            $pagination = $this->paginator_model->ciPaginatorFilters('bank_model', 'getComissoes', $filters, 25, 'usuarios/comissoes?startDate=' . $filters['startDate'] . '&endDate=' . $filters['endDate']);

            $data['comissoes'] = $pagination['itens'];
            $data['links'] = $pagination['links'];

            $data['total'] = $this->getTotalComissoes($filters['userId']);
        } else {
            $data = array(
                'startDate' => $startDate,
                'endDate' => $endDate,
                'class' => 'danger',
                'msg' => '<u>Não foi possivel consultar as comissões. Erro(s) encontrado(s):</u><br><br><b>' . $errors . '</b>'
            );
        }

        return $data;
    }

    public function calcComissao($codComissao, $valor, $nivel) {
        $this->db->order_by('ordem', 'asc');
        $ranges = $this->db->get_where('percent_comissoes', array('cod_comissao' => $codComissao))->result();

        foreach ($ranges as $range) {
            $niveis = explode('-', $range->niveis);
            if ($nivel <= $niveis[1]) {
                $percent = $range->percent;
                break;
            }
        }

        $comissao = $valor * $percent / 100;

        return $comissao;
    }

    public function comprarTickets($userId, $qtd, $formData) {
        $valor = $qtd * Repository\Config_sorteios::precoBilhete();
        $errors = RN\BankRN::validaCompra($userId, $valor, $formData);

        if (!$errors) {
            switch ($formData['tipoPgto']) {
                case 'saldo':
                    $this->removeSaldo('compra_bilhetes', $userId, $valor);
                    break;

                case 'voucher':
                    $this->removeVoucher($formData['codigoVoucher'], $userId, $formData['qtd']);
                    break;

                default:
                    break;
            }

            $this->venda($userId, $qtd, $formData['tipoPgto']);
            $this->addBilhetes((isset($formData['usuario']) ? $formData['usuario'] : $userId), $qtd);

            $data = array(
                'class' => 'success',
                'msg' => '<b>' . $qtd . '</b> bilhetes comprados com sucesso! Boa Sorte!'
            );
        } else {
            $data = array(
                'class' => 'danger',
                'msg' => '<u>Não foi possível efetuar a compra:</u><br><br> <b>' . $errors . '</b>'
            );
        }
        echo json_encode($data);
    }

    private function addBilhetes($userId, $qtd) {
        return $this->db->query("UPDATE usuarios SET bilhetes = (bilhetes + " . (int) $qtd . ") WHERE id_usuario = " . (int) $userId);
    }

    public function removeVoucher($codVoucher, $userId, $bilhetes) {
        $this->db->query("UPDATE vouchers SET bilhetes = (bilhetes - " . (int) $bilhetes . "), usuario = " . (int) $userId . ", usado = NOW()");
        $voucher = $this->getVoucher($codVoucher);
        $voucher->bilhetes == 0 ? $this->db->query("UPDATE vouchers SET usuario = " . (int) $userId . ", usado = NOW(), ativo = 0 WHERE voucher = '" . $codVoucher . "'") : '';
    }

    public function getVoucher($codigoVoucher) {
        return $this->db->get_where('vouchers', array('voucher' => $codigoVoucher))->row();
    }

    public function transfTickets($data) {
        $errors = RN\UsuariosRN::validateTransfer($data);
        if (!$errors) {
            $data['id_usuario'] = $this->session->userdata('user')['id'];
            $data['auth'] = sha1(rand(1, 99999) . time());
            $data['data'] = date('Y-m-d H:i:s', time());

            $this->db->query("INSERT INTO transf_tickets(remetente, destino, quantidade, auth, data, valida) VALUES(" . (int) $data['id_usuario'] . ", " . (int) $data['usuario'] . ", " . (int) $data['qtd'] . ", " . $this->db->escape($data['auth']) . ", '" . $data['data'] . "', 0)");

            echo json_encode(array('class' => 'success', 'msg' => 'Solicitação concluída. Para efetivar a transferência, confirme a solicitação enviada ao seu e-mail.'));

            $msg = 'Foi solicitado uma transferência de tickets na sua conta <b>' . \Repository\Config_system::titulo() . '</b>:<br><br>';
            $msg .= 'Usuário favorecido: <b>' . Repository\Usuarios::getUsuario($data['usuario'])->apelido . '</b><br>';
            $msg .= 'Quantidade de tickets: <b>' . $data['qtd'] . '</b><br>';
            $msg .= '<br>Solicitação: <b>' . date('d/m/Y H:i', strtotime($data['data'])) . '</b><br><br>';
            $msg .= 'Você confirma a transferência?<br>';
            $msg .= '<div style="margin: 20px;"><a style="padding: 10px; color: #fff; background-color: #c9302c; border-color: #761c19;" title="Cancelar" href="' . base_url('usuarios/cancelTransfTickets?user=' . $data['id_usuario'] . '&auth=' . $data['auth']) . '">Não</a> <a style="padding: 10px; color: #fff; background-color: #449d44; border-color: #255625;" title="Confirmar" href="' . base_url('usuarios/confTransfTickets?user=' . $data['id_usuario'] . '&auth=' . $data['auth']) . '">Sim</a></div>';
            $msg .= '* Se não foi você, clique em <u>Não</u> e altere sua senha o mais breve possível.';

            $this->load->model('email_model');
            $this->email_model->sendEmail(array('subject' => 'Transferência na sua Conta', 'to' => \Repository\Usuarios::getUsuario($data['id_usuario'])->email, 'msg' => $msg));
        } else {
            echo json_encode(array(
                'class' => 'danger',
                'msg' => '<u>Não foi possivel efetuar a solicitação. Erro(s) encontrado(s):</u><br><br><b>' . $errors . '</b>'
            ));
        }
    }

    public function confTransfTickets() {
        $request = $this->input->get();
        $data = $this->db->query("SELECT * FROM transf_tickets WHERE remetente = " . (int) $request['user'] . " and auth = " . $this->db->escape($request['auth']))->row();
        if ($data) {
            $this->db->query("UPDATE transf_tickets SET valida = 1, data = '" . date('Y-m-d H:i:s', time()) . "' WHERE remetente = " . $request['user'] . " AND auth = " . $this->db->escape($request['auth']));
            $this->db->query("UPDATE usuarios SET bilhetes = (bilhetes - " . (int) $data->quantidade . ") WHERE id_usuario = " . $data->remetente);
            $this->db->query("UPDATE usuarios SET bilhetes = (bilhetes + " . (int) $data->quantidade . ") WHERE id_usuario = " . (int) $data->destino);

            $data = array('msg' => 'Transferência realizada com sucesso!');
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

    public function cancelTransfTickets() {
        $request = $this->input->get();
        $data = $this->db->query("SELECT * FROM transf_tickets WHERE remetente = " . (int) $request['user'] . " and auth = " . $this->db->escape($request['auth']))->row();
        if ($data) {
            $this->db->query("DELETE FROM transf_tickets WHERE remetente = " . (int) $request['user'] . " and auth = " . $this->db->escape($request['auth']));

            $data = array('msg' => 'Transferência cancelada com sucesso!');
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

    public function getTrasfers($filters) {
        return $this->db->query("SELECT * FROM transf_tickets WHERE valida = 1 AND remetente = " . (int) $filters['userId'] . " OR destino = " . (int) $filters['userId'] . " AND data >= '" . date('Y-m-d H:i:s', strtotime($filters['startDate'])) . "' AND data <= '" . date('Y-m-d H:i:s', strtotime($filters['endDate']) + 86399) . "' ORDER BY data ASC" . (isset($filters['start']) ? ' LIMIT ' . $filters["start"] . ', ' . $filters["limit"] : ''))->result();
    }

    private function totalTransfers($userId, $type, $start, $end) {
        return $this->db->query("SELECT sum(quantidade) AS total FROM transf_tickets WHERE " . $this->db->escape_str($type) . " = " . (int) $userId . " AND data >= '" . date('Y-m-d H:i:s', strtotime($start)) . "' AND data <= '" . date('Y-m-d H:i:s', strtotime($end) + 86399) . "'")->row()->total;
    }

    public function transfersUser($startDate, $endDate, $captcha) {
        $errors = $this->input->get('per_page') ? RN\BankRN::validaDatasExtrato($startDate, $endDate) : RN\BankRN::validaDatasExtrato($startDate, $endDate, $captcha);

        if (!$errors) {
            $data['startDate'] = str_replace('/', '-', $startDate);
            $data['endDate'] = str_replace('/', '-', $endDate);

            $this->load->model('paginator_model');
            $filters = array('userId' => $this->session->userdata('user')['id'], 'startDate' => $data['startDate'], 'endDate' => $data['endDate']);
            $pagination = $this->paginator_model->ciPaginatorFilters('bank_model', 'getTrasfers', $filters, 25, 'usuarios/transferencias?startDate=' . $filters['startDate'] . '&endDate=' . $filters['endDate']);

            $data['transfers'] = $pagination['itens'];
            $data['links'] = $pagination['links'];
            $data['totalTransfers']['debitos'] = $this->totalTransfers($filters['userId'], 'remetente', $data['startDate'], $data['endDate']);
            $data['totalTransfers']['creditos'] = $this->totalTransfers($filters['userId'], 'destino', $data['startDate'], $data['endDate']);
        } else {
            $data = array(
                'class' => 'danger',
                'msg' => '<u>Não foi possivel consultar transferências. Erro(s) encontrado(s):</u><br><br><b>' . $errors . '</b>'
            );
        }

        return $data;
    }

}
