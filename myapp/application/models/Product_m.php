<?php

/**
 *
 * 상품 모델
 *
 * Created on 2018. 04. 21
 * @author 박태환 <kkum04@naver.co.kr>
 * @package application
 * @subpackage models
 * @category none
 * @version 1.0
 */
class Product_m extends CI_Model
{
    function __construct()
    {
        //Call the type constructor
        parent::__construct();
    }

    function get_product($product_id) {
        $this->db->select('P.product_id, P.category_id, P.product_name, P.description_file, P.cad_file, P.order, P.product_image,
                          P.description, P.product_spec, P.product_feature, P.created_at, P.updated_at, C.category_name');
        $this->db->from('product AS P');
        $this->db->join('category AS C', "P.category_id = C.category_id");

        $this->db->where('P.product_id', $product_id);

        $query = $this->db->get();
        return $query->row();
    }

    function get_product_list( $category_id, $limit_info = NULL, $type = 'list' ) {
        if( $type == 'list') {
            $this->db->select('P.product_id, P.category_id, P.product_name, P.description_file, P.cad_file, P.order, P.product_image,
                          P.description, P.product_spec, P.product_feature, P.created_at, P.updated_at, C.category_name');

            if( $limit_info != NULL) {
                $this->db->limit($limit_info['limit'], $limit_info['start']);
            }
        } else {
            $this->db->select('COUNT(*) AS cnt');
        }

        $this->db->from("product AS P");
        $this->db->join("category AS C", "P.category_id = C.category_id");

        $this->db->where('C.category_d', $category_id);
        $this->db->order_by("P.order", "DESC");

        $query = $this->db->get();
        if( $type == 'list' ) {
            $result = $query->result();
            //echo $this->db->last_query();
        } else {
            $result = $query->row();
        }
        return $result;
    }

    function create_product( $insert_data ) {
        $this->db->insert('product', $insert_data);
        $error = $this->db->error();
        if($error['code'] != 0)
        {
            error_log('create_product error. msg:'.$error['message']);
            return FALSE;
        }

        return $this->db->insert_id();
    }

    function update_product( $product_id, $update_data ) {
        $result = $this->db->update('product', $update_data, Array('product_id' => $product_id));
        if($result == FALSE)
        {
            $error = $this->db->error();
            error_log('update_product error. msg:'.$error['message']);
        }

        return $result;
    }

    function delete_product( $product_id ) {
        $result = $this->db->delete('product', Array('product_id' => $product_id));
        if($result == FALSE)
        {
            $error = $this->db->error();
            error_log('delete_product error. msg:'.$error['message']);
        }

        return $result;
    }

    function get_prev_product( $order, $category_id ) {
        $this->db->select('P.product_id, P.category_id, P.product_name, P.description_file, P.cad_file, P.order, P.product_image,
                          P.description, P.product_spec, P.product_feature, P.created_at, P.updated_at, C.category_name');
        $this->db->from('product AS P');
        $this->db->join("category AS C", "P.cagegory_id = C.category_id");
        $this->db->where('P.category_id', $category_id);
        $this->db->where('P.order > ', $order);
        $this->db->order_by('P.order', 'ASC');
        $this->db->limit(1);

        $query = $this->db->get();
        return $query->row();
    }

    function get_next_product( $order, $category_id ) {
        $this->db->select('P.product_id, P.category_id, P.product_name, P.description_file, P.cad_file, P.order, P.product_image,
                          P.description, P.product_spec, P.product_feature, P.created_at, P.updated_at, C.category_name');
        $this->db->from('product AS P');
        $this->db->join("category AS C", "P.product_id = C.category_id");
        $this->db->where('C.category_id', $category_id);
        $this->db->where('P.order < ', $order);
        $this->db->order_by('P.order', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get();
        return $query->row();
    }

    function update_product_order( $src_product_id, $target_product_id ) {
        $query = "UPDATE product AS A
                  JOIN product AS B
                  ON A.product_id = $src_product_id AND
                     B.product_id = $target_product_id
                  SET A.order = B.order, B.order = A.order";
        $this->db->query($query);

        $error = $this->db->error();
        if ($error['code'] == 0) {
            return TRUE;
        }

        return FALSE;
    }
}