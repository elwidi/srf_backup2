<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require('Main_Controller.php');

class Profile extends Main_Controller
{

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
        if ($this->session->userdata('leveluser_id') == 3)
            $this->viewAccount();
        elseif ($this->session->userdata('leveluser_id') == 2)
            $this->viewSupervisor();
    }

    public function viewAccount()
    {
        $rec = $this->user_model->viewAccount($this->session->userdata('id'));

        if($rec==null)
            redirect('notfound');

        $data = array(
            'view'          => 'account/view',
            'judul'         => 'My Profile',
            'js'            => array(),
            'css'           => array(),
            'rec'           => $rec,
            'recActivity'   => $this->user_model->listAccountActivity($this->session->userdata('id')),
            'recCustomer'   => $this->user_model->listAccountCustomer($this->session->userdata('id')),
        );

        $this->load->view('template', $data);
    }

    public function viewSupervisor()
    {
        $rec = $this->user_model->viewSupervisor($this->session->userdata('id'));

        if($rec==null)
            redirect('notfound');

        $data = array(
            'view'          => 'supervisor/view',
            'judul'         => 'My Profile',
            'js'            => array(),
            'css'           => array(),
            'rec'           => $rec,
            'recAccount'   => $this->user_model->listSupervisorAccount($this->session->userdata('id')),
            'recCustomer'   => $this->user_model->listSupervisorCustomer($this->session->userdata('id')),
        );

        $this->load->view('template', $data);
    }

    public function logout()
    {
        $this->user_model->setOffline();

        $this->session->sess_destroy();

        redirect(base_url().'login');
        //redirect('http://application.moratelindo.co.id/index.php/logout/clear/'.$_COOKIE['SSOID']);
    }
}