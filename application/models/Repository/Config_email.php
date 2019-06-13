<?php

namespace Repository;

class Config_email {

    public static function host() {
        return self::hasConfigEmail() ? get_instance()->db->get('config_email')->row()->smtp_host : '';
    }

    public static function email() {
        return self::hasConfigEmail() ? get_instance()->db->get('config_email')->row()->smtp_user : '';
    }

    public static function port() {
        return self::hasConfigEmail() ? get_instance()->db->get('config_email')->row()->smtp_port : '';
    }

    public static function pass() {
        return self::hasConfigEmail() ? get_instance()->db->get('config_email')->row()->smtp_pass : '';
    }

    public static function hasConfigEmail() {
        return get_instance()->db->get('config_email')->row();
    }

}
