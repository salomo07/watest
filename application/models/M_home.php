<?php

class M_home extends CI_Model {
    function __construct() {
        parent::__construct();
        // $this->dbMIS=$this->load->database('dbMIS', TRUE);
        // $this->tblLoginLog='tblLoginLog';
        $this->user='user';
    }

    function addPerson($data) {
        $this->db->insert('person', $data);
    }
    function addFamily($data) {
        $this->db->insert('keluarga', $data);
    }
    function addChild($data) {
        $this->db->insert('anak', $data);
    }
    function showPerson() {
        $query = $this->db->query("SELECT * FROM person"); 
        return $query->result();
    }
    function showKeluarga() {
        $query = $this->db->query("SELECT k.idkeluarga,(SELECT nama FROM `person` where id=suami) as suami,(SELECT nama FROM `person` where id=istri) as istri FROM keluarga k"); 
        return $query->result();
    }
    function showFamilyandChild() {
        $query = $this->db->query("SELECT k.idkeluarga,(SELECT nama FROM `person` where id=suami) as suami,(SELECT nama FROM `person` where id=istri) as istri,(SELECT nama FROM `person` where id=idperson) as 'anak', anakke FROM keluarga k inner join anak a on a.idkeluarga=k.idkeluarga"); 
        return $query->result();
    }
    function showChild($data) {
        $query = $this->db->query("SELECT (SELECT nama FROM `person` where id=suami) as suami,(SELECT nama FROM `person` where id=istri) as istri,(SELECT nama FROM `person` where id=idperson) as 'anak', anakke FROM keluarga k inner join anak a on a.idkeluarga=k.idkeluarga"); 
        return $query->result();    }
}
