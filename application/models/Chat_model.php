<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    
class chat_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        $this->load->database('default');
    }
    
    function getList()
    {
        $this->db->select('u.id, name, email, online');
        $this->db->from('user as u');

        if($this->session->userdata('leveluser_id')==3)
        {
            $this->db->where('leveluser_id', 2);
            $this->db->where('e.id = (select supervisor_id from user where id='.$this->session->userdata('id').')');
        }
        elseif($this->session->userdata('leveluser_id')==2)
        {
            $this->db->where('leveluser_id', 3);
            $this->db->where('supervisor_id', $this->session->userdata('employee_id'));
        }

        $this->db->join('employee as e', 'u.employee_id=e.id', 'left');
        $this->db->order_by('e.name');
        $rec = $this->db->get();
        
        if ($rec->num_rows() > 0)
            return $rec->result();
        else
            return null;
    }
    
    function view($user_chat)
    {
        $this->db->from('note as n');

        if($this->session->userdata('leveluser_id')==3)
        {
            $this->db->join('user as super', 'n.user_supervisor=super.id', 'left');
            $this->db->join('employee as e', 'super.employee_id=e.id', 'left');
            $this->db->where('user_sales', $this->session->userdata('id'));
        }
        elseif($this->session->userdata('leveluser_id')==2)
        {
            $this->db->join('user as sales', 'n.user_sales=sales.id', 'left');
            $this->db->join('employee as e', 'sales.employee_id=e.id', 'left');
            $this->db->where('user_supervisor', $this->session->userdata('id'));
            $this->db->where('user_sales', $user_chat);
        }

        $this->db->select('n.*, name, online');
        $this->db->order_by('n.id');
        $rec = $this->db->get();
        
        if ($rec->num_rows() > 0)
            return $rec->result();
        else
            return null;
    }

    function view_reload($user_chat)
    {
        $this->db->from('note as n');

        if($this->session->userdata('leveluser_id')==3)
        {
            $this->db->join('user as super', 'n.user_supervisor=super.id', 'left');
            $this->db->join('employee as e', 'super.employee_id=e.id', 'left');
            $this->db->where('user_sales', $this->session->userdata('id'));
        }
        elseif($this->session->userdata('leveluser_id')==2)
        {
            $this->db->join('user as sales', 'n.user_sales=sales.id', 'left');
            $this->db->join('employee as e', 'sales.employee_id=e.id', 'left');
            $this->db->where('user_supervisor', $this->session->userdata('id'));
            $this->db->where('user_sales', $user_chat);

        }

        $this->db->select('n.*, name');
        $this->db->where('read', false);
        $this->db->where('created_by !='.$this->session->userdata('id'));
        $this->db->order_by('n.id');
        // $this->db->order_by('read desc, id');
        $rec = $this->db->get();

        if ($rec->num_rows() > 0)
            return $rec->result();
        else
            return null;
    }

    function setRead($user_chat)
    {
        if($this->session->userdata('leveluser_id')==2)
            $this->db->where('user_supervisor', $this->session->userdata('id'));
        else
            $this->db->where('user_sales', $this->session->userdata('id'));

        $this->db->where('created_by', $user_chat);
        return $this->db->update('note', array('read'=>true));
    }

    function setReadMyChat($user_chat)
    {
        if($this->session->userdata('leveluser_id')==2)
            $this->db->where('user_sales', $user_chat);
        else
            $this->db->where('user_supervisor', $user_chat);

        $this->db->where('created_by', $this->session->userdata('id'));
        return $this->db->update('note', array('read'=>true));
    }
    
    function insert($rec)
    {
        return $this->db->insert('note', $rec);
    }
    
    function insertActivity($rec)
    {
        $this->db->insert('activity', $rec);

        return $this->db->insert_id();
    }

    function jumlah_notif()
    {
        $this->db->distinct();
        $this->db->select('count(n.created_by) as jml');
        $this->db->from('note as n');
        $this->db->where('read', false);

        if($this->session->userdata('leveluser_id')==2)
            $this->db->where('user_supervisor', $this->session->userdata('id'));
        else
            $this->db->where('user_sales', $this->session->userdata('id'));

        $this->db->where('read', false);
        $this->db->where('created_by!='.$this->session->userdata('id'));
        $rec = $this->db->get();

        if ($rec->num_rows() > 0)
            return $rec->row()->jml;
        else
            return 0;
    }

    function notif_chat()
    {
        $this->db->distinct();
        $this->db->select('n.created_by, name, created_date');
        $this->db->from('note as n');
        $this->db->join('user as u', 'n.created_by=u.id', 'left');
        $this->db->join('employee as e', 'u.employee_id=e.id', 'left');

        if($this->session->userdata('leveluser_id')==3)
        {
            $this->db->where('user_sales', $this->session->userdata('id'));
        }
        elseif($this->session->userdata('leveluser_id')==2)
        {
            $this->db->where('user_supervisor', $this->session->userdata('id'));
        }

        $this->db->where('read', false);
        $this->db->where('created_by!='.$this->session->userdata('id'));
        $rec = $this->db->get();

        if ($rec->num_rows() > 0)
            return $rec->result();
        else
            return null;
    }
}