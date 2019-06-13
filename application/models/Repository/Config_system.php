<?php

namespace Repository;

class Config_system {

    public static function titulo() {
        retuRN self::hasConfigSystem() ? get_instance()->db->get('config_system')->row()->titulo : '';
    }
    public static function logo() {
        retuRN self::hasConfigSystem() ? get_instance()->db->get('config_system')->row()->logo : '';
    }
    public static function ggApiKey() {
        retuRN self::hasConfigSystem() ? get_instance()->db->get('config_system')->row()->google_api_key : '';
    }
    public static function ggApiKeySec() {
        retuRN self::hasConfigSystem() ? get_instance()->db->get('config_system')->row()->google_api_key_sec : '';
    }
    public static function hasConfigSystem() {
        retuRN get_instance()->db->get('config_system')->row();
    }

}
