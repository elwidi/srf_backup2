<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    
class user_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        $this->load->database('default');
    }

    function getUser($employee_uid)
    {
        $this->db->select('u.*, e.id as id_employee, employee_uid, employee_no, e.name as user_name, email, l.name as level_name');
        $this->db->from('user as u');
        $this->db->join('employee as e', 'u.employee_id=e.id', 'left');
        $this->db->join('leveluser as l', 'u.leveluser_id=l.id', 'left');
        $this->db->where('employee_uid', $employee_uid);
        $rec = $this->db->get();
        
        if ($rec->num_rows() > 0)
            return $rec->row();
        else
            return null;
    }

    function getUserLogin($email)
    {
        $this->db->select('u.*, e.id as id_employee, employee_uid, employee_no, e.name as user_name, email, l.name as level_name');
        $this->db->from('user as u');
        $this->db->join('employee as e', 'u.employee_id=e.id', 'left');
        $this->db->join('leveluser as l', 'u.leveluser_id=l.id', 'left');
        $this->db->where('e.email', $email);
        $rec = $this->db->get();
        
        if ($rec->num_rows() > 0)
            return $rec->row();
        else
            return null;
    }

    function setOnline()
    {
        $this->db->where('id', $this->session->userdata('id'));
        return $this->db->update('user', array('online'=>true));
    }

    function setOffline()
    {
        $this->db->where('id', $this->session->userdata('id'));
        return $this->db->update('user', array('online'=>false));
    }
    // ===========================

    // Supervisor Page
    function getSupervisorList()
    {
        $this->db->select(  'u.id, e.name, email, active, 
                            (select count(distinct c.id) 
                             from customer as c 
                             left join user as us on c.user_id=us.id
                             where active=true and supervisor_id=u.id) as cust, 
                            (select count(distinct id) from user where leveluser_id=3 and active=true and supervisor_id=u.id) as acc');
        $this->db->from('user as u');
        $this->db->join('employee as e', 'u.employee_id=e.id', 'left');
        $this->db->where('leveluser_id', 2);
        if($this->session->userdata('leveluser_id')==4)
            $this->db->where('leader_id', $this->session->userdata('employee_id'));
        elseif($this->session->userdata('leveluser_id')==5)
            $this->db->where('leader_id in (select ee.id from employee ee left join user uu on ee.id=uu.employee_id where leveluser_id=4 and leader_id='.$this->session->userdata('employee_id').')');
        $this->db->order_by('u.id');
        $rec = $this->db->get();

        if ($rec->num_rows() > 0)
            return $rec->result();
        else
            return null;
    }

    function viewSupervisor($id)
    {
        $this->db->select(  'u.*, e.name, e.employee_no, e.email,  
                            (select count(distinct c.id) 
                             from customer as c 
                             left join user as us on c.user_id=us.id
                             where active=true and supervisor_id=u.id) as cust, 
                            (select count(distinct id) from user where leveluser_id=3 and active=true and supervisor_id=u.id) as acc');
        $this->db->from('user as u');
        $this->db->join('employee as e', 'u.employee_id=e.id', 'left');
        $this->db->where("u.id", $id);
        $rec = $this->db->get();

        if ($rec->num_rows() > 0)
            return $rec->row();
        else
            return null;
    }
    
    function listSupervisorAccount($supervisor_id)
    {
        $this->db->distinct();
        $this->db->select('u.id, employee_no, e.name as account_name, email, active');
        $this->db->from('user as u');
        $this->db->join('employee as e', 'u.employee_id=e.id', 'left');
        $this->db->where('u.active', true);
        $this->db->where('u.supervisor_id', $supervisor_id);
        $this->db->order_by('u.id desc');
        $rec = $this->db->get();
        
        if ($rec->num_rows() > 0)
            return $rec->result();
        else
            return null;
    }
    
    function listSupervisorCustomer($supervisor_id)
    {
        $stage =    "(select name 
                    from workflow as w 
                    left join stages as s on w.id=s.workflow_id 
                    where s.customer_id=c.id 
                    order by s.id desc
                    limit 1)";

        $telephone = "(select GROUP_CONCAT(DISTINCT concat(' ',number)) from telephone where customer_id=c.id) as telephone";

        $this->db->distinct();
        $this->db->select('c.id, c.name as customer_name, pic, '.$telephone.', e.name as account_name, '.$stage.' as stage_name, c.created_date');
        $this->db->from('customer as c');
        $this->db->join('user as u', 'c.user_id=u.id', 'left');
        $this->db->join('employee as e', 'u.employee_id=e.id', 'left');
        $this->db->where('u.active', true);
        $this->db->where('u.supervisor_id', $supervisor_id);
        // $this->db->where("u.leader_id", $this->session->userdata('employee_id'));
        $this->db->order_by('c.id desc');
        $rec = $this->db->get();
        
        if ($rec->num_rows() > 0)
            return $rec->result();
        else
            return null;
    }
    // ===========================

    // Account Page
    function getAccountList()
    {
        $this->db->select('u.id, e.name, e.email, s.name as supervisor_name, (select count(distinct id) from customer where user_id=u.id) as cust, active');
        $this->db->from('user as u');
        $this->db->join('employee as e', 'u.employee_id=e.id', 'left');
        $this->db->join('employee as s', 'u.supervisor_id=s.id', 'left');
        $this->db->where('leveluser_id', 3);
        
        if($this->session->userdata('leveluser_id')==2)
            $this->db->where('supervisor_id', $this->session->userdata('employee_id'));
        elseif($this->session->userdata('leveluser_id')==4)
            $this->db->where('supervisor_id in (select ee.id from employee ee left join user uu on ee.id=uu.employee_id where leveluser_id=2 and leader_id='.$this->session->userdata('employee_id').')');
        elseif($this->session->userdata('leveluser_id')==5)
            $this->db->where('supervisor_id in (select ee.id from employee ee left join user uu on ee.id=uu.employee_id where leveluser_id=2 
                                and leader_id in (select employee.id from employee left join user on employee.id=user.employee_id where leveluser_id=4 and leader_id='.$this->session->userdata('employee_id').' ) ) ');
        
        $this->db->order_by('s.id, u.id');
        $rec = $this->db->get();
        
        if ($rec->num_rows() > 0)
            return $rec->result();
        else
            return null;
    }

    function viewAccount($id)
    {
        $this->db->select('u.*, e.name, e.employee_no, e.email, s.name as supervisor_name,(select count(distinct id) from customer where user_id=u.id) as cust');
        $this->db->from('user as u');
        $this->db->join('employee as e', 'u.employee_id=e.id', 'left');
        $this->db->join('employee as s', 'u.supervisor_id=s.id', 'left');
        $this->db->where("leveluser_id", 3);
        $this->db->where("u.id", $id);
        $rec = $this->db->get();

        if ($rec->num_rows() > 0)
            return $rec->row();
        else
            return null;
    }

    function insertEmployee($rec)
    {
        $this->db->insert('employee', $rec);
        return $this->db->insert_id();
    }

    function insertUser($rec)
    {
        $this->db->insert('user', $rec);
        return $this->db->insert_id();
    }

    function listSupervisor()
    {
        $this->db->select('e.id, name, email');
        $this->db->from('user as u');
        $this->db->join('employee as e', 'u.employee_id=e.id', 'left');
        $this->db->where("leveluser_id", 2);
        $this->db->where("active", true);
        $this->db->order_by('name');
        $rec = $this->db->get();

        if ($rec->num_rows() > 0)
            return $rec->result();
        else
            return null;
    }

    function listSales($supervisor_id)
    {
        $this->db->select('u.id, name, email');
        $this->db->from('user as u');
        $this->db->join('employee as e', 'u.employee_id=e.id', 'left');
        $this->db->where("leveluser_id", 3);
        $this->db->where("supervisor_id", $supervisor_id);
        $this->db->where("active", true);
        $this->db->order_by('name');
        $rec = $this->db->get();

        if ($rec->num_rows() > 0)
            return $rec->result();
        else
            return null;
    }

    function checkEmailavailable($email, $id)
    {
        $this->db->distinct();
        $this->db->select('id');
        $this->db->from('user');
        $this->db->where("email", $email);
        $this->db->where("id!=".$id);
        $rec = $this->db->get();

        if ($rec->num_rows() > 0)
            return false;
        else
            return true;
    }

    function updateEmployee($update, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('employee', $update);
    }

    function updateUser($update, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('user', $update);
    }
    
    function listAccountActivity($account_id)
    {
        $this->db->select('a.*, t.name as type_name, w.name as stage_name, c.name as customer_name');
        $this->db->from('activity as a');
        $this->db->join('activitytype as t', 'a.activitytype_id=t.id', 'left');
        $this->db->join('workflow as w', 'a.workflow_id=w.id', 'left');
        $this->db->join('customer as c', 'a.customer_id=c.id', 'left');
        $this->db->where('c.user_id', $account_id);
        $this->db->order_by('a.id desc');
        $rec = $this->db->get();

        if($rec!=null)
            return $rec->result();
        else
            return null;
    }
    
    function listAccountCustomer($account_id)
    {
        $stage =    "(select name 
                    from workflow as w 
                    left join stages as s on w.id=s.workflow_id 
                    where s.customer_id=c.id 
                    order by s.id desc
                    limit 1)";

        $telephone = "(select GROUP_CONCAT(DISTINCT concat(' ',number)) from telephone where customer_id=c.id) as telephone";

        $this->db->distinct();
        $this->db->select('c.id, c.name as customer_name, pic, '.$telephone.', e.name as account_name, '.$stage.' as stage_name, c.created_date');
        $this->db->from('customer as c');
        $this->db->join('user as u', 'c.user_id=u.id', 'left');
        $this->db->join('employee as e', 'u.employee_id=e.id', 'left');
        $this->db->where('u.active', true);
        $this->db->where('u.id', $account_id);
        $this->db->order_by('c.id desc');
        $rec = $this->db->get();
        
        if ($rec->num_rows() > 0)
            return $rec->result();
        else
            return null;
    }
    // ===========================

    // Employee Page
    function getEmployeeList()
    {
        $this->db->select('e.*, u.id as user_id, u.leveluser_id, u.supervisor_id, active, online, l.name as level_name');
        $this->db->from('employee as e');
        $this->db->join('user as u', 'e.id=u.employee_id', 'left');
        $this->db->join('leveluser as l', 'u.leveluser_id=l.id', 'left');
        $this->db->where("email!='akbar.aziz@moratelindo.co.id'");
        $this->db->order_by('e.name');
        $rec = $this->db->get();

        if ($rec->num_rows() > 0)
            return $rec->result();
        else
            return null;
    }

    function listLeveluser()
    {
        $this->db->select('*');
        $this->db->from('leveluser');
        $this->db->order_by('id');
        $rec = $this->db->get();

        if ($rec->num_rows() > 0)
            return $rec->result();
        else
            return null;
    }

    function viewEmployee($id)
    {
        $this->db->select('e.*, u.id as user_id, u.leveluser_id, u.supervisor_id, active, online, l.name as level_name, s.name as supervisor_name');
        $this->db->from('employee as e');
        $this->db->join('user as u', 'e.id=u.employee_id', 'left');
        $this->db->join('leveluser as l', 'u.leveluser_id=l.id', 'left');
        $this->db->join('employee as s', 'u.supervisor_id=s.id', 'left');
        $this->db->where("e.id", $id);
        $rec = $this->db->get();

        if ($rec->num_rows() > 0)
            return $rec->row();
        else
            return null;
    }
    // ===========================
    
    // Change Password Page
    function viewProfile($id)
    {
        $this->db->select('u.*, e.name, e.employee_no, s.name as supervisor_name,(select count(distinct id) from customer where user_id=u.id) as cust');
        $this->db->from('user as u');
        $this->db->join('employee as e', 'u.employee_id=e.id', 'left');
        $this->db->join('employee as s', 'u.supervisor_id=s.id', 'left');
        $this->db->where("u.id", $id);
        $rec = $this->db->get();

        if ($rec->num_rows() > 0)
            return $rec->row();
        else
            return null;
    }
    
    function checkOldpassword($oldpassword, $id)
    {
        $this->db->distinct();
        $this->db->select('id');
        $this->db->from('user');
        $this->db->where("password", md5($oldpassword));
        $this->db->where("id", $id);
        $rec = $this->db->get();

        if ($rec->num_rows() > 0)
            return true;
        else
            return false;
    }

    // Session Page
    function getAllEmployee()
    {
        $this->db->select('e.*, u.id as user_id, u.leveluser_id, u.supervisor_id, active, online, l.name as level_name');
        $this->db->from('employee as e');
        $this->db->join('user as u', 'e.id=u.employee_id', 'left');
        $this->db->join('leveluser as l', 'u.leveluser_id=l.id', 'left');
        $this->db->order_by('e.name');
        $rec = $this->db->get();

        if ($rec->num_rows() > 0)
            return $rec->result();
        else
            return null;
    }

    // Manager Page
    function getManagerList()
    {
        $this->db->select(  'u.id, e.name, email, active, 
                            (select count(distinct v.id) 
                             from user as v 
                             where active=true and leveluser_id=2 and leader_id=e.id) as spv');
        $this->db->from('user as u');
        $this->db->join('employee as e', 'u.employee_id=e.id', 'left');
        $this->db->where('leveluser_id', 4);
        if($this->session->userdata('leveluser_id')==5)
            $this->db->where('leader_id', $this->session->userdata('employee_id'));
        $this->db->order_by('u.id');
        $rec = $this->db->get();

        if ($rec->num_rows() > 0)
            return $rec->result();
        else
            return null;
    }

    function viewManager($id)
    {
        $this->db->select(  'u.*, e.name, e.employee_no, e.email, employee_id,  
                            (select count(distinct c.id) 
                             from customer as c 
                             left join user as us on c.user_id=us.id
                             where active=true and supervisor_id=u.id) as cust, 
                            (select count(distinct id) from user where leveluser_id=3 and active=true and supervisor_id=u.id) as acc');
        $this->db->from('user as u');
        $this->db->join('employee as e', 'u.employee_id=e.id', 'left');
        $this->db->where("u.id", $id);
        $rec = $this->db->get();

        if ($rec->num_rows() > 0)
            return $rec->row();
        else
            return null;
    }

    function listManagerSupervisor($id)
    {
        $this->db->distinct();
        $this->db->select('u.id, employee_no, e.name as account_name, email, active');
        $this->db->from('user as u');
        $this->db->join('employee as e', 'u.employee_id=e.id', 'left');
        $this->db->where('u.active', true);
        $this->db->where('u.leveluser_id', 2);
        // if($this->session->userdata('leveluser_id')==5)
            $this->db->where('u.leader_id', $id);
        $this->db->order_by('u.id desc');
        $rec = $this->db->get();
        
        if ($rec->num_rows() > 0)
            return $rec->result();
        else
            return null;
    }

    function listManagerSales($id)
    {
        $this->db->distinct();
        $this->db->select('u.id, employee_no, e.name as account_name, email, active, supervisor_name, id_supervisor');
        $this->db->from('user as u');
        $this->db->join('employee as e', 'u.employee_id=e.id', 'left');
        $this->db->join('(select ee.id, ee.name as supervisor_name, uu.id as id_supervisor, uu.leader_id from employee ee left join user uu on ee.id=uu.employee_id where uu.leveluser_id=2 and uu.leader_id='.$id.') eu', 
                    'u.supervisor_id=eu.id', 
                    'left'
                );
        $this->db->where('u.active', true);
        $this->db->where('u.leveluser_id', 3);
        $this->db->where('eu.leader_id', $id);
        $this->db->order_by('u.id desc');
        $rec = $this->db->get();
        
        if ($rec->num_rows() > 0)
            return $rec->result();
        else
            return null;
    }

    function listManagerCustomer($leader_id)
    {
        $stage =    "(select name 
                    from workflow as w 
                    left join stages as s on w.id=s.workflow_id 
                    where s.customer_id=c.id 
                    order by s.id desc
                    limit 1)";

        $telephone = "(select GROUP_CONCAT(DISTINCT concat(' ',number)) from telephone where customer_id=c.id) as telephone";

        $this->db->distinct();
        $this->db->select('c.id, c.name as customer_name, pic, '.$telephone.', e.name as account_name, '.$stage.' as stage_name, c.created_date');
        $this->db->from('customer as c');
        $this->db->join('user as u', 'c.user_id=u.id', 'left');
        $this->db->join('employee as e', 'u.employee_id=e.id', 'left');
        $this->db->where('u.active', true);
        $this->db->where('u.leveluser_id', 3);
        $this->db->where("u.supervisor_id in (select ee.id from employee ee left join user uu on ee.id=uu.employee_id where leveluser_id=2 and uu.leader_id=".$leader_id.")");
        $this->db->order_by('c.id desc');
        $rec = $this->db->get();
        
        if ($rec->num_rows() > 0)
            return $rec->result();
        else
            return null;
    }
    // ================================


    function saveUserSSO($sso_user_id){

        $json1 = file_get_contents('http://morahrd.moratelindo.co.id/karyawan/index.php/employeeRestserver/employee/id/'.$sso_user_id);
        $user = json_decode($json1);

        $input = array(
            'employee_uid'      => $user->employee_id,
            'employee_no'       => $user->employee_no,
            'name'              => $user->fullname,
            'email'             => $user->email,
        );

        $employee_id = $this->insertEmployee($input);

        $input = array(
            'employee_id'       => $employee_id,
            'leveluser_id'      => '3',
            'active'            => true,
            'supervisor_id'     => '9',
            'online'            => false,
        );
        $this->insertUser($input);

        return true;
    }
}