<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH . '/models/Main_model.php';

    
class opportunities_model extends Main_model
{

    public function __construct()
    {
        parent::__construct();

        $this->load->database('default');
    }
    
    function getList()
    {
        $stage = "(select name 
                    from workflow as w 
                    left join stages as s on w.id=s.workflow_id 
                    where s.customer_id=c.id 
                    order by s.id desc
                    limit 1)";

        $telephone = "(select GROUP_CONCAT(DISTINCT concat(' ',number)) from telephone where customer_id=c.id) as number";
			
        $this->db->from('customer as c');
        
        if($this->session->userdata('leveluser_id')==3)
        {
            $this->db->where('user_id', $this->session->userdata('id'));
            $this->db->select('c.id, c.name as customer_name, '.$telephone.', '.$stage.' as stage_name');
        }
        elseif($this->session->userdata('leveluser_id')==2)
        {
            $this->db->join('user as u', 'c.user_id=u.id', 'left');
            $this->db->join('employee as e', 'u.employee_id=e.id', 'left');
            $this->db->where('u.active', true);
            $this->db->where('supervisor_id', $this->session->userdata('employee_id'));
            $this->db->select('c.id, c.name as customer_name, '.$telephone.', e.name as account_name, '.$stage.' as stage_name');
        }
        elseif($this->session->userdata('leveluser_id')==1)
        {
            $this->db->join('user as u', 'c.user_id=u.id', 'left');
            $this->db->join('employee as e', 'u.employee_id=e.id', 'left');
            $this->db->join('employee as v', 'u.supervisor_id=v.id', 'left');
            $this->db->where('u.active', true);
            $this->db->select('c.id, c.name as customer_name, '.$telephone.', e.name as account_name, v.name as supervisor_name, '.$stage.' as stage_name');
        }
        elseif($this->session->userdata('leveluser_id')==4)
        {
            $this->db->join('user as u', 'c.user_id=u.id', 'left');
            $this->db->join('employee as e', 'u.employee_id=e.id', 'left');
            $this->db->join('employee as v', 'u.supervisor_id=v.id', 'left');
            $this->db->where('u.active', true);
            $this->db->where('u.supervisor_id in (select ee.id from employee ee left join user uu on ee.id=uu.employee_id where leveluser_id=2 and leader_id='.$this->session->userdata('employee_id').')');
            $this->db->select('c.id, c.name as customer_name, '.$telephone.', e.name as account_name, v.name as supervisor_name, '.$stage.' as stage_name');
        }
        elseif($this->session->userdata('leveluser_id')==5)
        {
            $this->db->join('user as u', 'c.user_id=u.id', 'left');
            $this->db->join('employee as e', 'u.employee_id=e.id', 'left');
            $this->db->join('employee as v', 'u.supervisor_id=v.id', 'left');
            $this->db->where('u.active', true);
            $this->db->where('u.supervisor_id in (select ee.id from employee ee left join user uu on ee.id=uu.employee_id where leveluser_id=2 
                                and leader_id in (select employee.id from employee left join user on employee.id=user.employee_id where leveluser_id=4 and leader_id='.$this->session->userdata('employee_id').' ) ) ');
            $this->db->select('c.id, c.name as customer_name, '.$telephone.', e.name as account_name, v.name as supervisor_name, '.$stage.' as stage_name');
        }
        
        $this->db->distinct();
        $this->db->order_by('c.name');
        $rec = $this->db->get();
        
