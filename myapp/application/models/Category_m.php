<?php

/**
 *
 * 로그인 모델
 *
 * Created on 2017. 09. 09
 * @author 박태환 <kkum04@naver.co.kr>
 * @package application
 * @subpackage models
 * @category none
 * @version 1.0
 */
class Category_m extends CI_Model
{
    function __construct()
    {
        //Call the type constructor
        parent::__construct();
    }


    /**
     * 카테고리 리스트 리턴
     * @return mixed
     */
    function get_categories()
    {
        $this->db->select('category_id, category_name, order');
        $this->db->from('category');

        $this->db->order_by('order', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    /**
     * 한개의 카테고리 정보 리턴
     * @param $id
     * @return mixed
     */
    function get_category($id) {
        $this->db->select('category_id, category_name, order');
        $this->db->from('category');

        $this->db->where('category_id', $id);

        $query = $this->db->get();
        return $query->row();
    }

    function  create_category( $insert_data ) {
        $this->db->insert('category', $insert_data);
        $error = $this->db->error();
        if($error['code'] != 0)
        {
            error_log('create_category error. msg:'.$error['message']);
            return FALSE;
        }

        return TRUE;
    }

    function update_category( $category_id, $update_data ) {
        $result = $this->db->update('category', $update_data, Array('category_id' => $category_id));
        if($result == FALSE)
        {
            $error = $this->db->error();
            error_log('update_category error. msg:'.$error['message']);
        }

        return $result;
    }

    function delete_category( $category_id ) {
        $result = $this->db->delete('category', Array('category_id' => $category_id));
        if($result == FALSE)
        {
            $error = $this->db->error();
            error_log('delete_category error. msg:'.$error['message']);
        }

        return $result;
    }

    function get_prev_category( $order ) {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('order > ', $order);
        $this->db->order_by('order', 'ASC');
        $this->db->limit(1);

        $query = $this->db->get();
        return $query->row();
    }

    function get_next_category( $order ) {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('order < ', $order);
        $this->db->order_by('order', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get();
        return $query->row();
    }

    function update_category_order( $src_category_id, $target_category_id ) {
        $query = "UPDATE category AS A
                  JOIN category AS B
                  ON A.category_id = $src_category_id AND
                     B.category_id = $target_category_id
                  SET A.order = B.order, B.order = A.order";
        $this->db->query($query);

        $error = $this->db->error();
        if ($error['code'] == 0) {
            return TRUE;
        }

        return FALSE;
    }
}