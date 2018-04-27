<?php

/**
 *
 * 기술 모델
 *
 * Created on 2018. 4. 27
 * @author 박태환 <kkum04@naver.co.kr>
 * @package application
 * @subpackage models
 * @category none
 * @version 1.0
 */
class Tech_m extends CI_Model
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
    function get_teches()
    {
        $this->db->select('tech_id, tech_name, tech_number, tech_image, order, created_at');
        $this->db->from('tech');

        $this->db->order_by('order', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    /**
     * 한개의 카테고리 정보 리턴
     * @param $id
     * @return mixed
     */
    function get_tech( $tech_id ) {
        $this->db->select('tech_id, tech_name, tech_number, tech_image, order, created_at');
        $this->db->from('tech');

        $this->db->where('tech_id', $tech_id);

        $query = $this->db->get();
        return $query->row();
    }

    function create_tech( $insert_data ) {
        $this->db->insert('tech', $insert_data);
        $error = $this->db->error();
        if($error['code'] != 0)
        {
            error_log('create_tech error. msg:'.$error['message']);
            return FALSE;
        }

        return $this->db->insert_id();
    }

    function update_tech( $tech_id, $update_data ) {
        $result = $this->db->update('tech', $update_data, Array('tech_id' => $tech_id));
        if($result == FALSE)
        {
            $error = $this->db->error();
            error_log('update_tech error. msg:'.$error['message']);
        }

        return $result;
    }

    function delete_tech( $tech_id ) {
        $result = $this->db->delete('tech', Array('tech_id' => $tech_id));
        if($result == FALSE)
        {
            $error = $this->db->error();
            error_log('delete_tech error. msg:'.$error['message']);
        }

        return $result;
    }

    function get_prev_tech( $order ) {
        $this->db->select('*');
        $this->db->from('tech');
        $this->db->where('order > ', $order);
        $this->db->order_by('order', 'ASC');
        $this->db->limit(1);

        $query = $this->db->get();
        return $query->row();
    }

    function get_next_tech( $order ) {
        $this->db->select('*');
        $this->db->from('tech');
        $this->db->where('order < ', $order);
        $this->db->order_by('order', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get();
        return $query->row();
    }

    function update_tech_order( $src_tech_id, $target_tech_id ) {
        $query = "UPDATE tech AS A
                  JOIN tech AS B
                  ON A.tech_id = $src_tech_id AND
                     B.tech_id = $target_tech_id
                  SET A.order = B.order, B.order = A.order";
        $this->db->query($query);

        $error = $this->db->error();
        if ($error['code'] == 0) {
            return TRUE;
        }

        return FALSE;
    }
}