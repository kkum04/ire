<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends Ire_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('banner/Main_m');
        $this->load->model('banner/Product_banner_m');
    }

	public function index()
	{
	    $data['main_banners'] = $this->Main_m->get_main_banners();
	    $data['product_banners'] = $this->Product_banner_m->get_product_banners();


		$this->load->view('main', $data);
	}
}
