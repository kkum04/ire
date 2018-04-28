<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/admin/Admin.php');

class Main extends Admin
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('banner/Main_m');
    }

    function index()
    {
        $this->lists();
    }

    function lists() {
        $data['main_banners'] = $this->Main_m->get_main_banners();

        $this->load->view("/admin/banner/main/list_v", $data);
    }

    function update_form($banner_id) {
        $data['main_banner'] = $this->Main_m->get_main_banner($banner_id);
        $this->load->view('/admin/banner/main/update_form_v', $data);
    }

    function update($banner_id) {
        $post = $this->input->post();
        if( isset($post["button_text"]) == false ) {
            redirect_go("버튼 텍스트를 입력하세요.", "/admin/banner/main");
            return false;
        }

        if( isset($post["link"]) == false ) {
            redirect_go("링크를 입력하세요.", "/admin/banner/main");
            return false;
        }

        $result = $this->Main_m->update_main_banner($banner_id, $post);
        if($result == FALSE) {
            redirect_go("메인배너 수정을 실패했습니다.", "/admin/banner/main");
            return FALSE;
        }

        redirect_go("메인배너를 수정했습니다.", "/admin/banner/main");
    }

    function create_form() {
        $this->load->view('/admin/banner/main/create_form_v');
    }

    function create() {
        $post = $this->input->post();
        if( isset($post["button_text"]) == false ) {
            redirect_go("버튼 텍스트를 입력하세요.", "/admin/banner/main");
            return false;
        }

        if( isset($post["link"]) == false ) {
            redirect_go("링크를 입력하세요.", "/admin/banner/main");
            return false;
        }

        $result = $this->Main_m->create_main_banner($post);
        if($result == FALSE) {
            redirect_go("메인배너 추가를 실패했습니다.", "/admin/banner/main");
            return FALSE;
        }

        $this->Main_m->update_main_banner($result, Array('order' => $result));

        redirect_go("메인배너를 추가했습니다.", "/admin/banner/main");
    }

    function delete($banner_id) {
        $result = $this->Main_m->delete_main_banner($banner_id);
        if($result == FALSE) {
            redirect_go("메인배너 삭제를 실패했습니다.", "/admin/banner/main");
            return FALSE;
        }

        redirect_go("메인배너를 삭제했습니다.", "/admin/banner/main");
    }


    /**
     * 메인배너  순서 변경
     * @param $src_banner_id
     * @param $direction
     */
    function update_order($src_banner_id, $direction) {
        $src_banner = $this->Main_m->get_main_banner($src_banner_id);

        if( $direction == 'prev') {
            $target_banner = $this->Main_m->get_prev_main_banner(
                $src_banner->order
            );
        } else {
            $target_banner = $this->Main_m->get_next_main_Banner(
                $src_banner->order
            );
        }

        if($target_banner == NULL) {
            redirect_back('');
            return;
        }

        $result = $this->Main_m->update_main_banner_order($src_banner_id, $target_banner->banner_id);
        if( $result == TRUE ) {
            redirect_back('순서 변경 완료');
        } else {
            redirect_back('순서 변경 실패');
        }
    }
}