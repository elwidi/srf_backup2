<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    
class Report_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        $this->load->database('default');
    }
    
    function getCallLogTeam($date1, $date2)
    {
        $this->db = $this->load->database('default', true);

        $rec = $this->db->query("
                    select supervisor_name, sum(jml) as jml
                    from (
                        select distinct e.name as supervisor_name, 
                            (select count(r.customer_id) 
                            from customer as c
                            left join reportcalllog as r on c.id=r.customer_id 
                            where DATE_FORMAT(date, '%Y-%m-%d') between '".$date1."' and '".$date2."'
                                and c.user_id=u.id and r.customer_id is not null and r.id=(select id from reportcalllog where DATE_FORMAT(date, '%Y-%m-%d')=DATE_FORMAT(r.date, '%Y-%m-%d') and customer_id=r.customer_id order by id limit 1)) as jml 
                        from user as u
                        left join employee as e on u.supervisor_id=e.id 
                        where u.supervisor_id is not null 
                        group by e.name, u.id 
                    ) as t
                    group by supervisor_name
                    order by supervisor_name
                ");
        
        if ($rec->num_rows() > 0)
            return $rec->result();
        else
            return null;
    }

    function getCallLogDetailTeam($supervisor_name, $date1, $date2)
    {
        $rec = $this->db->query("
                    select distinct u.id, eu.name as sales_name, 
                        (select count(r.customer_id) 
                        from customer as c
                        left join reportcalllog as r on c.id=r.customer_id 
                        where DATE_FORMAT(date, '%Y-%m-%d') between '".$date1."' and '".$date2."'
                            and c.user_id=u.id and r.customer_id is not null and r.id=(select id from reportcalllog where DATE_FORMAT(date, '%Y-%m-%d')=DATE_FORMAT(r.date, '%Y-%m-%d') and customer_id=r.customer_id order by id limit 1)) as jml 
                    from user as u 
                    left join employee as e on u.supervisor_id=e.id 
                    left join employee as eu on u.employee_id=eu.id 
                    where e.name='".$supervisor_name."' 
                    group by eu.name, u.id 
                ");
        
        if ($rec->num_rows() > 0)
            return $rec->result();
        else
            return null;
    }

    function getCallLogDetailSales($sales_name, $date1, $date2)
    {
        $rec = $this->db->query("
                    select distinct DATE_FORMAT(date, '%Y-%m-%d') as tgl, count(distinct r.customer_id) as jml 
                    from reportcalllog as r 
                    left join customer as c on r.customer_id=c.id 
                    left join user as u on c.user_id=u.id 
                    left join employee as e on u.employee_id=e.id 
                    where e.name='".$sales_name."' and DATE_FORMAT(date, '%Y-%m-%d') between '".$date1."' and '".$date2."' 
                    group by DATE_FORMAT(date, '%Y-%m-%d')
                    order by DATE_FORMAT(date, '%Y-%m-%d')
                ");
        
        if ($rec->num_rows() > 0)
            return $rec->result();
        else
            return null;
    }

    function getCallActivity()
    {
        $this->db = $this->load->database('default', true);

        $this->db->select("id, customer_id, pin, telephone, DATE_FORMAT(telephone_date, '%Y-%m-%d') as telephone_date");
        $this->db->from('activity');
        $this->db->where("activitytype_id", 1);
        $this->db->where("get_log", false);
        $this->db->order_by("telephone_date");
        $rec = $this->db->get();
        
        if ($rec->num_rows() > 0)
            return $rec->result();
        else
            return null;
    }

    function checkReportExist($customer_id, $telephone_date)
    {
        $this->db = $this->load->database('default', true);

        $this->db->select("id");
        $this->db->from('reportcalllog');
        $this->db->where("customer_id", $customer_id);
        $this->db->where("DATE_FORMAT(date, '%Y-%m-%d')='".$telephone_date."'");
        $rec = $this->db->get();

        if ($rec->num_rows() > 0)
            return $rec->row();
        else
            return null;
    }

    function getCallLog($pin, $telephone, $telephone_date)
    {
        $this->db = $this->load->database('calllog', true);

        $this->db->distinct();
        $this->db->select("calldate");
        $this->db->from('cdr');
        $this->db->where("SUBSTRING(dst,2,(LENGTH(dst)-1))", $telephone);
        $this->db->where("accountcode", $pin);
        $this->db->where("DATE_FORMAT(calldate, '%Y-%m-%d') ='".$telephone_date."'");
        $this->db->group_by("DATE_FORMAT(calldate, '%Y-%m-%d'), ");
        $rec = $this->db->get();
        
        if ($rec->num_rows() > 0)
            return $rec->row();
        else
            return null;
    }

    function insertReport($rec)
    {
        $this->db = $this->load->database('default', true);

        $this->db->insert('reportcalllog', $rec);
    }

    function updateActivity($rec, $id)
    {
        $this->db = $this->load->database('default', true);

        $this->db->where('id', $id);
        $this->db->update('activity', $rec);
    }
}