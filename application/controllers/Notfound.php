<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once('Main_Controller.php');

class Notfound extends Main_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array(
                    'view'          => 'notfound',
                    'js'            => array(),
                    'css'           => array(),
                    'title'         => 'Not Found',
        );
        
        $this->load->view('template', $data);
    }
}
