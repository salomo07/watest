<?php

class M_wa extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function insertConversation($data) {
        $this->db->insert('active_conversation', $data);
    }
    function updateConversation($data) {
        if(substr($data["number"], 0, 2)=="62"){$no="0".substr($data["number"], 2);}
        $this->db->where("number ='$no' and endtime is null");
        $this->db->update('active_conversation', $data);
    }
    function checkActiveConversation($no) {
        if(substr($no, 0, 2)=="62"){$no="0".substr($no, 2);}
        $query= $this->db->query("select * from active_conversation where number='$no' and endtime IS NULL");
        return $query->row();
    }
    function checkIdMsg($id) {
        $query= $this->db->query("select message from keywords where keyword='$keyword'");
        return $query->row();
    }
    function getMsg($keyword) {
        $query= $this->db->query("select message from keywords where keyword='$keyword'");
        return $query->row();
    }
    function getLeads($no) {
        if(substr($no, 0, 2)=="62"){$no="0".substr($no, 2);}
        $query= $this->db->query("select * from customer_data where cred_mobile_ph_no='$no'");
        return $query->row();
    }

    // function insertConversation($data) {
    //     $this->db->insert('active_conversation', $data);
    // }
    // function updateConversation($data) {
    //     if(substr($data["number"], 0, 2)=="62"){$no="0".substr($data["number"], 2);}
    //     $this->db->where("number ='$no' and endtime is null");
    //     $this->db->update('active_conversation', $data);
    // }
    // function checkActiveConversation($no) {
    //     if(substr($no, 0, 2)=="62"){$no="0".substr($no, 2);}
    //     $query= $this->db->query("select * from active_conversation where number='$no' and endtime IS NULL");
    //     return $query->row();
    // }
    // function getMsg($keyword) {
    //     $query= $this->db->query("select message from keywords where keyword='$keyword'");
    //     return $query->row();
    // }
    // function getLeads($no) {
    //     if(substr($no, 0, 2)=="62"){$no="0".substr($no, 2);}
    //     $query= $this->db->query("select * from customer_data where cred_mobile_ph_no='$no'");
    //     return $query->row();
    // }
}
