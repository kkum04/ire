<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/admin/Admin.php');

class Product extends Admin
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
        $category_id = $this->input->get('cur_category');

        $data['categories'] = $this->Category_m->get_categories();
        if( $category_id == null ) {
            $category_id = $data['categories'][0]->category_id;
        }

        $data['cur_category_id'] = $category_id;
        $data['products'] = $this->Product_m->get_products($category_id);

        $this->load->view("/admin/product/list_v", $data);
    }

    function create_form() {
        $data['categories'] = $this->Category_m->get_categories();

        $this->load->view('/admin/product/create_form_v', $data);
    }

    function create() {
        $post = $this->input->post();
        if( isset($post["product_name"]) == false ) {
            redirect_go("제품 이름을 입력하세요.", "/admin/product");
            return false;
        }

        if( isset($post["product_image"]) == false ) {
        redirect_go("제품 이미지를 등록하세요.", "/admin/product");
            return false;
        }

        $result = $this->Product_m->create_product($post);
        if($result == FALSE) {
            redirect_go("제품 추가를 실패했습니다.", "/admin/product");
            return FALSE;
        }

        $this->Product_m->update_product($result, Array('order' => $result));

        redirect_go("제품을 추가했습니다.", "/admin/product");
    }

    function update_form($product_id) {
        $product = $this->Product_m->get_product($product_id);
        if( $product == null ) {
            redirect_go("잘못된 접근입니다.", "/admin/product");
            return;
        }

        $data['categories'] = $this->Category_m->get_categories();
        $data['product'] = $product;
        $this->load->view('/admin/product/update_form_v', $data);
    }

    function update( $product_id ) {
        $post = $this->input->post();
        if( isset($post["product_name"]) == false ) {
            redirect_go("제품 이름을 입력하세요.", "/admin/product");
            return false;
        }

        $result = $this->Product_m->update_product($product_id, $post);
        if($result == FALSE) {
            redirect_go("제품 수정을 실패했습니다.", "/admin/product");
            return FALSE;
        }

        redirect_go("제품을 수정했습니다.", "/admin/product");
    }

    function upload_product_image() {
        $upload_data = $this->_upload_file('upload', IMAGE_DIR, 'jpg|gif|jpeg|png|pdf|dwg');

        if ( isset($upload_data['error']) ==  true)
        {
            echo "[ERROR]".$upload_data['error'];
            return;
        }

        echo IMAGE_URL.'/'.$upload_data['file_name'];
    }

    function delete($product_id) {
        $result = $this->Product_m->delete_product($product_id);
        if($result == FALSE) {
            redirect_go("제품 삭제를 실패했습니다.", "/admin/product");
            return FALSE;
        }

        redirect_go("제품을 삭제했습니다.", "/admin/product");
    }


    function update_order($src_product_id, $direction) {
        $src_product = $this->Product_m->get_product($src_product_id);

        if( $direction == 'prev') {
            $target_product = $this->Product_m->get_prev_product(
                $src_product->order,
                $src_product->category_id
            );
        } else {
            $target_product = $this->Product_m->get_next_product(
                $src_product->order,
                $src_product->category_id
            );
        }



        if($target_product == NULL) {
            redirect_back('');
            return;
        }

        $result = $this->Product_m->update_product_order($src_product_id, $target_product->product_id);
        if( $result == TRUE ) {
            redirect_back('순서 변경 완료');
        } else {
            redirect_back('순서 변경 실패');
        }
    }
}