<?php

date_default_timezone_set('America/Sao_Paulo');

class upload extends CI_Controller {

    public function uploadImg() {
        if (isset($_FILES["images"])) {
            $session = $this->session->userdata();
            $error = $_FILES["images"]["error"];
            $hash = substr(sha1($_FILES["images"]["name"]), 0, 6);
            $ext = strtolower($this->getExtension(stripslashes($_FILES["images"]["name"])));
            $image_name = mb_strtolower($session['nome']) . '-' . $session['id'] . '-' . $hash . '.' . $ext;
            if (!$error) {
                $valid_formats = array("jpg", "png", "gif", "bmp", "jpeg");
                if (in_array($ext, $valid_formats)) {
                    define("MAX_SIZE", 2000);
                    $size = filesize($_FILES['images']['tmp_name']);
                    if ($size < MAX_SIZE * 1024) {
                        $output_dir = "uploaded_imgs/";
                        move_uploaded_file($_FILES["images"]["tmp_name"], $output_dir . $image_name);
                        $return = array('0' => $image_name, 'status' => 'success', 'class' => 'success', 'msg' => 'Arquivos salvos com sucesso!');
                    } else {
                        $return = ['file' => $image_name, 'status' => 'error', 'class' => 'danger', 'msg' => 'Tamanho de imagem excede o limite!'];
                    }
                } else {
                    $return = ['file' => $image_name, 'status' => 'error', 'class' => 'danger', 'msg' => 'Formato de imagem inválido!'];
                }
            } else {
                $return = ['file' => $image_name, 'status' => 'error', 'class' => 'danger', 'msg' => 'Erro ao fazer upload da imagem!' . $error];
            }

            header('Content-type: application/json');
            echo json_encode($return);
        }
    }

    public function getExtension($str) {
        $i = strrpos($str, ".");
        if (!$i) {
            return "";
        }
        $l = strlen($str) - $i;
        $ext = substr($str, $i + 1, $l);
        return $ext;
    }

}
