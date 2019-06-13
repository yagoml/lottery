<?php

namespace RN;

class AdminRN {

    public static function validaDatasExtrato($startDate, $endDate) {
        $errors = "";

        if (!checkBrData($startDate)) {
            $errors .= $errors ? '<br>' : '';
            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
            $errors .= "Data inicial inválida.";
        }

        if (!checkBrData($endDate)) {
            $errors .= $errors ? '<br>' : '';
            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
            $errors .= "Data final inválida.";
        }

        if ($startDate > $endDate) {
            $errors .= $errors ? '<br>' : '';
            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
            $errors .= "Data inicial não pode ser maior que a final.";
        }

        return $errors;
    }

    public static function validaLogin($captcha_data, $login) {
        $errors = "";

        $captchaResponse = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . \Repository\Config_system::ggApiKeySec() . "&response=" . $captcha_data . "&remoteip=" . $_SERVER['REMOTE_ADDR']));
        if (!$captchaResponse->success || !$captcha_data) {
            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
            $errors .= "Por favor, confirme o captcha.";
        } else {
            if (!alpha_numeric($login)) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "Login inválido.";
            }
        }

        return $errors;
    }

    public static function validaFiltroVouchers($filters) {
        $errors = "";

        if ($filters['idVoucher']) {
            if (strlen($filters['idVoucher']) < 1 || strlen($filters['idVoucher']) > 11) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "ID deve ter de 1 à 11 dígitos.";
            }
            if (!isNumber($filters['idVoucher']) || $filters['idVoucher'] < 1) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "ID Inválido";
            }
        }

        if (isset($filters['ativo']) && $filters['ativo'] != 'on') {
            $errors .= $errors ? '<br>' : '';
            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
            $errors .= "Ativo inválido";
        }

        if ($filters['usuario']) {
            if (!isNumber($filters['usuario']) || $filters['usuario'] < 1) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "Usuário Inválido";
            }
        }

        if ($filters['voucher']) {
            if (!self::checkVoucher($filters['voucher'])) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "Voucher Inválido";
            }
        }

        if ($filters['minBilhetes']) {
            if (!isNumber($filters['minBilhetes']) || (int) $filters['minBilhetes'] < 1) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "Bilhetes mínimo inválido";
            }
        }
        if ($filters['maxBilhetes']) {
            if (!isNumber($filters['maxBilhetes']) || (int) $filters['maxBilhetes'] < 1) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "Bilhetes máximo inválido";
            }
        }
        if ($filters['maxBilhetes'] && $filters['minBilhetes']) {
            if ((int) $filters['maxBilhetes'] < (int) $filters['minBilhetes']) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "Bilhetes máximo não pode ser menor que mínimo";
            }
        }

        if ($filters['startDate']) {
            if (!checkBrData($filters['startDate'])) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "Data inicial inválida.";
            }
        }
        if ($filters['endDate']) {
            if (!checkBrData($filters['endDate'])) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "Data final inválida.";
            }
        }
        if ($filters['startDate'] && $filters['endDate']) {
            if ((int) $filters['endDate'] < (int) $filters['startDate']) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "Data final não pode ser menor que inicial.";
            }
        }

        if ($filters['startUsado']) {
            if (!checkBrData($filters['startDate'])) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "Data inicial inválida.";
            }
        }
        if ($filters['endUsado']) {
            if (!checkBrData($filters['endDate'])) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "Data final inválida.";
            }
        }
        if ($filters['startUsado'] && $filters['endUsado']) {
            if ((int) $filters['endDate'] < (int) $filters['startDate']) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "Data final não pode ser menor que inicial.";
            }
        }
    }

    public static function checkVoucher($sorteio) {
        return preg_match('^[a-zA-Z0-9]{5}-[a-zA-Z0-9]{5}-[a-zA-Z0-9]{5}$^', $sorteio);
    }

    public static function validaNewVoucher($sorteio) {
        $errors = '';
        if (strlen($sorteio['descricao']) < 3 || strlen($sorteio['descricao']) > 255) {
            $errors .= $errors ? '<br>' : '';
            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
            $errors .= "Descrição de 3 à 255 caracteres.";
        }

        if (!checkBrData($sorteio['validade'])) {
            $errors .= $errors ? '<br>' : '';
            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
            $errors .= "Data validade inválida.";
        }

        if (!isNumber($sorteio['bilhetes']) || (int) $sorteio['bilhetes'] < 1) {
            $errors .= $errors ? '<br>' : '';
            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
            $errors .= "Bilhetes inválido";
        }
        return $errors;
    }

    public static function validaNewSorteio($sorteio) {
        $errors = '';

        if (!checkBrData($sorteio['data'])) {
            $errors .= $errors ? '<br>' : '';
            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
            $errors .= "Data inválida.";
        }

        if (!checkTime($sorteio['hora'])) {
            $errors .= $errors ? '<br>' : '';
            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
            $errors .= "Hora inválida.";
        }

        if (!isNumber($sorteio['preco']) || (int) $sorteio['preco'] < 1) {
            $errors .= $errors ? '<br>' : '';
            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
            $errors .= "Preço inválido";
        }

        if (!isNumber($sorteio['minBilhetes']) || (int) $sorteio['minBilhetes'] < 1) {
            $errors .= $errors ? '<br>' : '';
            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
            $errors .= "Mínimo de Bilhetes inválido";
        }

        return $errors;
    }

    public static function validaConfigSystem($config) {
        $errors = '';

        

        return $errors;
    }

    public static function validaConfigSorteios($config) {
        $errors = '';

        if (!validaReal($config['preco_bilhete']) && !isNumber($config['preco_bilhete'])) {
            $errors .= $errors ? '<br>' : '';
            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
            $errors .= "Preço inválido.";
        }
        if (!isNumber($config['mult_bilhete']) || (int) $config['mult_bilhete'] < 1) {
            $errors .= $errors ? '<br>' : '';
            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
            $errors .= "Multiplicador de Bilhetes inválido";
        }
        if (!isNumber($config['mult_bonus_xp_bilhetes']) || (int) $config['mult_bonus_xp_bilhetes'] < 1) {
            $errors .= $errors ? '<br>' : '';
            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
            $errors .= "Multiplicador bônus de Bilhetes inválido";
        }

        return $errors;
    }

    public static function validaConfigEmail($config) {
        $errors = '';

        if (!checkEmail($config['smtp_user'])) {
            $errors .= $errors ? '<br>' : '';
            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
            $errors .= "User inválido.";
        }

        if (!isNumber($config['smtp_port']) || $config['smtp_port'] < 1) {
            $errors .= $errors ? '<br>' : '';
            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
            $errors .= "Porta inválida.";
        }

        return $errors;
    }

    public static function validaConfigComissao($config) {
        $errors = '';

        if (!isNumber($config['ordem']) || $config['ordem'] < 0) {
            $errors .= $errors ? '<br>' : '';
            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
            $errors .= "Ordem inválida.";
        }
        if (!isNumber($config['rangeMin']) || $config['rangeMin'] < 0) {
            $errors .= $errors ? '<br>' : '';
            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
            $errors .= "Nível DE inválido.";
        }
        if (!isNumber($config['rangeMax']) || $config['rangeMax'] < 0) {
            $errors .= $errors ? '<br>' : '';
            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
            $errors .= "Nível ATÉ inválido.";
        }
        if ($config['rangeMax'] < $config['rangeMin']) {
            $errors .= $errors ? '<br>' : '';
            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
            $errors .= "Nível inicial não pode ser maior que o final.";
        }
        if (!isNumber($config['percComissao']) || $config['percComissao'] < 0) {
            $errors .= $errors ? '<br>' : '';
            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
            $errors .= "Comissão inválida.";
        }

        return $errors;
    }

    public static function validateEditUser($formData) {
        $ci = & get_instance();
        $errors = "";

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

            if ($ci->usuarios_model->checkExistsEdit('usuarios', 'apelido', $formData['apelido'], 'id_usuario', $formData['id'])) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "Apelido já existe.";
            }
            if (!checkEmail($formData['email'])) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "E-mail inválido.";
            }
            if ($ci->usuarios_model->checkExistsEdit('usuarios', 'email', $formData['email'], 'id_usuario', $formData['id'])) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "E-mail já está sendo usado.";
            }

            if ($formData['password']) {
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
        }
        return $errors;
    }

}
