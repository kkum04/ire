<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Ire_Controller
{
    var $left_menu;

    function __construct()
    {
        parent::__construct();

        if( isset($_SESSION['member']) == false ) {
            redirect_go('잘못된 접근입니다.', '/admin/login');
            return;
        }

        $this->left_menu = $this->load->view("/admin/include/left_menu", NULL, TRUE);
    }

    function logout() {
        unset($_SESSION['member']);
        redirect('/admin/login');
    }
}