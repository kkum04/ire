<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Ire_Controller
{
    var $left_menu;

    function __construct()
    {
        parent::__construct();

        $this->left_menu = $this->load->view("/admin/include/left_menu", NULL, TRUE);
    }
}