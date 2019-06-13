<?php 

namespace Models;

class Config_email{

    private $smtp_host;
    private $smtp_user;
    private $smtp_port;
    private $smtp_pass;

    function __construct() {
        $this->smtp_host = "";
        $this->smtp_user = "";
        $this->smtp_port = 0;
        $this->smtp_pass = "";
    }

    /**
     * smtp_host
     * @type varchar
     */
    public function getSmtp_host() {
        return $this->smtp_host;
    }
    public function setSmtp_host($smtp_host) {
        $this->smtp_host = $smtp_host;
        return $this;
    }

    /**
     * smtp_user
     * @type varchar
     */
    public function getSmtp_user() {
        return $this->smtp_user;
    }
    public function setSmtp_user($smtp_user) {
        $this->smtp_user = $smtp_user;
        return $this;
    }

    /**
     * smtp_port
     * @type int
     */
    public function getSmtp_port() {
        return $this->smtp_port;
    }
    public function setSmtp_port($smtp_port) {
        $this->smtp_port = $smtp_port;
        return $this;
    }

    /**
     * smtp_pass
     * @type varchar
     */
    public function getSmtp_pass() {
        return $this->smtp_pass;
    }
    public function setSmtp_pass($smtp_pass) {
        $this->smtp_pass = $smtp_pass;
        return $this;
    }

}