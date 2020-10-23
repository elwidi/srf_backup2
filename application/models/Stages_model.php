<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    
class stages_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        $this->load->database('default');
    }
    
    function insert($rec)
    {
        $this->db->insert('stages', $rec);
        return $this->db->insert_id();
    }
}