<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cronjob extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('user_model');
        $this->load->model('report_model');
    }
    
    public function index()
    {
        
    }
    
    public function get_call_log()
    {
        $rec = $this->report_model->getCallActivity();

        if($rec!=null)
        {
            foreach($rec as $r)
            {
                // cek sudah ada belum customer di report log
                $id_report = $this->report_model->checkReportExist($r->customer_id, $r->telephone_date);
                
                if($id_report==null)
                {
                    // check log call in server
                    $log = $this->report_model->getCallLog($r->pin, $r->telephone, $r->telephone_date);
                    if($log!=null)
                    {
                        // insert into table report
                        $input = array (
                            'customer_id'   => $r->customer_id,
                            'date'          => $log->calldate,
                        );
                        $this->report_model->insertReport($input);
                    }
                }

                // update status get log in activity table
                $update = array (
                    'get_log'   => true
                );
                $this->report_model->updateActivity($update, $r->id);
            }
        }
    }
}