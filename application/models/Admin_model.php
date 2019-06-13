<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function checkAdm($login, $password, $captcha_data) {
        $errors = \RN\AdminRN::validaLogin($captcha_data, $login);

        if ($errors == "") {
            $usr = $this->db->get_where('admins', array('login' => $login, 'password' => sha1($password)))->row();
            if (!$usr) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "Login ou senha inválidos !";

                $data = array(
                    'class' => 'danger',
                    'msg' => '<u>Falha na Autenticação:</u><br><br><b>' . $errors . '</b>'
                );
            } else {
                $data = array(
                    'id_adm' => $usr->id_admin,
                    'email' => $usr->email,
                    'nome' => $usr->nome,
                );
            }
        } else {
            $data = array(
                'class' => 'danger',
                'msg' => '<u>Falha na Autenticação:</u><br><br><b>' . $errors . '</b>'
            );
        }
        return $data;
    }

    public function addCompanyComission($qtdBilhetes, $valor) {
        $total = $qtdBilhetes * Repository\Config_sorteios::precoBilhete();
        $this->db->query("UPDATE saldo_company SET saldo = (saldo + " . (double) $valor . ")");
        $this->addExtratoCompany('premiacao_sorteio', $valor);
        return;
    }

    public function addExtratoCompany($codigoOp, $valor) {
        return $this->db->insert('extratos_company', array('valor' => $valor, 'operacao' => $codigoOp, 'saldo' => '(saldo + ' . (double) $valor . ')', 'data' => date('Y-m-d H:i:s', time())));
    }

    public function getSaldoCompany() {
        return $this->db->get('saldo_company')->row()->saldo;
    }

    public function bilhetesDistribuidos() {
        return $this->db->query("SELECT SUM(bilhetes) AS total FROM vendas")->row()->total;
    }

    public function statsCompany() {
        return array(
            'bilhetesDist' => $this->bilhetesDistribuidos(),
            'qtdSorteios' => count($this->sorteios_model->getSorteiosConcluidos()),
            'caixa' => $this->getSaldoCompany()
        );
    }

    public function extratosCompany($startDate, $endDate) {
        $data['startDate'] = str_replace('-', '/', $startDate);
        $data['endDate'] = str_replace('-', '/', $endDate);
        $errors = RN\AdminRN::validaDatasExtrato($data['startDate'], $data['endDate']);

        if ($errors == '') {
            $data['startDate'] = str_replace('/', '-', $startDate);
            $data['endDate'] = str_replace('/', '-', $endDate);

            $this->load->model('paginator_model');
            $filters = array('startDate' => $data['startDate'], 'endDate' => $data['endDate']);
            $pagination = $this->paginator_model->ciPaginatorFilters('admin_model', 'getExtratos', $filters, 25, 'admin/extrato?startDate=' . $filters['startDate'] . '&endDate=' . $filters['endDate']);

            $data['extratos'] = $pagination['itens'];
            $data['links'] = $pagination['links'];
        } else {
            $data = array(
                'startDate' => $startDate,
                'endDate' => $endDate,
                'class' => 'danger',
                'msg' => '<u>Não foi possivel consultar o extrato. Erro(s) encontrado(s):</u><br><br><b>' . $errors . '</b>'
            );
        }

        return $data;
    }

    public function getExtratos($filters) {
        return $this->db->query("SELECT * FROM extratos_company e, operacoes o WHERE e.operacao = o.codigo AND data >= '" . date('Y-m-d H:i:s', strtotime($filters['startDate'])) . "' AND data <= '" . date('Y-m-d H:i:s', strtotime($filters['endDate']) + 86399) . "' ORDER BY data ASC" . (isset($filters['start']) ? ' LIMIT ' . $filters["start"] . ', ' . $filters["limit"] : ''))->result();
    }

    public function getVouchers($filters = []) {
        return $this->db->query("SELECT * FROM vouchers" . (isset($filters['start']) ? ' LIMIT ' . $filters["start"] . ', ' . $filters["limit"] : ''))->result();
    }

    public function getVoucherBySerial($serial) {
        return $this->db->query("SELECT * FROM vouchers WHERE voucher = '" . $serial . "'")->row();
    }

    public function filtroVouchers($filters = []) {
        return $this->db->query(
                        "SELECT * FROM vouchers WHERE id_voucher > 0"
                        . ($filters['idVoucher'] ? " AND id_voucher = " . $filters['idVoucher'] : "")
                        . ($filters['voucher'] ? " AND voucher = '" . $filters['voucher'] . "'" : "")
                        . ($filters['descricao'] ? " AND descricao LIKE '%" . $filters['descricao'] . "'%" : "")
                        . ($filters['minBilhetes'] ? " AND bilhetes >= " . $filters['minBilhetes'] : "")
                        . ($filters['maxBilhetes'] ? " AND bilhetes <= " . $filters['maxBilhetes'] : "")
                        . ($filters['startDate'] ? " AND validade >= '" . date('Y-m-d H:i:s', strtotime($filters['startDate'])) . "'" : "")
                        . ($filters['endDate'] ? " AND validade <= '" . date('Y-m-d H:i:s', strtotime($filters['endDate'])) . "'" : "")
                        . ($filters['usuario'] ? " AND usuario = " . $filters['usuario'] : "")
                        . ($filters['startUsado'] ? " AND usado >= '" . date('Y-m-d H:i:s', strtotime($filters['startUsado'])) . "'" : "")
                        . ($filters['endUsado'] ? " AND validade <= '" . date('Y-m-d H:i:s', strtotime($filters['endUsado'])) . "'" : "")
                        . (isset($filters['ativo']) ? " AND ativo = 1" : " AND ativo = 0")
                        . (isset($filters["start"]) ? ' LIMIT ' . $filters['start'] . ', ' . $filters["limit"] : '')
                )->result();
    }

    public function vouchersPagination($filters) {
        $this->load->model('paginator_model');
        $filters['startDate'] = str_replace('/', '-', $filters['startDate']);
        $filters['endDate'] = str_replace('/', '-', $filters['endDate']);
        return $this->paginator_model->ciPaginatorFilters('admin_model', 'filtroVouchers', $filters, 12, 'admin/vouchers?time=' . time()
                        . '&idVoucher=' . ($filters['idVoucher'] ? $filters['idVoucher'] : '')
                        . (isset($filters['ativo']) ? '&ativo=' . $filters['ativo'] : '')
                        . '&usuario=' . ($filters['usuario'] ? $filters['usuario'] : '')
                        . '&voucher=' . ($filters['voucher'] ? $filters['voucher'] : '')
                        . '&descricao=' . ($filters['descricao'] ? $filters['descricao'] : '')
                        . '&minBilhetes=' . ($filters['minBilhetes'] ? $filters['minBilhetes'] : '')
                        . '&maxBilhetes=' . ($filters['maxBilhetes'] ? $filters['maxBilhetes'] : '')
                        . '&startDate=' . ($filters['startDate'] ? $filters['startDate'] : '')
                        . '&endDate=' . ($filters['endDate'] ? $filters['endDate'] : '')
                        . '&startUsado=' . ($filters['startUsado'] ? $filters['startUsado'] : '')
                        . '&endUsado=' . ($filters['endUsado'] ? $filters['endUsado'] : '')
        );
    }

    public function filtroVouchersInfo($filters) {
        $filtroInfo = '';
        $filtroInfo .= $filters['idVoucher'] ? '<span>ID (<b>' . $filters['idVoucher'] . '</b>)</span>' : '';
        $filtroInfo .= isset($filters['ativo']) ? '<span><b>Ativos</b></span>' : '';
        $filtroInfo .= $filters['usuario'] ? '<span>Usuário (<b>' . $filters['usuario'] . '</b>)</span>' : '';
        $filtroInfo .= $filters['voucher'] ? '<span>Voucher (<b>' . $filters['voucher'] . '</b>)</span>' : '';
        $filtroInfo .= $filters['descricao'] ? '<span>Descrição (<b>' . $filters['descricao'] . '</b>)</span>' : '';
        $filtroInfo .= $filters['minBilhetes'] ? '<span>Bilhetes de (<b>' . $filters['minBilhetes'] . '</b>)</span>' : '';
        $filtroInfo .= $filters['maxBilhetes'] ? '<span>Bilhetes até (<b>' . $filters['maxBilhetes'] . '</b>)</span>' : '';
        $filtroInfo .= $filters['startDate'] ? '<span>Validade de: (<b>' . $filters['startDate'] . '</b>)</span>' : '';
        $filtroInfo .= $filters['endDate'] ? '<span>Validade até (<b>' . $filters['endDate'] . '</b>)</span>' : '';
        $filtroInfo .= $filters['startUsado'] ? '<span>Usado de (<b>' . $filters['startUsado'] . '</b>)</span>' : '';
        $filtroInfo .= $filters['endUsado'] ? '<span>Usado até (<b>' . $filters['endUsado'] . '</b>)</span>' : '';

        return $filtroInfo;
    }

    public function newSorteio($sorteio) {
        $errors = RN\AdminRN::validaNewSorteio($sorteio);
        if (!$errors) {
            $sorteio['data'] = str_replace('/', '-', $sorteio['data']);
            $lastNumber = $this->db->query("SELECT numero_sorteio FROM sorteios WHERE show_users = " . (isset($sorteio['showUsers']) ? 1 : 0) . " ORDER BY numero_sorteio DESC LIMIT 1")->row();
            $numero = $lastNumber ? $lastNumber->numero_sorteio + 1 : 1;

            $this->db->query("INSERT INTO sorteios (numero_sorteio, data_sorteio, preco, min_bilhetes" . (isset($sorteio['showUsers']) ? ", show_users" : "") . ") VALUES($numero, '" . date('Y-m-d H:i:s', strtotime($sorteio['data'] . $sorteio['hora'] . ':00')) . "', '" . $sorteio['preco'] . "', " . $sorteio['minBilhetes'] . (isset($sorteio['showUsers']) ? ", 1" : "") . ")");

            $idSorteio = $this->db->query("SELECT id_sorteio FROM sorteios WHERE numero_sorteio = " . $numero . " AND show_users = " . (isset($sorteio['showUsers']) ? 1 : 0))->row()->id_sorteio;

            $fileName = $_SERVER['DOCUMENT_ROOT'] . 'sorte/' . 'chats/sorteio_' . $idSorteio . '.txt';
            fopen($fileName, 'a');

            $data = array(
                'class' => 'success',
                'msg' => 'Sorteio criado.'
            );
        } else {
            $data = array(
                'class' => 'danger',
                'msg' => '<u>Não foi possivel efetuar o cadastro. Erro(s) encontrado(s):</u><br><br><b>' . $errors . '</b>'
            );
        }
        return $data;
    }

    public function deleteSorteio($id) {
        $fileName = $_SERVER['DOCUMENT_ROOT'] . 'sorte/' . 'chats/sorteio_' . $id . '.txt';
        unlink($fileName);
        return $this->db->query("DELETE FROM sorteios WHERE id_sorteio = " . (int) $id);
    }

    public function editSorteio($sorteio) {
        $errors = RN\AdminRN::validaNewSorteio($sorteio);
        if (!$errors) {
            $sorteio['data'] = str_replace('/', '-', $sorteio['data']);
            $this->db->query("UPDATE sorteios SET" . ($sorteio['preco'] ? " preco = '" . $sorteio['preco'] . "'," : '') . ($sorteio['minBilhetes'] ? " min_bilhetes = " . $sorteio['minBilhetes'] . "," : '') . ($sorteio['data'] ? " data_sorteio = '" . date('Y-m-d H:i:s', strtotime($sorteio['data'] . $sorteio['hora'] . ':00')) . "'" : '') . (isset($sorteio['showUsers']) ? ", show_users = 1" : ", show_users = 0") . " WHERE id_sorteio = " . $sorteio['id']);
            $data = array(
                'class' => 'success',
                'msg' => 'Sorteio salvo com sucesso.'
            );
        } else {
            $data = array(
                'class' => 'danger',
                'msg' => '<u>Não foi possivel efetuar a edição. Erro(s) encontrado(s):</u><br><br><b>' . $errors . '</b>'
            );
        }
        return $data;
    }

    public function editUser($user) {
        $errors = RN\AdminRN::validateEditUser($user);
        if (!$errors) {
            $this->db->query("UPDATE usuarios SET nome = '" . $user['nome'] . "', apelido = '" . $user['apelido'] . "', celular = '" . $user['celular'] . "', email = '" . $user['email'] . "', cpf = '" . $user['cpf'] . "'" . (isset($user['password']) ? ", password = '" . $user['password'] . "'" : ''));
            $data = array(
                'class' => 'success',
                'msg' => 'Usuário salvo com sucesso.'
            );
        } else {
            $data = array(
                'class' => 'danger',
                'msg' => '<u>Não foi possivel efetuar a edição. Erro(s) encontrado(s):</u><br><br><b>' . $errors . '</b>'
            );
        }
        return $data;
    }

    public function newVoucher($voucher) {
        $errors = RN\AdminRN::validaNewVoucher($voucher);
        if (!$errors) {
            $serial = $this->gerarVoucher();
            $voucher['validade'] = str_replace('/', '-', $voucher['validade']);

            $this->db->query("INSERT INTO vouchers (voucher, descricao, bilhetes, validade" . (isset($voucher['inativo']) ? ", ativo" : "") . ") VALUES('" . $serial . "', '" . $voucher['descricao'] . "', " . $voucher['bilhetes'] . ", '" . date('Y-m-d H:i:s', strtotime($voucher['validade']) + 86399) . "'" . (isset($voucher['inativo']) ? ", 0" : "") . ")");
            $data = array(
                'class' => 'success',
                'msg' => 'Voucher gerado: <b>' . $serial
            );
        } else {
            $data = array(
                'class' => 'danger',
                'msg' => '<u>Não foi possivel efetuar o cadastro. Erro(s) encontrado(s):</u><br><br><b>' . $errors . '</b>'
            );
        }
        return $data;
    }

    public function editVoucher($voucher) {
        $errors = RN\AdminRN::validaNewVoucher($voucher);
        if (!$errors) {
            $voucher['validade'] = str_replace('/', '-', $voucher['validade']);
            $this->db->query("UPDATE vouchers SET" . ($voucher['descricao'] ? " descricao = '" . $voucher['descricao'] . "'," : '') . ($voucher['bilhetes'] ? " bilhetes = " . $voucher['bilhetes'] . "," : '') . ($voucher['validade'] ? " validade = '" . date('Y-m-d H:i:s', strtotime($voucher['validade']) + 86399) . "'" : '') . (isset($voucher['inativo']) ? ", ativo = 0" : ", ativo = 1") . " WHERE id_voucher = " . $voucher['id']);
            $data = array(
                'class' => 'success',
                'msg' => 'Voucher salvo com sucesso.'
            );
        } else {
            $data = array(
                'class' => 'danger',
                'msg' => '<u>Não foi possivel efetuar a edição. Erro(s) encontrado(s):</u><br><br><b>' . $errors . '</b>'
            );
        }
        return $data;
    }

    public function gerarVoucher() {
        $length = 5;
        $blocos = 3;
        $separador = "-";
        $voucher = "";
        $characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
        $max = count($characters) - 1;
        for ($b = 0; $b < $blocos; $b++) {
            for ($i = 0; $i < $length; $i++) {
                $rand = mt_rand(0, $max);
                $voucher .= $characters[$rand];
            }
            $voucher .= $b < $blocos - 1 ? $separador : '';
        }

        if ($this->getVoucherBySerial($voucher)) {
            $this->gerarVoucher();
        } else {
            return $voucher;
        }
    }

    public function deleteVoucher($idVoucher) {
        return $this->db->query("DELETE FROM vouchers WHERE id_voucher = " . (int) $idVoucher);
    }

    public function deleteUser($id) {
        return $this->db->query("DELETE FROM usuarios WHERE id_usuario = " . (int) $id);
    }

    public function saveConfigSystem($config) {
        $errors = RN\AdminRN::validaConfigSystem($config);
        
        if ($_FILES['logo']['size'] > 0) {
            $uploadImg = uploadImg('logo', 'uploaded_imgs');
            if (!$uploadImg['moved']) {
                $errors .= $errors !== '' ? '<br>' : '';
                $errors .= $uploadImg['msg'];
            } else {
                $config['logo'] = $uploadImg['url'];
            }
        }
        
        if (!$errors) {
            if (Repository\Config_system::hasConfigSystem()) {
                $this->db->update('config_system', $config);
            } else {
                $this->db->insert('config_system', $config);
            }

            $data = array(
                'class' => 'success',
                'msg' => 'Salvo com sucesso!'
            );
        } else {
            $data = array(
                'class' => 'danger',
                'msg' => '<u>Falha ao tentar salvar:</u><br><br><b>' . $errors . '</b>'
            );
        }
        echo json_encode($data);
    }

    public function saveConfigSorteios($config) {
        $error = RN\AdminRN::validaConfigSorteios($config);
        if (!$error) {
            $config['preco_bilhete'] = str_replace(',', '.', $config['preco_bilhete']);

            if (Repository\Config_sorteios::hasConfigSorteios()) {
                $this->db->update('config_sorteios', $config);
            } else {
                $this->db->insert('config_sorteios', $config);
            }

            $data = array(
                'class' => 'success',
                'msg' => 'Salvo com sucesso!'
            );
        } else {
            $data = array(
                'class' => 'danger',
                'msg' => '<u>Falha ao tentar salvar:</u><br><br><b>' . $error . '</b>'
            );
        }
        echo json_encode($data);
    }

    public function saveConfigEmail($config) {
        $errors = RN\AdminRN::validaConfigEmail($config);
        if (!$errors) {
            if (Repository\Config_email::hasConfigEmail()) {
                $this->db->update('config_email', $config);
            } else {
                $this->db->insert('config_email', $config);
            }

            $data = array(
                'class' => 'success',
                'msg' => 'Salvo com sucesso!'
            );
        } else {
            $data = array(
                'class' => 'danger',
                'msg' => '<u>Falha ao tentar salvar:</u><br><br><b>' . $errors . '</b>'
            );
        }
        echo json_encode($data);
    }

    public function getPercentComissoes($cod) {
        return $this->db->query("SELECT * FROM percent_comissoes WHERE cod_comissao = '" . $cod . "' ORDER BY ordem")->result();
    }

    public function getConfigEmail() {
        return $this->db->query("SELECT * FROM config_email")->row();
    }

    public function deleteComission($comission) {
        return $this->db->query("DELETE FROM percent_comissoes WHERE id = " . $comission['id']);
    }

    public function getOpComissions() {
        return $this->db->query("SELECT * FROM operacoes WHERE codigo LIKE '%comissao_%'")->result();
    }

    public function addPercentComission($comission) {
        $errors = RN\AdminRN::validaConfigComissao($comission);
        if (!$errors) {
            $this->db->query("INSERT INTO percent_comissoes(ordem, niveis, cod_comissao, percent) VALUES(" . $comission['ordem'] . ", '" . $comission['rangeMin'] . '-' . $comission['rangeMax'] . "', '" . $comission['codComissao'] . "', " . $comission['percComissao'] . ")");

            $data = array('class' => 'success', 'msg' => 'Adicionado com sucesso!');
        } else {
            $data = array('class' => 'danger', 'msg' => 'Erro ao adicionar:<br><br><b>' . $errors . '</b>');
        }

        echo json_encode($data);
    }

    public function editPercComission($comissao) {
        $errors = RN\AdminRN::validaConfigComissao($comissao);
        if (!$errors) {
            $this->db->query("UPDATE percent_comissoes SET" . ($comissao['ordem'] ? " ordem = '" . $comissao['ordem'] . "'" : '') . ($comissao['rangeMin'] && $comissao['rangeMax'] ? ", niveis = '" . $comissao['rangeMin'] . '-' . $comissao['rangeMax'] . "'" : '') . ($comissao['codComissao'] ? ", cod_comissao = '" . $comissao['codComissao'] . "'" : '') . ($comissao['percComissao'] ? ", percent = " . $comissao['percComissao'] : "") . " WHERE id = " . $comissao['idPercCom']);
            $data = array(
                'class' => 'success',
                'msg' => 'Perc. Comissão salvo com sucesso.'
            );
        } else {
            $data = array(
                'class' => 'danger',
                'msg' => '<u>Não foi possivel efetuar a edição. Erro(s) encontrado(s):</u><br><br><b>' . $errors . '</b>'
            );
        }
        return $data;
    }

}
