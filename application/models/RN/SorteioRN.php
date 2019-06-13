<?php

namespace RN;

class SorteioRN {

    public static function regraPremiacao($bilhetes) {
        $arrecadado = $bilhetes * \Repository\Config_sorteios::precoBilhete();
        return $arrecadado - ($arrecadado * \Repository\Config_sorteios::descArrecadado()) / 100;
    }

    public static function applyPremio($sorteios) {
        foreach ($sorteios as &$sorteio) {
            $sorteio->premio = self::regraPremiacao(is_array($sorteio->bilhetes) ? count($sorteio->bilhetes) : $sorteio->bilhetes);
        }
        return $sorteios;
    }

    public static function validaFiltroSortsConcluidos($filters) {
        $errors = "";

        if (!get_instance()->session->userdata('admin')) {
            $captchaResponse = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . \Repository\Config_system::ggApiKeySec() . "&response=" . $filters['g-recaptcha-response'] . "&remoteip=" . $_SERVER['REMOTE_ADDR']));
            if (!$captchaResponse->success || !$filters['g-recaptcha-response']) {
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= "Por favor, confirme o captcha.";
            }
        }

        if (!$errors) {
            if ($filters['numero']) {
                if (strlen($filters['numero']) < 1 || strlen($filters['numero']) > 11) {
                    $errors .= $errors ? '<br>' : '';
                    $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                    $errors .= "Número deve ter de 1 à 11 dígitos.";
                }
                if (!isNumber($filters['numero']) || $filters['numero'] < 1) {
                    $errors .= $errors ? '<br>' : '';
                    $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i>';
                    $errors .= "Número Inválido.";
                }
            }

            if (isset($filters['usuario']) && $filters['usuario']) {
                if (!isNumber($filters['usuario']) || $filters['usuario'] < 1) {
                    $errors .= $errors ? '<br>' : '';
                    $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                    $errors .= "Ganhador Inválido.";
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

            if ($filters['minPremio']) {
                if (!validaReal($filters['minPremio']) || $filters['minPremio'] < 1.00) {
                    $errors .= $errors ? '<br>' : '';
                    $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                    $errors .= "Prêmio mínimo inválido";
                }
            }
            if ($filters['maxPremio']) {
                if (!validaReal($filters['maxPremio']) || $filters['maxPremio'] < 1.00) {
                    $errors .= $errors ? '<br>' : '';
                    $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                    $errors .= "Prêmio máximo inválido";
                }
            }
            if ($filters['maxPremio'] && $filters['minPremio']) {
                if ((int) $filters['maxPremio'] < (int) $filters['minPremio']) {
                    $errors .= $errors ? '<br>' : '';
                    $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                    $errors .= "Prêmio máximo não pode ser menor que mínimo";
                }
            }

            if ($filters['minParticipantes']) {
                if (!isNumber($filters['minParticipantes']) || (int) $filters['minParticipantes'] < 1) {
                    $errors .= $errors ? '<br>' : '';
                    $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                    $errors .= "Participantes mínimo inválido";
                }
            }
            if ($filters['maxParticipantes']) {
                if (!isNumber($filters['maxParticipantes']) || (int) $filters['maxParticipantes'] < 1) {
                    $errors .= $errors ? '<br>' : '';
                    $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                    $errors .= "Participantes máximo inválido";
                }
            }
            if ($filters['maxParticipantes'] && $filters['minParticipantes']) {
                if ((int) $filters['maxParticipantes'] < (int) $filters['minParticipantes']) {
                    $errors .= $errors ? '<br>' : '';
                    $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                    $errors .= "Participantes máximo não pode ser menor que mínimo";
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

            if ($filters['minBilhetesNec']) {
                if (!isNumber($filters['minBilhetesNec']) || (int) $filters['minBilhetesNec'] < 1) {
                    $errors .= $errors ? '<br>' : '';
                    $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                    $errors .= "Bilhetes Necessários mínimo inválido";
                }
            }
            if ($filters['maxBilhetesNec']) {
                if (!isNumber($filters['maxBilhetesNec']) || (int) $filters['maxBilhetesNec'] < 1) {
                    $errors .= $errors ? '<br>' : '';
                    $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                    $errors .= "Bilhetes Necessários máximo inválido";
                }
            }
            if ($filters['maxBilhetesNec'] && $filters['minBilhetesNec']) {
                if ((int) $filters['maxBilhetesNec'] < (int) $filters['minBilhetesNec']) {
                    $errors .= $errors ? '<br>' : '';
                    $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                    $errors .= "Bilhetes Necessários máximo não pode ser menor que mínimo";
                }
            }

            if ($filters['minAposta']) {
                if (!isNumber($filters['minAposta']) || (int) $filters['minAposta'] < 1) {
                    $errors .= $errors ? '<br>' : '';
                    $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                    $errors .= "Aposta mínima inválida.";
                }
            }
            if ($filters['maxAposta']) {
                if (!isNumber($filters['maxAposta']) || (int) $filters['maxAposta'] < 1) {
                    $errors .= $errors ? '<br>' : '';
                    $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                    $errors .= "Aposta máxima inválida.";
                }
            }
            if ($filters['maxAposta'] && $filters['minAposta']) {
                if ((int) $filters['maxAposta'] < (int) $filters['minAposta']) {
                    $errors .= $errors ? '<br>' : '';
                    $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                    $errors .= "Aposta máxima não pode ser menor que mínima";
                }
            }

            if ($filters['minPreco']) {
                if (!isNumber($filters['minPreco']) || (int) $filters['minPreco'] < 1) {
                    $errors .= $errors ? '<br>' : '';
                    $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                    $errors .= "Preço mínimo inválido";
                }
            }
            if ($filters['maxPreco']) {
                if (!isNumber($filters['maxPreco']) || (int) $filters['maxAposta'] < 1) {
                    $errors .= $errors ? '<br>' : '';
                    $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                    $errors .= "Preço máximo inválido";
                }
            }
            if ($filters['maxPreco'] && $filters['minPreco']) {
                if ((int) $filters['maxPreco'] < (int) $filters['minPreco']) {
                    $errors .= $errors ? '<br>' : '';
                    $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                    $errors .= "Preço máximo não pode ser menor que mínimo";
                }
            }
        }

        return $errors;
    }

    public static function validaNumBilhetes($jogadorBilhetes, $bilhetes, $sorteioId) {
        $errors = '';
        if ((int) $bilhetes < 1 || !isNumber($bilhetes) || $bilhetes > 9999) {
            $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
            $errors .= 'Número de Bilhetes inválido.';
        } else {
            $minBilhetes = get_instance()->db->query("SELECT preco FROM sorteios WHERE id_sorteio = " . $sorteioId)->row()->preco;
            if ($bilhetes < $minBilhetes) {
                $errors .= $errors ? '<br>' : '';
                $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                $errors .= 'A Aposta mínima desse sorteio é de ' . $minBilhetes . ' bilhetes.';
            } else {
                if ($jogadorBilhetes < $bilhetes) {
                    $errors .= $errors ? '<br>' : '';
                    $errors .= '<i class="glyphicon glyphicon-exclamation-sign"></i> ';
                    $errors .= 'Você não tem <b>' . $bilhetes . '</b> bilhetes. Você tem <b>' . $jogadorBilhetes . '</b>. <a class="btn btn-success" href="' . base_url('sorteios/bilhetes') . '">Comprar agora</a>';
                }
            }
        }
        return $errors;
    }

    public static function winwheelPercentToDegrees($percentValue) {
        $degrees = 0;
        if (($percentValue > 0) && ($percentValue <= 100)) {
            $divider = ($percentValue / 100);
            $degrees = (360 * $divider);
        }
        return $degrees;
    }

    public static function random_color() {
        $letters = '0123456789ABCDEF';
        $color = '#';
        for ($i = 0; $i < 6; $i++) {
            $index = rand(0, 15);
            $color .= $letters[$index];
        }
        return $color;
    }

}
