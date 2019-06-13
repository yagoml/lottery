<?php

namespace RN;

class UsuariosRN {

    public static function validaLogin($captcha_data, $email, $password) {
        $errors = "";

        $captchaResponse = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . \Repository\Config_system::ggApiKeySec() . "&response=" . $captcha_data . "&remoteip=" . $_SERVER['REMOTE_ADDR']));
        if (!$captchaResponse->success || !$captcha_data) {
            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
            $errors .= "Por favor, confirme o captcha.";
        } else {
            if (!checkEmail($email)) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "E-mail inválido.";
            } else {
                $usr = get_instance()->db->get_where('usuarios', array('email' => $email, 'password' => sha1($password)))->row();
                if (!$usr) {
                    $errors .= $errors ? '<br>' : '';
                    $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                    $errors .= "E-mail ou senha inválidos !";
                }
            }
        }
        return $errors;
    }

    public static function validateUser($formData) {
        $ci = & get_instance();
        $errors = "";

        if (!$ci->session->userdata['admin']) {
            $captchaResponse = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . \Repository\Config_system::ggApiKeySec() . "&response=" . $formData['captcha_data'] . "&remoteip=" . $_SERVER['REMOTE_ADDR']));
            if (!$captchaResponse->success || !$formData['captcha_data']) {
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "Por favor, confirme o captcha.";
            }

            if ($formData['aceite'] != 'on') {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "É preciso concordar com nossos Termos e Condições.";
            }
        }

        if (!$errors) {
            if (strlen($formData['nome']) < 8 || strlen($formData['nome']) > 80) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "Nome deve ter de 8 à 80 caracteres.";
            }
            if (strlen($formData['apelido']) < 3 || strlen($formData['apelido']) > 25) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "Apelido deve ter de 8 à 255 caracteres.";
            }
            if (strlen($formData['email']) < 8 || strlen($formData['email']) > 255) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "E-Mail deve ter de 8 à 255 caracteres.";
            }

            if (!nomeComposto($formData['nome'])) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "Nome inválido.";
            }
            if (!alpha_numeric($formData['apelido'])) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "Apelido inválido.";
            }

            $ci->load->model('usuarios_model');

            if ($ci->usuarios_model->checkExists('usuarios', 'apelido', $formData['apelido'])) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "Apelido já existe.";
            }
            if (!checkEmail($formData['email'])) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "E-mail inválido.";
            }
            if ($ci->usuarios_model->checkExists('usuarios', 'email', $formData['email'])) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "E-mail já está sendo usado.";
            }
            if (strlen($formData['password']) < 8 || strlen($formData['password']) > 255) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "Senha deve ter de 8 à 255 caracteres.";
            }
            if (($formData['password'] != $formData['conf_password'])) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "Confirmação de senha não confere.";
            }
        }
        return $errors;
    }

    public static function validateEditionUser($formData) {
        $ci = & get_instance();
        $errors = "";
        $captchaResponse = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . \Repository\Config_system::ggApiKeySec() . "&response=" . $formData['g-recaptcha-response'] . "&remoteip=" . $_SERVER['REMOTE_ADDR']));
        if (!$captchaResponse->success || !$formData['g-recaptcha-response']) {
            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
            $errors .= "Por favor, confirme o captcha.";
        } else if (!$errors) {
            $solicitacao = $ci->db->get_where('pre_edicao_usuarios', array('id_usuario' => (int) $ci->session->userdata['user']['id']))->row();
            if ($solicitacao) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "Já existe uma solicitação de alteração feita em: <u>" . date('d/m/Y H:i', strtotime($solicitacao->data)) . "</u>. Confirme ou cancele a mesma no e-mail recebido.";
            } else if (strlen($formData['nome']) < 8 || strlen($formData['nome']) > 80) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "Nome deve ter de 8 à 80 caracteres.";
            } else if (!nomeComposto($formData['nome'])) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "Nome inválido.";
            } else if ($formData['celular'] && !checkPhone($formData['celular'])) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "Celular inválido.";
            } else if ($formData['oldPassword'] && $formData['password']) {
                if (!\Repository\Usuarios::checkPassword($ci->session->userdata['id'], sha1($formData['oldPassword']))) {
                    $errors .= $errors ? '<br>' : '';
                    $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                    $errors .= "Senha não confere.";
                } else if (strlen($formData['password']) < 8 || strlen($formData['password']) > 255) {
                    $errors .= $errors ? '<br>' : '';
                    $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                    $errors .= "Nova Senha deve ter de 8 à 255 caracteres.";
                } else if (($formData['password'] != $formData['conf_password'])) {
                    $errors .= $errors ? '<br>' : '';
                    $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                    $errors .= "Confirmação de senha não confere.";
                }
            }
        }

        return $errors;
    }

    public static function validateCompletCadastro($formData) {
        $ci = & get_instance();
        $errors = "";
        $captchaResponse = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . \Repository\Config_system::ggApiKeySec() . "&response=" . $formData['g-recaptcha-response'] . "&remoteip=" . $_SERVER['REMOTE_ADDR']));
        if (!$captchaResponse->success || !$formData['g-recaptcha-response']) {
            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
            $errors .= "Por favor, confirme o captcha.";
        } else if (!$errors) {
            $solicitacao = $ci->db->get_where('completa_cadastro', array('id_usuario' => (int) $ci->session->userdata['user']['id']))->row();
            if ($solicitacao) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "Já existe uma solicitação de alteração feita em: <u>" . date('d/m/Y H:i', strtotime($solicitacao->data)) . "</u>. Confirme ou cancele a mesma no e-mail recebido.";
            } else if ($formData['cpf'] && !checkCpf($formData['cpf'])) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "CPF inválido.";
            } else if ($formData['celular'] && !checkPhone($formData['celular'])) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "Celular inválido.";
            }
        }

        return $errors;
    }

    public static function validateTransfer($formData) {
        $ci = & get_instance();
        $errors = "";
        $captchaResponse = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . \Repository\Config_system::ggApiKeySec() . "&response=" . $formData['g-recaptcha-response'] . "&remoteip=" . $_SERVER['REMOTE_ADDR']));
        if (!$captchaResponse->success || !$formData['g-recaptcha-response']) {
            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
            $errors .= "Por favor, confirme o captcha.";
        } else if (!$errors) {
            $ci->load->model('sorteios_model');
            if (!isNumber($formData['usuario']) || $formData['usuario'] < 1) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "Usuário Inválido.";
            } else if (!isNumber($formData['qtd']) || $formData['qtd'] < 1) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "Mínimo 1 Ticket.";
            } else if ($ci->sorteios_model->totalTicketsUser($ci->session->userdata['user']['id']) < $formData['qtd']) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "Tickets Insuficientes.";
            }
        }
        return $errors;
    }

}
