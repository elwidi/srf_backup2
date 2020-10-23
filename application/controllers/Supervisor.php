<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require('Main_Controller.php');

class Supervisor extends Main_Controller {

    public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('id')==null)
        redirect("login");
        // redirect(APP_URL);
        if($this->session->userdata('leveluser_id')==2 && $this->session->userdata('leveluser_id')==3)
            redirect('denied');

        $this->load->model('user_model');
    }

    public function index()
    {
        $rec = $this->user_model->getSupervisorList();

        $data = array(
            'view'          => 'supervisor/index',
            'js'            => array('datatables'=>'datatables'),
            'css'           => array('datatables'=>'datatables'),
            'title'         => 'Supervisor',
            'rec'           => $rec,
        );

        $this->load->view('template', $data);
    }

    public function view($id)
    {
        $rec = $this->user_model->viewSupervisor($id);

        if($rec==null)
            redirect('notfound');

        $data = array(
            'view'          => 'supervisor/view',
            'judul'         => 'Supervisor',
            'js'            => array(),
            'css'           => array(),
            'rec'           => $rec,
            'recAccount'   => $this->user_model->listSupervisorAccount($id),
            'recCustomer'   => $this->user_model->listSupervisorCustomer($id),
        );

        $this->load->view('template', $data);
    }

}