<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require('Main_Controller.php');

class Employee extends Main_Controller {

    public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('id')==null)
        redirect("login");
        // redirect(APP_URL);
        if($this->session->userdata('leveluser_id')!=1)
            redirect('denied');

        $this->load->model('user_model');
    }

    public function index()
    {
        $rec = $this->user_model->getEmployeeList();

        $data = array(
            'view'          => 'employee/index',
            'js'            => array('datatables'=>'datatables'),
            'css'           => array('datatables'=>'datatables'),
            'title'         => 'User',
            'rec'           => $rec,
        );

        $this->load->view('template', $data);
    }

    public function view($id)
    {
        $rec = $this->user_model->viewEmployee($id);

        if($rec==null)
            redirect('notfound');

        $data = array(
            'view'          => 'employee/view',
            'judul'         => 'User',
            'js'            => array(),
            'css'           => array(),
            'rec'           => $rec,
        );

        $this->load->view('template', $data);
    }

    public function create()
    {
        $cmbSupervisor = null;

        if($_POST)
        {
            $this->form_validation->set_rules('employee_uid','Employee UID','trim|required');
            $this->form_validation->set_rules('employee_no','Employee Number','trim|required');
            $this->form_validation->set_rules('name','Name','trim|required');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[employee.email]');
            $this->form_validation->set_rules('leveluser_id','User Level','trim|required');

            if($this->input->post('leveluser_id')==3)
                $this->form_validation->set_rules('supervisor_id','Supervisor','trim|required');

            $this->form_validation->set_message('is_unique', 'User has been added!');
            $this->form_validation->set_message('supervisor_id', 'Please select a supervisor');

            if($this->form_validation->run() == true)
            {
                $input = array(
                    'employee_uid'      => $this->input->post('employee_uid'),
                    'employee_no'       => $this->input->post('employee_no'),
                    'name'              => $this->input->post('name'),
                    'email'             => $this->input->post('email'),
                );
                $employee_id = $this->user_model->insertEmployee($input);

                $input = array(
                    'employee_id'       => $employee_id,
                    'leveluser_id'      => $this->input->post('leveluser_id'),
                    'active'            => true,
                    'supervisor_id'     => ($this->input->post('leveluser_id')==3) ? $this->input->post('supervisor_id') : null,
                    'online'            => false,
                );
                $this->user_model->insertUser($input);

                $this->session->set_userdata('status', 'success');
                $this->session->set_userdata('pesan', 'Save New Employee Successfully');

                redirect(base_url().'employee/view/'.$employee_id);
            }
            else
            {
                if($this->input->post('leveluser_id')==3)
                    $cmbSupervisor = $this->user_model->listSupervisor();

                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('pesan', 'Your Input Data is Not Valid');
            }
        }

        $json = file_get_contents('http://morahrd.moratelindo.co.id/karyawan/index.php/employeeRestserver/employees');
        $cmbEmployee = json_decode($json);

        $data = array(
            'view'          => 'employee/create',
            'judul'         => 'User',
            'js'            => array('validation'=>'validation','select2'=>'select2'),
            'css'           => array('select2'=>'select2'),
            'cmbEmployee'   => $cmbEmployee,
            'cmbLevel'      => $this->user_model->listLeveluser(),
            'cmbSupervisor' => $cmbSupervisor,
        );

        $this->load->view('template', $data);
    }

    public function get_supervisor()
    {
        $rec = $this->user_model->listSupervisor();

        if($rec!=null)
        {
            $i = 0;
            foreach($rec as $r)
            {
                $data['value'][$i] = $r->id;
                $data['text'][$i] = $r->name;

                $i++;
            }

            echo json_encode(array(
                'success'=>true,
                'value'=>$data['value'],
                'text'=>$data['text'],
            ));
        }
        else
        {
            echo json_encode(array(
                'success'=>false,
                'value'=>null,
                'text'=>null,
            ));
        }
    }

    public function edit($id)
    {
        $rec = $this->user_model->viewEmployee($id);
        if($rec==null)
            redirect('notfound');

        if($rec->leveluser_id==3)
            $cmbSupervisor = $this->user_model->listSupervisor();
        else
            $cmbSupervisor = null;

        if($_POST)
        {
            $this->form_validation->set_rules('employee_uid','Employee UID','trim|required');
            $this->form_validation->set_rules('leveluser_id','User Level','trim|required');
            $this->form_validation->set_rules('active','Active','trim|required');

            if($this->input->post('leveluser_id')==3)
                $this->form_validation->set_rules('supervisor_id','Supervisor','trim|required');

            $this->form_validation->set_message('supervisor_id', 'Please select a supervisor');

            if($this->form_validation->run() == true)
            {
                $input = array(
                    'employee_uid'      => $this->input->post('employee_uid'),
                    'employee_no'       => $this->input->post('employee_no'),
                    'name'              => $this->input->post('name'),
                    'email'             => $this->input->post('email'),
                );
                $this->user_model->updateEmployee($input, $rec->id);

                $input = array(
                    'leveluser_id'      => $this->input->post('leveluser_id'),
                    'active'            => $this->input->post('active'),
                    'supervisor_id'     => ($this->input->post('leveluser_id')==3) ? $this->input->post('supervisor_id') : null,
                );
                $this->user_model->updateUser($input, $rec->user_id);

                $this->session->set_userdata('status', 'success');
                $this->session->set_userdata('pesan', 'Update Employee Data Successfully');

                redirect(base_url().'employee/view/'.$rec->id);
            }
            else
            {
                if($this->input->post('leveluser_id')==3)
                    $cmbSupervisor = $this->user_model->listSupervisor();

                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('pesan', 'Your Input Data is Not Valid');
            }
        }

        $data = array(
            'view'          => 'employee/edit',
            'judul'         => 'User',
            'js'            => array('validation'=>'validation','select2'=>'select2'),
            'css'           => array('select2'=>'select2'),
            'rec'           => $rec,
            'cmbLevel'      => $this->user_model->listLeveluser(),
            'cmbSupervisor' => $cmbSupervisor,
        );

        $this->load->view('template', $data);
    }

}