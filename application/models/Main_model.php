
<?php

class Main_model extends CI_Model {

    var $presales;


    public function __construct()
    {
        parent::__construct();
        $this->presales = $this->load->database('presales', TRUE);
    }

    public function setUserId()
    {
        /*$crop[0] = '3358';
        return $crop[0];*/

    }

    public function countData($table, $condition = ""){
        $this->db->select('*');
        $this->db->from($table);
        if(!empty($condition)) $this->db->where($condition);
        $qry = $this->db->get();

        return $qry->num_rows();
    }

    function getData($param){
        if(isset($param['field'])) $this->db->select($param['field']);
        else $this->db->select('*');
        
        $this->db->from($param['table']);

        if(isset($param['join'])){
            foreach($param['join'] as $tbl){
                $this->db->join($tbl['table'], $tbl['condition'], $tbl['type']);
            }
        }

        if(isset($param['condition'])){
            $this->db->where($param['condition']);
        }
        if(isset($param['condition_or'])){
            $this->db->or_where($param['condition_or']);
        }

        if(isset($param['order'])){
            $this->db->order_by($param['order']['field'], $param['order']['order']);
        }

        if(isset($param['start']) && isset($param['limit'])){
            $this->db->limit($param['limit'], $param['start']);
        }

        $qry = $this->db->get();

        // if(isset($param['type'])) return $qry->result();
        // else return $qry->row();
        if(isset($param['return'])){
            if(isset($param['type'])) return $qry->result_array();
            else return $qry->row_array();
        } else {
            if(isset($param['type'])) return $qry->result();
            else return $qry->row();
        }
        
    }

    function updateData($table, $data, $condition){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();

        $this->db->where($condition);
        $this->db->update($table, $data);

        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }

        return true;
    }

    private function _get_datatables_query($param)
    {
        // var_dump($_GET); exit();
    	$this->presales->select($param['column_select']);
        $this->presales->from($param['table_name']);

        if(isset($param['join'])){
            foreach($param['join'] as $tbl){
                $this->presales->join($tbl['table_name'], $tbl['condition'], $tbl['type']);
            }
        }

        if(isset($param['condition'])){
            $this->presales->where($param['condition']);
        }
        if(isset($param['condition_or'])){
            $this->presales->or_where($param['condition_or']);
        }

        $i = 0;

        foreach ($param['column_search'] as $key => $item) // loop column
        {

            if(!empty($_GET['sSearch'])) // if datatable send POST for search
            {
                if($i===0) // first loop
                {
                    $this->presales->like($item, $_GET['sSearch']);
                }
                else
                {
                    $this->presales->or_like($item, $_GET['sSearch']);
                }
            }
            $i++;
        }

        if(isset($param['group_by'])){
            $this->presales->group_by($param['group_by']);
        }

        $this->presales->order_by($param['order']['field'], $param['order']['order']);
    }

    function get_datatable($param)
    {
        $this->_get_datatables_query($param);
        if($_GET['iDisplayLength'] != -1)
            $this->presales->limit($_GET['iDisplayLength'], $_GET['iDisplayStart']);
        $query = $this->presales->get();
        return $query->result();
    }

    /*function count_filtered($param)
    {
        $this->_get_datatables_query($param);
        $query = $this->presales->get();
        return $query->num_rows();
    }

    public function count_all($table_name)
    {
        $this->presales->from($table_name);
        return $this->presales->count_all_results();
    }*/

    function saveData($table, $data, $return = ""){
         /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();

        $this->db->insert($table, $data);
        $insert_id = $this->db->insert_id();

        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }

        if($return == 'id') return $insert_id;
        else return true;
    }

    function deleteData($table, $condition = "", $in = ""){
        /**
         * ===================================================
         */
        $this->db->trans_begin();

        if(!empty($condition)) $this->db->where($condition);
        if(!empty($in)) $this->db->where_in($in['column'], $in['value']);
        
        $this->db->delete($table);

        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }

        return true;
    }

     function getDataPresales($param){
        if(isset($param['field'])) $this->presales->select($param['field']);
        else $this->presales->select('*');
        
        $this->presales->from($param['table']);

        if(isset($param['join'])){
            foreach($param['join'] as $tbl){
                $this->presales->join($tbl['table'], $tbl['condition'], $tbl['type']);
            }
        }

        if(isset($param['condition'])){
            $this->presales->where($param['condition']);
        }
        if(isset($param['condition_or'])){
            $this->presales->or_where($param['condition_or']);
        }

        if(isset($param['order'])){
            $this->presales->order_by($param['order']['field'], $param['order']['order']);
        }

        if(isset($param['start']) && isset($param['limit'])){
            $this->presales->limit($param['limit'], $param['start']);
        }

        $qry = $this->presales->get();

        // if(isset($param['type'])) return $qry->result();
        // else return $qry->row();
        if(isset($param['return'])){
            if(isset($param['type'])) return $qry->result_array();
            else return $qry->row_array();
        } else {
            if(isset($param['type'])) return $qry->result();
            else return $qry->row();
        }
        
    }

} 