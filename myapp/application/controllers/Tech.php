<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tech extends Ire_Controller {

    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		$this->lists();
	}

	public function lists() {
        $this->load->view('tech/lists_v');
    }
}
