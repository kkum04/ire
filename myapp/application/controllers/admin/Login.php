<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Ire_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('admin/Member_m');
    }

    function index() {
        if( isset($_SESSION["member"]) == true ) {
            redirect("/admin/category");
        }

        $this->load->view("/admin/login/login_v");
    }

    function check_login() {
        $id = $this->input->post("id");
        $password = $this->input->post("password");

        $enc_password = sha1($password);
        $member = $this->Member_m->get_member_info($id, $enc_password);
        if( $member == null ) {
            redirect_go("아이디 또는 비밀번호를 확인해주세요.", "/admin/login/");
            return;
        }

        $_SESSION['member'] = $member;
        redirect("/admin/category/");
    }

    function create_password($password) {
        echo sha1($password);
    }
}