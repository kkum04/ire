<?php
/**
 * Created by IntelliJ IDEA.
 * User: taehwanpark
 * Date: 2018. 4. 5.
 * Time: PM 8:34
 */

class Ire_Controller extends CI_Controller
{
    var $header;
    var $footer;

    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $this->load->helper('cambus_common_helper');
        $this->load->helper('url_helper');

        $this->load->database();

        $this->load->model('Category_m');

        $this->load_header();
        $this->load_footer();
        $this->load_sitemap();
    }

    private function load_header() {
        $data['categories'] = $this->Category_m->get_categories();

        $this->header = $this->load->view('/include/header_v', $data, TRUE);
    }

    private function load_footer() {
        $this->footer = $this->load->view('/include/footer_v', NULL, TRUE);
    }

    private function load_sitemap() {
        $this->sitemap = $this->load->view('/include/sitemap_v', NULL, TRUE);
    }
}