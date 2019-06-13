<?php

namespace Repository;

class Sorteios {
    
        
    public static function getTicket($id) {
        return $GLOBALS['CI']->db->get_where('bilhetes', array('id_bilhete' => $id))->row();
    }

}
