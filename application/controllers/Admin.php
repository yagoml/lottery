<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function index() {
        if ($this->session->userdata('admin')) {
            $data['pagina'] = 'admin/main';
            $data['paginaInterna'] = 'admin/painel/inicio';
            $this->load->view('index', $data);
        } else {
            redirect('admin/login');
        }
    }

    public function checkLogin() {
        $login = $this->input->post('login');
        $password = $this->input->post('password');
        $captcha_data = $this->input->post('g-recaptcha-response');

        $this->load->model('admin_model');
        $login = $this->admin_model->checkAdm($login, $password, $captcha_data);

        if (isset($login['id_adm'])) {
            $this->session->admin = $login;
            echo json_encode(array('url' => base_url('admin')));
        } else {
            echo json_encode($login);
        }
    }

    public function login() {
        $data['pagina'] = 'admin/login';
        $data['title'] = 'Administração';
        $data['breadCrumb'] = array(
            0 => (object) array('section' => 'Início', 'link' => base_url()),
            1 => (object) array('section' => 'ADM', 'link' => '')
        );
        $this->load->view('index', $data);
    }

    public function configEmail() {
        if ($this->session->userdata('admin')) {
            $this->load->model("admin_model");
            $config = $this->input->post();
            if ($config) {
                $this->load->model('admin_model');
                $this->admin_model->saveConfigEmail($config);
            } else {
                $data['pagina'] = 'admin/main';
                $data['paginaInterna'] = 'admin/painel/config_email';
                $data['configEmail'] = $this->admin_model->getConfigEmail();
                $this->load->view('index', $data);
            }
        } else {
            redirect();
        }
    }

    public function configSystem() {
        if ($this->session->userdata('admin')) {
            $config = $this->input->post();
            if ($config) {
                $this->load->model('admin_model');
                $this->admin_model->saveConfigSystem($config);
            } else {
                $data['pagina'] = 'admin/main';
                $data['paginaInterna'] = 'admin/painel/config_system';
                $data['configSystem'] = $this->db->get('config_system')->row();

                $this->load->view('index', $data);
            }
        } else {
            redirect();
        }
    }

    public function configSorteios() {
        if ($this->session->userdata('admin')) {
            $config = $this->input->post();
            if ($config) {
                $this->load->model('admin_model');
                $this->admin_model->saveConfigSorteios($config);
            } else {
                $data['pagina'] = 'admin/main';
                $data['paginaInterna'] = 'admin/painel/config_sorteios';
                $data['configSorteios'] = $this->db->get('config_sorteios')->row();

                $this->load->view('index', $data);
            }
        } else {
            redirect();
        }
    }

    public function configComissoes() {
        if ($this->session->userdata('admin')) {
            $this->load->model("admin_model");
            $comission = $this->input->post();
            if ($comission) {
                $this->admin_model->addPercentComission($comission);
            } else {
                $data['pagina'] = 'admin/main';
                $data['paginaInterna'] = 'admin/painel/config_comissoes/config_comissoes';

                $data['comissoes'] = $this->admin_model->getOpComissions();
                $data['percentComissoes']['bilhetes'] = $this->admin_model->getPercentComissoes('comissao_bilhetes');
                $data['percentComissoes']['premios'] = $this->admin_model->getPercentComissoes('comissao_premio');
                $this->load->view('index', $data);
            }
        } else {
            redirect();
        }
    }

    public function extrato() {
        if ($this->session->userdata('admin')) {
            $this->load->model('admin_model');
            if ($this->input->get()) {
                $data = $this->admin_model->extratosCompany($this->input->get('startDate'), $this->input->get('endDate'));
            }

            $data['pagina'] = 'admin/main';
            $data['paginaInterna'] = 'admin/painel/extrato';

            $this->load->view('index', $data);
        } else {
            redirect();
        }
    }

    public function sorteiosConcluidos() {
        if ($this->session->userdata('admin')) {
            $data['pagina'] = 'admin/main';
            $data['paginaInterna'] = 'admin/painel/sorteios_concluidos';


            if ($this->input->post()) {
                $filters = $this->input->post();
                $errors = \RN\SorteioRN::validaFiltroSortsConcluidos($filters);
                if (!$errors) {
                    $this->load->model('sorteios_model');
                    $data['sorteios'] = $this->sorteios_model->filtro($filters);
                    $data['filtroInfo'] = $this->sorteios_model->filtroInfo($filters);
                    $pagination = $this->sorteios_model->filtroPagination($filters);
                } else {
                    echo json_encode(array('msg' => '<u>Não foi possivel filtrar. Erro(s) encontrado(s):</u><br><br><b>' . $errors . '</b>', 'class' => 'danger'));
                }
                exit;
            } else {
                $this->load->model('paginator_model');
                $this->load->model('sorteios_model');
                $data['sorteios'] = $this->sorteios_model->getSorteiosConcluidos();
                $pagination = $this->paginator_model->ciPaginator('sorteios_model', 'getSorteiosConcluidos', 25, 'admin/sorteiosConcluidos');

                $data['sorteios'] = $pagination['itens'];
            }

            if (isset($errors) && !$errors || !isset($errors)) {
                $data['links'] = $pagination['links'];

                foreach ($data['sorteios'] as &$sorteio) {
//                    $filter = ['where' => $sorteio->id_sorteio];
                    $sorteio->ganhouCom = $this->sorteios_model->qtdTicketsUser($sorteio->id_sorteio, $sorteio->id_usuario);
                }
            }

            if (isset($filters)) {
                $data['filters'] = $filters;
                $result = array(
                    'view' => $this->load->view($data['paginaInterna'], $data, true),
                );
                $this->output->set_output(json_encode($result));
            } else {
                $this->load->view('index', $data);
            }
        } else {
            redirect();
        }
    }

    public function sorteios() {
        if ($this->session->userdata('admin')) {
            $data['pagina'] = 'admin/main';
            $data['paginaInterna'] = 'admin/painel/sorteios/sorteios';

            if ($this->input->post()) {
                $sorteio = $this->input->post();
                $errors = \RN\SorteioRN::validaNewSorteio($sorteio);
                if (!$errors) {
                    $this->load->model('sorteios_model');
                    $data['sorteios'] = $this->sorteios_model->filtroSorteios($sorteio);
                }
            } else {
                $this->load->model('sorteios_model');
                $data['sorteios'] = $this->sorteios_model->getSorteiosDisponiveis();
            }

            if (isset($errors) && !$errors || !isset($errors)) {
                if (isset($sorteio)) {
                    $result = array(
                        'view' => $this->load->view($data['paginaInterna'], $data, true),
                    );
                    $this->output->set_output(json_encode($result));
                } else {
                    $this->load->view('index', $data);
                }
            }
        } else {
            redirect();
        }
    }

    public function usuarios() {
        if ($this->session->userdata('admin')) {
            $data['pagina'] = 'admin/main';
            $data['paginaInterna'] = 'admin/painel/usuarios/usuarios';

            if ($this->input->post()) {
                $usuario = $this->input->post();
//                $errors = \RN\SorteioRN::validaNew($usuario);
                if (!$errors) {
                    $this->load->model('usuarios_model');
                    $data['usuarios'] = $this->usuarios_model->filtroUsuarios($usuario);
                }
            } else {
                $this->load->model('usuarios_model');
                $data['usuarios'] = \Repository\Usuarios::getUsuarios(array('order' => 'data_cadastro'));
            }

            if (isset($errors) && !$errors || !isset($errors)) {
                if (isset($usuario)) {
                    $result = array(
                        'view' => $this->load->view($data['paginaInterna'], $data, true),
                    );
                    $this->output->set_output(json_encode($result));
                } else {
                    $this->load->view('index', $data);
                }
            }
        } else {
            redirect();
        }
    }

    public function newSorteio() {
        if ($this->session->userdata('admin')) {
            $data = $this->input->post();
            $this->load->model('admin_model');
            echo json_encode($this->admin_model->newSorteio($data));
        } else {
            redirect();
        }
    }

    public function editSorteio() {
        if ($this->session->userdata('admin')) {
            $data = $this->input->post();
            $this->load->model('admin_model');
            echo json_encode($this->admin_model->editSorteio($data));
        } else {
            redirect();
        }
    }

    public function deleteSorteio($id) {
        if ($this->session->userdata('admin')) {
            $this->load->model('admin_model');
            $this->admin_model->deleteSorteio($id);
            redirect("admin/sorteios");
        } else {
            redirect();
        }
    }

    public function vouchers() {
        if ($this->session->userdata('admin')) {
            $data['pagina'] = 'admin/main';
            $data['paginaInterna'] = 'admin/painel/vouchers/vouchers';

            if ($this->input->get()) {
                $filters = $this->input->get();
                $errors = RN\AdminRN::validaFiltroVouchers($filters);
                if (!$errors) {
                    $this->load->model('admin_model');
                    $data['vouchers'] = $this->admin_model->filtroVouchers($filters);
                    $pagination = $this->admin_model->vouchersPagination($filters);
                    $data['filtroInfo'] = $this->admin_model->filtroVouchersInfo($filters);
                }
            } else {
                $this->load->model('paginator_model');
                $this->load->model('admin_model');
                $data['vouchers'] = $this->admin_model->getVouchers();
                $pagination = $this->paginator_model->ciPaginator('admin_model', 'getVouchers', 25, 'admin/vouchers');
                $data['vouchers'] = $pagination['itens'];
                $data['links'] = $pagination['links'];
            }

            if (isset($filters)) {
                $data['filters'] = $filters;
                $result = array(
                    'view' => $this->load->view($data['paginaInterna'], $data, true),
                );
                $this->output->set_output(json_encode($result));
            } else {
                $this->load->view('index', $data);
            }
        } else {
            redirect();
        }
    }

    public function newVoucher() {
        if ($this->session->userdata('admin')) {
            $data = $this->input->post();
            $this->load->model('admin_model');
            echo json_encode($this->admin_model->newVoucher($data));
        } else {
            redirect();
        }
    }

    public function editVoucher() {
        if ($this->session->userdata('admin')) {
            $data = $this->input->post();
            $this->load->model('admin_model');
            echo json_encode($this->admin_model->editVoucher($data));
        } else {
            redirect();
        }
    }

    public function deleteVoucher($idVoucher) {
        if ($this->session->userdata('admin')) {
            $this->load->model('admin_model');
            $this->admin_model->deleteVoucher($idVoucher);
            redirect("admin/vouchers");
        } else {
            redirect();
        }
    }

    public function deleteUser($id) {
        if ($this->session->userdata('admin')) {
            $this->load->model('admin_model');
            $this->admin_model->deleteUser($id);
            redirect("admin/usuarios");
        } else {
            redirect();
        }
    }

    public function deleteComission() {
        if ($this->session->userdata('admin')) {
            $this->load->model('admin_model');
            if ($this->admin_model->deleteComission($this->input->post())) {
                echo json_encode(array('class' => 'success', 'msg' => 'Deletado com sucesso!'));
            }
        } else {
            redirect();
        }
    }

    public function editPercComission() {
        if ($this->session->userdata('admin')) {
            $data = $this->input->post();
            $this->load->model('admin_model');
            echo json_encode($this->admin_model->editPercComission($data));
        } else {
            redirect();
        }
    }

    public function editUser() {
        if ($this->session->userdata('admin')) {
            $data = $this->input->post();
            $this->load->model('admin_model');
            echo json_encode($this->admin_model->editUser($data));
        } else {
            redirect();
        }
    }

    public function ggApiKeyJson() {
        echo json_encode(array('key' => \Repository\Config_system::ggApiKey()));
    }

}
