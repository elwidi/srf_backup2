<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require('Main_Controller.php');

class Report extends Main_Controller {

    public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('id')==null)
        redirect("login");
        // redirect(APP_URL);
        
        $this->load->model('user_model');
        $this->load->model('report_model');
    }
    
    public function index()
    {
        
    }
    
    public function calllog()
    {
        if($this->session->userdata('leveluser_id')!=1 && $this->session->userdata('leveluser_id')!=2 && $this->session->userdata('leveluser_id')!=4)
            redirect('home');
            
        $date1 = null;
        $date2 = null;
        $label = '';
        $value = '';
        
        if($_POST)
        {
            $this->form_validation->set_rules('date','Date','trim|required');
            // $this->form_validation->set_rules('supervisor','Supervisor','trim|required');
            // $this->form_validation->set_rules('sales','Sales','trim|required');

            if($this->form_validation->run() == true)
            {
                $tmp = explode(" - ", $this->input->post('date'));
                $date1 = date('Y-m-d', strtotime($tmp[0]));
                $date2 = date('Y-m-d', strtotime($tmp[1]));

                $rec = $this->report_model->getCallLogTeam($date1, $date2); //, $this->input->post('sales')
                // echo '<pre>';print_r($rec);die();
                if($rec!=null)
                {
                    $nilai = 0;
                    foreach($rec as $r)
                    {
                        $label .= '"'.$r->supervisor_name.'",';
                        $value .= $r->jml.',';
                    }
                }

                if($label!='')
                    $label = substr($label, 0, strlen($label)-1);
                if($value!='')
                    $value = substr($value, 0, strlen($value)-1);
            }
            else
                $rec = null;
        }
        else
            $rec = null;

        if($this->session->userdata('leveluser_id')==2)
            $cmbSales = $this->user_model->listSales($this->session->userdata('employee_id'));
        elseif($this->input->post('supervisor')!=null)
            $cmbSales = $this->user_model->listSales($this->input->post('supervisor'));
        else
            $cmbSales = null;
        
        $data = array(
                    'view'          => 'report/calllog',
                    'title'         => 'Report Call Log',
                    'js'            => array('highchart'=>'highchart','select2'=>'select2','datepicker'=>'datepicker'),
                    'css'           => array('select2'=>'select2'),
                    'cmbSupervisor' => $this->user_model->listSupervisor(),
                    'cmbSales'      => $cmbSales,
                    'rec'           => $rec,
                    'date1'         => $date1,
                    'date2'         => $date2,
                    'label'         => $label,
                    'value'         => $value,
        );
        
        $this->load->view('template', $data);
    }
    
    public function calllog_detailtim()
    {
        $supervisor_name = $this->input->post('supervisor');
        $date1 = $this->input->post('date1');
        $date2 = $this->input->post('date2');

        $label = '';
        $value = '';

        if($supervisor_name!='')
        {
            $rec = $this->report_model->getCallLogDetailTeam($supervisor_name, $date1, $date2);

            if($rec!=null)
            {
                $nilai = 0;
                foreach($rec as $r)
                {
                    $label .= '"'.$r->sales_name.'",';
                    $value .= $r->jml.',';
                }

                if($label!='')
                    $label = substr($label, 0, strlen($label)-1);
                if($value!='')
                    $value = substr($value, 0, strlen($value)-1);
            }
        }

        $data = array(
                'js'            => array(),
                'title'         => 'Report Call Log Team '.$supervisor_name.'<br />',
                'label'         => $label,
                'value'         => $value,
                'date1'         => $date1,
                'date2'         => $date2,
        );

        echo $this->load->view('report/calllog_team', $data, true);
    }
    
    public function calllog_detailsales()
    {
        $sales = $this->input->post('sales');
        $date1 = $this->input->post('date1');
        $date2 = $this->input->post('date2');

        $label = '';
        $value = '';

        if($sales!='')
        {
            $rec = $this->report_model->getCallLogDetailSales($sales, $date1, $date2);

            if($rec!=null)
            {
                $nilai = 0;
                foreach($rec as $r)
                {
                    $label .= '"'.date('d-m-Y', strtotime($r->tgl)).'",';
                    $value .= $r->jml.',';
                }

                if($label!='')
                    $label = substr($label, 0, strlen($label)-1);
                if($value!='')
                    $value = substr($value, 0, strlen($value)-1);
            }
        }

        $data = array(
                'js'            => array(),
                'title'         => 'Report Call Log Sales '.$sales.'<br />',
                'label'         => $label,
                'value'         => $value,
                'date1'         => date('d-m-Y', strtotime($date1)),
                'date2'         => date('d-m-Y', strtotime($date2)),
        );

        echo $this->load->view('report/calllog_sales', $data, true);
    }
}