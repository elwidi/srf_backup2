<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require('Main_Controller.php');

class Account extends Main_Controller {

    public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('id')==null)
            redirect("login");
            // redirect(APP_URL);
        if($this->session->userdata('leveluser_id')==3)
            redirect('denied');

        $this->load->model('user_model');
    }

    public function index()
    {
        $rec = $this->user_model->getAccountList();

        $data = array(
            'view'          => 'account/index',
            'js'            => array('datatables'=>'datatables'),
            'css'           => array('datatables'=>'datatables'),
            'title'         => 'Sales',
            'rec'           => $rec,
        );

        $this->load->view('template', $data);
    }

    public function view($id)
    {
        $rec = $this->user_model->viewAccount($id);

        if($rec==null)
            redirect('notfound');

        $data = array(
            'view'          => 'account/view',
            'judul'         => 'Sales',
            'js'            => array(),
            'css'           => array(),
            'rec'           => $rec,
            'recActivity'   => $this->user_model->listAccountActivity($id),
            'recCustomer'   => $this->user_model->listAccountCustomer($id),
        );

        $this->load->view('template', $data);
    }


    public function emp_session(){
        $employee_id = $this->session->userdata('employee_id');

        $emp_detail = $this->user_model->viewEmployee($employee_id);

        if(!empty($emp_detail)){
            $data = array('status' => 200, 'data' => $emp_detail);
        } else {
            $data = array('status' => 400);
        }

        echo json_encode($data); exit();
    }
}