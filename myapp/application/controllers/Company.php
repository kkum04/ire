<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends Ire_Controller {

    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		$this->ceo();
	}

	public function ceo() {
        $this->load->view('company/ceo');
    }

    public function history() {
        $this->load->view('company/history');
    }

    public function way() {
        $this->load->view('company/way');
    }
}
