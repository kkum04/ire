<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends Ire_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('banner/Main_m');
    }

	public function index()
	{
	    $data['main_banners'] = $this->Main_m->get_main_banners();


		$this->load->view('main', $data);
	}
}
