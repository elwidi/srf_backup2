<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require('Main_Controller.php');

class Chat extends Main_Controller
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
    }

    public function index()
    {
        $rec = $this->chat_model->getList();

        $data = array(
            'view' => 'chat/index',
            'js' => array('chat' => 'chat'),
            'css' => array('chat' => 'chat'),
            'title' => 'Chat',
            'rec' => $rec,
        );

        $this->load->view('template', $data);
    }

    public function view()
    {
        $user_chat = $_POST['user_chat'];
        $name = $_POST['name'];

        // set read true
        $this->chat_model->setRead($user_chat);

        // get record chat
        $rec = $this->chat_model->view($user_chat);

        $data = array(
            'view' => 'chat/view',
            'judul' => 'chat',
            'js' => array('chat' => 'chat'),
            'css' => array('chat' => 'chat'),
            'rec' => $rec,
            'user_chat' => $user_chat,
            'name' => $name
        );

        $this->load->view($data['view'], $data);

    }

    public function view_reload()
    {
        $user_chat = $_POST['user_chat'];
        $name = $_POST['name'];

        $rec = $this->chat_model->view_reload($user_chat);

        if($rec!=null)
        {
            $message = '';
            $id = '';

            foreach($rec as $r)
            {
                $message .= '<li class="'.(($r->created_by==$this->session->userdata('id')) ? 'replies' : 'sent').'">
                                <img src="'.base_url().'assets/chat/pict.png" alt="'.$r->name.'"/>
                                <p>
                                    '.$r->message;

                if($r->created_by==$this->session->userdata('id'))
                {
                    $message .= '<span class="fa '.(($r->read) ? 'fa-check-square-o' : 'fa-check').'"></span>';
                }

                $message .= '</p>
                            </li>';

                $id .= $r->id;
            }

            echo json_encode(array(
                'success' => true,
                'message' => $message,
                'new_chat'=> $id,
            ));
        }
        else
        {
            echo json_encode(array(
                'success' => false,
                'message' => '',
                'new_chat'=> '',
            ));
        }
    }

    public function insert()
    {
        $message = $_POST['msg'];
        $user_sales = $_POST['user_sales'];
        $user_supervisor = $_POST['user_supervisor'];

        $created_date = date('Y-m-d H:i:s');

        if ($message != '') {
            $input = array(
                'user_sales' => $user_sales,
                'user_supervisor' => $user_supervisor,
                'message' => $message,
                'created_by' => $this->session->userdata('id'),
                'created_date' => $created_date,
                'read' => false
            );
            $insert_id = $this->chat_model->insert($input);

            if ($insert_id) {
                echo json_encode(array(
                    'success' => true,
                ));
            } else {
                echo json_encode(array(
                    'success' => false,
                ));
            }
        }
    }

    /*
     fungsi-fungsi pending

    public function read_chat()
    {
        $user_chat = $_POST['user_chat'];

        // set read true
        $read = $this->chat_model->setReadMyChat($user_chat);

        if($read)
        {
            echo json_encode(array(
                'success' => true,
            ));
        }
        else
        {
            echo json_encode(array(
                'success' => false,
            ));
        }
    }

    public function set_online()
    {
        $this->user_model->setOnline();

        echo 'online success';
    }

    public function set_offline()
    {
        $this->user_model->setOffline();

        echo 'offline success';
    }
    */

}