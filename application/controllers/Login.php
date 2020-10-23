<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('user_model');
    }
    
    public function index()
    {
        if($this->session->userdata('id')!=null)
            redirect('home');
        
        $data = null;

        if($_POST)
        {
            if($this->input->post('email')!='' && $this->input->post('password')!='')
            {
                $this->form_validation->set_rules('email','Email','trim|valid_email|required');
                $this->form_validation->set_rules('password','Password','trim|required');

                if($this->form_validation->run() == true)
                {
                    $email = $this->input->post('email');
                    $password = $this->input->post('password');


                    $url = 'http://presensi.apps.moratelindo.co.id/api/login';
                    $data = array('email' => $email, 'password' => $password);

                    $options = array(
                        'http' => array(
                            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                            'method'  => 'POST',
                            'content' => http_build_query($data)
                        )
                    );
                    $context  = stream_context_create($options);
                    $result = file_get_contents($url, false, $context);
                    if ($result === FALSE) { /* Handle error */ }

                    $e = json_decode($result, true);

                    $user = $this->user_model->getUserLogin($email);

                    if($e['success'] == true && $user == null)
                    {
                        $r = $this->user_model->saveUserSSO($e['user']['userId']);
                    }

                    $user = $this->user_model->getUserLogin($email);

                    // if($user!=null && strtolower($password)=='password')

                    if($user!=null && $e['success'] == true)
                    {
                        if($user->active==false)
                        {
                            $this->session->set_flashdata('status', 'danger');
                            $this->session->set_flashdata('pesan', 'Your Account is Not Active.');
                        }
                        else
                        {
                            $this->session->set_userdata('id', $user->id);
                            $this->session->set_userdata('employee_id', $user->id_employee);
                            $this->session->set_userdata('employee_uid', $user->employee_uid);
                            $this->session->set_userdata('user_name', $user->user_name);
                            $this->session->set_userdata('leveluser_id', $user->leveluser_id);
                            $this->session->set_userdata('level_name', $user->level_name);
                            $this->session->set_userdata('email', $user->email);
                            $this->session->set_userdata('active', $user->active);
                            $this->session->set_userdata('foto', null);

                            $this->user_model->setOnline();

                            redirect(base_url().'home');
                        }
                    }
                    else
                    {
                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('pesan', 'Login Failed. Email or Password is Wrong.');
                    }
                }
                else
                {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('pesan', 'Your Email or Password is Not Valid');
                }
            }
            else
            {
                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('pesan', 'Please Input Your Email and Password.');
            }
        }
        
        $data = array(
                    'view'          => 'login',
                    'judul'         => 'Login',
                    'css'           => array(),
        );
        
        $this->load->view('login', $data);
    }
    
    public function logout()
    {
        $this->user_model->setOffline();

        session_destroy();

        redirect(base_url().'login');
    }
}
