<?php

class M_mutasi extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    function showMutasi($start,$limit,$search)
    {
        $query = $this->db->query("SELECT * FROM mutasi where (tglmutasi like '%$search%' or keterangan like '%$search%' or kodebank like '%$search%' or customer like '%$search%' or nopayment like '%$search%' or norp like '%$search%' or nocf like '%$search%') and isdeleted is not true order by createdtime desc LIMIT $limit OFFSET $start "); 
        return $query->result();
    }
    function countMutasi()
    {
        $query = $this->db->query("SELECT COUNT(*) 'jumlah' FROM mutasi where isdeleted is not true"); 
        return $query->row();
    }
    function getNoExist()
    {
        $query = $this->db->query("SELECT no FROM mutasi where isdeleted is not true"); 
        return $query->result();
    }
    function insertMutasi($data){
        $this->db->insert('mutasi', $data);
    }
}
