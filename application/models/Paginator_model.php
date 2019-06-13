<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Paginator_model extends CI_model {

    /**
     * Monta paginação com itens e links
     * @param string $model = models/$model 
     * @param string $function = models/$model->$function 
     * @param int $per_page = Itens por páginas
     * @param string $uri = Caminho 1ª página
     * @return array com itens buscados e links de paginação
     * @author Yago M. Laignier <yagoskor@gmail.com>
     */
    public function ciPaginator($model, $function, $per_page, $uri) {
        $start = $start = $this->uri->segment(3) ? $start = $this->uri->segment(3) : 0;
        $this->load->model($model);

        $totalRows = count($this->$model->$function());
        $config['base_url'] = base_url($uri);
        $config['total_rows'] = $totalRows;
        $config['per_page'] = $per_page;
        $config['first_link'] = '1';
        $config['last_link'] = $totalRows / $per_page;
        $config['next_link'] = '<i class="glyphicon glyphicon-chevron-right"></i>';
        $config['prev_link'] = '<i class="glyphicon glyphicon-chevron-left"></i>';

        $itens = $this->$model->$function(['start' => $start, 'limit' => $per_page]);

        $this->pagination->initialize($config);
        $links = $this->pagination->create_links();

        return array(
            'links' => $links,
            'itens' => $itens
        );
    }

    /**
     * Monta paginação com itens e links
     * @param string $model = models/$model 
     * @param string $function = models/$model->$function 
     * @param int $per_page = Itens por páginas
     * @param string $uri = Caminho 1ª página
     * @return array com itens buscados e links de paginação
     * @author Yago M. Laignier <yagoskor@gmail.com>
     */
    public function ciPaginatorFiltered($model, $function, $where, $per_page, $uri, $segment) {
        $start = $this->uri->segment($segment) ? $this->uri->segment($segment) : 0;

        $this->load->model($model);

        $filter = ['where' => $where];
        $totalRows = count($this->$model->$function($filter));
        $config['base_url'] = base_url($uri);
        $config['total_rows'] = $totalRows;
        $config['per_page'] = $per_page;
        $config['first_link'] = '1';
        $config['last_link'] = $totalRows / $per_page;
        $config['next_link'] = '<i class="glyphicon glyphicon-chevron-right"></i>';
        $config['prev_link'] = '<i class="glyphicon glyphicon-chevron-left"></i>';

        $this->pagination->initialize($config);
        $links = $this->pagination->create_links();

        $filter = ['where' => $where, 'start' => $start, 'limit' => $per_page];
        $itens = $this->$model->$function($filter);

        $pagination = array(
            'links' => $links,
            'itens' => $itens
        );
        return $pagination;
    }

    public function ciPaginatorFilters($model, $function, $filters, $per_page, $uri) {
        $start = $this->input->get('per_page') ? $this->input->get('per_page') : 0;
        $this->load->model($model);

        $config['page_query_string'] = TRUE;
        $totalRows = count($this->$model->$function($filters));
        $config['base_url'] = base_url($uri);
        $config['total_rows'] = $totalRows;
        $config['per_page'] = $per_page;
        $config['first_link'] = '1';
        $config['last_link'] = ceil($totalRows / $per_page);
        $config['next_link'] = '<i class="glyphicon glyphicon-chevron-right"></i>';
        $config['prev_link'] = '<i class="glyphicon glyphicon-chevron-left"></i>';

        $this->pagination->initialize($config);
        $links = $this->pagination->create_links();

        $filters['start'] = $start;
        $filters['limit'] = $per_page;

        $itens = $this->$model->$function($filters);

        $pagination = array(
            'links' => $links,
            'itens' => $itens
        );
        return $pagination;
    }

}
