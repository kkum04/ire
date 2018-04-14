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
        $primary_category = $this->Product_m->get_product_primary_category();

        $cur_category = $this->input->get("cur_category");
        $cur_page = $this->input->get('per_page');
        $per_page = 10;

        $cur_category = $cur_category == NULL ? $primary_category[0]->id : $cur_category;
        $cur_page = $cur_page == NULL ? '1' : $cur_page;

        $limit_info = Array(
            'limit' => $per_page,
            'start' => ($cur_page - 1) * $per_page
        );

        $query_string = "cur_category={$cur_category}";
        $config = get_paging_config();
        $config['total_rows'] = $this->Product_m->get_product_list($cur_category, NULL, 'count')->cnt;
        $config['per_page'] = $per_page;
        $config['num_links'] = 5;
        $config['base_url'] = base_url(uri_string()).'?'.$query_string;
        $this->pagination->initialize($config);

        $product_list = $this->Product_m->get_product_list($cur_category, $limit_info);

        $data['cur_category'] = $cur_category;
        $data['primary_category'] = $primary_category;
        $data['product_list'] = $product_list;
        $data['total_rows'] = $config['total_rows'];
        $data['total_page'] = ceil($data['total_rows'] / $per_page);
        $data['cur_page'] = $cur_page;
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view("/admin/product/list_v", $data);
    }

    function add() {
        $primary_category = $this->Product_m->get_product_primary_category();

        $data['primary_category'] = $primary_category;
        $this->load->view('/admin/product/add_v', $data);
    }

    function change($product_id) {
        $product_info = $this->Product_m->get_product_info($product_id);
        $primary_category = $this->Product_m->get_product_primary_category();
        $brother_category = $this->Product_m->get_children_product_category($product_info->parent_id);


        $data['product_info'] = $product_info;
        $data['primary_category'] = $primary_category;
        $data['brother_category'] = $brother_category;

        $this->load->view('/admin/product/change_v', $data);
    }

    function upload_product_image() {
        $upload_data = $this->_upload_file('upload', PRODUCT_IMAGE_DIR, 'jpg|gif|jpeg|png');

        if ( isset($upload_data['error']) ==  true)
        {
            echo "[ERROR]".$upload_data['error'];
            return;
        }

        echo PRODUCT_IMAGE_URL.'/'.$upload_data['file_name'];
    }

    function insert_product() {
        $post = $this->input->post();
        if( isset($post["name"]) == false ) {
            redirect_go("이름을 입력하세요.", "/admin/product");
            return false;
        }

        $result = $this->Product_m->insert_product($post);
        if($result == FALSE) {
            redirect_go("상품 추가를 실패했습니다.", "/admin/product");
            return FALSE;
        }

        $this->Product_m->update_product($result, Array('order' => $result));

        redirect_go("상품을 추가 했습니다.", "/admin/product");
    }

    function update_product($product_id) {
        $post = $this->input->post();
        if( isset($post["name"]) == false ) {
            redirect_go("이름을 입력하세요.", "/admin/product");
            return false;
        }

        $result = $this->Product_m->update_product($product_id, $post);
        if($result == FALSE) {
            redirect_go("상품 수정을 실패했습니다.", "/admin/product");
            return FALSE;
        }

        redirect_go("상품을 수정 했습니다.", "/admin/product");
    }

    function delete_product($product_id) {
        $result = $this->Product_m->delete_product($product_id);
        if($result == FALSE) {
            redirect_go("상품 삭제를 실패했습니다.", "/admin/product");
            return FALSE;
        }

        redirect_go("상품을 삭제 했습니다.", "/admin/product");
    }

    function get_product_category($parent_category) {
        $product_category_list = $this->Product_m->get_children_product_category($parent_category);

        echo json_encode($product_category_list);
    }

    function update_product_order($src_product_id, $direction) {
        $src_product_info = $this->Product_m->get_product_info($src_product_id);

        if( $direction == 'prev') {
            $target_product_info = $this->Product_m->get_prev_product(
                $src_product_info->order,
                $src_product_info->parent_id
            );
        } else {
            $target_product_info = $this->Product_m->get_next_product(
                $src_product_info->order,
                $src_product_info->parent_id
            );
        }

        if($target_product_info == NULL) {
            redirect_back('');
            return;
        }

        $result = $this->Product_m->update_product_order($src_product_id, $target_product_info->id);
        if( $result == TRUE ) {
            redirect_back('순서 변경 완료');
        } else {
            redirect_back('순서 변경 실패');
        }
    }
}