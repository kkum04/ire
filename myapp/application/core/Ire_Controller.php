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
    var $categories;

    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $this->load->helper('cambus_common_helper');
        $this->load->helper('url_helper');

        $this->load->database();

        $this->load->model('Category_m');
        $this->load->model('Product_m');

        $this->load_header();
        $this->load_footer();
        $this->load_sitemap();
    }

    private function load_header() {
        $this->categories = $this->Category_m->get_categories();
        foreach($this->categories as $category) {
            $category->products = $this->Product_m->get_products($category->category_id);
        }

        $data['categories'] = $this->categories;
        $this->header = $this->load->view('/include/header_v', $data, TRUE);
    }

    private function load_footer() {
        $this->footer = $this->load->view('/include/footer_v', NULL, TRUE);
    }

    private function load_sitemap() {
        $data['categories'] = $this->categories;
        //$this->sitemap = $this->load->view('/include/sitemap_v', $data, TRUE);
    }

    /**
     * @brief 파일 업로드
     * @param $file
     * @param $upload_path
     * @param $allow_type '| | | '
     * @return array|bool
     */
    protected function _upload_file($file, $upload_path, $allow_type)
    {
        $config['upload_path'] = $upload_path;
        $config['max_size'] = 100000;
        $config['encrypt_name'] = TRUE;
        $config['allowed_types'] = $allow_type;

        $upload_data = upload($file, $config);
        return $upload_data;
    }
}