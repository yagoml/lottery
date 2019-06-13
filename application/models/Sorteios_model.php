<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sorteios_model extends CI_Model {

    private $sorteios;

    public function __construct() {
        $this->sorteios = new AbstractDAOs\Sorteios();
        parent::__construct();
    }

    public function inscritos($filter) {
        try {
            $inscritos = $this->db->query("SELECT *, count(*) as bilhetes FROM bilhetes b, usuarios U, niveis N WHERE b.sorteios_id = " . (int) $filter['where'] . " AND b.usuarios_id = U.id_usuario AND N.nivel = (SELECT nivel FROM niveis WHERE exp <= U.xp order by exp DESC LIMIT 1) GROUP BY usuarios_id ORDER BY bilhetes DESC" . (isset($filter['start']) ? ' LIMIT ' . $filter['start'] . ', ' . $filter['limit'] : ''))->result();
            $this->sorteios->setInscritos($inscritos);
            return $this->sorteios->getInscritos();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function qtdTicketsUser($sorteioId, $usuarioId) {
        try {
            $bilhetesGanhador = $this->db->query("SELECT count(*) AS bilhetes FROM bilhetes b, usuarios u WHERE b.usuarios_id = u.id_usuario AND b.sorteios_id = " . (int) $sorteioId . " AND b.usuarios_id = " . (int) $usuarioId . " GROUP BY u.id_usuario;")->result();
            $this->sorteios = new AbstractDAOs\Sorteios();
            $this->sorteios->setBilhetesGanhador($bilhetesGanhador);
            return $bilhetesGanhador ? current($this->sorteios->qtdTicketsUser())->bilhetes : 0;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getTicketsUser($sorteioId, $usuarioId) {
        try {
            return $this->db->query("SELECT * FROM bilhetes b, usuarios u WHERE b.usuarios_id = u.id_usuario AND b.sorteios_id = " . (int) $sorteioId . " AND b.usuarios_id = " . (int) $usuarioId)->result();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function totalTicketsUser($usuarioId) {
        try {
            return $this->db->query("SELECT bilhetes FROM usuarios WHERE id_usuario = " . (int) $usuarioId)->row()->bilhetes;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getBilhetesSorteio($sorteioId) {
        try {
            $bilhetesSorteio = $this->db->query("SELECT * FROM bilhetes WHERE sorteios_id = " . (int) $sorteioId)->result();
            $this->sorteios = new AbstractDAOs\Sorteios();
            $this->sorteios->setBilhetesSorteio($bilhetesSorteio);
            return $this->sorteios->getBilhetesSorteio();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function ticketsSorteio($sorteioId) {
        try {
            return $this->db->query("SELECT b.id_bilhete, b.numero, u.id_usuario, u.apelido FROM bilhetes b, usuarios u WHERE b.sorteios_id = " . (int) $sorteioId . " AND b.usuarios_id = u.id_usuario ORDER BY b.numero")->result();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function estatisticas() {
        try {
            $premiados = $this->db->query('SELECT *, count(bilhete_premiado) as bilhetes, count(U.id_usuario) as usuarios, sum(premio) as premiado FROM sorteios AS S INNER JOIN bilhetes AS B ON S.bilhete_premiado = B.id_bilhete INNER JOIN usuarios AS U ON B.usuarios_id = U.id_usuario group by U.id_usuario ORDER BY premiado desc;')->result();
            $data['totalPremiado'] = 0;
            $data['qtdBilhetesPremiados'] = 0;
            $data['comissoesPagas'] = $this->comissoesPagas();
            $data['usuariosPremiados'] = $premiados;
            foreach ($premiados as $premiado) {
                $data['totalPremiado'] += $premiado->premiado;
                $data['qtdBilhetesPremiados'] += $premiado->bilhetes;
            }
            $data['totalPago'] = $data['totalPremiado'] + $data['comissoesPagas'];
            $this->sorteios = new AbstractDAOs\Sorteios();
            $this->sorteios->setestatisticas($data);
            return $this->sorteios->getestatisticas();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function comissoesPagas() {
        return $this->db->query("SELECT *, SUM(valor) AS total FROM comissoes")->row()->total;
    }

    public function getSorteiosConcluidos($filter = []) {
        try {
            $sorteiosConcluidos = $this->db->query("SELECT S.*, B.*, U.id_usuario, U.apelido AS ganhador, U.xp, count(B2.id_bilhete) bilhetes, N.nivel, count(distinct U2.id_usuario) usuarios FROM sorteios S, bilhetes B, usuarios U, usuarios U2, bilhetes B2, niveis N WHERE S.bilhete_premiado = B.id_bilhete AND B.usuarios_id = U.id_usuario AND B2.sorteios_id = S.id_sorteio AND U2.id_usuario = B2.usuarios_id " . (isset($filter['show_users']) ? ' AND show_users = ' . $filter['show_users'] : '') . " AND N.nivel = (SELECT nivel FROM niveis WHERE exp <= U.xp order by exp DESC LIMIT 1) GROUP BY S.id_sorteio ORDER BY S.data_sorteio DESC" . (isset($filter['start']) ? ' LIMIT ' . $filter['start'] . ', ' . $filter['limit'] : ''))->result();

            $this->sorteios = new AbstractDAOs\Sorteios();
            $this->sorteios->setSorteiosConcluidos($sorteiosConcluidos);
            return $this->sorteios->getSorteiosConcluidos();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function filtro($filter = []) {
        try {
            $this->sorteios->setbusca($this->db->query("SELECT S.*, B.*, U.id_usuario, U.apelido AS ganhador, U.xp, count(B2.id_bilhete) bilhetes, N.nivel, count(distinct U2.id_usuario) usuarios FROM sorteios S, bilhetes B, usuarios U, usuarios U2, bilhetes B2, niveis N WHERE S.bilhete_premiado = B.id_bilhete AND B.usuarios_id = U.id_usuario AND B2.sorteios_id = S.id_sorteio AND U2.id_usuario = B2.usuarios_id AND N.nivel = (SELECT nivel FROM niveis WHERE exp <= U.xp order by exp DESC LIMIT 1) AND show_users = " . $filter['tipo'] . ($filter['numero'] ? ' AND S.numero_sorteio = ' . $filter['numero'] : '') . (isset($filter['usuario']) && $filter['usuario'] ? ' AND U.id_usuario = ' . $filter['usuario'] : '') . ($filter['startDate'] ? " AND S.data_sorteio >= '" . date('Y-m-d H:i:s', strtotime($filter['startDate'])) . "'" : '') . ($filter['endDate'] ? " AND S.data_sorteio <= '" . date('Y-m-d H:i:s', strtotime($filter['endDate']) + 86399) . "'" : '') . ($filter['minPremio'] ? ' AND S.premio >= ' . $filter['minPremio'] : '') . ($filter['maxPremio'] ? ' AND S.premio <= ' . $filter['maxPremio'] : '') . ($filter['minBilhetes'] ? ' AND (SELECT COUNT(id_bilhete) FROM bilhetes WHERE sorteios_id = S.id_sorteio) >= ' . $filter['minBilhetes'] : '') . ($filter['maxBilhetes'] ? ' AND (SELECT count(id_bilhete) FROM bilhetes WHERE sorteios_id = S.id_sorteio) <= ' . $filter['maxBilhetes'] : '') . ($filter['minBilhetesNec'] ? ' AND min_bilhetes >= ' . $filter['minBilhetesNec'] : '') . ($filter['maxBilhetesNec'] ? ' AND min_bilhetes <= ' . $filter['maxBilhetesNec'] : '') . ($filter['minParticipantes'] ? ' AND (SELECT COUNT(DISTINCT usuarios_id) FROM bilhetes WHERE sorteios_id = S.id_sorteio) >= ' . $filter['minParticipantes'] : '') . ($filter['maxParticipantes'] ? ' AND (SELECT COUNT(DISTINCT usuarios_id) FROM bilhetes WHERE sorteios_id = S.id_sorteio) <= ' . $filter['maxParticipantes'] : '') . ($filter['minPreco'] ? ' AND S.preco >= ' . $filter['minPreco'] : '') . ($filter['minPreco'] ? ' AND S.preco >= ' . $filter['minPreco'] : '') . " GROUP BY S.id_sorteio" . ($filter['minAposta'] || $filter['maxAposta'] ? ' HAVING ' : '') . ($filter['minAposta'] ? ' bilhetes >= ' . $filter['minAposta'] : '') . ($filter['maxAposta'] && $filter['minAposta'] ? ' AND bilhetes <= ' . $filter['maxAposta'] : '') . ($filter['maxAposta'] && !$filter['minAposta'] ? ' bilhetes <= ' . $filter['maxAposta'] : '') . " ORDER BY S.data_sorteio DESC" . (isset($filter['start']) ? ' LIMIT ' . $filter['start'] . ', ' . $filter['limit'] : ''))->result());
            return $this->sorteios->getbusca();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function fitroValidation($filters) {
        $errors = RN\SorteioRN::validaFiltroSortsConcluidos($filters);
        if ($errors) {
            echo json_encode(array(
                'class' => 'danger',
                'msg' => '<u>Não foi possivel filtrar. Erro(s) encontrado(s):</u><br><br><b>' . $errors . '</b>'
            ));
            exit;
        } else {
            return TRUE;
        }
    }

    public function filtroPagination($filters) {
        $this->load->model('paginator_model');
        $filters['startDate'] = str_replace('/', '-', $filters['startDate']);
        $filters['endDate'] = str_replace('/', '-', $filters['endDate']);
        return $this->paginator_model->ciPaginatorFilters('sorteios_model', 'filtro', $filters, 12, 'sorteios/concluidos?numero=' . ($filters['numero'] ? $filters['numero'] : '') . '&usuario=' . (isset($filters['usuario']) ? $filters['usuario'] : '') . '&startDate=' . ($filters['startDate'] ? $filters['startDate'] : '') . '&endDate=' . ($filters['endDate'] ? $filters['endDate'] : '') . '&minPremio=' . ($filters['minPremio'] ? $filters['minPremio'] : '') . '&maxPremio=' . ($filters['maxPremio'] ? $filters['maxPremio'] : '') . '&minParticipantes=' . ($filters['minParticipantes'] ? $filters['minParticipantes'] : '') . '&maxParticipantes=' . ($filters['maxParticipantes'] ? $filters['maxParticipantes'] : '') . '&minBilhetes=' . ($filters['minBilhetes'] ? $filters['minBilhetes'] : '') . '&maxBilhetes=' . ($filters['maxBilhetes'] ? $filters['maxBilhetes'] : '') . '&minBilhetesNec=' . ($filters['minBilhetesNec'] ? $filters['minBilhetesNec'] : '') . '&maxBilhetesNec=' . ($filters['maxBilhetesNec'] ? $filters['maxBilhetesNec'] : '') . '&minAposta=' . ($filters['minAposta'] ? $filters['minAposta'] : '') . '&maxAposta=' . ($filters['maxAposta'] ? $filters['maxAposta'] : '') . '&minPreco=' . ($filters['minPreco'] ? $filters['minPreco'] : '') . '&maxPreco=' . ($filters['maxPreco'] ? $filters['maxPreco'] : ''));
    }

    public function filtroInfo($filters) {
        $filtroInfo = '';
        $filtroInfo .= $filters['numero'] ? '<span>Número (<b>' . $filters['numero'] . '</b>)</span>' : '';
        $filtroInfo .= isset($filters['usuario']) && $filters['usuario'] ? '<span>Ganhador (<b>' . $filters['usuario'] . '</b>)</span>' : '';
        $filtroInfo .= isset($filters['tipo']) ? '<span>Tipo (<b>' . ($filters['tipo'] ? 'Roletas' : 'Loteria') . '</b>)</span>' : '';
        $filtroInfo .= $filters['startDate'] ? '<span>Data de: (<b>' . $filters['startDate'] . '</b>)</span>' : '';
        $filtroInfo .= $filters['endDate'] ? '<span>Data até (<b>' . $filters['endDate'] . '</b>)</span>' : '';
        $filtroInfo .= $filters['minPremio'] ? '<span>Prêmio de (<b>' . $filters['minPremio'] . '</b>)</span>' : '';
        $filtroInfo .= $filters['maxPremio'] ? '<span>Prêmio até (<b>' . $filters['maxPremio'] . '</b>)</span>' : '';
        $filtroInfo .= $filters['minPreco'] ? '<span>Preço de (<b>' . $filters['minPreco'] . '</b>)</span>' : '';
        $filtroInfo .= $filters['maxPreco'] ? '<span>Preço até (<b>' . $filters['maxPreco'] . '</b>)</span>' : '';
        $filtroInfo .= $filters['minParticipantes'] ? '<span>Participantes de (<b>' . $filters['minParticipantes'] . '</b>)</span>' : '';
        $filtroInfo .= $filters['maxParticipantes'] ? '<span>Participantes até (<b>' . $filters['maxParticipantes'] . '</b>)</span>' : '';
        $filtroInfo .= $filters['minBilhetes'] ? '<span>Bilhetes de (<b>' . $filters['minBilhetes'] . '</b>)</span>' : '';
        $filtroInfo .= $filters['maxBilhetes'] ? '<span>Bilhetes até (<b>' . $filters['maxBilhetes'] . '</b>)</span>' : '';
        $filtroInfo .= $filters['minBilhetesNec'] ? '<span>Mínimo de Bilhetes (<b>' . $filters['minBilhetesNec'] . '</b>)</span>' : '';
        $filtroInfo .= $filters['maxBilhetesNec'] ? '<span>Máximo de Bilhetes (<b>' . $filters['maxBilhetesNec'] . '</b>)</span>' : '';
        $filtroInfo .= $filters['minAposta'] ? '<span>Aposta de (<b>' . $filters['minAposta'] . '</b>)</span>' : '';
        $filtroInfo .= $filters['maxAposta'] ? '<span>Aposta até (<b>' . $filters['maxAposta'] . '</b>)</span>' : '';
        return $filtroInfo;
    }

    public function getSorteiosDisponiveis($filter = []) {
        try {
            $sorteios = $this->db->query("SELECT * FROM sorteios S WHERE S.bilhete_premiado = 0 " . (isset($filter['where']) ? " AND show_users = " . $filter['where'] : "") . " GROUP BY S.id_sorteio ORDER BY S.data_sorteio ASC" . (isset($filter['start']) ? ' LIMIT ' . $filter['start'] . ', ' . $filter['limit'] : ''))->result();

            $sorteios = $this->addSorteiosInfos($sorteios);

            $this->sorteios = new AbstractDAOs\Sorteios();
            $this->sorteios->setSorteiosDisponiveis($sorteios);
            return $this->sorteios->getSorteiosDisponiveis();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getUserSorteios($userId) {
        $sorteios = $this->db->query("SELECT S.* FROM sorteios S, bilhetes b, usuarios u WHERE S.bilhete_premiado = 0 AND u.id_usuario = " . (int) $userId . " AND b.sorteios_id = S.id_sorteio AND b.usuarios_id = u.id_usuario GROUP BY S.id_sorteio ORDER BY S.data_sorteio ASC")->result();
        return $this->addSorteiosInfos($sorteios);
    }

    public function addSorteiosInfos($sorteios) {
        foreach ($sorteios as $sorteio) {
            $bilhetes = $this->getBilhetesSorteio($sorteio->id_sorteio);
            $sorteio->bilhetes = $bilhetes ? $bilhetes : 0;
            $sorteio->premio = $bilhetes ? RN\SorteioRN::regraPremiacao(count($bilhetes)) : 0;
            $inscritos = $this->inscritos(array('where' => $sorteio->id_sorteio));
            $sorteio->usuarios = $inscritos ? $inscritos : 0;
            $sorteio->bilhetesUser = $this->qtdTicketsUser($sorteio->id_sorteio, $this->session->userdata('user')['id']);
        }
        return $sorteios;
    }

    public function getSorteiosDetalhados($filter = []) {
        try {
            $sorteios = $this->db->query("SELECT S.`*` FROM sorteios S WHERE S.bilhete_premiado = 0 AND show_users = 1 GROUP BY S.id_sorteio ORDER BY S.data_sorteio ASC" . ($filter ? ' LIMIT ' . $filter['start'] . ', ' . $filter['limit'] : ''))->result();

            foreach ($sorteios as $sorteio) {
                $bilhetes = $this->getBilhetesSorteio($sorteio->id_sorteio);
                $sorteio->bilhetes = count($bilhetes);
                $inscritos = $this->inscritos(array('where' => $sorteio->id_sorteio));
                $sorteio->usuarios = count($inscritos);
            }

            $this->sorteios = new AbstractDAOs\Sorteios();
            $this->sorteios->setSorteiosDisponiveis($sorteios);
            return $this->sorteios->getSorteiosDisponiveis();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getSorteioConcluido($sorteioId) {
        try {
            $sorteioConcluido = current($this->db->query("SELECT S.*, B.*, U.id_usuario, U.apelido ganhador, count(B2.id_bilhete) bilhetes, N.nivel FROM sorteios S, bilhetes B, usuarios U, bilhetes B2, niveis N WHERE S.id_sorteio = " . (int) $sorteioId . " AND S.bilhete_premiado = B.id_bilhete AND B.usuarios_id = U.id_usuario AND B2.sorteios_id = S.id_sorteio AND N.nivel = (SELECT nivel FROM niveis WHERE exp <= U.xp order by exp DESC LIMIT 1)")->result());
            $this->sorteios = new AbstractDAOs\Sorteios();
            $this->sorteios->setSorteioConcluido($sorteioConcluido);
            return $this->sorteios->getSorteioConcluido();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getSorteioDisponivel($sorteioId) {
        try {
            $sorteioDisponivel = current($this->db->query("SELECT S.`*`, count(B.id_bilhete) bilhetes, count(distinct U.id_usuario) usuarios, U.id_usuario, U.apelido FROM sorteios S, bilhetes B, usuarios U WHERE S.id_sorteio = " . (int) $sorteioId . " AND S.bilhete_premiado = 0 AND S.id_sorteio = B.sorteios_id AND B.usuarios_id = U.id_usuario")->result());
            $this->sorteios = new AbstractDAOs\Sorteios();
            $this->sorteios->setSorteioDisponivel($sorteioDisponivel);
            return $this->sorteios->getSorteioDisponivel();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function sorteiosAtrasados() {
        return $this->db->query("SELECT * FROM sorteios WHERE bilhete_premiado = 0 AND data_sorteio <= NOW() ORDER BY data_sorteio ASC")->result();
    }

    public function sortear() {
        $this->load->model('usuarios_model');
        $this->load->model('bank_model');
        $this->load->model('admin_model');
        $this->load->model('email_model');

        $sorteios = $this->sorteiosAtrasados();

        foreach ($sorteios as $sorteio) {
            if ($sorteio->premio == 0 && $sorteio->bilhete_premiado == 0) {
                $bilhetes = $this->getBilhetesSorteio($sorteio->id_sorteio);
                $qtdBilhetes = count($bilhetes);

                if ($qtdBilhetes >= $sorteio->min_bilhetes) {
                    $firstTree = array();
                    for ($i = 0; $i < 3; $i++) {
                        $firstTree[] = $bilhetes[array_rand($bilhetes)];
                    }
                    $premiado = $firstTree[array_rand($firstTree)];

                    if ($premiado) {
                        $resultado = array(
                            'data_sorteio' => date('Y-m-d H:i:s', time()),
                            'premio' => \RN\SorteioRN::regraPremiacao($qtdBilhetes),
                            'bilhete_premiado' => $premiado->id_bilhete
                        );
                        $this->db->update('sorteios', $resultado, ['id_sorteio' => $sorteio->id_sorteio]);
                        $winner = \Repository\Usuarios::getUsuario($premiado->usuarios_id);
                        $this->sorteios->setSorteado($winner);
                        $this->usuarios_model->addExp($winner->id_usuario, $qtdBilhetes * Repository\Config_sorteios::multPremio());
                        if ($winner->patrocinador) {
                            $this->usuarios_model->addExp($winner->patrocinador, $qtdBilhetes * Repository\Config_sorteios::multBonusPremio());
                        }
                        $this->bank_model->addSaldo('premiacao_sorteio', $winner->id_usuario, $resultado['premio']);
                        $comissaoPatrocinador = $winner->patrocinador ? $this->bank_model->addComissao($winner->id_usuario, 'comissao_premio', $qtdBilhetes * \Repository\Config_sorteios::precoBilhete()) : '';
                        $this->admin_model->addCompanyComission($qtdBilhetes, $qtdBilhetes * \Repository\Config_sorteios::precoBilhete() - $resultado['premio'] - $comissaoPatrocinador);
                        $this->deleteChat($sorteio->id_sorteio);
                        $this->sendEmailSorteio($sorteio);
                    }
                } else {
                    $this->adiaSorteio($sorteio, 300);
                }
            }
        }
    }

    public function adiaSorteio($sorteio, $segundos) {
        return $this->db->query("UPDATE sorteios SET data_sorteio = '" . date('Y-m-d H:i:s', strtotime($sorteio->data_sorteio) + $segundos) . "' WHERE id_sorteio = " . (int) $sorteio->id_sorteio);
    }

    public function addJogador() {
        $sorteioId = $this->input->post('sorteio');
        $bilhetes = $this->input->post('bilhetes');
        $jogador = current($this->db->get_where('usuarios', array('id_usuario' => $this->session->userdata('user')['id']))->result());
        $errors = \RN\SorteioRN::validaNumBilhetes($jogador->bilhetes, $bilhetes, $sorteioId);
        if (!$errors) {
            try {
                for ($i = 1; $i <= $bilhetes; $i++) {
                    do {
                        $numero = rand(1000, 9999);
                        $exists = $this->ticketSorteioByNumber($sorteioId, $numero);
                    } while ($exists);

                    $this->db->insert('bilhetes', array('sorteios_id' => $sorteioId, 'numero' => $numero, 'usuarios_id' => $jogador->id_usuario));
                }

                $this->removeBilhetes($jogador->id_usuario, $bilhetes);
                $this->load->model('usuarios_model');
                $this->usuarios_model->addExp($jogador->id_usuario, $bilhetes * Repository\Config_sorteios::multBilhetes());
                if ($jogador->patrocinador) {
                    $this->usuarios_model->addExp($jogador->patrocinador, $bilhetes * Repository\Config_sorteios::multBonusBilhetes());
                }

                $data = array(
                    'class' => 'success',
                    'msg' => '<b>' . $bilhetes . '</b> apostados! Boa Sorte! (+ ' . $bilhetes * Repository\Config_sorteios::multBilhetes() . ' xp)',
                );
            } catch (Exception $exc) {
                echo $exc->getMessage();
            }
        } else {
            $data = array(
                'class' => 'danger',
                'msg' => '<u>Não foi possível apostar:</u><br><br><b>' . $errors . '</b>'
            );
        }
        echo json_encode($data);
    }

    public function removeBilhetes($userId, $bilhetes) {
        return $this->db->query("UPDATE usuarios SET bilhetes = (bilhetes - " . (int) $bilhetes . ") WHERE id_usuario = " . (int) $userId);
    }

    public function deleteChat($id) {
        $filename = str_replace('/', '\\', $_SERVER['DOCUMENT_ROOT']) . 'sorte\chats\sorteio_' . $id . '.txt';
        unlink($filename);
    }

    public function resultSorteio($idSorteio) {
        return $this->db->query("SELECT id_usuario, u.apelido, s.show_users FROM sorteios s, bilhetes b, usuarios u WHERE s.bilhete_premiado = b.id_bilhete AND u.id_usuario = b.usuarios_id AND s.id_sorteio = " . (int) $idSorteio . " GROUP BY u.id_usuario")->row();
    }

    public function getUsersOfSorteio($idSorteio) {
        return $this->db->query("SELECT DISTINCT u.id_usuario, u.apelido, u.email, count(b.id_bilhete) AS bilhetes FROM sorteios s, bilhetes b, usuarios u WHERE b.sorteios_id = s.id_sorteio AND u.id_usuario = b.usuarios_id AND s.id_sorteio = " . (int) $idSorteio . " GROUP BY u.id_usuario")->result();
    }

    public function getTotalBilhetes($idSorteio) {
        return $this->db->query("SELECT count(b.id_bilhete) AS bilhetes FROM sorteios s, bilhetes b WHERE b.sorteios_id = s.id_sorteio AND s.id_sorteio = " . (int) $idSorteio)->row()->bilhetes;
    }

    public function ticketSorteioByNumber($idSorteio, $ticketNum) {
        return $this->db->query("SELECT * FROM bilhetes WHERE sorteios_id = " . (int) $idSorteio . " AND numero = " . $ticketNum)->row();
    }

    public function sendEmailSorteio($sorteio) {
        $sorteio = $this->getSorteioConcluido(10);
        $users = $this->getUsersOfSorteio($sorteio->id_sorteio);

        $email['to'] = \Repository\Config_email::email();
        $email['subject'] = $sorteio->show_users ? 'Roleta da Sorte Premiada' : 'Sorteio Realizado';

        $email['msg'] = 'Olá Jogador, <br><br>';
        $email['msg'] = '<u>' . \Repository\Config_system::titulo() . ' informa:</u><br><br>';
        $email['msg'] .= $sorteio->show_users ? 'Uma <b>Roleta da Sorte</b> da qual você participava foi <b>Premiada</b>! <br><br>' : 'Um <b>Sorteio</b> do qual você participava foi foi <b>Sorteado</b>! <br><br>';
        $email['msg'] .= '<div style="margin-top: 20px;"></div><a style="background: rgba(49,180,4,1); padding: 10px; color: white; text-decoration: none; border-radius: 3px;" href="' . base_url('sorteios/concluido/' . $sorteio->id_sorteio) . '">Ver Resultado</a>';

        $email['cco'] = '';
        foreach ($users as $k => $user) {
            if ($k > 0) {
                $email['cco'] .= ', ';
            }
            $email['cco'] .= $user->email;
        }

        $this->load->model('email_model');
        return $this->email_model->sendEmail($email);
    }

}
