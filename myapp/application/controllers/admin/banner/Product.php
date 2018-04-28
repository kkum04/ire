<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/admin/Admin.php');

class Product extends Admin
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('banner/Product_banner_m');
    }

    function index()
    {
        $this->lists();
    }

    function lists() {
        $data['product_banners'] = $this->Product_banner_m->get_product_banners();

        $this->load->view("/admin/banner/product/list_v", $data);
    }

    function update_form($banner_id) {
        $data['product_banner'] = $this->Product_banner_m->get_product_banner($banner_id);
        $this->load->view('/admin/banner/product/update_form_v', $data);
    }

    function update($banner_id) {
        $post = $this->input->post();
        if( isset($post["product_id"]) == false ) {
            redirect_go("제품 id를 입력하세요.", "/admin/banner/product");
            return false;
        }

        $result = $this->Product_banner_m->update_product_banner($banner_id, $post);
        if($result == FALSE) {
            redirect_go("제품배너 수정을 실패했습니다.", "/admin/banner/product");
            return FALSE;
        }

        redirect_go("제품배너를 수정했습니다.", "/admin/banner/product");
    }

    function create_form() {
        $this->load->view('/admin/banner/product/create_form_v');
    }

    function create() {
        $post = $this->input->post();
        if( isset($post["product_id"]) == false ) {
            redirect_go("제품 id를 입력하세요.", "/admin/banner/product");
            return false;
        }

        $result = $this->Product_banner_m->create_product_banner($post);
        if($result == FALSE) {
            redirect_go("제품배너 추가를 실패했습니다.", "/admin/banner/product");
            return FALSE;
        }

        $this->Product_banner_m->update_product_banner($result, Array('order' => $result));

        redirect_go("제품배너를 추가했습니다.", "/admin/banner/product");
    }

    function delete($banner_id) {
        $result = $this->Product_banner_m->delete_product_banner($banner_id);
        if($result == FALSE) {
            redirect_go("제품배너 삭제를 실패했습니다.", "/admin/banner/product");
            return FALSE;
        }

        redirect_go("제품배너를 삭제했습니다.", "/admin/banner/product");
    }


    /**
     * 메인배너  순서 변경
     * @param $src_banner_id
     * @param $direction
     */
    function update_order($src_banner_id, $direction) {
        $src_banner = $this->Product_banner_m->get_product_banner($src_banner_id);

        if( $direction == 'prev') {
            $target_banner = $this->Product_banner_m->get_prev_product_banner(
                $src_banner->order
            );
        } else {
            $target_banner = $this->Product_banner_m->get_next_product_banner(
                $src_banner->order
            );
        }

        if($target_banner == NULL) {
            redirect_back('');
            return;
        }

        $result = $this->Product_banner_m->update_product_banner_order($src_banner_id, $target_banner->banner_id);
        if( $result == TRUE ) {
            redirect_back('순서 변경 완료');
        } else {
            redirect_back('순서 변경 실패');
        }
    }
}