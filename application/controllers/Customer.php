<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require('Main_Controller.php');

class Customer extends Main_Controller {

    public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('id')==null)
            redirect("login");
            // redirect(APP_URL);
        
        $this->load->model('customer_model');
        $this->load->model('stages_model');
    }
    
    public function index()
    {
        $rec1 = $this->customer_model->getList();
        if(empty($rec1)) $rec1 = array();
        $rec2 = $this->customer_model->get_customer_oracle();

        if($rec1!=null && $rec2!=null)
            $rec = array_merge($rec1, $rec2);
        elseif($rec1!=null)
            $rec = $rec1;
        elseif($rec2!=null)
            $rec = $rec2;

        $data = array(
                    'view'          => 'customer/index',
                    'js'            => array('datatables'=>'datatables', 'select2' => 'select2'),
                    'css'           => array('datatables'=>'datatables', 'select2' => 'select2'),
                    'title'         => 'Customer',
                    'rec'           => $rec,
        );
        
        $this->load->view('template', $data);
    }

     public function data()
    {
        /*$rec1 = $this->customer_model->getList();
        if(empty($rec1)) $rec1 = array();
        $rec2 = $this->customer_model->get_customer_oracle();

        if($rec1!=null && $rec2!=null)
            $rec = array_merge($rec1, $rec2);
        elseif($rec1!=null)
            $rec = $rec1;
        elseif($rec2!=null)
            $rec = $rec2;*/

        $data = array(
                    'view'          => 'customer/list_customer',
                    'js'            => array('datatables2'=>'datatables2', 'select2' => 'select2'),
                    'css'           => array('datatables2'=>'datatables2', 'select2' => 'select2'),
                    'title'         => 'Customer',
                    // 'rec'           => $rec,
        );
        
        $this->load->view('template', $data);
    }

    public function create2()
    {
        if($this->session->userdata('leveluser_id')!=3)
            redirect('customer');
        
        if($_POST)
        {
            $this->form_validation->set_rules('name','Company Name','trim|required');
            $this->form_validation->set_rules('pic','Contact Person','trim|required');
            $this->form_validation->set_rules('telephone','Contact Number','trim|required');
            // $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_rules('address','Contact Address','trim|required');
            $this->form_validation->set_rules('customercategory_id', 'Category', 'trim|required');

            if($this->input->post('customercategory_id')=='-')
                $this->form_validation->set_rules('category_name', 'New Category', 'trim|required');

            if($this->form_validation->run() == true)
            {
                $date = date('Y-m-d H:i:s');
                $tlpn = explode(",", $this->input->post('telephone'));

                if($this->input->post('customercategory_id')=='-')
                {
                    $arr = array(
                        'name'      => $this->input->post('category_name'),
                    );
                    $customercategory_id = $this->customer_model->insertCustomercategory($arr);
                }
                else
                    $customercategory_id = $this->input->post('customercategory_id');

                $input = array(
                    'user_id'               => $this->session->userdata('id'),
                    'name'                  => $this->input->post('name'),
                    'pic'                   => $this->input->post('pic'),
                    'email'                 => $this->input->post('email'),
                    'address'               => $this->input->post('address'),
                    'customercategory_id'   => $customercategory_id,
                    'created_date'          => $date,
                );
                $id = $this->customer_model->insert($input);
                
                $input = array(
                    'customer_id'       => $id,
                    'workflow_id'       => 1,
                    'created_date'      => $date,
                );
                $this->stages_model->insert($input);

                for($i=0;$i<count($tlpn);$i++)
                {
                    $phone = array(
                        'customer_id'       => $id,
                        'number'            => $tlpn[$i],
                    );
                    $this->customer_model->insertTelephone($phone);
                }

                $this->session->set_userdata('status', 'success');
                $this->session->set_userdata('pesan', 'Save New Customer Successfully');

                redirect(base_url().'customer/view/'.$id);
            }
            else
            {
                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('pesan', 'Your Input Data is Not Valid');
            }
        }
        
        $data = array(
                    'view'          => 'customer/create',
                    'title'         => 'Customer',
                    'js'            => array('validation'=>'validation','select2'=>'select2','tagsinput'=>'tagsinput'),
                    'css'           => array('select2'=>'select2'),
                    'cmbCustomer'   => $this->customer_model->listCustomer(),
                    'cmbCategory'   => $this->customer_model->listCategory(),
        );
        
        $this->load->view('template', $data);
    }

    public function create()
    {
        if($this->session->userdata('leveluser_id')!=3)
            redirect('customer');
        
        if($_POST)
        {
            $this->form_validation->set_rules('name','Company Name','trim|required');
            $this->form_validation->set_rules('pic','Contact Person','trim|required');
            // $this->form_validation->set_rules('telephone','Contact Number','trim|required');
            // $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_rules('address','Contact Address','trim|required');
            // $this->form_validation->set_rules('customercategory_id', 'Category', 'trim|required');

            if($this->input->post('customercategory_id')=='-')
                $this->form_validation->set_rules('category_name', 'New Category', 'trim|required');

            if($this->form_validation->run() == true)
            {
                $file = array();

                if(!empty($_FILES['list_data']['name'])){
                    $upload = $this->uploadFile('list_data');
                    if($upload['status'] == 'success'){
                        $file = array(
                            'path' => $upload['path'],
                            'filename' => $upload['upload_data']['file_name'],
                        );
                    }
                }

                
                $date = date('Y-m-d H:i:s');
                $tlpn = explode(",", $this->input->post('telephone'));

                if($this->input->post('customercategory_id')=='-')
                {
                    $arr = array(
                        'name'      => $this->input->post('category_name'),
                    );
                    $customercategory_id = $this->customer_model->insertCustomercategory($arr);
                }
                else
                    $customercategory_id = $this->input->post('customercategory_id');

                $input = array(
                    'user_id'               => $this->session->userdata('id'),
                    'name'                  => $this->input->post('name'),
                    'pic'                   => $this->input->post('pic'),
                    'email'                 => $this->input->post('email'),
                    'address'               => $this->input->post('address'),
                    'customercategory_id'   => $customercategory_id,
                    'created_date'          => $date,
                    'nama_sales'            => $this->session->userdata('user_name'),
                    'segmen'                => $this->input->post('segmen'),
                    'area'                  => $this->input->post('area'),
                    'id_product'            => $this->input->post('service'),
                    'type_service'          => $this->input->post('type_service'),
                    'koordinat_lat'         => $this->input->post('latitude'),
                    'koordinat_long'        => $this->input->post('longitude'),
                    'terminasi'             => $this->input->post('ruang_terminasi'),
                    'mix'                   => $this->input->post('mix'),
                    'kapasitas'             => $this->input->post('kapasitas'),
                    'satuan'                => $this->input->post('satuan'),
                    'mix1'                  => $this->input->post('mix1'),
                    'kapasitas1'            => $this->input->post('kapasitas1'),
                    'satuan1'               => $this->input->post('satuan1'),
                    'interface'             => $this->input->post('interface'),
                    'media'                 => $this->input->post('media'),
                    'existing'              => $this->input->post('existing_provider'),
                    'budget'                => $this->input->post('budget'),
                    'notes'                 => $this->input->post('notes'),
                );

                if(!empty($file)){
                    $input['list_data_path'] = $file['path'];
                    $input['list_data_filename'] = $file['filename'];
                }

                $pId = $this->customer_model->savePresales($file);
                $input['id_customer_presales']  = $pId;

                $id = $this->customer_model->insert($input);

                
                $input = array(
                    'customer_id'       => $id,
                    'workflow_id'       => 1,
                    'created_date'      => $date,
                );
                $this->stages_model->insert($input);

                for($i=0;$i<count($tlpn);$i++)
                {
                    $phone = array(
                        'customer_id'       => $id,
                        'number'            => $tlpn[$i],
                    );
                    $this->customer_model->insertTelephone($phone);
                }

                $this->session->set_userdata('status', 'success');
                $this->session->set_userdata('pesan', 'Save New Customer Successfully');

                redirect(base_url().'customer/view2/'.$id);
            }
            else
            {
                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('pesan', 'Your Input Data is Not Valid');
            }
        }
        $cmbCustomer = $this->customer_model->listCustomer();
        $customer_oracle = $this->customer_model->get_customer_oracle();

        if($cmbCustomer!=null && $customer_oracle!=null)
            $cst = array_merge($cmbCustomer, $customer_oracle);
        elseif($cmbCustomer!=null)
            $cst = $cmbCustomer;
        elseif($cmbCustomer!=null)
            $cst = $customer_oracle;

        $json1 = file_get_contents('http://morahrd.moratelindo.co.id/karyawan/index.php/employeeRestserver/dati2');
        $kab = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $json1), true );

        foreach ($kab as $key => $value) {
            $kab[$key]['name'] = str_replace("KOTA", "", $kab[$key]['name']);
            $kab[$key]['name'] = str_replace("KAB", "", $kab[$key]['name']);
            $kab[$key]['name'] = str_replace(".", "", $kab[$key]['name']);
            if(substr($kab[$key]['name'], 0, 1) == " "){
                $kab[$key]['name'] = substr($kab[$key]['name'], 1);
            }
        }

        $data = array(
                    'view'          => 'customer/create2',
                    'title'         => 'Customer',
                    'js'            => array('validation'=>'validation','select2'=>'select2','tagsinput'=>'tagsinput'),
                    'css'           => array('select2'=>'select2'),
                    // 'cmbCustomer'   => $this->customer_model->listCustomer(),
                    'cmbCustomer'   => $cst,
                    'cmbCategory'   => $this->customer_model->listCategory(),
                    'segmen'        => $this->customer_model->listSegmen(),
                    'product'       => $this->customer_model->listProduct(),
                    'kab'           => $kab
        );
        
        $this->load->view('template', $data);
    }

    public function prospect($id = "")
    {
        if($this->session->userdata('leveluser_id')!=3)
            redirect('customer');
        
        if($_POST)
        {
            $this->form_validation->set_rules('name','Company Name','trim|required');
            $this->form_validation->set_rules('pic','Contact Person','trim|required');
            // $this->form_validation->set_rules('telephone','Contact Number','trim|required');
            // $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_rules('address','Contact Address','trim|required');
            // $this->form_validation->set_rules('customercategory_id', 'Category', 'trim|required');

            if($this->input->post('customercategory_id')=='-')
                $this->form_validation->set_rules('category_name', 'New Category', 'trim|required');

            if($this->form_validation->run() == true)
            {
                $file = array();

                if(!empty($_FILES['list_data']['name'])){
                    $upload = $this->uploadFile('list_data');
                    if($upload['status'] == 'success'){
                        $file = array(
                            'path' => $upload['path'],
                            'filename' => $upload['upload_data']['file_name'],
                        );
                    }
                }

                
                $date = date('Y-m-d H:i:s');
                $tlpn = explode(",", $this->input->post('telephone'));

                if($this->input->post('customercategory_id')=='-')
                {
                    $arr = array(
                        'name'      => $this->input->post('category_name'),
                    );
                    $customercategory_id = $this->customer_model->insertCustomercategory($arr);
                }
                else
                    $customercategory_id = $this->input->post('customercategory_id');

                /*$input = array(
                    'user_id'               => $this->session->userdata('id'),
                    'name'                  => $this->input->post('name'),
                    'pic'                   => $this->input->post('pic'),
                    'email'                 => $this->input->post('email'),
                    'address'               => $this->input->post('address'),
                    'customercategory_id'   => $customercategory_id,
                    'created_date'          => $date,
                    'nama_sales'            => $this->session->userdata('user_name'),
                    'segmen'                => $this->input->post('segmen'),
                    'area'                  => $this->input->post('area'),
                    'id_product'            => $this->input->post('service'),
                    'type_service'          => $this->input->post('type_service'),
                    'koordinat_lat'         => $this->input->post('latitude'),
                    'koordinat_long'        => $this->input->post('longitude'),
                    'terminasi'             => $this->input->post('ruang_terminasi'),
                    'mix'                   => $this->input->post('mix'),
                    'kapasitas'             => $this->input->post('kapasitas'),
                    'satuan'                => $this->input->post('satuan'),
                    'mix1'                  => $this->input->post('mix1'),
                    'kapasitas1'            => $this->input->post('kapasitas1'),
                    'satuan1'               => $this->input->post('satuan1'),
                    'interface'             => $this->input->post('interface'),
                    'media'                 => $this->input->post('media'),
                    'existing'              => $this->input->post('existing_provider'),
                    'budget'                => $this->input->post('budget'),
                    'notes'                 => $this->input->post('notes'),
                );*/

                /*if(!empty($file)){
                    $input['list_data_path'] = $file['path'];
                    $input['list_data_filename'] = $file['filename'];
                }*/

                $id = $this->input->post('customer_id');
                
                $input = array();

                $pId = $this->customer_model->savePresales($file);
                $input['id_customer_presales']  = $pId;

                // $id = $this->customer_model->insert($input);
                $this->customer_model->updateData('customer', $input, array('id' => $id));

                
                $input = array(
                    'customer_id'       => $id,
                    'workflow_id'       => 2,
                    'created_date'      => $date,
                );
                $this->stages_model->insert($input);

                /*for($i=0;$i<count($tlpn);$i++)
                {
                    $phone = array(
                        'customer_id'       => $id,
                        'number'            => $tlpn[$i],
                    );
                    $this->customer_model->insertTelephone($phone);
                }*/

                $this->session->set_userdata('status', 'success');
                $this->session->set_userdata('pesan', 'Save New Customer Successfully');

                redirect(base_url().'customer/view2/'.$id);
            }
            else
            {
                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('pesan', 'Your Input Data is Not Valid');
            }
        }

        $cmbCustomer = $this->customer_model->listCustomer();
        $customer_oracle = $this->customer_model->get_customer_oracle();

        if($cmbCustomer!=null && $customer_oracle!=null)
            $cst = array_merge($cmbCustomer, $customer_oracle);
        elseif($cmbCustomer!=null)
            $cst = $cmbCustomer;
        elseif($cmbCustomer!=null)
            $cst = $customer_oracle;

        $json1 = file_get_contents('http://morahrd.moratelindo.co.id/karyawan/index.php/employeeRestserver/dati2');
        $kab = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $json1), true );

        foreach ($kab as $key => $value) {
            $kab[$key]['name'] = str_replace("KOTA", "", $kab[$key]['name']);
            $kab[$key]['name'] = str_replace("KAB", "", $kab[$key]['name']);
            $kab[$key]['name'] = str_replace(".", "", $kab[$key]['name']);
            if(substr($kab[$key]['name'], 0, 1) == " "){
                $kab[$key]['name'] = substr($kab[$key]['name'], 1);
            }
        }

        $data = array(
                    'view'          => 'customer/create2',
                    'title'         => 'Customer',
                    'js'            => array('validation'=>'validation','select2'=>'select2','tagsinput'=>'tagsinput'),
                    'id'            => $id,
                    'css'           => array('select2'=>'select2'),
                    // 'cmbCustomer'   => $this->customer_model->listCustomer(),
                    'cmbCustomer'   => $cst,
                    'cmbCategory'   => $this->customer_model->listCategory(),
                    'segmen'        => $this->customer_model->listSegmen(),
                    'product'       => $this->customer_model->listProduct(),
                    'kab'           => $kab
        );
        
        $this->load->view('template', $data);
    }
    
    
    public function view($id)
    {
        $rec = $this->customer_model->view($id);
        $file = $this->customer_model->get_files($id);

        if($rec!=null)
        {
            $data = array(
                'view' => 'customer/view',
                'judul' => 'Customer',
                'js' => array(),
                'css' => array(),
                'rec' => $rec,
                'file' => $file
            );

            $this->load->view('template', $data);
        }
        else
            redirect('notfound');
    }


    public function view2($id)
    {
        /*$rec = $this->customer_model->view($id);
        $file = $this->customer_model->get_files($id);*/
        
        $rec = $this->customer_model->presalesGetData(array(
            'field' => array('a.*', 'b.PRODUCT_NAME'),
            'table' => 'CUSTOMER a',
            'condition' => array('ID_CUSTOMER' => $id),
            'join' => array(
                array(
                    'table' => 'PRODUCT b',
                    'condition' => 'a.ID_PRODUCT = b.ID_PRODUCT',
                    'type' => 'INNER'
                )
            )
        ));

        // var_dump($rec); exit();

        $presales = $this->customer_model->listpresalesinfo($id);
        $comment = $this->customer_model->listcoment($id);
        // var_dump($comment); exit();
        // var_dump($rec[0]->segmen_name); exit();


        if($rec!=null)
        {
            $data = array(
                'view' => 'customer/view2',
                'judul' => 'Customer',
                'js' => array(),
                'css' => array(),
                'rec' => $rec,
                'comment' => $comment,
                // 'file' => $file
            );

            $this->load->view('template', $data);
        }
        else
            redirect('notfound');
    }

    function comment()
    {
        $customer_id = $this->input->post('id_customer');
        $this->customer_model->savecomment();
        redirect(base_url() . 'customer/view2/' . $customer_id);
    }
    
    public function edit($id)
    {
        if($this->session->userdata('leveluser_id')!=3)
            redirect('notfound');
        
        $rec = $this->customer_model->view($id);

        if($rec!=null)
        {
            if ($_POST)
            {
                $this->form_validation->set_rules('name','Company Name','trim|required');
                $this->form_validation->set_rules('pic','Contact Person','trim|required');
                $this->form_validation->set_rules('telephone', 'Contact Number', 'trim|required');
                $this->form_validation->set_rules('email', 'Email', 'trim|required');
                $this->form_validation->set_rules('address', 'Company Address', 'trim|required');
                $this->form_validation->set_rules('customercategory_id', 'Category', 'trim|required');

                if($this->input->post('customercategory_id')=='-')
                    $this->form_validation->set_rules('category_name', 'New Category', 'trim|required');

                if ($this->form_validation->run() == true)
                {
                    $tlpn = explode(",", $this->input->post('telephone'));
                    
                    if($this->input->post('customercategory_id')=='-')
                    {
                        $arr = array(
                            'name'      => $this->input->post('category_name'),
                        );
                        $customercategory_id = $this->customer_model->insertCustomercategory($arr);
                    }
                    else
                        $customercategory_id = $this->input->post('customercategory_id');

                    $input = array(
                        'name'                  => $this->input->post('name'),
                        'pic'                   => $this->input->post('pic'),
                        'email'                 => $this->input->post('email'),
                        'address'               => $this->input->post('address'),
                        'customercategory_id'   => $customercategory_id,
                    );
                    $this->customer_model->update($input, $rec[0]->id);

                    // delete list telephone, and insert new input
                    $this->customer_model->deleteTelephone($rec[0]->id);
                    for($i=0;$i<count($tlpn);$i++)
                    {
                        $phone = array(
                            'customer_id'       => $rec[0]->id,
                            'number'            => $tlpn[$i],
                        );
                        $this->customer_model->insertTelephone($phone, $rec[0]->id);
                    }

                    $this->session->set_userdata('status', 'success');
                    $this->session->set_userdata('pesan', 'Update Customer Data Successfully');

                    redirect(base_url() . 'customer/view/' . $rec[0]->id);
                }
                else
                {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('pesan', 'Your Input Data is Not Valid');
                }
            }

            $data = array(
                'view'          => 'customer/edit',
                'judul'         => 'Customer',
                'js'            => array('validation'=>'validation','select2'=>'select2','tagsinput'=>'tagsinput'),
                'css'           => array('select2'=>'select2'),
                'rec'           => $rec,
                'cmbCategory'   => $this->customer_model->listCategory(),
            );

            $this->load->view('template', $data);
        }
        else
            redirect('notfound');
    }


    public function upload_po($id){
        if($_POST){
            if(empty($_FILES['PO']['name']) && empty($_FILES['KTP']['name']) && empty($_FILES['NPWP']['name']) ){
                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('pesan', 'No File Uploaded');
            } else {
                $success = 0;
                foreach ($_FILES as $name => $file) {
                    $upload = $this->uploadFile($name);
                    if($upload['status'] == 'success'){
                        $file = array(
                            'customer_id' => $id, 
                            'path' => $upload['path'],
                            'file' => $upload['upload_data']['file_name'],
                            'type' => $name,
                            'upload_date' => date('Y-m-d H:i:s'),
                            'upload_by' => $this->session->userdata('id'),
                        );

                        $up = $this->customer_model->updateFile($file, $id, $name);
                        if($up < 1){
                            $this->customer_model->insertFile($file);
                        }
                    }
                }

                $this->update_file_status($id);

                $this->session->set_userdata('status', 'success');
                $this->session->set_userdata('pesan', 'Update Customer File Successfully');

                redirect(base_url() . 'customer/view/' . $id);
            }  
        }

        $data = array(
            'view' => 'customer/upload_po',
            'title' => 'Customer',
            'js' => array('validation'=>'validation','select2'=>'select2','tagsinput'=>'tagsinput'),
            'css' => array('select2'=>'select2'),
            'customer_id' => $id  
        );
        
        $this->load->view('template', $data);
    }

    public function file(){
        if(!$this->input->post('id')) $res = array('status' => 400);

        $cust_id = $this->input->post('id');

        $cust_detail_file = $this->customer_model->customerFile($cust_id);

        if(!empty($cust_detail_file)){
            $res = array('status' => 200, 'data' => $cust_detail_file);
        } else {
            $res = array('status' => 400);
        }

        echo json_encode($res); exit();

    }

    public function uploadFile($input){
        // $config['upload_path'] = '/var/www/project.apps.moratelindo.co.id/public_html/assets/file/issue_risk/';
        $config['upload_path'] = 'assets/files/customer/';

        $config['allowed_types'] = 'jpeg|jpg|png|pdf|xls|xlsx|ppt|doc|docx';

        //not overwrite if same file name exist, add index instead.
        $config['overwrite'] = false;

        //max size file
        $config['max_size'] = 5*1024;

        //call upload lib
        $this->load->library('upload', $config);

        //do upload action
        if (!$this->upload->do_upload($input)){
            $returns = array('status' => 'failed', 'error' => $this->upload->display_errors());
        }else{
            $returns = array('status' => 'success', 'upload_data' => $this->upload->data(), 'path' => $config['upload_path']);
        }
        return $returns;
    }


    function update_file_status($id){
        $files = $this->customer_model->get_files($id);
        if(sizeof($files) == 3){
            $data = array(
                'file_status' => 1
            );
            $this->customer_model->update($data, $id);
        }
    }


    function get_po_number(){
        $json = file_get_contents('http://presales.apps.moratelindo.co.id/index.php/action/getPO');
        $obj = json_decode($json);
        return $obj;
    }

    function get_po_price(){
        $po_number = $this->input->post('number');
        $json = file_get_contents('http://presales.apps.moratelindo.co.id/index.php/action/po_price/'.$po_number);
        $obj = json_decode($json);
        $data = $obj->data[0];
        $class = "";

        if(!empty($data->PRICE)){
            if($data->PRICE < 500000000){
                $class = "Bronze";
            } elseif ($data->PRICE >= 500000000 && $data->PRICE < 1000000000) {
                $class = "Silver";
            } elseif ($data->PRICE >= 1000000000 && $data->PRICE < 2000000000){
                $class = "Gold";
            } elseif($data->PRICE >= 2000000000){
                $class = "Platinum";
            } else {
                $class = "VVIP";
            } 
        }

        if(!empty($class)){
            $data = array('status' => 200, 'data'=> $class);
        } else {
            $data = array('status' => 400);
        }

        echo json_encode($data); exit();
    }


    function srf(){
        

        $id = $_GET['id'];
        $customer = $this->customer_model->view_customer($id);

        // $sg = $this->customer_model->getService();
        $sg = $this->customer_model->getService2();
        $service_group = array_chunk($sg, ceil(count($sg)/2));

        $ss = $this->customer_model->getSubService2();
        $subservice = array_chunk($ss, 4);

        $additional_products = array();

        $po = $this->get_po_number();

        $srfNumber = $this->customer_model->srf_number();

        $bp = $this->customer_model->getBP();

        $line_business = $this->customer_model->getLineBusiness();


        if($_POST){
            $newSRF = $this->customer_model->saveSRF();
            redirect(base_url() . 'customer/srfView/' . $newSRF);
        }

        $data = array(
                'view'          => 'customer/srf',
                'title'         => 'Service Request Form',
                'js'            => array('select2'=>'select2',
                                'tagsinput'=>'tagsinput',
                                'wizard2'=>'wizard',
                                'parsley' => 'parsley',
                                'datepicker' => 'datepicker',
                                'datatables' => 'datatables'),
                'css'           => array('select2'=>'select2', 'datatables' => 'datatables'),
                'service_group' => $service_group,
                'subservice'    => $subservice,
                'type_service'  => $ss,
                'additional'    => $additional_products,
                'po'            => $po,
                'srf_number'    => $srfNumber,
                'bp'            => $bp,
                'line_business' => $line_business,
                'id'            => $id,
                'customer'      => $customer,
                'source'        => '',
                'customer_presales' => ''
        );

        if(isset($_GET['source'])){
            $data['source'] = $_GET['source'];
        }

        if(isset($_GET['customer_id'])){
            $data['customer_presales'] = $_GET['customer_presales'];
        }
        
        $this->load->view('template', $data);
    }

    function srfv2(){
        
        $id = 0;
        if(isset($_GET['id'])) $id = $_GET['id'];
        if(isset($_GET['source'])) {
            if($_GET['source'] == 'presales'){

                 $user = $this->customer_model->presalesGetData(array(
                    'table' => 'USER', 
                    'condition' => array('EMAIL' => $this->session->userdata('email')),
                    'return' => 'array'
                ));

                $rrq = $this->customer_model->getDataB(array(
                    'table_name' => 'srf',
                    'condition' => array('presales_customer_id' => $_GET['customer_id'])
                ));

                if(!empty($rrq) && $user['ROLE_ID'] == 1){
                    redirect(base_url() . 'customer/srf_edit/' . $rrq->id);
                }
            }
        }
        $customer = $this->customer_model->view_customer($id);

        $sg = $this->customer_model->getService();
        $sg = $this->customer_model->getService2();
        $service_group = array_chunk($sg, ceil(count($sg)/2));

        $ss = $this->customer_model->getSubService2();
        $subservice = array_chunk($ss, 4);

        $employee_id = $this->customer_model->get_employee_id($this->session->userdata('id'));

        $json1 = file_get_contents('http://morahrd.moratelindo.co.id/karyawan/index.php/employeeRestserver/employee/id/'.$employee_id->employee_uid );
        $user = json_decode($json1);

        $product_classification = $this->customer_model->get_data('service_group_new', '','bulk');

        $additional_products = array();

        $po = $this->get_po_number();

        $srfNumber = $this->customer_model->srf_number();

        $bp = $this->customer_model->getBP();

        $line_business = $this->customer_model->getLineBusiness();

        $json1 = file_get_contents('http://morahrd.moratelindo.co.id/karyawan/index.php/employeeRestserver/dati2');
        $kab = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $json1), true );

        // http://presales.apps.moratelindo.co.id/index.php/action/item_code
        $ffff = file_get_contents('http://presales.apps.moratelindo.co.id/index.php/action/item_code');
        $item_code = json_decode($ffff);

        // var_dump($item_code->data); exit();
        // foreach ($item_code->data as $key => $value) {
        //     var_dump($value); exit();
        // }


        if($_POST){
            $newSRF = $this->customer_model->saveSRF2();
            redirect(base_url() . 'customer/view_srf/' . $newSRF);
        }

        $data = array(
                'view'          => 'customer/srf_new',
                'title'         => 'Service Request Form',
                'js'            => array('select2'=>'select2',
                                'tagsinput'=>'tagsinput',
                                'wizard2'=>'wizard',
                                'parsley' => 'parsley',
                                'datepicker' => 'datepicker',
                                'datatables' => 'datatables'),
                'css'           => array('select2'=>'select2', 'datatables' => 'datatables'),
                'service_group' => $product_classification,
                'subservice'    => $subservice,
                'type_service'  => $ss,
                'additional'    => $additional_products,
                'po'            => $po,
                'srf_number'    => $srfNumber,
                'bp'            => $bp,
                'line_business' => $line_business,
                'id'            => $id,
                'customer'      => $customer,
                'source'        => '',
                'user'          => $user,
                'province'      => $kab,
                'customer_presales' => ''
                // 'item_code'     => $item_code->data
        );

        if(isset($_GET['source'])){
            $data['source'] = $_GET['source'];
        }

        if(isset($_GET['customer_id'])){
            $data['customer_presales'] = $_GET['customer_id'];
        }
        
        $this->load->view('template', $data);
    }

    function srf_edit($srf_id){

       
        if($_POST){
            $updated = $this->customer_model->updateSRF();
            redirect(base_url() . 'customer/view_srf/' . $updated);
        } else {
            $id = 0;
            if(isset($_GET['id'])) $id = $_GET['id'];
            $customer = $this->customer_model->view_customer($id);

            $srf = $this->customer_model->getSRF($srf_id);

            $market_segment = $this->customer_model->getDataB(array(
                'table_name' => 'market_segment',
                'type' => 'bulk'
            ));

            $class_detail = $this->customer_model->get_data('customer_classification', array('customer_classification' => $srf->customer_classification));

            $customer_type = $srf->customer_type;

            $qry = array(
                'column' => array('a.*','b.*', 'a.id as mservice_id', 'd.*', 'c.*'),
                'table_name' => 'srf_multiple_service a',
                'condition' => array('a.srf_id' => $srf_id),
                'join' => array(
                    array(
                        'table_name' => 'service_group_new b',
                        'condition' => 'a.service_group_id = b.id',
                        'type' => 'inner'
                    ),

                    array(
                        'table_name' => 'service_definition_new c',
                        'condition' => 'a.service_id = c.id',
                        'type' => 'inner'
                    ),

                    array(
                        'table_name' => 'srf_installation d',
                        'condition' => 'a.address_id = d.id',
                        'type' => 'left'
                    ),
                ),
                'type' => 'bulk'
            );


            $service_req = $this->customer_model->getDataB($qry);

            // var_dump($service_req); exit();

            /*if($customer_type == 'Corporate'){
                $customer = $this->customer_model->getCorporateSRF($id);
            } else {
                $customer = $this->customer_model->getPersonalSRF($id);
            }

            if($customer_type == 'Corporate'){
                $customer = $this->customer_model->getCorporateSRF($id);
            } else {
                $customer = $this->customer_model->getPersonalSRF($id);
            }*/
            $customer['personal'] = $this->customer_model->getPersonalSRF($srf_id);
            $customer['corporate'] = $this->customer_model->getCorporateSRF($srf_id);

            // var_dump($customer); exit();

            // $sg = $this->customer_model->getService();
            $sg = $this->customer_model->getService2();
            $service_group = array_chunk($sg, ceil(count($sg)/2));

            $ss = $this->customer_model->getSubService2();
            $subservice = array_chunk($ss, 4);

            $employee_id = $this->customer_model->get_employee_id($this->session->userdata('id'));

            $json1 = file_get_contents('http://morahrd.moratelindo.co.id/karyawan/index.php/employeeRestserver/employee/id/'.$employee_id->employee_uid );
            $user = json_decode($json1);

            $product_classification = $this->customer_model->get_data('service_group_new', '','bulk');

            $additional_products = array();

            $po = $this->get_po_number();

            $srfNumber = $this->customer_model->srf_number();

            $bp = $this->customer_model->getBP();

            $line_business = $this->customer_model->getLineBusiness();

            $json1 = file_get_contents('http://morahrd.moratelindo.co.id/karyawan/index.php/employeeRestserver/dati2');
            $kab = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $json1), true );

            // http://presales.apps.moratelindo.co.id/index.php/action/item_code
            $ffff = file_get_contents('http://presales.apps.moratelindo.co.id/index.php/action/item_code');
            $item_code = json_decode($ffff);

            // var_dump($item_code->data); exit();
            // foreach ($item_code->data as $key => $value) {
            //     var_dump($value); exit();
            // }


        }

        $data = array(
                'view'          => 'customer/srf_edit',
                'title'         => 'Service Request Form',
                'js'            => array('select2'=>'select2',
                                'tagsinput'=>'tagsinput',
                                'wizard2'=>'wizard',
                                'parsley' => 'parsley',
                                'datepicker' => 'datepicker',
                                'datatables' => 'datatables'),
                'css'           => array('select2'=>'select2', 'datatables' => 'datatables'),
                'service_group' => $product_classification,
                'subservice'    => $subservice,
                'type_service'  => $ss,
                'additional'    => $additional_products,
                'po'            => $po,
                'srf_number'    => $srfNumber,
                'bp'            => $bp,
                'line_business' => $line_business,
                'id'            => $id,
                'customer'      => $customer,
                'source'        => '',
                'user'          => $user,
                'province'      => $kab,
                'customer_presales' => '',
                'srf'           => $srf,
                'market_segment' => $market_segment,
                'class_detail'  => $class_detail,
                'customer'      => $customer,
                'services'      => $service_req,
                'real_srf_id'   => $srf_id
                /*'customer'      => $customer,
                'user'          => $user,
                'class_detail'  => $class_detail,
                'installation'  => $installation_detail,
                'services'      => $service_req*/
                // 'item_code'     => $item_code->data
        );

        // var_dump($srf); exit();

        if(isset($_GET['source'])){
            $data['source'] = $_GET['source'];
        }

        if(isset($_GET['customer_id'])){
            $data['customer_presales'] = $_GET['customer_id'];
        }
        
        $this->load->view('template', $data);
    }


    function srfv2_no_session(){
        
        $id = 0;
        if(isset($_GET['id'])) $id = $_GET['id'];
        $customer = $this->customer_model->view_customer($id);

        $sg = $this->customer_model->getService();
        $sg = $this->customer_model->getService2();
        $service_group = array_chunk($sg, ceil(count($sg)/2));

        $ss = $this->customer_model->getSubService2();
        $subservice = array_chunk($ss, 4);

        $employee_id = $this->customer_model->get_employee_id($this->session->userdata('id'));

        $json1 = file_get_contents('http://morahrd.moratelindo.co.id/karyawan/index.php/employeeRestserver/employee/id/'.$employee_id->employee_uid );
        $user = json_decode($json1);

        $product_classification = $this->customer_model->get_data('service_group_new', '','bulk');

        $additional_products = array();

        $po = $this->get_po_number();

        $srfNumber = $this->customer_model->srf_number();

        $bp = $this->customer_model->getBP();

        $line_business = $this->customer_model->getLineBusiness();

        $json1 = file_get_contents('http://morahrd.moratelindo.co.id/karyawan/index.php/employeeRestserver/dati2');
        $kab = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $json1), true );

        // http://presales.apps.moratelindo.co.id/index.php/action/item_code
        $ffff = file_get_contents('http://presales.apps.moratelindo.co.id/index.php/action/item_code');
        $item_code = json_decode($ffff);

        // var_dump($item_code->data); exit();
        // foreach ($item_code->data as $key => $value) {
        //     var_dump($value); exit();
        // }


        if($_POST){
            $newSRF = $this->customer_model->saveSRF2();
            redirect(base_url() . 'customer/srfv2view/' . $newSRF);
        }

        $data = array(
                'view'          => 'customer/srf_v2',
                'title'         => 'Service Request Form',
                'js'            => array('select2'=>'select2',
                                'tagsinput'=>'tagsinput',
                                'wizard2'=>'wizard',
                                'parsley' => 'parsley',
                                'datepicker' => 'datepicker',
                                'datatables' => 'datatables'),
                'css'           => array('select2'=>'select2', 'datatables' => 'datatables'),
                'service_group' => $product_classification,
                'subservice'    => $subservice,
                'type_service'  => $ss,
                'additional'    => $additional_products,
                'po'            => $po,
                'srf_number'    => $srfNumber,
                'bp'            => $bp,
                'line_business' => $line_business,
                'id'            => $id,
                'customer'      => $customer,
                'source'        => '',
                'user'          => $user,
                'province'      => $kab,
                'customer_presales' => ''
                // 'item_code'     => $item_code->data
        );

        if(isset($_GET['source'])){
            $data['source'] = $_GET['source'];
        }

        if(isset($_GET['customer_id'])){
            $data['customer_presales'] = $_GET['customer_id'];
        }
        
        $this->load->view('template', $data);
    }

    public function bp_list(){
        $where = array();
        $limit = 10;
        $search = $this->input->post('search');
        $page = $this->input->post('page');

        $param['start'] = ($page * $limit) - $limit;
        $param['limit'] = $limit;

        if($search != '') {
            $param['key'] = strtolower($search);
        } 
        $data = $this->customer_model->get_bp($param);
        $total = $this->customer_model->total_bp();
        $_models = array();
        if(!empty($data)){
            foreach ($data as $key => $value) {
                $_models[] = array(
                    'id' => $value->PR_NUMBER,
                    'text' => $value->PR_NUMBER ." - " . $value->SUGGESTED_VENDOR_NAME
                );
            }
        }

        $response['results'] = $_models;
        $response['total_count'] = $total;

        echo json_encode($response);
        exit;
    }


    function subservice(){
        $input = $this->input->post();
        $grouping = array();
        foreach ($input['subservice'] as $key => $value) {
            if(isset($value['id'])){
                $value['group_name'] = $this->customer_model->getService2($value['group'])[0]->group_name;
                $subserv = $this->customer_model->subserviceId2($value['id']);
                $value['subservice_name'] = $subserv->subservice_name;
                // $value['uom'] = $subserv->uom;
                if(isset($grouping[$value['group']])){
                    $grouping[$value['group']][] = $value;
                } else {
                    $grouping[$value['group']][] = $value;
                }  
            }
        }

        $grouping = array_chunk($grouping, ceil(count($grouping)/2));
        echo json_encode($grouping); exit();
    }


    function srfView($id){
        $this->srfv2view($id);
        /*$srf = $this->customer_model->getSRF($id);

        // var_dump($srf); exit();

        $customer_type = $srf->customer_type;

        if($customer_type == 'Corporate'){
            $customer = $this->customer_model->getCorporateSRF($id);
        } else {
            $customer = $this->customer_model->getPersonalSRF($id);
        }

        $srf_service_group = $this->customer_model->srf_service_group($id);

        $installation_detail = $this->customer_model->srf_installation_info($id);

        $service_detail = $this->customer_model->srf_service_detail($id);
        
        $data = array(
            'view'          => 'customer/srf_view',
            'title'         => 'Service Request Form',
            'srf'           => $srf,
            'customer'      => $customer,
            'service_group' => $srf_service_group,
            'installation'  => $installation_detail,
            'service'       => $service_detail,
        );

        $this->load->view('template', $data);*/
    }

    function srfv2view($id){
        // var_dump($this->session->userdata()); exit();
        $srf = $this->customer_model->getSRF($id);

        $customer_type = $srf->customer_type;

        if($customer_type == 'Corporate'){
            $customer = $this->customer_model->getCorporateSRF($id);
        } else {
            $customer = $this->customer_model->getPersonalSRF($id);
        }

        $srf->approver_id = $this->getSrfApprover($srf->user_id);

        // var_dump($customer_type); exit();

        $installation_detail = $this->customer_model->srf_installation_info($id);

        $employee_id = $this->customer_model->get_employee_id($srf->user_id);

        $json1 = file_get_contents('http://morahrd.moratelindo.co.id/karyawan/index.php/employeeRestserver/employee/id/'.$employee_id->employee_uid );
        $user = json_decode($json1);

        $class_detail = $this->customer_model->get_data('customer_classification', array('customer_classification' => $srf->customer_classification));

        $qry = array(
            'table_name' => 'srf_multiple_service a',
            'condition' => array('a.srf_id' => $id),
            'join' => array(
                array(
                    'table_name' => 'service_group_new b',
                    'condition' => 'a.service_group_id = b.id',
                    'type' => 'inner'
                ),

                array(
                    'table_name' => 'service_definition_new c',
                    'condition' => 'a.service_id = c.id',
                    'type' => 'inner'
                ),

                array(
                    'table_name' => 'srf_installation d',
                    'condition' => 'a.address_id = d.id',
                    'type' => 'left'
                ),
            ),
            'type' => 'bulk'
        );


        $service_req = $this->customer_model->getDataB($qry);

        $data = array(
            'view'          => 'customer/srf_viewv2',
            'title'         => 'Service Request Form',
            'js'            => array('select2' => 'select2'),
            'css'           => array('select2' => 'select2'),
            'srf'           => $srf,
            'customer'      => $customer,
            'user'          => $user,
            'class_detail'  => $class_detail,
            'installation'  => $installation_detail,
            'services'      => $service_req
        );

        $this->load->view('template', $data);
    }


    function view_srf($id){
        // var_dump($this->session->userdata()); exit();
        $srf = $this->customer_model->getSRF($id);

        $customer_type = $srf->customer_type;

        if($customer_type == 'Corporate'){
            $customer = $this->customer_model->getCorporateSRF($id);
        } else {
            $customer = $this->customer_model->getPersonalSRF($id);
        }

        $srf->approver_id = $this->getSrfApprover($srf->user_id);

        // var_dump($customer_type); exit();

        $installation_detail = $this->customer_model->srf_installation_info($id);

        $employee_id = $this->customer_model->get_employee_id($srf->user_id);

        $json1 = file_get_contents('http://morahrd.moratelindo.co.id/karyawan/index.php/employeeRestserver/employee/id/'.$employee_id->employee_uid );
        $user = json_decode($json1);

        $class_detail = $this->customer_model->get_data('customer_classification', array('customer_classification' => $srf->customer_classification));

        $qry = array(
            'table_name' => 'srf_multiple_service a',
            'condition' => array('a.srf_id' => $id),
            'join' => array(
                array(
                    'table_name' => 'service_group_new b',
                    'condition' => 'a.service_group_id = b.id',
                    'type' => 'inner'
                ),

                array(
                    'table_name' => 'service_definition_new c',
                    'condition' => 'a.service_id = c.id',
                    'type' => 'inner'
                ),

                array(
                    'table_name' => 'srf_installation d',
                    'condition' => 'a.address_id = d.id',
                    'type' => 'left'
                ),
            ),
            'type' => 'bulk'
        );


        $service_req = $this->customer_model->getDataB($qry);

        $data = array(
            'view'          => 'customer/srfv_view_new',
            'title'         => 'Service Request Form',
            // 'js'            => array('select2' => 'select2'),
            // 'css'           => array('select2' => 'select2'),
            'srf'           => $srf,
            'customer'      => $customer,
            'user'          => $user,
            'class_detail'  => $class_detail,
            'installation'  => $installation_detail,
            'services'      => $service_req
        );

        $this->load->view('template', $data);
    }

    public function req_boq_list()
    {
        $rec = $this->customer_model->boq_req_list();

        $data = array(
                    'view'          => 'customer/boq_request_list',
                    'js'            => array('datatables'=>'datatables', 'select2' => 'select2'),
                    'css'           => array('datatables'=>'datatables', 'select2' => 'select2'),
                    'title'         => 'List Request BOQ',
                    'rec'           => $rec,
        );
        
        $this->load->view('template', $data);
    }

    public function orc_detail(){
        $party_id = $this->input->post('party_id');
        $detail = $this->customer_model->customer_oracle_detail($party_id);
        if(!empty($detail)){
            $data = array('status' => 200, 'data'=> $detail);
        } else {
            $data = array('status' => 400);
        }

        echo json_encode($data); exit();
    }

    public function list_srf()
    {
        $rec = $this->customer_model->getListSrf();

        foreach($rec as $k => $row){
            if(empty($row->customer_name) && empty($row->presales_customer_id)){
                $dtl = $this->customer_model->customer_oracle_detail($row->customer_id);
                $rec[$k]->customer_name = $dtl->PARTY_NAME;
            }
        }

        $data = array(
                    'view'          => 'customer/srf_list',
                    'js'            => array('datatables'=>'datatables'),
                    'css'           => array('datatables'=>'datatables'),
                    'title'         => 'SRF List',
                    'rec'           => $rec,
        );
        
        $this->load->view('template', $data);
    }

    public function getSrfApprover($userId){
        $a = $this->customer_model->getDataB(array(
            'column' => array('supervisor_id', 'leader_id'),
            'table_name' => 'user',
            'condition' => array('id' => $userId)
        ));

        if(!empty($a->supervisor_id)){
            $b = $this->customer_model->getDataB(array(
                'column' => array('supervisor_id', 'leader_id'),
                'table_name' => 'user',
                'condition' => array('id' => $a->supervisor_id)
            ));

            $approver_id = $b->leader_id;

        } else {
            $approver_id = $a->leader_id;            
        }

        return $approver_id;

    }

    public function list_fat()
    {
        $data = array(
                    'view'          => 'customer/fat_list',
                    'js'            => array('datatables'=>'datatables'),
                    'css'           => array('datatables'=>'datatables'),
                    'title'         => 'FAT List',
        );
        
        $this->load->view('template', $data);
    }


    public function map_fat()
    {
        $data = array(
                    'view'          => 'customer/fat_map',
                    // 'js'            => array('datatables'=>'datatables'),
                    // 'css'           => array('datatables'=>'datatables'),
                    'title'         => 'FAT',
        );
        
        $this->load->view('template', $data);
    }

    public function classification(){
        $cust_class = $this->input->post('cust_class');
        $detail = $this->customer_model->getClassDetail($cust_class);
        if(!empty($detail)){
            $data = array('status' => 200, 'data'=> $detail);
        } else {
            $data = array('status' => 400);
        }

        echo json_encode($data); exit();
    }

    public function product_name(){
        $sg = $this->input->post('service_group_id');
        $service = $this->customer_model->get_data(
            'service_definition_new',
            array('group_id' => $sg),
            'bulk'
        );

        if(empty($service)){
            $data = array('status' => 400);
        } else {
            $data = array('status' => 200, 'data' => $service);
        }

        echo json_encode($data); exit();
    }

    public function product_class(){
        $product_class = $this->customer_model->get_data(
            'service_group_new','',
            'bulk'
        );

        if(empty($product_class)){
            $data = array('status' => 400);
        } else {
            $data = array('status' => 200, 'data' => $product_class);
        }

        echo json_encode($data); exit();
    }


    public function datatable_fat(){
        if(empty($_GET['sSearch'])){
            $key_word = 'all';
        } else {
            $key_word = str_replace(" ", "_", $_GET['sSearch']);
        }

        $url = 'http://presales.apps.moratelindo.co.id/index.php/action/xxyy/'.$key_word.'/1';

        $json = file_get_contents('http://presales.apps.moratelindo.co.id/index.php/action/xxyy/'.$key_word.'/'.$_GET['iDisplayStart']);

        $yy = json_decode($json);
        $dt = $yy->data;

        $data = array();
        $no = $_GET['iDisplayStart'];
        foreach ($dt as $mta) {
            $no++;
            $row = array();
            $row['no'] = $no;

            foreach ($mta as $key => $value) {
                if (empty($value)){
                    $value = "";
                }
                $row[$key] = $value;

            }
            $data[] = $row;
        }

        if($yy->count > 999) $yy->count = 999;

        $output = array(
                "sEcho"                 => $_GET['sEcho'],
                "iTotalRecords"         => '999',
                "iTotalDisplayRecords"  => $yy->count,
                "aaData"                => $data,
        );
        echo json_encode($output); exit;
    }

    public function datatable_item_code(){
        if(empty($_GET['sSearch'])){
            $key_word = 'all';
        } else {
            $key_word = str_replace(" ", "_", $_GET['sSearch']);
        }

        $url = 'http://presales.apps.moratelindo.co.id/index.php/action/item_code_/'.$key_word.'/1';

        $json = file_get_contents('http://presales.apps.moratelindo.co.id/index.php/action/item_code_/'.$key_word.'/'.$_GET['iDisplayStart']);

        $yy = json_decode($json);
        $dt = $yy->data;

        $data = array();
        $no = $_GET['iDisplayStart'];
        foreach ($dt as $mta) {
            $no++;
            $row = array();
            $row['no'] = $no;

            foreach ($mta as $key => $value) {
                if (empty($value)){
                    $value = "";
                }
                $row[$key] = $value;

            }
            $data[] = $row;
        }

        if($yy->count > 999) $yy->count = 999;

        $output = array(
                "sEcho"                 => $_GET['sEcho'],
                "iTotalRecords"         => '999',
                "iTotalDisplayRecords"  => $yy->count,
                "aaData"                => $data,
        );
        echo json_encode($output); exit;
    }

    public function datatable_customer(){
       /* if(empty($_GET['sSearch'])){
            $key_word = 'all';
        } else {
            $key_word = str_replace(" ", "_", $_GET['sSearch']);
        }

        $url = 'http://presales.apps.moratelindo.co.id/index.php/action/xxyy/'.$key_word.'/1';

        $json = file_get_contents('http://presales.apps.moratelindo.co.id/index.php/action/xxyy/'.$key_word.'/'.$_GET['iDisplayStart']);*/
        $user = $this->customer_model->presalesGetData(array(
            'table' => 'USER', 
            'condition' => array('EMAIL' => $this->session->userdata('email')),
            'return' => 'array'
        ));

        $list = $this->customer_model->get_datatables1(); 

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $customers) {
            $no++;
            $row = array();
            $row['no'] = $no;
            foreach ($customers as $key => $value) {
                $row[$key] = $value;
                if($key == "BUDGET"){
                    $row['BUDGET'] =  number_format($row['BUDGET'],0,'','.');
                }
            }
            $row["SESSION"] = $user['ROLE_ID'];
            $data[] = $row;
        }

        $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->customer_model->count_all(),
                "recordsFiltered" => $this->customer_model->count_filtered(),
                "data" => $data,
        );
        echo json_encode($output); exit;
    }



    public function bounds(){
        $i = $this->input->post();
        // var_dump($this->input->post()); exit();

        $url = 'http://presales.apps.moratelindo.co.id/index.php/action/boundaries?minlat='.$i['minlat'].'&maxlat='.$i['maxlat'].'&minlong='.$i['minlong'].'&maxlong='.$i['maxlong'];
        // var_dump($url);

        $json = file_get_contents($url);

        $e = json_decode($json, true);

        echo json_encode($e); exit;
    }

    public function cluster_search($key){

        $url = "http://presales.apps.moratelindo.co.id/index.php/action/xxyz/".$key;

        $json = file_get_contents($url);

        $e = json_decode($json, true);

        echo json_encode($e); exit;
    }

    public function kecamatan($datiId){
        $url = 'http://morahrd.moratelindo.co.id/karyawan/index.php/employeeRestserver/kecamatan?id='.$datiId;

        $json1 = file_get_contents($url);
        $kab = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $json1), true );

        $data = array('status' => 200, 'data' => $kab);

        echo json_encode($data); exit();
    }

    public function kelurahan($kecId){
        $url = 'http://morahrd.moratelindo.co.id/karyawan/index.php/employeeRestserver/kelurahan?id='.$kecId;

        $json1 = file_get_contents($url);
        $kab = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $json1), true );

        $data = array('status' => 200, 'data' => $kab);

        echo json_encode($data); exit();
    }

    public function itemCodeAjax(){
        $where = array();
        $limit = 10;
        $search = $this->input->post('search');
        // var_dump($search); exit();
        $page = $this->input->post('page');

        $param['start'] = ($page * $limit) - $limit;
        $param['limit'] = $limit;

        /*if($search != '') {
            $param['key'] = strtolower($search);
        }*/

        if(isset($search)){
            $param['key'] = strtolower($search);
        }



        $data = $this->customer->get_cust($param);
        $total = $this->customer->total_cust();
        $_models = array();
        if(!empty($data)){
            foreach ($data as $key => $value) {
                $_models[] = array(
                    'id' => $value->ID_CUSTOMER,
                    'text' => $value->NAME_CUSTOMER
                );
            }
        }

        $response['results'] = $_models;
        $response['total_count'] = $total;

        echo json_encode($response);
        exit;
    }

    public function preview(){
        $user_id = $this->session->userdata('id');
        $employee_id = $this->customer_model->get_employee_id($user_id);

        $json1 = file_get_contents('http://morahrd.moratelindo.co.id/karyawan/index.php/employeeRestserver/employee/id/'.$employee_id->employee_uid );
        $user = json_decode($json1);

        $isi_form = $this->input->post(); 

        $service = $this->input->post('mservice');
        $installation = $this->input->post('installation');

        $mapping = array();

        foreach ($service as $key => $value) {
            // var_dump($value); exit();
            $qry1 = $this->customer_model->getDataB(array('column' => array('group_name'), 'table_name' => 'service_group_new', 'condition' => array('id' => $value['product_classification'])));
            $value['classification_name'] = $qry1->group_name;
            $qry2 = $this->customer_model->getDataB(array('column' => array('subservice_name'), 'table_name' => 'service_definition_new', 'condition' => array('id' => $value['product_name'])));
            $value['product'] = $qry2->subservice_name;
            if(isset($installation[$key])){
                $mapping[$key]['installation'] = $installation[$key];
                $mapping[$key]['service'][]  = $value;
            } else {
                $max_i = count($mapping)-1;
                $mapping[$max_i]['service'][] = $value;
            }
        }

        $isi_form['user'] = $user;
        $isi_form['mapping'] = $mapping;

        echo json_encode($isi_form); exit();
    }

    public function cityAjax(){
        $json1 = file_get_contents('http://morahrd.moratelindo.co.id/karyawan/index.php/employeeRestserver/dati2');
        $kab = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $json1), true );

        echo json_encode($kab); exit();
    }

    public function srf_approval(){

        // var_dump($this->input->post()); exit();

        $approver = $this->customer_model->get_employee_id($this->session->userdata('id'));

        $data = array(
            'approval_date' => date('Y-m-d H:i:s'),
            'approved_by' => $this->session->userdata('id'),
            'approved_by_name' => $approver->name,
            'status' => $this->input->post('action_type'),
            'approval_notes' => $this->input->post('approval_notes')
        );

        if($this->customer_model->updateData('srf', $data, array('id' => $this->input->post('srf_id')))){
            $data = array('status' => 200);
        } else {
            $data = array('status' => 400);
        }


        echo json_encode($data); exit();

    }


    public function customer_presales(){
        $id = $this->input->post('customer_id');

        $json = file_get_contents('http://presales.apps.moratelindo.co.id/index.php/api/customer_detail/'.$id);
        $obj = json_decode($json);

        echo json_encode($obj);
        exit();
        /*var_dump($obj); 
        exit();*/
    }

    public function product_subclass(){
        $sg = $this->input->post('service_group_id');
        $service = $this->customer_model->get_data(
            'subservice_definition',
            array('group_id' => $sg),
            'bulk'
        );

        if(empty($service)){
            $data = array('status' => 400);
        } else {
            $data = array('status' => 200, 'data' => $service);
        }

        echo json_encode($data); exit();
    }

    public function customer_detail($customer){

        $r = $this->customer_model->get_data('customer', array('id' => $customer));

        if(!empty($r->id_customer_presales)){
            $presales = $this->customer_model->presalesGetData(array('table' => 'CUSTOMER', 'condition' => array('ID_CUSTOMER' => $r->id_customer_presales)));    
            $r->presales = $presales;

            $data = array('status' => 200, 'data' => $r);

        } else {
            $data = array('status' => 400);
        }

        echo json_encode($data); exit;

    }
}
