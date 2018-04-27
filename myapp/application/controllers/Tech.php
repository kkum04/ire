<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tech extends Ire_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Tech_m');
    }

	public function index()
	{
		$this->lists();
	}

	public function lists() {
        $data['teches'] = $this->Tech_m->get_teches();
        $this->load->view('tech/lists_v', $data);
    }
}
