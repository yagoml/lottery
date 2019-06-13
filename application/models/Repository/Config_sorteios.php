<?php

namespace Repository;

class Config_sorteios {

    public static function precoBilhete() {
        retuRN self::hasConfigSorteios() ? get_instance()->db->get('config_sorteios')->row()->preco_bilhete : '';
    }
    public static function multBilhetes() {
        retuRN self::hasConfigSorteios() ? get_instance()->db->get('config_sorteios')->row()->mult_bilhete : '';
    }
    public static function multPremio() {
        retuRN self::hasConfigSorteios() ? get_instance()->db->get('config_sorteios')->row()->mult_premio : '';
    }
    public static function multBonusBilhetes() {
        retuRN self::hasConfigSorteios() ? get_instance()->db->get('config_sorteios')->row()->mult_bonus_xp_bilhetes : '';
    }
    public static function multBonusPremio() {
        retuRN self::hasConfigSorteios() ? get_instance()->db->get('config_sorteios')->row()->mult_bonus_xp_premio : '';
    }
    public static function descArrecadado() {
        retuRN self::hasConfigSorteios() ? get_instance()->db->get('config_sorteios')->row()->desc_arrecadado : '';
    }
    public static function hasConfigSorteios() {
        retuRN get_instance()->db->get('config_sorteios')->row();
    }

}
