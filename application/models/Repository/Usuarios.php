<?php

namespace Repository;

class Usuarios {

    public static function getUsuario($userId) {
        return get_instance()->db->query("SELECT * FROM usuarios u, niveis N WHERE u.id_usuario = " . (int) $userId . " AND N.nivel = (SELECT nivel FROM niveis WHERE exp <= u.xp order by exp DESC LIMIT 1)")->row();
    }

    public static function getUserNivel($userId) {
        $user = self::getUsuario($userId);
        return get_instance()->db->query("SELECT nivel FROM niveis WHERE exp <= " . (int) $user->xp . " ORDER BY exp DESC LIMIT 1")->row()->nivel;
    }

    public static function getUsuarios($filter = []) {
        return get_instance()->db->query("SELECT * FROM usuarios u, niveis n WHERE n.nivel = (SELECT nivel FROM niveis WHERE exp <= u.xp order by exp DESC LIMIT 1) ORDER BY " . (isset($filter['value']) && isset($filter['order']) ? $filter['value'] : ' data_cadastro DESC'))->result();
    }

    public static function checkPassword($userId, $password) {
        return $password == get_instance()->db->get_where('usuarios', array('id_usuario' => $userId))->row()->password;
    }

}
