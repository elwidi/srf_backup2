<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require('Main_Controller.php');

class Changesession extends Main_Controller {

    public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('id')==null)
        redirect("login");
        // redirect(APP_URL);
        // if($this->session->userdata('leveluser_id')!=1)
        //     redirect('denied');

        $this->load->model('user_model');
    }

    public function index()
    {
        if($_POST)
        {
            $this->form_validation->set_rules('cmbemployee','User','trim|required');
            
            if($this->form_validation->run() == true)
            {
                $this->session->set_userdata('id', $this->input->post('id'));
                $this->session->set_userdata('employee_id', $this->input->post('employee_id'));
                $this->session->set_userdata('employee_uid', $this->input->post('employee_uid'));
                $this->session->set_userdata('user_name', $this->input->post('name'));
                $this->session->set_userdata('leveluser_id', $this->input->post('leveluser_id'));
                $this->session->set_userdata('level_name', $this->input->post('level_name'));
                $this->session->set_userdata('email', $this->input->post('email'));
                $this->session->set_userdata('active', $this->input->post('active'));
                $this->session->set_userdata('foto', '');

                $this->session->set_userdata('status', 'success');
                $this->session->set_userdata('pesan', 'Login Success');

                redirect(base_url().'home');
            }
            else
            {
                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('pesan', 'Your Input Data is Not Valid');
            }
        }

        $data = array(
            'view'          => 'changesession/index',
            'judul'         => 'Session',
            'js'            => array('validation'=>'validation','select2'=>'select2'),
            'css'           => array('select2'=>'select2'),
            'cmbEmployee'   => $this->user_model->getAllEmployee(),
        );

        $this->load->view('template', $data);
    }

}