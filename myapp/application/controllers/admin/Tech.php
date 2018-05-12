<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/admin/Admin.php');

class Tech extends Admin
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Tech_m');
    }

    function index()
    {
        $this->lists();
    }

    function lists() {
        $data['teches'] = $this->Tech_m->get_teches();

        $this->load->view("/admin/tech/list_v", $data);
    }

    function update_form($tech_id) {
        $data['tech'] = $this->Tech_m->get_tech($tech_id);
        $this->load->view('/admin/tech/update_form_v', $data);
    }

    function update($tech_id) {
        $post = $this->input->post();
        if( isset($post["tech_name"]) == false ) {
            redirect_go("카테고리 이름을 입력하세요.", "/admin/tech");
            return false;
        }

        if( isset($post["tech_number"]) == false ) {
            redirect_go("일련번호를 입력하세요..", "/admin/tech");
            return false;
        }

        $result = $this->Tech_m->update_tech($tech_id, $post);
        if($result == FALSE) {
            redirect_go("기술현황 수정을 실패했습니다.", "/admin/tech");
            return FALSE;
        }

        redirect_go("기술현황을 수정했습니다.", "/admin/tech");
    }

    function create_form() {
        $this->load->view('/admin/tech/create_form_v');
    }

    function create() {
        $post = $this->input->post();
        if( isset($post["tech_name"]) == false ) {
            redirect_go("카테고리 이름을 입력하세요.", "/admin/tech");
            return false;
        }

        if( isset($post["tech_number"]) == false ) {
            redirect_go("일련번호를 입력하세요..", "/admin/tech");
            return false;
        }

        $result = $this->Tech_m->create_tech($post);
        if($result == FALSE) {
            redirect_go("기술현황 추가를 실패했습니다.", "/admin/tech");
            return FALSE;
        }

        $this->Tech_m->update_tech($result, Array('order' => $result));

        redirect_go("기술현황을 추가했습니다.", "/admin/tech");
    }

    function delete($tech_id) {
        $result = $this->Tech_m->delete_tech($tech_id);
        if($result == FALSE) {
            redirect_go("기술현황 삭제를 실패했습니다.", "/admin/tech");
            return FALSE;
        }

        redirect_go("기술현황을 삭제했습니다.", "/admin/tech");
    }


    /**
     * 기술현황 순서 변경
     * @param $src_tech_id
     * @param $direction
     */
    function update_order($src_tech_id, $direction) {
        $src_tech = $this->Tech_m->get_tech($src_tech_id);

        if( $direction == 'prev') {
            $target_tech = $this->Tech_m->get_prev_tech(
                $src_tech->order
            );
        } else {
            $target_tech = $this->Tech_m->get_next_tech(
                $src_tech->order
            );
        }

        if($target_tech == NULL) {
            redirect_back('');
            return;
        }

        $result = $this->Tech_m->update_tech_order($src_tech_id, $target_tech->tech_id);
        if( $result == TRUE ) {
            redirect_back('순서 변경 완료');
        } else {
            redirect_back('순서 변경 실패');
        }
    }

    function upload_tech_image() {
        $upload_data = $this->_upload_file('upload', IMAGE_DIR, 'jpg|gif|jpeg|png|pdf|dwg');

        if ( isset($upload_data['error']) ==  true)
        {
            echo "[ERROR]".$upload_data['error'];
            return;
        }

        echo IMAGE_URL.'/'.$upload_data['file_name'];
    }
}