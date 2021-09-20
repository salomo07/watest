<?php

class M_api extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->dbLeads=$this->load->database('dbLeads', TRUE);
    }

    function insertLeads($data) {
        $this->dbLeads->insert('leadstemp', $data);
    }
    function insertOffset($data) {
        $this->dbLeads->insert('offset', $data);
    }
    function getLastOffset($topicname) {
        $query= $this->dbLeads->query("select ifnull(max(lastoffset),0) AS offset from offset where topicname='$topicname'");
        return $query->row();
    }
}
