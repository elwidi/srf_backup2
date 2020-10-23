<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require('Main_Controller.php');

class Notif extends Main_Controller
{
    public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('id')==null)
        redirect("login");
        // redirect(APP_URL);
        if($this->session->userdata('leveluser_id') == 1)
            redirect('denied');

        $this->load->model('chat_model');
        $this->load->model('opportunities_model');
    }

    public function index()
    {
        $jml_notif = $this->chat_model->jumlah_notif();

        $exist = '';
        $notif_pesan = '';

        // notif chat
        $i = 0;
        $rec = $this->chat_model->notif_chat();
        if ($rec != null) 
        {
            foreach ($rec as $r) 
            {
                $notif_pesan .= '<li>
                                    <a href="' . base_url() . 'chat">
                                        <span>
                                            <span>Chat Notification</span>
                                            <span class="time">' . date("d-m-Y H:i:s", strtotime($r->created_date)) . '</span>
                                        </span>
                                        <span class="message">
                                            You have a message from ' . $r->name . '
                                        </span>
                                    </a>
                                </li>';

                $exist .= $r->created_by;

                $i++;
            }
        }

        // notif deadline stage untuk sales
        if($this->session->userdata('leveluser_id')==3)
        {
            $i = 0;
            $rec = $this->opportunities_model->notif_deadline();
            
            if ($rec != null) 
            {
                $jml_notif += $rec->num_rows();

                foreach ($rec->result() as $r) 
                {
                    $notif_pesan .= '<li style="background-color:#ffeba3">
                                        <a href="' . base_url() . 'opportunities/view/'.$r->id.'">
                                            <span>
                                                <span>Deadline Stage</span>
                                                <span class="time">' . $r->stage_name . '</span>
                                            </span>
                                            <span class="message">
                                                Customer stages past the deadline (' . date('d-m-Y', strtotime($r->deadline)) . ') 
                                            </span>
                                        </a>
                                    </li>';

                    $exist .= $r->id;

                    $i++;
                }
            }
        }

        echo json_encode(array(
            'jml_notif' => $jml_notif,
            'exist' => $exist,
            'notif_pesan' => $notif_pesan,
        ));
    }
}