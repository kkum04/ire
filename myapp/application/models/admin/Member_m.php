<?php

/**
 *
 * �α��� ��
 *
 * Created on 2017. 09. 09
 * @author ����ȯ <kkum04@naver.co.kr>
 * @package application
 * @subpackage models
 * @category none
 * @version 1.0
 */
class Member_m extends CI_Model
{
    function __construct()
    {
        //Call the type constructor
        parent::__construct();
    }


    /**
     * @brief ���ԵǾ� �ִ� ����� ���� ����
     * @param $member_id
     * @param $password
     * @return mixed
     */
    function get_member_info( $member_id, $password )
    {
        $this->db->select('id, member_id, member_password');
        $this->db->from('member');

        $this->db->where('member_id', $member_id);
        $this->db->where('member_password', $password);

        $query = $this->db->get();
        return $query->row();
    }
}