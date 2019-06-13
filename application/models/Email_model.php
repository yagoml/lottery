<?php

class Email_model extends CI_Model {

    /**
     * Send CI Email
     * @author Yago ML
     * @param array $email [subject*, to*, msg*, cc, cco, attach]
     */
    public function sendEmail($email) {
        $this->load->library('email');
        $this->load->config('email');

        $this->email->from(\Repository\Config_email::email(), \Repository\Config_system::titulo());
        $this->email->subject($email['subject']);
        $this->email->reply_to(\Repository\Config_email::email());
        $this->email->to($email['to']);

        if (isset($email['cc'])) {
            $this->email->cc($email['cc']);
        }
        if (isset($email['cco'])) {
            $this->email->bcc($email['cco']);
        }
        if (isset($email['attach'])) {
            $this->email->attach($email['attach']);
        }

        $this->email->message($this->_htmlMail($email['msg']));
        $this->email->send();

//        echo $this->email->print_debugger();
//        exit;
    }

    private function _htmlMail($msg) {
        $logomarca = base_url("lib/images/logo.png");

        return '<html>
        <head>
            <title>' . \Repository\Config_system::titulo() . '</title>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        </head>
        <body>
            <header>

            </header>

            <div style="margin: 20px 0;">
                <span>' . $msg . '</span>
            </div>

            <footer>
                <div>
                    <a href="' . base_url() . '" target="_blank">
                        <img src="' . $logomarca . '" title="' . \Repository\Config_system::titulo() . '" width="175" height="78" alt="">
                    </a>    
                </div>
                <div>
                    <a title="' . \Repository\Config_system::titulo() . '" href="' . base_url() . '">' . \Repository\Config_system::titulo() . ' ©' . date('Y') . '</a>
                </div>
            </footer>
        </body>
    </html>';
    }

}
