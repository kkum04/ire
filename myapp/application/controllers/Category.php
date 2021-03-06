<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/admin/Admin.php');

class Category extends Ire_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->library('pagination');
    }

    function index($category_id)
    {
        if( $category_id == null ) {
            $categories = $this->Category_m->get_categories();
            $category = $categories[0];
        } else {
            $category = $this->Category_m->get_category($category_id);
        }

        if($category == null){
            redirect_go("잘못된 접근입니다.", "/");
            return;
        }

        $category_products = $this->Product_m->get_products($category_id);
        $data['category'] = $category;
        $data['category_products'] = $category_products;

        $this->load->view('/category/category_v', $data);
    }
}