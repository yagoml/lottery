<?php

namespace RN;

class BankRN {

    public static function validaDatasExtrato($startDate, $endDate, $captcha_data = '') {
        $errors = "";

        $captchaResponse = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . \Repository\Config_system::ggApiKeySec() . "&response=" . $captcha_data . "&remoteip=" . $_SERVER['REMOTE_ADDR']));
        if (!$captchaResponse->success || !$captcha_data) {
            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
            $errors .= "Por favor, confirme o captcha.";
        } else {
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
        }

        return $errors;
    }

    public static function validaCompra($userId, $valor, $formData) {
        $errors = "";
        $captcha_data = $formData['g-recaptcha-response'] ? $formData['g-recaptcha-response'] : '';

        $captchaResponse = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . \Repository\Config_system::ggApiKeySec() . "&response=" . $captcha_data . "&remoteip=" . $_SERVER['REMOTE_ADDR']));
        if (!$captchaResponse->success || !$captcha_data) {
            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
            $errors .= "Por favor, confirme o captcha.";
        } else if (!isNumber($formData['qtd']) || $formData['qtd'] > 9999) {
            $errors .= $errors ? '<br>' : '';
            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
            $errors .= "Quantidade inválida.";
        } else if (!isset($formData['tipoPgto'])) {
            $errors .= $errors ? '<br>' : '';
            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
            $errors .= "Selecione um método para pagamento.";
        } else {
            if ($formData['tipoPgto'] == 'saldo') {
                if ((int) $formData['qtd'] < 1) {
                    $errors .= $errors ? '<br>' : '';
                    $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                    $errors .= "Compra mínima: 5 bilhetes.";
                }
            } else {
                if ((int) $formData['qtd'] < 5) {
                    $errors .= $errors ? '<br>' : '';
                    $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                    $errors .= "Compra mínima: 5 bilhetes.";
                }
            }

            $ci = & get_instance();
            if (isset($formData['usuario'])) {
                $hasUser = $ci->db->get_where('usuarios', array('id_usuario' => $formData['usuario']))->row();
                if (!$hasUser) {
                    $errors .= $errors ? '<br>' : '';
                    $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                    $errors .= "Usuário para presentear não existe.";
                }
            }

            $ci->load->model('bank_model');
            switch ($formData['tipoPgto']) {
                case 'saldo':
                    $saldo = $ci->bank_model->getSaldo($userId);
                    if ($valor > $saldo) {
                        $errors .= $errors ? '<br>' : '';
                        $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                        $errors .= 'Saldo insuficiente para comprar <b>' . $formData['qtd'] . '</b> bilhete(s).';
                    }
                    break;

                case 'voucher':
                    $voucher = $ci->db->get_where('vouchers', array('voucher' => $formData['codigoVoucher']))->row();
                    if (!$voucher) {
                        $errors .= $errors ? '<br>' : '';
                        $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                        $errors .= 'Voucher inválido.';
                    } else {
                        if (strtotime($voucher->validade) <= time() || !$voucher->ativo) {
                            $errors .= $errors ? '<br>' : '';
                            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                            $errors .= 'Voucher expirado.';
                        }
                        if ($voucher->bilhetes < $formData['qtd']) {
                            $errors .= $errors ? '<br>' : '';
                            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                            $errors .= 'Este Voucher tem saldo para <b>' . $voucher->bilhetes . '</b> bilhetes.';
                        }
                    }
                    break;

                default:
                    $errors .= $errors ? '<br>' : '';
                    $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                    $errors .= 'Forma de Pagamento ainda não disponível.';
                    break;
            }
        }

        return $errors;
    }

}
