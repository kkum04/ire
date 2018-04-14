<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/admin/Admin.php');

class Category extends Admin
{
    function __construct()
    {
        parent::__construct();

        $this->load->library('pagination');
    }

    function index()
    {
        $this->lists();
    }

    function lists() {
        $data['categories'] = $this->Category_m->get_categories();

        $this->load->view("/admin/category/list_v", $data);
    }

    function update_order($src_category_id, $direction) {
        $src_category = $this->Category_m->get_category($src_category_id);

        if( $direction == 'prev') {
            $target_category = $this->Category_m->get_prev_category(
                $src_category->order
            );
        } else {
            $target_category = $this->Category_m->get_next_category(
                $src_category->order
            );
        }

        if($target_category == NULL) {
            redirect_back('');
            return;
        }

        $result = $this->Category_m->update_category_order($src_category_id, $target_category->category_id);
        if( $result == TRUE ) {
            redirect_back('순서 변경 완료');
        } else {
            redirect_back('순서 변경 실패');
        }
    }
}