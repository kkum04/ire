<?php

/**
 *
 * FAQ 모델
 *
 * Created on 2018. 01. 20
 * @author 박태환 <kkum04@naver.co.kr>
 * @package application
 * @subpackage models
 * @category none
 * @version 1.0
 */
class Faq_m extends CI_Model
{
    function __construct()
    {
        //Call the type constructor
        parent::__construct();
    }


    /**
     * @brief faq 목록 리턴
     * @return mixed
     */
    function get_faq_list( $limit_info = NULL, $type = 'list'  )
    {
        if ( $type == 'list') {
            $this->db->select('id, owner, title, contents, hit, created_at');

            if( $limit_info != NULL) {
                $this->db->limit($limit_info['limit'], $limit_info['start']);
            }
        } else {
            $this->db->select('COUNT(*) AS cnt');
        }

        $this->db->from('faq');
        $this->db->order_by("id", "DESC");

        $query = $this->db->get();
        if( $type == 'list' ) {
            $result = $query->result();
            //echo $this->db->last_query();
        } else {
            $result = $query->row();
        }

        return $result;
    }

    function get_faq_info( $faq_id ) {
        $this->db->select("id, owner, title, contents, hit, created_at");
        $this->db->from('faq');
        $this->db->where('id', $faq_id);

        $query = $this->db->get();
        return $query->row();
    }

    function insert_faq( $insert_data ) {
        $this->db->insert('faq', $insert_data);
        $error = $this->db->error();
        if($error['code'] != 0)
        {
            error_log('insert_faq error. msg:'.$error['message']);
            return FALSE;
        }

        return TRUE;
    }

    function update_faq( $faq_id, $update_data ) {
        $result = $this->db->update('faq', $update_data, Array('id' => $faq_id));
        if($result == FALSE)
        {
            $error = $this->db->error();
            error_log('update_faq error. msg:'.$error['message']);
        }

        return $result;
    }

    function delete_faq( $faq_id ) {
        $result = $this->db->delete('faq', Array('id' => $faq_id));
        if($result == FALSE)
        {
            $error = $this->db->error();
            error_log('delete_faq error. msg:'.$error['message']);
        }

        return $result;
    }
}