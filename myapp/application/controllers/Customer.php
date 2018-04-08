<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends Ire_Controller {

    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		$this->lists();
	}

	public function lists() {
        $this->load->view('/customer/lists');
    }

	public function detail() {
        $this->load->view('/customer/detail');
    }
}
