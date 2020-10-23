<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require('Main_Controller.php');

class Home extends Main_Controller {

    public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('id')==null)
            redirect("login");
            // redirect(APP_URL);

        $this->load->model('home_model');
    }
    
    public function index()
    {
            $data = array(
                    'view'          => 'home',
                    'js'            => array(),
                    'css'           => array(),
                    'title'         => 'Home',
        );
        
        $this->load->view('template', $data);
    }

}
