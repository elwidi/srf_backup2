<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require('Main_Controller.php');

class Opportunities extends Main_Controller {

    public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('id')==null)
        redirect("login");
        // redirect(APP_URL);
        
        $this->load->model('opportunities_model');
        $this->load->model('customer_model');
    }
    
    public function index()
    {
        $rec = $this->opportunities_model->getList();
        
        $data = array(
                    'view'          => 'opportunities/index',
                    'js'            => array('datatables'=>'datatables'),
                    'css'           => array('datatables'=>'datatables'),
                    'title'         => 'Opportunities',
                    'rec'           => $rec,
        );
        
        $this->load->view('template', $data);
    }

    public function view($id)
    {
        $rec = $this->opportunities_model->view($id);

        if($rec!=null)
        {
            $data = array(
                        'view'          => 'opportunities/view',
                        'judul'         => 'Opportunities',
                        'js'            => array('wizard'=>'wizard','validation'=>'validation','loadingmodal'=>'loadingmodal','sweetalert'=>'sweetalert','datepicker'=>'datepicker','select2'=>'select2','timepicker'=>'timepicker'),
                        'css'           => array('wizard'=>'wizard','loadingmodal'=>'loadingmodal','sweetalert'=>'sweetalert','select2'=>'select2','datepicker'=>'datepicker','timepicker'=>'timepicker'),
                        'rec'           => $rec,
                        'recStages'     => $this->opportunities_model->listStages(),
                        'recActivity'   => $this->opportunities_model->listActivity($rec->id),
                        'recType'       => $this->opportunities_model->listType(),
                        'recTelephone'  => $this->opportunities_model->listTelephone($rec->id),
            );

            $this->load->view('template', $data);
        }
        else
            redirect('notfound');
    }

    public function view2($id = "")
    {
            if(!empty($id)){
                // $rec = $this->opportunities_model->getData('customer', array('id' => $id));
                $rec2 = $this->opportunities_model->getData(array(
                    'table' => 'customer',
                    'condition' => array('id' =>$id),
                    // 'type' => 'array'
                ));
                $rec = $this->opportunities_model->view($id);
                // var_dump($rec); exit;
                $recActivity = $this->opportunities_model->listActivity($id);
            } else {
                $rec = array();
                $rec2 = array();
                $recActivity = array();
            }

            $data = array(
                        'view'          => 'opportunities/view_2',
                        'judul'         => 'Opportunities',
                        'js'            => array('wizard'=>'wizard','validation'=>'validation','loadingmodal'=>'loadingmodal','sweetalert'=>'sweetalert','datepicker'=>'datepicker','select2'=>'select2','timepicker'=>'timepicker','tagsinput'=>'tagsinput'),
                        'css'           => array('wizard'=>'wizard','loadingmodal'=>'loadingmodal','sweetalert'=>'sweetalert','select2'=>'select2','datepicker'=>'datepicker','timepicker'=>'timepicker'),
                        'rec'           => $rec,
                        'rec2'           => $rec2,
                        'id'            => $id,
                        'recStages'     => $this->opportunities_model->listStages(),
                        'recActivity'   => $recActivity,
                        'recType'       => $this->opportunities_model->listType(),
                        // 'recTelephone'  => $this->opportunities_model->listTelephone($rec->id),
            );

            // var_dump($data['recStages']); exit;

            $this->load->view('template', $data);
    }
    
    public function process_stage()
    {
        $workflow_id = $this->input->post('stages_id');
        $customer_id = $this->input->post('customer_id');
        
        if($workflow_id!=null && $customer_id!=null)
        {
            $input = array(
                'customer_id'       => $customer_id,
                'workflow_id'       => $workflow_id,
                'created_date'      => date('Y-m-d H:i:s')
            );
            $insert = $this->opportunities_model->insert($input);

            if($insert)
            {
            	$stage = $this->opportunities_model->getStage($workflow_id);
            	
                echo json_encode(array(
                        'success'=>true,
                        'stage'=>$stage,
                ));
            }
            else
            {
                echo json_encode(array(
                        'success'=>false,
                        'stage'=>null,
                ));
            }
        }
    }

    public function generate_form()
    {
        $workflow_id = $this->input->post('workflow_id');
        $customer_id = $this->input->post('customer_id');
        
        switch ($workflow_id)
        {
            case 1 : 
                $view = $this->form_canvasing($customer_id);
                echo $view;
                break;
            case 2 : 
                $view = $this->form_prospect($customer_id);
                echo $view;
                break;
            case 3 : 
                $view = $this->form_negotiation($customer_id);
                echo $view;
                break;
            case 4 : 
                $view = $this->form_registration($customer_id);
                echo $view;
                break;
            case 5 : 
                $view = $this->form_report($customer_id);
                echo $view;
                break;
            default : 
                echo json_encode(array(
                    'success'=>false,
                    'result'=>null,
                ));
        }
    }

    public function form_canvasing($customer_id)
    {
        $r = $this->opportunities_model->getData(array(
            'table' => 'customer', 
            'condition' => array('id' => $customer_id),
            'return' => 'array'
        ));

        

        // $r = $this->opportunities_model->getProspectdata($customer_id);
        if($r==null)
        {
            $r['name'] = null;
            $r['pic'] = null;
            $r['email'] = null;
            $r['address'] = null;
            $r['telephone'] = null;
        } else {
            $telephone = $this->opportunities_model->getData(array(
                'table' => 'telephone',
                'condition' => array('customer_id' => $customer_id),
                'return' => 'array'
            ));

            if(!empty($telephone)){
                $rr = array();
                foreach ($telephone as $key => $value) {
                    $rr[] = $value;
                }

                $r['telephone'] = implode(", ", $rr);
               
            }
        }

        $data = array(
                    'title'         => 'Form Prospect',
                    'js'            => array('validation'=>'validation','select2'=>'select2'),
                    'css'           => array('select2'=>'select2'),
                    'customer_id'   => $customer_id,
                    'r'             => $r,
        );
        
        return $this->load->view('opportunities/form_canvasing', $data, true);
    }


    public function proses_canvasing()
    {
        if($_POST)
        {
            $this->form_validation->set_rules('customer_name','Customer Name','trim|required');
            $this->form_validation->set_rules('contact_person','Contact Person','trim|required');
            $this->form_validation->set_rules('address', 'Address', 'trim|required');

            if($this->form_validation->run() == true)
            {
                $date = date('Y-m-d H:i:s');
                $r = null;

                if($r==null) // INSERT
                {
                    $input = array(
                        'name'                  => $this->input->post('customer_name'),
                        'email'                 => $this->input->post('email'),
                        'pic'                   => $this->input->post('contact_person'),
                        'address'               => $this->input->post('address'),
                        'created_date'          => $date,
                        'user_id'               => $this->session->userdata('id')
                    );

                    $id = $this->opportunities_model->saveData('customer', $input, 'id');

                    $tel = explode(",", $this->input->post('telephone'));
                    foreach ($tel as $i => $t) {
                        $data_tel = array(
                            'customer_id'   => $id,
                            'number'        => $t
                        );

                        $this->opportunities_model->saveData('telephone', $data_tel);
                    }

                    $pipline = array(
                        'customer_id' => $id,
                        'workflow_id' => 1,
                        'created_date' => $date
                    );

                    $this->opportunities_model->saveData('stages', $pipline);
                }
                else
                {
                    $input = array(
                        'existing_conditions'   => $this->input->post('existing_conditions'),
                        'existing_provider'     => $this->input->post('existing_provider'),
                        'existing_capacity'     => $this->input->post('existing_capacity'),
                        'needs_plan'            => $this->input->post('needs_plan'),
                        'budget'                => $this->input->post('budget'),
                        'updated_date'          => $date,
                    );
                    $this->opportunities_model->updateProspect($input, $r['id']);
                }


                
                echo json_encode(array(
                    'success'=>true,
                    'pesan'=>'Save Prospect Data Successfully',
                ));

            }
            else
            {
                echo json_encode(array(
                    'success'=>false,
                    'pesan'=>'Your Input Data is Not Valid',
                ));
            }
        }
        else
        {
            echo json_encode(array(
                'success'=>false,
                'pesan'=>'No input data',
            ));
        }
    }




    public function form_prospect($customer_id)
    {
        $r = $this->opportunities_model->getProspectdata($customer_id);
        if($r==null)
        {
            $r['customer_id'] = null;
            $r['existing_conditions'] = null;
            $r['existing_provider'] = null;
            $r['existing_capacity'] = null;
            $r['needs_plan'] = null;
            $r['budget'] = null;
            $r['updated_date'] = null;
        }
        
        $data = array(
                    'title'         => 'Form Prospect',
                    'js'            => array('validation'=>'validation','select2'=>'select2'),
                    'css'           => array('select2'=>'select2'),
                    'customer_id'   => $customer_id,
                    'r'             => $r,
        );
        
        return $this->load->view('opportunities/form_prospect', $data, true);
    }


    public function proses_prospect()
    {
        if($_POST)
        {
            $this->form_validation->set_rules('customer_id','Customer','trim|required');
            $this->form_validation->set_rules('existing_conditions','Existing Conditions','trim|required');
            $this->form_validation->set_rules('existing_provider','Existing Provider','trim|required');
            $this->form_validation->set_rules('existing_capacity', 'Existing Capacity', 'trim|required');
            $this->form_validation->set_rules('needs_plan','Needs Plan','trim|required');
            $this->form_validation->set_rules('budget','Budget','trim|required');

            if($this->form_validation->run() == true)
            {
                $date = date('Y-m-d H:i:s');

                $r = $this->opportunities_model->getProspectdata($this->input->post('customer_id'));

                if($r==null) // INSERT
                {
                    $input = array(
                        'customer_id'           => $this->input->post('customer_id'),
                        'existing_conditions'   => $this->input->post('existing_conditions'),
                        'existing_provider'     => $this->input->post('existing_provider'),
                        'existing_capacity'     => $this->input->post('existing_capacity'),
                        'needs_plan'            => $this->input->post('needs_plan'),
                        'budget'                => $this->input->post('budget'),
                        'updated_date'          => $date,
                    );
                    $id = $this->opportunities_model->insertProspect($input);
                }
                else
                {
                    $input = array(
                        'existing_conditions'   => $this->input->post('existing_conditions'),
                        'existing_provider'     => $this->input->post('existing_provider'),
                        'existing_capacity'     => $this->input->post('existing_capacity'),
                        'needs_plan'            => $this->input->post('needs_plan'),
                        'budget'                => $this->input->post('budget'),
                        'updated_date'          => $date,
                    );
                    $this->opportunities_model->updateProspect($input, $r['id']);
                }
                
                echo json_encode(array(
                    'success'=>true,
                    'pesan'=>'Save Prospect Data Successfully',
                ));

            }
            else
            {
                echo json_encode(array(
                    'success'=>false,
                    'pesan'=>'Your Input Data is Not Valid',
                ));
            }
        }
        else
        {
            echo json_encode(array(
                'success'=>false,
                'pesan'=>'No input data',
            ));
        }
    }

    public function form_negotiation($customer_id)
    {
        $product = $this->opportunities_model->getDataPresales(array(
                'table' => 'PRODUCT',
                'condition' => array('PARENT_ID' => 0),
                'type' => 'bulk',
                'return' => 'array'   
        ));


        $r = $this->opportunities_model->getNegotiationdata($customer_id);
        if($r==null)
        {
            $r['customer_id'] = null;
            $r['bid_price'] = null;
            $r['product_offered'] = null;
            $r['asking_price'] = null;
            $r['agreed_price'] = null;
            $r['updated_date'] = null;
        } else {
            $pn = $this->opportunities_model->getDataPresales(array(
                'table' => 'PRODUCT',
                'condition' => array('ID_PRODUCT' => $r['product_offered']),
                'return' => 'array'
            ));

            $r['parent_id'] = $pn['PARENT_ID'];
            $r['list_product'] = $this->opportunities_model->getDataPresales(array(
                'table' => 'PRODUCT',
                'condition' => array('PARENT_ID' => $r['parent_id']),
                'return' => 'array',
                'type' => 'bulk'
            ));
        }

        // var_dump($r); exit();
        
        $data = array(
                    'title'         => 'Form Negotiation',
                    'js'            => array('validation'=>'validation','select2'=>'select2'),
                    'css'           => array('select2'=>'select2'),
                    'customer_id'   => $customer_id,
                    'r'             => $r,
                    'product'       => $product
        );
        
        return $this->load->view('opportunities/form_negotiation', $data, true);
    }

    public function proses_negotiation()
    {
        if($_POST)
        {   
            $this->form_validation->set_rules('customer_id','Customer','trim|required');
            $this->form_validation->set_rules('bid_price','Bid Price','trim|required');
            $this->form_validation->set_rules('service2','Product Offered','trim|required');
            $this->form_validation->set_rules('asking_price', 'Asking Price', 'trim|required');
            $this->form_validation->set_rules('agreed_price','Agreed Price','trim|required');

            if($this->form_validation->run() == true)
            {
                $date = date('Y-m-d H:i:s');

                $r = $this->opportunities_model->getNegotiationdata($this->input->post('customer_id'));

                if($r==null) // INSERT
                {
                    $input = array(
                        'customer_id'       => $this->input->post('customer_id'),
                        'bid_price'         => $this->input->post('bid_price'),
                        'product_offered'   => $this->input->post('service2'),
                        'asking_price'      => $this->input->post('asking_price'),
                        'agreed_price'      => $this->input->post('agreed_price'),
                        'type_service'      => $this->input->post('order_type'),
                        'description'       => $this->input->post('description'),
                        'updated_date'      => $date,
                    );
                    $id = $this->opportunities_model->insertNegotiation($input);
                }
                else
                {
                    $input = array(
                        'bid_price'         => $this->input->post('bid_price'),
                        'product_offered'   => $this->input->post('service2'),
                        'asking_price'      => $this->input->post('asking_price'),
                        'agreed_price'      => $this->input->post('agreed_price'),
                        'type_service'      => $this->input->post('order_type'),
                        'description'       => $this->input->post('description'),
                        'updated_date'      => $date,
                    );
                    $this->opportunities_model->updateNegotiation($input, $r['id']);
                }
                
                echo json_encode(array(
                    'success'=>true,
                    'pesan'=>'Save Negotiation Data Successfully',
                ));

            }
            else
            {
                echo json_encode(array(
                    'success'=>false,
                    'pesan'=>'Your Input Data is Not Valid',
                ));
            }
        }
        else
        {
            echo json_encode(array(
                'success'=>false,
                'pesan'=>'No input data',
            ));
        }
    }
    
    public function form_registration($customer_id)
    {
        $r = $this->opportunities_model->getRegistrationdata($customer_id);
        if($r==null)
        {
            $r['customer_id'] = null;
            $r['company_name'] = null;
            $r['address'] = null;
            $r['npwp'] = null;
            $r['pic_signing'] = null;
            $r['updated_date'] = null;
        }
        
        $data = array(
                    'title'         => 'Form Registration',
                    'js'            => array('validation'=>'validation','select2'=>'select2'),
                    'css'           => array('select2'=>'select2'),
                    'customer_id'   => $customer_id,
                    'r'             => $r,
        );
        
        return $this->load->view('opportunities/form_registration', $data, true);
    }

    public function proses_registration()
    {
        if($_POST)
        {
            $this->form_validation->set_rules('customer_id','Customer','trim|required');
            $this->form_validation->set_rules('company_name','Company Name','trim|required');
            $this->form_validation->set_rules('address','Address','trim|required');
            $this->form_validation->set_rules('npwp', 'NPWP', 'trim|required');
            $this->form_validation->set_rules('pic_signing','PIC Signing','trim|required');

            if($this->form_validation->run() == true)
            {
                $date = date('Y-m-d H:i:s');

                $r = $this->opportunities_model->getRegistrationdata($this->input->post('customer_id'));

                if($r==null) // INSERT
                {
                    $input = array(
                        'customer_id'       => $this->input->post('customer_id'),
                        'company_name'      => $this->input->post('company_name'),
                        'address'           => $this->input->post('address'),
                        'npwp'              => $this->input->post('npwp'),
                        'pic_signing'       => $this->input->post('pic_signing'),
                        'updated_date'      => $date,
                    );
                    $id = $this->opportunities_model->insertRegistration($input);
                }
                else
                {
                    $input = array(
                        'company_name'      => $this->input->post('company_name'),
                        'address'           => $this->input->post('address'),
                        'npwp'              => $this->input->post('npwp'),
                        'pic_signing'       => $this->input->post('pic_signing'),
                        'updated_date'      => $date,
                    );
                    $this->opportunities_model->updateRegistration($input, $r['id']);
                }
                
                echo json_encode(array(
                    'success'=>true,
                    'pesan'=>'Save Registration Data Successfully',
                ));

            }
            else
            {
                echo json_encode(array(
                    'success'=>false,
                    'pesan'=>'Your Input Data is Not Valid',
                ));
            }
        }
        else
        {
            echo json_encode(array(
                'success'=>false,
                'pesan'=>'No input data',
            ));
        }
    }

    public function form_report($customer_id)
    {
        $r = $this->opportunities_model->getReportdata($customer_id);
        if($r==null)
        {
            $r['customer_id'] = null;
            $r['date'] = null;
            $r['pks'] = null;
            $r['updated_date'] = null;
            $rbast = null;
        }
        else
        {
            $rbast = $this->opportunities_model->getBastdata($r['id']);
        }
        
        $data = array(
                    'title'         => 'Form Official Report',
                    'js'            => array('validation'=>'validation','select2'=>'select2','datepicker'=>'datepicker'),
                    'css'           => array('select2'=>'select2'),
                    'customer_id'   => $customer_id,
                    'r'             => $r,
                    'rbast'         => $rbast,
        );
        
        return $this->load->view('opportunities/form_report', $data, true);
    }

    public function proses_report()
    {
        if($_POST)
        {
            $this->form_validation->set_rules('customer_id','Customer','trim|required');
            $this->form_validation->set_rules('date','Date','trim|required');

            if($this->form_validation->run() == true)
            {
                $date = date('Y-m-d H:i:s');
                $tmp = explode('/', $this->input->post('date'));
            
                $r = $this->opportunities_model->getReportdata($this->input->post('customer_id'));

                if($r==null) // INSERT
                {
                    // upload pks
                    $config['upload_path']          = './data/pks/';
                    $config['allowed_types']        = 'jpeg|jpg|png|xls|xlsx|pdf|zip|doc|docx|ppt|pptx';
                    $config['max_size']             = 3072;
                    $this->load->library('upload', $config);

                    if ( ! $this->upload->do_upload('pks')) 
                    {
                        echo json_encode(array(
                            'success'=>false,
                            'pesan'=>strip_tags('PKS failed to upload. '.$this->upload->display_errors()),
                        ));
                    }
                    else
                    {
                        $input = array(
                            'customer_id'       => $this->input->post('customer_id'),
                            'date'              => $tmp[2].'-'.$tmp[1].'-'.$tmp[0],
                            'pks'               => $this->upload->data('file_name'),
                            'updated_date'      => $date,
                        );
                        $id = $this->opportunities_model->insertReport($input);

                        // upload bast
                        $statusUpload = true;
                        $jumlah_bast = $this->input->post('jumlah_bast');
                        for($i=1;$i<=$jumlah_bast;$i++)
                        {
                            $config2['upload_path']          = './data/bast/';
                            $config2['allowed_types']        = 'jpg|png|jpeg|gif';
                            $config2['max_size']             = 1024;
                            $this->load->library('upload', $config2);
                            $this->upload->initialize($config2);

                            if ( ! $this->upload->do_upload('file_'.$i)) 
                            {
                                $statusUpload = false;
                                break;
                            }
                            else
                            {
                                $input2 = array(
                                    'officialreportdata_id' => $id,
                                    'file'                  => $this->upload->data('file_name'),
                                );
                                $this->opportunities_model->insertBast($input2);
                            }
                        }

                        if($statusUpload==true)
                        {
                            echo json_encode(array(
                                'success'=>true,
                                'pesan'=>'Save Official Report Successfully',
                            ));
                        }
                        else
                        {
                            echo json_encode(array(
                                'success'=>true,
                                'pesan'=>'Save Official Report Success, and BAST photo failed to upload.',
                            ));
                        }

                    }

                }
                else
                {
                    if(!empty($_FILES['pks']['name']))
                    {
                        // upload pks
                        $config['upload_path']          = './data/pks/';
                        $config['allowed_types']        = 'jpeg|jpg|png|xls|xlsx|pdf|zip|doc|docx|ppt|pptx';
                        $config['max_size']             = 3072;
                        $this->load->library('upload', $config);

                        if ( ! $this->upload->do_upload('pks')) 
                        {
                            echo json_encode(array(
                                'success'=>false,
                                'pesan'=>strip_tags('PKS failed to upload. '.$this->upload->display_errors()),
                            ));
                        }
                        else
                        {
                            if(file_exists('data/pks/'.$this->input->post('pks_old')))
                                unlink('data/pks/'.$this->input->post('pks_old'));

                            $input = array(
                                'date'              => $tmp[2].'-'.$tmp[1].'-'.$tmp[0],
                                'pks'               => $this->upload->data('file_name'),
                                'updated_date'      => $date,
                            );
                            $this->opportunities_model->updateReport($input, $r['id']);

                        }
                    }
                    else
                    {
                        $input = array(
                            'date'              => $tmp[2].'-'.$tmp[1].'-'.$tmp[0],
                            'updated_date'      => $date,
                        );
                        $this->opportunities_model->updateReport($input, $r['id']);
                    }

                    // upload bast
                    $statusUpload = true;
                    $jumlah_bast = $this->input->post('jumlah_bast');
                    for($i=1;$i<=$jumlah_bast;$i++)
                    {
                        $config2['upload_path']          = './data/bast/';
                        $config2['allowed_types']        = 'jpg|png|jpeg|gif';
                        $config2['max_size']             = 1024;
                        $this->load->library('upload', $config2);
                        $this->upload->initialize($config2);

                        if ( ! $this->upload->do_upload('file_'.$i)) 
                        {
                            $statusUpload = false;
                            break;
                        }
                        else
                        {
                            $input2 = array(
                                'officialreportdata_id' => $r['id'],
                                'file'                  => $this->upload->data('file_name'),
                            );
                            $this->opportunities_model->insertBast($input2);
                        }
                    }

                    if($statusUpload==true)
                    {
                        echo json_encode(array(
                            'success'=>true,
                            'pesan'=>'Save Official Report Successfully',
                        ));
                    }
                    else
                    {
                        echo json_encode(array(
                            'success'=>true,
                            'pesan'=>'Save Official Report Success, and BAST photo failed to upload.',
                        ));
                    }
                    
                }

            }
            else
            {
                echo json_encode(array(
                    'success'=>false,
                    'pesan'=>'Your Input Data is Not Valid',
                ));
            }
        }
        else
        {
            echo json_encode(array(
                'success'=>false,
                'pesan'=>'No input data',
            ));
        }
    }

    public function delete_bast()
    {
        $id = $this->input->post('id');
        $nama_file = $this->input->post('nama_file');

        if(file_exists('data/bast/'.$nama_file))
        {
            if(unlink('data/bast/'.$nama_file))
            {
                $this->opportunities_model->deleteBast($id);

                echo json_encode(array(
                    'success'=>true,
                    'pesan'=>'File has been deleted',
                ));
            }
            else
            {
                echo json_encode(array(
                    'success'=>false,
                    'pesan'=>"File can't be deleted",
                ));
            }
        }
        else
        {
            echo json_encode(array(
                'success'=>false,
                'pesan'=>"File not found",
            ));
        }

    }

    public function insert_activity()
    {
        $customer_id = $_POST['customer_id'];
        $activitytype_id = $_POST['subject'];
        $workflow_id = $_POST['workflow_id'];
        $message = $_POST['message'];
        $created_date = date('Y-m-d H:i:s');

        if($customer_id!='' && $activitytype_id!='' && $workflow_id!='' && $message!='')
        {
            $insert_id = null;

            if($activitytype_id==1) // call activity
            {
                $telephone = $_POST['telephone'];
                $pin = $_POST['pin'];
                
                $tmp = explode("/", $_POST['date']);
                $date = $tmp[2].'-'.$tmp[1].'-'.$tmp[0];
                
                $tmp = explode(" : ", $_POST['time']);
                $time = $tmp[0].':'.$tmp[1].':00';

                $isp = $_POST['isp'];
                $bandwith = $_POST['bandwith'];
                $location = $_POST['location'];
                $budget = $_POST['budget'];

                if($telephone!='' && $pin!='' && $date!='' && $time!='')
                {
                    $existNo = $this->opportunities_model->isNoCustomer($customer_id, $telephone);
                    if($existNo==false) // no telepon baru
                    {
                        $phone = array(
                            'customer_id'       => $customer_id,
                            'number'            => $telephone,
                        );
                        $this->customer_model->insertTelephone($phone);
                    }

                    $input = array(
                        'customer_id'       => $customer_id,
                        'activitytype_id'   => $activitytype_id,
                        'workflow_id'       => $workflow_id,
                        'pin'               => $pin,
                        'telephone'         => $telephone,
                        'isp'               => $isp,
                        'bandwith'          => $bandwith,
                        'location'          => $location,
                        'budget'            => $budget,
                        'message'           => $message,
                        'telephone_date'    => $date.' '.$time,
                        'created_date'      => $created_date
                    );
                    $insert_id = $this->opportunities_model->insertActivity($input);
                }
                else
                {
                    echo json_encode(array(
                        'success'=>false,
                        'result'=>null,
                        'message'=>"Please input required data!",
                    ));
                }
            }
            else
            {
                $input = array(
                    'customer_id'       => $customer_id,
                    'activitytype_id'   => $activitytype_id,
                    'workflow_id'       => $workflow_id,
                    'message'           => $message,
                    'created_date'      => $created_date
                );
                $insert_id = $this->opportunities_model->insertActivity($input);
            }

            if($insert_id!=null)
            {
                $result = $this->opportunities_model->getActivity($insert_id);

                if($result!=null)
                {
                    echo json_encode(array(
                        'success' => true,
                        'result' => $result,
                        'message'=>"Success insert Activity!",
                    ));
                }
                else
                {
                    echo json_encode(array(
                        'success' => true,
                        'result' => null,
                        'message'=>"Failed load new Activity!",
                    ));
                }
            }
            else
            {
                echo json_encode(array(
                    'success'=>false,
                    'result'=>null,
                    'message'=>"Failed insert Activity!",
                ));
            }
        }
        else
        {
            echo json_encode(array(
                'success'=>false,
                'result'=>null,
                'message'=>"Please input required data!",
            ));
        }
    }
    
    public function insert_reply()
    {
        $activity_id = $_POST['activity_id'];
        $message = $_POST['reply'];
        $created_date = date('Y-m-d H:i:s');


        if($activity_id!='' && $message!='')
        {
            $input = array(
                'activity_id'       => $activity_id,
                'message'           => $message,
                'created_date'      => $created_date
            );
            $insert_id = $this->opportunities_model->insertReply($input);

            if($insert_id!=null)
            {
                $result = $this->opportunities_model->getReply($insert_id);

                if($result!=null)
                {
                    echo json_encode(array(
                        'success' => true,
                        'result' => $result,
                    ));
                }
                else
                {
                    echo json_encode(array(
                        'success' => true,
                        'result' => null,
                    ));
                }
            }
            else
            {
                echo json_encode(array(
                    'success'=>false,
                    'result'=>null,
                ));
            }
        }
    }

    public function getSubProduct(){
        $id = $this->input->post('id');

        $product_child = $this->opportunities_model->getDataPresales(array(
            'table' => 'PRODUCT', 
            'condition' => array('PARENT_ID' => $id),
            'type' => 'bulk',
            'return' => 'array'
        ));

        if(!empty($product_child)){
            $data = array('status' => 200, 'data' => $product_child);
        } else {
            $data = array('status' => 400);
        }

        echo json_encode($data); exit();
    }
}