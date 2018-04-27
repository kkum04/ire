<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends Ire_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->library('pagination');
        $this->load->model('Faq_m');
    }

	public function index()
	{
		$this->lists();
	}

	public function lists() {
        $cur_page = $this->input->get('per_page');
        $cur_page = $cur_page == NULL ? '1' : $cur_page;
        $per_page = 10;

        $limit_info = Array(
            'limit' => $per_page,
            'start' => ($cur_page - 1) * $per_page
        );
        $config = get_paging_config();
        $config['total_rows'] = $this->Faq_m->get_faq_list(NULL, 'count')->cnt;
        $config['per_page'] = $per_page;
        $config['num_links'] = 5;
        $config['base_url'] = base_url(uri_string());
        $this->pagination->initialize($config);


        $data['total_rows'] = $config['total_rows'];
        $data['total_page'] = ceil($data['total_rows'] / $per_page);
        $data['cur_page'] = $cur_page;
        $data['pagination'] = $this->pagination->create_links();
        $data['faq_lists'] = $this->Faq_m->get_faq_list($limit_info);


        $this->load->view('/customer/lists_v', $data);
    }

	public function view($faq_id) {
        $faq = $this->Faq_m->get_faq_info($faq_id);
        if( $faq == null ) redirect("/customer/faq");

        $update_data = Array();
        $update_data['hit'] = $faq->hit++;
        $this->Faq_m->update_faq($faq_id, $faq);


        $data['faq'] = $faq;
        $this->load->view('/customer/detail_v', $data);
    }
}
