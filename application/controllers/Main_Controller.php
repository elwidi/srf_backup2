<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include dirname(__FILE__).DIRECTORY_SEPARATOR.'SsoClient/ClientAPI.php';

class Main_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // get info user login
        // if($this->session->userdata('id')==null) // check new session
        // {
        //     $ClientApi = new ClientAPI();
        //     $ClientApi->doCurl();

        //     $this->load->library('apps');

        //     $this->getUserLogin();
        // }
            
    }

    private function getUserLogin()
    {
        $this->load->model('user_model');

        $sso = $this->apps->info();

        $user = $this->user_model->getUser($sso['apps_user_id']);

        if($user!=null)
        {
            if($user->active==false)
            {
                $this->session->set_userdata('status', 'danger');
                $this->session->set_userdata('pesan', 'Your account is not active.<br />Please contact Administrator.');

                redirect('denied');
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
                $this->session->set_userdata('foto', $sso['obj_photo']);

                $this->user_model->setOnline();

                $this->session->unset_userdata('status');
                $this->session->unset_userdata('pesan');
            }
        }
        else
        {
//                    echo '<pre>';print_r($user);die();

            $this->session->set_userdata('status', 'danger');
            $this->session->set_userdata('pesan', 'Your account is not registered!<br />Please contact Administrator.');

            redirect('denied');
        }
    }

}