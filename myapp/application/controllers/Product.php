<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/admin/Admin.php');

class Product extends Ire_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->library('pagination');
    }

    function index()
    {

    }

    function detail($product_id) {
        $product = $this->Product_m->get_product($product_id);
        if($product == null) {
            redirect_go("잘못된 접근 입니다.", "/");
            return;
        }

        $cur_category_products = $this->Product_m->get_products($product->category_id);

        $data['product'] = $product;
        $data['cur_category_products'] = $cur_category_products;
        $this->load->view('/product/detail_v', $data);
    }
}