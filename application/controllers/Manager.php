<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require('Main_Controller.php');

class Manager extends Main_Controller {

    public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('id')==null)
            redirect("login");
            // redirect(APP_URL);
        
        $this->load->model('user_model');
    }
    
    public function index()
    {
        $rec = $this->user_model->getManagerList();

        $data = array(
                    'view'          => 'manager/index',
                    'js'            => array('datatables'=>'datatables'),
                    'css'           => array('datatables'=>'datatables'),
                    'title'         => 'Manager',
                    'rec'           => $rec,
        );
        
        $this->load->view('template', $data);
    }

    public function view($id)
    {
        $rec = $this->user_model->viewManager($id);

        if($rec==null)
            redirect('notfound');

        $data = array(
            'view'          => 'manager/view',
            'judul'         => 'manager',
            'js'            => array(),
            'css'           => array(),
            'rec'           => $rec,
            'recSpv'        => $this->user_model->listManagerSupervisor($rec->employee_id),
            'recSales'      => $this->user_model->listManagerSales($rec->employee_id),
            'recCustomer'   => $this->user_model->listManagerCustomer($rec->employee_id),
        );

        $this->load->view('template', $data);
    }

}