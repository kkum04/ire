<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH.'controllers/admin/Admin.php');


class Faq extends Admin
{
    function __construct()
    {
        parent::__construct();

        $this->load->library('pagination');
        $this->load->model('Faq_m');
    }

    function index()
    {
        $this->lists();
    }

    function lists() {
        $cur_page = $this->input->get('per_page');
        $cur_page = $cur_page == NULL ? '1' : $cur_page;
        $per_page = 10;

        $limit_info = Array(
            'limit' => $per_page,
            'start' => ($cur_page - 1) * $per_page
        );
        $config = get_paging_config();
        $config['total_rows'] = $this->Faq_m->get_faq_list(NULL, 'count')->cnt;
        $config['per_page'] = $per_page;
        $config['num_links'] = 5;
        $config['base_url'] = base_url(uri_string());
        $this->pagination->initialize($config);


        $data['total_rows'] = $config['total_rows'];
        $data['total_page'] = ceil($data['total_rows'] / $per_page);
        $data['cur_page'] = $cur_page;
        $data['pagination'] = $this->pagination->create_links();
        $data['faq_list'] = $this->Faq_m->get_faq_list($limit_info);

        $this->load->view("/admin/faq/list_v", $data);
    }

    function view($faq_id) {
        $data['faq_info'] = $this->Faq_m->get_faq_info($faq_id);

        $this->load->view("/admin/faq/detail_v", $data);
    }

    function add() {
        $this->load->view('/admin/faq/add_v');
    }

    function insert() {
        $post = $this->input->post();
        if( isset($post["title"]) == false || isset($post["contents"]) == false ) {
            redirect_go("제목을 입력하세요.", "/admin/faq/lists");
            return false;
        }

        $post['owner'] = "운영자";
        $result = $this->Faq_m->insert_faq($post);
        if($result == FALSE) {
            redirect_go("FAQ 추가를 실패했습니다.", "/admin/faq/lists");
            return FALSE;
        }


        redirect_go("FAQ를 추가 했습니다.", "/admin/faq/lists");
    }

    function change($faq_id) {
        $data['faq_info'] = $this->Faq_m->get_faq_info($faq_id);

        $this->load->view('/admin/faq/change_v', $data);
    }

    function update($faq_id) {
        $post = $this->input->post();
        if( isset($post["title"]) == false || isset($post["contents"]) == false ) {
            redirect_go("제목을 입력하세요.", "/admin/faq/lists");
            return false;
        }

        $result = $this->Faq_m->update_faq($faq_id, $post);
        if($result == FALSE) {
            redirect_go("FAQ 수정을 실패했습니다.", "/admin/faq/lists");
            return FALSE;
        }

        redirect_go("FAQ를 수정 했습니다.", "/admin/faq/lists");
    }

    function delete($faq_id) {
        $result = $this->Faq_m->delete_faq($faq_id);
        if($result == FALSE) {
            redirect_back("FAQ 삭제를 실패했습니다.");
            return FALSE;
        }

        redirect_back("FAQ를 삭제 했습니다.");
    }
}