        if ($rec->num_rows() > 0)
            return $rec->result();
        else
            return null;
    }
    
    function view($id)
    {
        $currentStage = "select workflow_id from stages where customer_id=".$id." order by id desc limit 1";
        
        $stageName = "(select name 
			from workflow as w 
			left join stages as s on w.id=s.workflow_id 
			where s.customer_id=c.id 
			order by s.id desc
			limit 1)";
        
        $telephone = "(select GROUP_CONCAT(DISTINCT concat(' ',number)) from telephone where customer_id=c.id) as telephone";

        $this->db->from('customer as c');
        
        if($this->session->userdata('leveluser_id')==3)
        {
            $this->db->where('user_id', $this->session->userdata('id'));
            $this->db->select('c.id, c.name as customer_name, pic, '.$telephone.', address, created_date, ('.$currentStage.') as pipeline, '.$stageName.' as stage_name');
        }
        elseif($this->session->userdata('leveluser_id')==2)
        {
            $this->db->join('user as u', 'c.user_id=u.id', 'left');
            $this->db->join('employee as e', 'u.employee_id=e.id', 'left');
            $this->db->where('u.active', true);
            $this->db->where('supervisor_id', $this->session->userdata('employee_id'));
            $this->db->select('c.id, c.name as customer_name, pic, '.$telephone.', address, created_date, e.name as account_name, ('.$currentStage.') as pipeline, '.$stageName.' as stage_name');
        }
        elseif($this->session->userdata('leveluser_id')==1 || $this->session->userdata('leveluser_id')==4 || $this->session->userdata('leveluser_id')==5)
        {
            $this->db->join('user as u', 'c.user_id=u.id', 'left');
            $this->db->join('employee as e', 'u.employee_id=e.id', 'left');
            $this->db->join('employee as v', 'u.supervisor_id=v.id', 'left');
            $this->db->where('u.active', true);
            $this->db->select('c.id, c.name as customer_name, pic, '.$telephone.', address, created_date, e.name as account_name, v.name as supervisor_name, ('.$currentStage.') as pipeline, '.$stageName.' as stage_name');
        }
        
        $this->db->where('c.id', $id);
        $rec = $this->db->get();
        
        if ($rec->num_rows() > 0)
            return $rec->row();
        else
            return null;
    }
    
    function insert($rec)
    {
        return $this->db->insert('stages', $rec);
    }
    
    function getStage($id)
    {
			$this->db->select('name');
			$this->db->from('workflow');
			$this->db->where('id', $id);
			$rec = $this->db->get();

			if($rec!=null)
				return $rec->row()->name;
			else
				return null;
    }

    function listStages()
    {
        $this->db->select('*');
        $this->db->from('workflow');
        $this->db->where('active', '1');
        $this->db->order_by('order');
        $rec = $this->db->get();

        if($rec!=null)
            return $rec->result();
        else
            return null;
    }

    function getCustomerData($customer_id)
    {
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->where('customer_id', $customer_id);
        $rec = $this->db->get();

        if($rec!=null)
            return $rec->row_array();
        else
            return null;
    }

    function getProspectdata($customer_id)
    {
        $this->db->select('*');
        $this->db->from('prospectdata');
        $this->db->where('customer_id', $customer_id);
        $rec = $this->db->get();

        if($rec!=null)
            return $rec->row_array();
        else
            return null;
    }

    function insertProspect($rec)
    {
        $this->db->insert('prospectdata', $rec);

        return $this->db->insert_id();
    }

    function updateProspect($rec, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('prospectdata', $rec);
    }

    function getNegotiationdata($customer_id)
    {
        $this->db->select('*');
        $this->db->from('negotiationdata');
        $this->db->where('customer_id', $customer_id);
        $rec = $this->db->get();

        if($rec!=null)
            return $rec->row_array();
        else
            return null;
    }
    
    function insertNegotiation($rec)
    {
        $this->db->insert('negotiationdata', $rec);

        return $this->db->insert_id();
    }

    function updateNegotiation($rec, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('negotiationdata', $rec);
    }

    function getRegistrationdata($customer_id)
    {
        $this->db->select('*');
        $this->db->from('registrationdata');
        $this->db->where('customer_id', $customer_id);
        $rec = $this->db->get();

        if($rec!=null)
            return $rec->row_array();
        else
            return null;
    }

    function insertRegistration($rec)
    {
        $this->db->insert('registrationdata', $rec);

        return $this->db->insert_id();
    }

    function updateRegistration($rec, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('registrationdata', $rec);
    }

    function getReportdata($customer_id)
    {
        $this->db->select('*');
        $this->db->from('officialreportdata');
        $this->db->where('customer_id', $customer_id);
        $rec = $this->db->get();

        if($rec!=null)
            return $rec->row_array();
        else
            return null;
    }

    function getBastdata($officialreportdata_id)
    {
        $this->db->select('*');
        $this->db->from('bastphoto');
        $this->db->where('officialreportdata_id', $officialreportdata_id);
        $rec = $this->db->get();

        if($rec!=null)
            return $rec;
        else
            return null;
    }

    function insertReport($rec)
    {
        $this->db->insert('officialreportdata', $rec);

        return $this->db->insert_id();
    }
    
    function insertBast($rec)
    {
        $this->db->insert('bastphoto', $rec);
    }

    function updateReport($rec, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('officialreportdata', $rec);
    }

    function deleteBast($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('bastphoto');
    }

    function listActivity($customer_id)
    {
        $this->db->select('a.*, t.name as type_name, w.name as stage_name, r.message as reply, r.created_date as reply_date');
        $this->db->from('activity as a');
        $this->db->join('replyactivity as r', 'a.id=r.activity_id', 'left');
        $this->db->join('activitytype as t', 'a.activitytype_id=t.id', 'left');
        $this->db->join('workflow as w', 'a.workflow_id=w.id', 'left');
        $this->db->where('customer_id', $customer_id);
        $this->db->order_by('a.id desc, r.id');
        $rec = $this->db->get();

        if($rec!=null)
            return $rec->result();
        else
            return null;
    }

    function listType()
    {
        $this->db->select('*');
        $this->db->from('activitytype');
        $this->db->order_by('id');
        $rec = $this->db->get();

        if($rec!=null)
            return $rec->result();
        else
            return null;
    }

    function listTelephone($customer_id)
    {
        $this->db->select('*');
        $this->db->from('telephone');
        $this->db->where('customer_id', $customer_id);
        $this->db->order_by('id');
        $rec = $this->db->get();

        if($rec!=null)
            return $rec->result();
        else
            return null;
    }

    function insertActivity($rec)
    {
        $this->db->insert('activity', $rec);

        return $this->db->insert_id();
    }

    function getActivity($id)
    {
        $this->db->select('a.*, DATE_FORMAT(telephone_date, "%d-%m-%Y %H:%i:%s") as waktu_tlpn, DATE_FORMAT(created_date, "%d-%m-%Y %H:%i:%s") as waktu, t.name as type_name, w.name as stage_name');
        $this->db->from('activity as a');
        $this->db->join('activitytype as t', 'a.activitytype_id=t.id', 'left');
        $this->db->join('workflow as w', 'a.workflow_id=w.id', 'left');
        $this->db->where('a.id', $id);
        $rec = $this->db->get();

        if($rec!=null)
            return $rec->row();
        else
            return null;
    }
    
    function isNoCustomer($customer_id, $telephone)
    {
        $this->db->select('number');
        $this->db->from('telephone');
        $this->db->where('customer_id', $customer_id);
        $this->db->where('number', $telephone);
        $rec = $this->db->get();

        if ($rec->num_rows() > 0)
            return true;
        else
            return false;
    }

    function insertReply($rec)
    {
        $this->db->insert('replyactivity', $rec);

        return $this->db->insert_id();
    }

    function getReply($id)
    {
        $this->db->select('*, DATE_FORMAT(created_date, "%d-%m-%Y %H:%i:%s") as waktu');
        $this->db->from('replyactivity');
        $this->db->where('id', $id);
        $rec = $this->db->get();

        if($rec!=null)
            return $rec->row();
        else
            return null;
    }

    function notif_deadline()
    {
        $stage = "  (select name 
                    from workflow as w 
                    left join stages as s on w.id=s.workflow_id 
                    where s.customer_id=c.id 
                    order by s.id desc
                    limit 1)";

        $deadline = "  (select IF ( 
                                    (WEEKDAY( 
                                        DATE_ADD(
                                            created_date,
                                            INTERVAL 6 + 
                                            IF( (WEEK(created_date) <> WEEK(DATE_ADD(created_date, INTERVAL 6 DAY))) OR (WEEKDAY(DATE_ADD(created_date, INTERVAL 6 DAY)) IN (5, 6)), 2, 0) DAY 
                                        ) 
                                    ) IN (5, 6)),
                                    (DATE_ADD(created_date, INTERVAL 10 + 0 DAY)),
                                    (DATE_ADD(
                                        created_date,
                                        INTERVAL 6 + 
                                        IF( (WEEK(created_date) <> WEEK(DATE_ADD(created_date, INTERVAL 6 DAY))) OR (WEEKDAY(DATE_ADD(created_date, INTERVAL 6 DAY)) IN (5, 6)), 2, 0) DAY 
                                        )
                                    )
                                ) 
                        from stages 
                        where customer_id=c.id 
                        order by id desc 
                        limit 1)";
        
        // $this->db->distinct();
        $this->db->select('c.id, c.name as customer_name, '.$stage.' as stage_name, '.$deadline.' as deadline');
        $this->db->from('customer as c');
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->where($deadline." < now()");
        $this->db->where(" (".$stage."='Prospect' or ".$stage."='Negotiation') ");
        // $this->db->where('(workflow_id=2 or workflow_id=3)');
        // $this->db->where("IF ( (NOW() > 
        //                     IF ( 
        //                         (WEEKDAY( 
        //                             DATE_ADD(
        //                                 s.created_date,
        //                                 INTERVAL 6 + 
        //                                 IF( (WEEK(s.created_date) <> WEEK(DATE_ADD(s.created_date, INTERVAL 6 DAY))) OR (WEEKDAY(DATE_ADD(s.created_date, INTERVAL 6 DAY)) IN (5, 6)), 2, 0) DAY 
        //                             ) 
        //                         ) IN (5, 6)),
        //                         (DATE_ADD(s.created_date, INTERVAL 10 + 0 DAY)),
        //                         (DATE_ADD(
        //                             s.created_date,
        //                             INTERVAL 6 + 
        //                             IF( (WEEK(s.created_date) <> WEEK(DATE_ADD(s.created_date, INTERVAL 6 DAY))) OR (WEEKDAY(DATE_ADD(s.created_date, INTERVAL 6 DAY)) IN (5, 6)), 2, 0) DAY 
        //                             )
        //                         )
        //                         )
        //                     ),
        //                     'warning',
        //                     'ok'
        //                 ) = 'warning'");
        // $this->db->group_by('c.id');
        // $this->db->order_by('s.id desc');
        $rec = $this->db->get();
        // echo $this->session->userdata('id');die();
        if ($rec->num_rows() > 0)
            return $rec;
        else
            return null;

    }
}