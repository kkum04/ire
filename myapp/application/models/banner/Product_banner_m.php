<?php

/**
 *
 * 메인 배너 모델
 *
 * Created on 2018. 4. 28
 * @author 박태환 <kkum04@naver.co.kr>
 * @package application
 * @subpackage models
 * @category none
 * @version 1.0
 */
class Product_banner_m extends CI_Model
{
    function __construct()
    {
        //Call the type constructor
        parent::__construct();
    }


    /**
     * 상품 배너 리스트 리턴
     * @return mixed
     */
    function get_product_banners()
    {
        $this->db->select('A.banner_id, A.product_id, B.product_image, B.product_name, B.product_type, C.category_name');
        $this->db->from('product_banner AS A');
        $this->db->join('product AS B', 'A.product_id = B.product_id');
        $this->db->join("category AS C", "B.category_id = C.category_id");

        $this->db->order_by('A.order', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    /**
     * 한개의 상품 배너 정보 리턴
     * @param $banner_id
     * @return mixed
     */
    function get_product_banner( $banner_id ) {
        $this->db->select('banner_id, product_id, order');
        $this->db->from('product_banner');

        $this->db->where('banner_id', $banner_id);

        $query = $this->db->get();
        return $query->row();
    }

    function create_product_banner( $insert_data ) {
        $this->db->insert('product_banner', $insert_data);
        $error = $this->db->error();
        if($error['code'] != 0)
        {
            error_log('create_product_banner error. msg:'.$error['message']);
            return FALSE;
        }

        return $this->db->insert_id();
    }

    function update_product_banner( $banner_id, $update_data ) {
        $result = $this->db->update('product_banner', $update_data, Array('banner_id' => $banner_id));
        if($result == FALSE)
        {
            $error = $this->db->error();
            error_log('update_product_banner error. msg:'.$error['message']);
        }

        return $result;
    }

    function delete_product_banner( $banner_id ) {
        $result = $this->db->delete('product_banner', Array('banner_id' => $banner_id));
        if($result == FALSE)
        {
            $error = $this->db->error();
            error_log('delete_product_banner error. msg:'.$error['message']);
        }

        return $result;
    }

    function get_prev_product_banner( $order ) {
        $this->db->select('*');
        $this->db->from('product_banner');
        $this->db->where('order > ', $order);
        $this->db->order_by('order', 'ASC');
        $this->db->limit(1);

        $query = $this->db->get();
        return $query->row();
    }

    function get_next_product_banner( $order ) {
        $this->db->select('*');
        $this->db->from('product_banner');
        $this->db->where('order < ', $order);
        $this->db->order_by('order', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get();
        return $query->row();
    }

    function update_product_banner_order($src_banner_id, $target_banner_id ) {
        $query = "UPDATE product_banner AS A
                  JOIN product_banner AS B
                  ON A.banner_id = $src_banner_id AND
                     B.banner_id = $target_banner_id
                  SET A.order = B.order, B.order = A.order";
        $this->db->query($query);

        $error = $this->db->error();
        if ($error['code'] == 0) {
            return TRUE;
        }

        return FALSE;
    }
}