<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Denied extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array(
                    'js'            => array(),
                    'css'           => array(),
                    'title'         => 'Access Denied',
        );
        
        $this->load->view('denied', $data);
    }
}
