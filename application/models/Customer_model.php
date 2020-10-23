<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH . '/models/Main_model.php';
    
class Customer_model extends Main_model
{
    var $po;
    var $bp; 
    var $presales; 

    public function __construct()
    {
        parent::__construct();

        $this->load->database('default');
        // $this->po = $this->load->database('po',TRUE);
        $this->bp = $this->load->database('bp', TRUE);
        $this->presales = $this->load->database('presales', TRUE);
    }
    
    function getList()
    {
        $telephone = "(select GROUP_CONCAT(DISTINCT concat(' ',number)) from telephone where customer_id=c.id) as number, file_status, s.id as srf_id";

        $this->db->from('customer as c');

        if($this->session->userdata('leveluser_id')==3)
        {
            $this->db->join('telephone as t', 'c.id=t.customer_id', 'left');
            $this->db->join('srf as s', 'c.id = s.fcustomer_id', 'left');
            $this->db->where('c.user_id', $this->session->userdata('id'));
            $this->db->select('c.id, c.name as customer_name, pic, '.$telephone.', c.email'); //, w.name as pipeline_name
        }
        elseif($this->session->userdata('leveluser_id')==2)
        {
            // $this->db->join('telephone as t', 'c.id=t.customer_id', 'left');
            $this->db->join('user as u', 'c.user_id=u.id', 'left');
            $this->db->join('employee as e', 'u.employee_id=e.id', 'left');
            $this->db->join('srf as s', 'c.id = s.fcustomer_id', 'left');
            $this->db->where('u.active', true);
            $this->db->where('supervisor_id', $this->session->userdata('employee_id'));
            $this->db->select('c.id, c.name as customer_name, pic, '.$telephone.', c.email, e.name as account_name'); //w.name as pipeline_name, 
        }
        elseif($this->session->userdata('leveluser_id')==4)
        {
            // $this->db->join('telephone as t', 'c.id=t.customer_id', 'left');
            $this->db->join('user as u', 'c.user_id=u.id', 'left');
            $this->db->join('employee as e', 'u.employee_id=e.id', 'left');
            $this->db->join('employee as v', 'u.supervisor_id=v.id', 'left');
            $this->db->join('srf as s', 'c.id = s.fcustomer_id', 'left');
            $this->db->where('u.active', true);
            $this->db->where('u.supervisor_id in (select ee.id from employee ee left join user uu on ee.id=uu.employee_id where leveluser_id=2 and leader_id='.$this->session->userdata('employee_id').')');
            $this->db->select('c.id, c.name as customer_name, pic, '.$telephone.', c.email, e.name as account_name, v.name as supervisor_name'); //w.name as pipeline_name, 
        }
        elseif($this->session->userdata('leveluser_id')==5)
        {
            // $this->db->join('telephone as t', 'c.id=t.customer_id', 'left');
            $this->db->join('user as u', 'c.user_id=u.id', 'left');
            $this->db->join('employee as e', 'u.employee_id=e.id', 'left');
            $this->db->join('employee as v', 'u.supervisor_id=v.id', 'left');
            $this->db->join('srf as s', 'c.id = s.fcustomer_id', 'left');
            $this->db->where('u.active', true);
            $this->db->where('supervisor_id in (select ee.id from employee ee left join user uu on ee.id=uu.employee_id where leveluser_id=2 
                                and leader_id in (select employee.id from employee left join user on employee.id=user.employee_id where leveluser_id=4 and leader_id='.$this->session->userdata('employee_id').' ) ) ');
            $this->db->select('c.id, c.name as customer_name, pic, '.$telephone.', c.email, e.name as account_name, v.name as supervisor_name'); //w.name as pipeline_name, 
        }
        elseif($this->session->userdata('leveluser_id')==1)
        {
            // $this->db->join('telephone as t', 'c.id=t.customer_id', 'left');
            $this->db->join('user as u', 'c.user_id=u.id', 'left');
            $this->db->join('employee as e', 'u.employee_id=e.id', 'left');
            $this->db->join('employee as v', 'u.supervisor_id=v.id', 'left');
            $this->db->join('srf as s', 'c.id = s.fcustomer_id', 'left');
            $this->db->where('u.active', true);
            $this->db->select('c.id, c.name as customer_name, pic, '.$telephone.', c.email, e.name as account_name, v.name as supervisor_name'); //w.name as pipeline_name, 
        }
        
        $this->db->order_by('c.id');
        $rec = $this->db->get();
        
        if ($rec->num_rows() > 0)
            return $rec->result();
        else
            return null;
    }
    
    function listCustomer()
    {
        $this->db->select('id,name');
        $this->db->from('customer');
        $this->db->order_by('name');
        $rec = $this->db->get();
        
        if ($rec->num_rows() > 0)
            return $rec->result();
        else
            return null;
    }

    function listCategory()
    {
        $this->db->select('*');
        $this->db->from('customercategory');
        $this->db->order_by('id');
        $rec = $this->db->get();
        
        if ($rec->num_rows() > 0)
            return $rec->result();
        else
            return null;
    }

    function listSegmen()
    {
        $this->db->select('*');
        $this->db->from('segmentation');
        $this->db->order_by('id');
        $rec = $this->db->get();
        
        if ($rec->num_rows() > 0)
            return $rec->result();
        else
            return null;
    }
    
    function insertCustomercategory($rec)
    {
        $this->db->insert('customercategory', $rec);
        return $this->db->insert_id();
    }

    function insert($rec)
    {
        $this->db->insert('customer', $rec);
        return $this->db->insert_id();
    }

    function insertTelephone($rec)
    {
        $this->db->insert('telephone', $rec);
    }

    function insertFile($rec){
        $this->db->insert('customer_file', $rec);
    }
    
    function view($id)
    {
        $this->db->from('customer as c');
        $this->db->join('customercategory as cc', 'c.customercategory_id=cc.id', 'left');
        $this->db->join('segmentation s', 'c.segmen = s.id', 'left');
        $this->db->join('product p', 'c.id_product = p.ID_PRODUCT', 'left');
        
        if($this->session->userdata('leveluser_id')==3)
        {
            $this->db->join('telephone as t', 'c.id=t.customer_id', 'left');
            $this->db->where('user_id', $this->session->userdata('id'));
            $this->db->select('c.*, c.name as customer_name, pic, t.number, c.email, address, customercategory_id, cc.name as category_name, created_date, s.name as segmen_name, p.product_name as service, p.product_name');
        }
        elseif($this->session->userdata('leveluser_id')==2)
        {
            $this->db->join('telephone as t', 'c.id=t.customer_id', 'left');
            $this->db->join('user as u', 'c.user_id=u.id', 'left');
            $this->db->join('employee as e', 'u.employee_id=e.id', 'left');
            $this->db->where('u.active', true);
            $this->db->where('supervisor_id', $this->session->userdata('employee_id'));
            $this->db->select('c.id, c.name as customer_name, pic, t.number, c.email, address, customercategory_id, cc.name as category_name, created_date, e.name as account_name, s.name as segmen_name');
        }
        elseif($this->session->userdata('leveluser_id')==1)
        {
            $this->db->join('telephone as t', 'c.id=t.customer_id', 'left');
            $this->db->join('user as u', 'c.user_id=u.id', 'left');
            $this->db->join('employee as e', 'u.employee_id=e.id', 'left');
            $this->db->join('employee as v', 'u.supervisor_id=v.id', 'left');
            $this->db->where('u.active', true);
            // $this->db->select('c.id, c.name as customer_name, pic, t.number, c.email, address, customercategory_id, cc.name as category_name, created_date, e.name as account_name, v.name as supervisor_name');
            $this->db->select('c.*, c.name as customer_name, t.number, c.email, address, customercategory_id, cc.name as category_name, created_date, e.name as account_name, v.name as supervisor_name, s.name as segmen_name, p.product_name');
        }
        elseif($this->session->userdata('leveluser_id')==4)
        {
            $this->db->join('telephone as t', 'c.id=t.customer_id', 'left');
            $this->db->join('user as u', 'c.user_id=u.id', 'left');
            $this->db->join('employee as e', 'u.employee_id=e.id', 'left');
            $this->db->join('employee as v', 'u.supervisor_id=v.id', 'left');
            $this->db->where('u.active', true);
            $this->db->select('c.id, c.name as customer_name, pic, t.number, c.email, address, customercategory_id, cc.name as category_name, created_date, e.name as account_name, v.name as supervisor_name');
        }
        elseif($this->session->userdata('leveluser_id')==5)
        {
            $this->db->join('telephone as t', 'c.id=t.customer_id', 'left');
            $this->db->join('user as u', 'c.user_id=u.id', 'left');
            $this->db->join('employee as e', 'u.employee_id=e.id', 'left');
            $this->db->join('employee as v', 'u.supervisor_id=v.id', 'left');
            $this->db->where('u.active', true);
            $this->db->select('c.id, c.name as customer_name, pic, t.number, c.email, address, customercategory_id, cc.name as category_name, created_date, e.name as account_name, v.name as supervisor_name');
        }
        
        $this->db->where('c.id', $id);
        $rec = $this->db->get();
        
        if ($rec->num_rows() > 0)
            return $rec->result();
        else
            return null;
    }
    
    function update($update, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('customer', $update);
    }

    function updateFile($update, $id, $type)
    {
        $this->db->where('customer_id', $id);
        $this->db->where('type', $type);
        $this->db->update('customer_file', $update);

        return $this->db->affected_rows();
    }

    function deleteTelephone($customer_id)
    {
        $this->db->where('customer_id', $customer_id);
        $this->db->delete('telephone');
    }

    function view_customer($customerId){
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->where('id', $customerId);
        $query = $this->db->get();

        return $query->row();
    }

    function customerFile($id){
        $this->db->select('id, name');
        $this->db->from('customer');
        $this->db->where('id', $id);
        $qry = $this->db->get();
        $cust = $qry->row();
        $cust->file = $this->get_files($id);

        return $cust;
    }

    function get_files($id){
        $this->db->select('*');
        $this->db->from('customer_file');
        $this->db->where('customer_id', $id);
        $query = $this->db->get();

        $r = $query->result();
        $files = array();
        foreach ($r as $k => $v) {
            $files[$v->type] = $v; 
        }

        return $files;
    }

    function getService($id = ""){
        $this->db->select('*');
        $this->db->from('service_group');
        if(!empty($id)){
            $this->db->where('id', $id);
        }
        $query = $this->db->get();

        return $query->result();
    }

    function subserviceId($id){
        $this->db->select('*');
        $this->db->from('service_definition');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    function getSubService($id = ""){
        $this->db->select('a.*, b.group_name');
        $this->db->from('service_definition a');
        $this->db->join('service_group b', 'a.group_id = b.id');

        $data = $this->db->get()->result();

        $r = array();

        foreach ($data as $key => $value) {
            $r[$value->group_name][] = (array)$value;
        }

        return $r;

    }

    function getService2($id = ""){
        $this->db->select('*');
        $this->db->from('service_group_new');
        if(!empty($id)){
            $this->db->where('id', $id);
        }
        $query = $this->db->get();

        return $query->result();
    }

    function subserviceId2($id){
        $this->db->select('*');
        $this->db->from('service_definition_new');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    function getSubService2($id = ""){
        $this->db->select('a.*, b.group_name');
        $this->db->from('service_definition_new a');
        $this->db->join('service_group_new b', 'a.group_id = b.id');

        $data = $this->db->get()->result();

        $r = array();

        foreach ($data as $key => $value) {
            $r[$value->group_name][] = (array)$value;
        }

        return $r;

    }

    function getLineBusiness(){
        $this->db->select('*');
        $this->db->from('master_business_line');
        $query = $this->db->get();
        return $query->result();
    }

    function getLastSRF($table_name){
        $data = $this->db->query("select MAX(srf_identifier) as lastID from srf WHERE MONTH(created_date) = date_format(NOW(),'%m') AND YEAR(created_date) = date_format(NOW(),'%Y')");
        return $data->row();
    }


    function srf_number(){
        $ls = $this->getLastSRF('srf');

        if(empty($ls->lastID)){
            $last_srf = 1;
        } else {
            $last_srf = $ls->lastID+1;
        }

        if(strlen($last_srf)==1){
            $id='0000'.$last_srf;
        }else if(strlen($last_srf)==2){
            $id='000'.$last_srf;
        }else if(strlen($last_srf)==3){
            $id='00'.$last_srf;
        }else if(strlen($last_srf)==4){
            $id='0'.$last_srf;
        }

        $srf_number = $id."/SRF/".date('m').'/'.date('Y');

        return $srf_number;
    }


    function getBP(){
        $this->bp->select('*'); 
        $this->bp->from('vw_bp_approved');
        $query = $this->bp->get();

        return $query->result();
    }

    function get_bp($param){
        $this->bp->select('BP_NO, TITLE');
        $this->bp->from('vw_bp_approved');
        // $this->bp->where('flag', 1);
        if(isset($param['key'])){
            // $f = 'pr_number LIKE %'.$param['key'].'%';
            // $this->bp->where('pr_number', $param['key']);
            $this->bp->or_where("BP_NO LIKE '%".$param['key']."%'");
            $this->bp->or_where("TITLE LIKE '%".$param['key']."%'");
        }
        $this->bp->limit($param['limit'], $param['start']);
        $query = $this->bp->get();

        return $query->result();
    }

    function total_bp(){
        $this->bp->select('count(ID) as total');
        $this->bp->from('vw_bp_approved');

        $qry =  $this->bp->get();
        $r = $qry->row();

        // var_dump($r);

        return $r->TOTAL;
    }

    function get_employee_id($user_id){
        $this->db->select('*');
        $this->db->from('user a');
        $this->db->join('employee b', 'a.employee_id = b.id');
        $this->db->where('a.id', $user_id);

        $qry = $this->db->get();

        return $qry->row();
    }

    function saveSRF(){
        $personal = $this->input->post('personal');

        $company = $this->input->post('company');

        $service_group = $this->input->post('service_group');

        $installation = $this->input->post('installation');

        $subservice = $this->input->post('subservice');

        $srf_no = $this->srf_number();
        $ls = $this->getLastSRF('srf');
        $ls = $ls->lastID+1;


        $srf = array(
            'input_date'                => date('Y-m-d'),
            'srf_number'                => $srf_no,
            'srf_identifier'            => $ls,
            'po_number'                 => $this->input->post('po_number'),
            'bp_number'                 => $this->input->post('bp_number'), //bpnumber juga masih kosong
            'customer_id'               => $this->input->post('customer_id'),
            'fcustomer_id'              => $this->input->post('fcustomer_id'),
            'user_id'                   => $this->session->userdata('id'),
            'customer_classification'   => $this->input->post('customer_classification'),
            'customer_status'           => $this->input->post('customer_status'),
            'customer_type'             => $this->input->post('customer_type'),
            'number_of_node'            => $this->input->post('number_of_node'),
            'scale'                     => $this->input->post('scale'),
            'coverage_status'           => $this->input->post('coverage_status'),
            'type_of_order'             => $this->input->post('order_type'),
            'service_purpose'           => $this->input->post('service_purpose'),
            'temporary_service'         => $this->input->post('temporary_service'),
            'service_status'            => $this->input->post('service_status'),
            'service_owner'             => $this->input->post('service_owner'),
            'protocol'                  => $this->input->post('protocol_technology'),
            'connection_method'         => $this->input->post('connection_method'),
            'media'                     => $this->input->post('media_delivery'),
            'media_detail'              => $this->input->post('media_delivery_fo'),
            'interface'                 => $this->input->post('interface_connection'),
            'rfs_date'                  => date('Y-m-d', strtotime($this->input->post('rfs_date'))),
            'end_temp_service'          => $this->input->post('end_temp_service'),
            'notes'                     => $this->input->post('notes'),
            //remark belum masuk
            'created_date'              => date('Y-m-d H:i:s')
        );

        $this->db->insert('srf', $srf);
        $srf_id = $this->db->insert_id();


        if($this->input->post('customer_type') == 'Personal'){
            $cust_personal = array(
                'srf_id'            => $srf_id,
                'customer_id'       => $this->input->post('fcustomer_id'),
                'birthday'          => date('Y-m-d', strtotime($personal['birthday'])),
                'address'           => $personal['address'],
                'gender'            => $personal['gender'],
                'nationality'       => $personal['nationality'],
                'address'           => $personal['address'],
                'subdistrict'       => $personal['subdistrict'],
                'district'          => $personal['district'],
                'city'              => $personal['city'],
                'state'             => $personal['state'],
                'zip_code'          => $personal['zip_code'],
                'personal_id'       => $personal['personid'],
                'npwp'              => $personal['npwp'],
                'phone'             => $personal['phone'],
                'mobile'            => $personal['mobile'],
                'profession'        => $personal['profession'],
                'building_type'     => $personal['bulding'],
                'number_of_floor'   => $personal['number_floor'],
                'created_date'      => date('Y-m-d H:i:s')
            );
            $this->db->insert('srf_personal_detail', $cust_personal);
        } else {
            $cust_company = array(
                'srf_id'            => $srf_id,
                'customer_id'                   => $this->input->post('fcustomer_id'),
                'organization_level'            => $company['organization_level'],
                'building_name'                 => $company['building_name'],
                'address'                       => $company['address'],
                'subdistrict'                   => $company['subdistrict'],
                'district'                      => $company['district'],
                'city'                          => $company['city'],
                'state'                         => $company['state'],
                'subdistrict'                   => $company['subdistrict'],
                'district'                      => $company['district'],
                'city'                          => $company['city'],
                'state'                         => $company['state'],
                'zip_code'                      => $company['zip_code'],
                'npwp'                          => $company['npwp'],
                'siup'                          => $company['siup'],
                'category'                      => $company['category'],
                'company_phone'                        => $company['phones'],
                'fax'                           => $company['fax'],
                'web'                           => $company['web'],
                'commercial_pic_name'           => $company['commercial_name'],
                'commercial_pic_email'          => $company['commercial_email'],
                'commercial_pic_job'            => $company['commercial_job'],
                'commercial_pic_company_phone'  => $company['commercial_phone'],
                'commercial_pic_ext'            => $company['commercial_ext'],
                'commercial_pic_hp'             => $company['commercial_hp'],
                'technical_pic_name'            => $company['technical_name'],
                'technical_pic_email'           => $company['technical_email'],
                'technical_pic_job'             => $company['technical_job'],
                'technical_pic_company_phone'   => $company['technical_phone'],
                'technical_pic_ext'             => $company['technical_ext'],
                'technical_pic_hp'              => $company['technical_hp'],
                'created_date'                  => date('Y-m-d')
            );

            $this->db->insert('srf_corporate_detail', $cust_company);

        }

        $installation = array(
            'srf_id'            => $srf_id,
            'interconnection_point'  => $installation['interconnection_point'],
            'ne_site_id'             => $installation['ne_site_id'],
            'ne_address'             => $installation['ne_address'],
            'ne_subdistrict'         => $installation['ne_subdistrict'],
            'ne_district'            => $installation['ne_district'],
            'ne_city'                => $installation['ne_city'],
            'ne_state'               => $installation['ne_state'],
            'ne_zip_code'            => $installation['ne_zip_code'],
            'ne_latitude'            => $installation['ne_latitude'],
            'ne_longitude'           => $installation['ne_longitude'],
            'ne_by'                  => $installation['ne_by'],
            'fe_building_name'       => $installation['fe_building_name'],
            'fe_floor'               => $installation['fe_floor'],
            'fe_address'             => $installation['fe_address'],
            'fe_subdistrict'         => $installation['fe_subdistrict'],
            'fe_district'            => $installation['fe_district'],
            'fe_city'                => $installation['fe_city'],
            'fe_state'               => $installation['fe_state'],
            'fe_zip_code'            => $installation['fe_zip_code'],
            'fe_latitude'            => $installation['fe_latitude'],
            'fe_longitude'           => $installation['fe_longitude'],
            'fe_by'                  => $installation['fe_by'],
            'olt_coordinate'         => $installation['olt_booked']
        );

        $this->db->insert('srf_installation', $installation);


        foreach ($service_group as $value) {
            $sg = array(
                'srf_id' => $srf_id,
                'service_group_id' => $value
            );

            $this->db->insert('srf_group_service', $sg);
        }
    
        foreach ($subservice as $key => $value) {
            if(isset($value['id'])){
                $sg = array(
                    'srf_id' => $srf_id,
                    'group_id' => $value['group'],
                    'service_id' => $value['id'],
                    'capacity' => $value['kapasitas'],
                    'uom'      => $value['uom']
                );

                $this->db->insert('srf_service', $sg);

            }

        }

        return $srf_id;

    }

    function saveSRF2(){
        $personal = $this->input->post('personal');

        $company = $this->input->post('company');

        $service_group = $this->input->post('service_group');

        $installation = $this->input->post('installation');

        // var_dump($installation); exit;

        $subservice = $this->input->post('subservice');

        if($this->input->post('customer_type') == 'Personal'){
            $correspondence = $this->input->post('p_correspondence');

            $billing = $this->input->post('p_billing');
        } else {
            $correspondence = $this->input->post('c_correspondence');

            $billing = $this->input->post('c_billing');
        }

        $srf_no = $this->srf_number();
        $ls = $this->getLastSRF('srf');
        $ls = $ls->lastID+1;

        $business_line = $this->input->post('business_line');

        if($business_line == 'OTHERS…'){
          $business_line = $this->input->post('business_line2');
        }


        $srf = array(
            'input_date'                     => date('Y-m-d'),
            'srf_number'                     => $srf_no,
            'srf_identifier'                 => $ls,
            'po_number'                      => $this->input->post('po_number'),
            'bp_number'                      => $this->input->post('bp_number'), //bpnumber juga masih kosong
            'customer_id'                    => $this->input->post('customer_id'),
            'fcustomer_id'                   => $this->input->post('fcustomer_id'),
            'presales_customer_id'           => $this->input->post('customer_presales_id'),
            'user_id'                        => $this->session->userdata('id'),
            'customer_classification'        => $this->input->post('customer_classification'),
            'customer_status'                => $this->input->post('customer_status'),
            'customer_type'                  => $this->input->post('customer_type'),
            'market_segment'                 => $this->input->post('market_segment'),
            'business_line'                  => $business_line,
            'number_of_node'                 => $this->input->post('number_of_node'),
            'scale'                          => $this->input->post('scale'),
            'coverage_status'                => $this->input->post('coverage_status'),
            'type_of_order'                  => $this->input->post('order_type'),
            'service_purpose'                => $this->input->post('service_purpose'),
            'temporary_service'              => $this->input->post('temporary_service'),
            'service_status'                 => $this->input->post('service_status'),
            'service_owner'                  => $this->input->post('service_owner'),
            'protocol'                       => $this->input->post('protocol_technology'),
            'connection_method'              => $this->input->post('connection_method'),
            'media'                          => $this->input->post('media_delivery'),
            'media_detail'                   => $this->input->post('media_delivery_fo'),
            'interface'                      => $this->input->post('interface_connection'),
            'rfs_date'                       => date('Y-m-d', strtotime($this->input->post('rfs_date'))),
            'end_temp_service'               => $this->input->post('end_temp_service'),
            'correspondence_building_name'   => $correspondence['building_name'],
            'correspondence_floor_block'     => $correspondence['floor'],
            'correspondence_address'         => $correspondence['address'],
           /* 'correspondence_subdistrict'     => $correspondence['subdistrict'],
            'correspondence_district'        => $correspondence['district'],
            'correspondence_city'            => $correspondence['city'],
            'correspondence_state'           => $correspondence['state'],
            'correspondence_zip_code'        => $correspondence['zip_code'],*/
            'billing_building_name'          => $billing['building_name'],
            'billing_floor_block'            => $billing['floor'],
            'billing_address'                => $billing['address'],
            /*'billing_subdistrict'            => $billing['subdistrict'],
            'billing_district'               => $billing['district'],
            'billing_city'                   => $billing['city'],
            'billing_state'                  => $billing['state'],
            'billing_zip_code'               => $billing['zip_code'],*/
            'notes'                          => $this->input->post('notes'),
            'created_date'                   => date('Y-m-d H:i:s'),
            'status'                         => 'Submitted'
        );

        $this->db->insert('srf', $srf);
        $srf_id = $this->db->insert_id();


        if($this->input->post('customer_type') == 'Personal'){
            $cust_personal = array(
                'srf_id'            => $srf_id,
                'customer_id'       => $this->input->post('fcustomer_id'),
                'name'              => $personal['name'],
                'birthday'          => date('Y-m-d', strtotime($personal['birthday'])),
                'address'           => $personal['address'],
                'gender'            => $personal['gender'],
                'nationality'       => $personal['nationality'],
                'npwp'              => $personal['npwp'],
                'phone'             => $personal['phone'],
                'mobile'            => $personal['mobile'],
                'personal_id'       => $personal['personid'],
                /*'address'           => $personal['address'],
                'subdistrict'       => $personal['subdistrict'],
                'district'          => $personal['district'],
                'city'              => $personal['city'],
                'state'             => $personal['state'],
                'zip_code'          => $personal['zip_code'],
                'personal_id'       => $personal['personid'],
                
                'phone'             => $personal['phone'],
                'mobile'            => $personal['mobile'],
                'profession'        => $personal['profession'],
                'building_type'     => $personal['bulding'],
                'number_of_floor'   => $personal['number_floor'],*/
                'created_date'      => date('Y-m-d H:i:s')
            );
            $this->db->insert('srf_personal_detail', $cust_personal);
        } else {
            $cust_company = array(
                'srf_id'                        => $srf_id,
                'customer_id'                   => $this->input->post('fcustomer_id'),
                'name'                          => $company['name'],
                'organization_level'            => $company['organization_level'],
                /*'building_name'                 => $company['building_name'],
                'address'                       => $company['address'],
                'subdistrict'                   => $company['subdistrict'],
                'district'                      => $company['district'],
                'city'                          => $company['city'],
                'state'                         => $company['state'],
                'subdistrict'                   => $company['subdistrict'],
                'district'                      => $company['district'],
                'city'                          => $company['city'],
                'state'                         => $company['state'],
                'zip_code'                      => $company['zip_code'],*/
                'npwp'                          => $company['npwp'],
                'siup'                          => $company['siup'],
                // 'category'                      => $company['category'],
                // 'company_phone'                 => $company['phones'],
                // 'fax'                           => $company['fax'],
                // 'web'                           => $company['web'],
                'director_name'                 => $company['director_name'],
                'director_email'                => $company['director_email'],
                // 'director_job'                  => $company['director_job'],
                'director_company_phone'        => $company['director_phone'],
                'director_ext'                  => $company['director_ext'],
                'director_hp'                   => $company['director_hp'],
                'commercial_pic_name'           => $company['commercial_name'],
                'commercial_pic_email'          => $company['commercial_email'],
                'commercial_pic_job'            => $company['commercial_job'],
                'commercial_pic_company_phone'  => $company['commercial_phone'],
                'commercial_pic_ext'            => $company['commercial_ext'],
                'commercial_pic_hp'             => $company['commercial_hp'],
                'technical_pic_name'            => $company['technical_name'],
                'technical_pic_email'           => $company['technical_email'],
                'technical_pic_job'             => $company['technical_job'],
                'technical_pic_company_phone'   => $company['technical_phone'],
                'technical_pic_ext'             => $company['technical_ext'],
                'technical_pic_hp'              => $company['technical_hp'],
                'created_date'                  => date('Y-m-d')
            );

            $this->db->insert('srf_corporate_detail', $cust_company);

        }

        $insts = array();

        foreach ($installation as $key => $value) {
             $inst = array(
                'srf_id'                 => $srf_id,
                'interconnection_point'  => $value['interconnection_point'],
                'address'                => $value['interconnection_address'],
                'rack_id'                => $value['rack_id'],
                'ne_site_id'             => $value['ne_site_id'],
                'ne_floor'               => $value['ne_floor'],
                'ne_address'             => $value['ne_address'],
                /*'ne_subdistrict'         => $value['ne_subdistrict'],
                'ne_district'            => $value['ne_district'],
                'ne_city'                => $value['ne_city'],
                'ne_state'               => $value['ne_state'],
                'ne_zip_code'            => $value['ne_zip_code'],*/
                'ne_latitude'            => $value['ne_latitude'],
                'ne_longitude'           => $value['ne_longitude'],
                // 'ne_by'                  => $value['ne_by'],
                'fe_building_name'       => $value['fe_building_name'],
                'fe_floor'               => $value['fe_floor'],
                'fe_address'             => $value['fe_address'],
                /*'fe_subdistrict'         => $value['fe_subdistrict'],
                'fe_district'            => $value['fe_district'],
                'fe_city'                => $value['fe_city'],
                'fe_state'               => $value['fe_state'],
                'fe_zip_code'            => $value['fe_zip_code'],*/
                'fe_latitude'            => $value['fe_latitude'],
                'fe_longitude'           => $value['fe_longitude'],
                // 'fe_by'                  => $value['fe_by'],
                'olt_coordinate'         => $value['olt_booked']
            );

            $this->db->insert('srf_installation', $inst);
            $insts[] = $this->db->insert_id();
        }

       


        /*foreach ($service_group as $value) {
            $sg = array(
                'srf_id' => $srf_id,
                'service_group_id' => $value
            );

            $this->db->insert('srf_group_service', $sg);
        }
    
        foreach ($subservice as $key => $value) {
            if(isset($value['id'])){
                $sg = array(
                    'srf_id' => $srf_id,
                    'group_id' => $value['group'],
                    'service_id' => $value['id'],
                    'capacity' => $value['kapasitas'],
                    'uom'      => $value['uom']
                );

                $this->db->insert('srf_service', $sg);

            }

        }*/

        $multiple_service = $this->input->post('mservice');

        foreach ($multiple_service as $i => $service) {
            /*if(sizeof($installation) == 1){
                $address_id = $insts[0];
            } elseif (sizeof($installation) > 1) {
                if(isset($insts[$i])){
                    $address_id = $insts[$i];
                } else {
                    $address_id = 0;
                }
            }

            if( $service['protocol_technology'] == 'OTHERS…'){
                $service['protocol_technology'] = $service['protocol_technology2'];
            }
            if($service['cpe_equipment'] == 'OTHERS…'){
                $service['cpe_equipment'] = $service['cpe_equipment2'];
            }
            if($service['equipment_protection'] == 'OTHERS…'){
                $service['equipment_protection'] = $service['equipment_protection2'];
            }
            if($service['security_protection'] == 'OTHERS…'){
                $service['security_protection'] = $service['security_protection2'];
            }
            if($service['other_protection'] == 'OTHERS…'){
                $service['other_protection'] = $service['other_protection2'];
            }
            if($service['monitoring_tools'] == 'OTHERS…'){
                $service['monitoring_tools'] = $service['monitoring_tools2'];
            }*/ 
            $aservice = array(
                'srf_id' => $srf_id,
                'service_group_id' => $service['product_classification'],
                'product_subclassification' => $service['product_subclassification'],
                'service_id' => $service['product_name'],
                'capacity' => $service['capacity'],
                'uom' => $service['uom'],
                'type_of_order' => $service['type_order'],
                'billing_type' => $service['billing_type'],
                'type_service' => $service['type_service'],
                'service_purpose' => $service['service_purpose'],
                'service_status' => $service['service_status'],
                'service_owner' => $service['service_owner'],
                'sla' => $service['product_sla'],
                'sla_restitution' => $service['sla_restitution'],
                'rfs_date' => date('Y-m-d', strtotime(str_replace("/", "-", $value['rfs_date']))),
                'end_temp_service' => date('Y-m-d', strtotime(str_replace("/", "-", $value['rfs_date']))),
                'duration_contract' => $service['duration_contract'].' '. $service['contract_uom'],
               /* 'service_layer' => $service['service_layer'],
                'media' => $service['media'],
                'interface_connection' => $service['interface'],
                'connection_method' => $service['connection_method'],
                'item_code' => $service['item_code'],
                'item_code_desc' => $service['item_code_desc'],
                'protocol_technology' => $service['protocol_technology'],
                'cpe_equipment' => $service['cpe_equipment'],
                'backbone_protection' => $service['backbone_protection'],
                'access_protection' => $service['access_protection'],
                'lastmile_protection' => $service['lastmile_protection'],
                'equipment_protection' => $service['equipment_protection'],
                'security_protection' => $service['security_protection'],
                'other_protection' => $service['other_protection'],
                'monitoring_tools' => $service['monitoring_tools'],
                'service_managed_by' => $service['service_managed'],
                'billing_by' => $service['billing_by'],
                'lastmile_by' => $service['lastmile_by'],
                'cpe_by' => $service['cpe_by'],*/
                'address_id' => $address_id

            );

            $this->db->insert('srf_multiple_service', $aservice);
        }

        return $srf_id;

    }


    function updateSRF(){
        // var_dump($this->input->post()); exit();
        $srf_id = $this->input->post('srf_id');

        $multiple_service = $this->input->post('mservice');

        foreach ($multiple_service as $i => $service) {
            /*if(sizeof($installation) == 1){
                $address_id = $insts[0];
            } elseif (sizeof($installation) > 1) {
                if(isset($insts[$i])){
                    $address_id = $insts[$i];
                } else {
                    $address_id = 0;
                }
            }*/

            if( $service['protocol_technology'] == 'OTHERS…'){
                $service['protocol_technology'] = $service['protocol_technology2'];
            }
            if($service['cpe_equipment'] == 'OTHERS…'){
                $service['cpe_equipment'] = $service['cpe_equipment2'];
            }
            if($service['equipment_protection'] == 'OTHERS…'){
                $service['equipment_protection'] = $service['equipment_protection2'];
            }
            if($service['security_protection'] == 'OTHERS…'){
                $service['security_protection'] = $service['security_protection2'];
            }
            if($service['other_protection'] == 'OTHERS…'){
                $service['other_protection'] = $service['other_protection2'];
            }
            if($service['monitoring_tools'] == 'OTHERS…'){
                $service['monitoring_tools'] = $service['monitoring_tools2'];
            } 
            $aservice = array(
                'service_layer' => $service['service_layer'],
                'media' => $service['media'],
                'interface_connection' => $service['interface'],
                'connection_method' => $service['connection_method'],
                'item_code' => $service['item_code'],
                'item_code_desc' => $service['item_code_desc'],
                'protocol_technology' => $service['protocol_technology'],
                'cpe_equipment' => $service['cpe_equipment'],
                'backbone_protection' => $service['backbone_protection'],
                'access_protection' => $service['access_protection'],
                'lastmile_protection' => $service['lastmile_protection'],
                'equipment_protection' => $service['equipment_protection'],
                'security_protection' => $service['security_protection'],
                'other_protection' => $service['other_protection'],
                'monitoring_tools' => $service['monitoring_tools'],
                'service_managed_by' => $service['service_managed'],
                'billing_by' => $service['billing_by'],
                'lastmile_by' => $service['lastmile_by'],
                'cpe_by' => $service['cpe_by'],
            );
            $this->db->where('id', $service['service_id']);
            $this->db->update('srf_multiple_service', $aservice);
        }

        return $srf_id;
    }

    public function getSRF($srfId){
        $this->db->select('a.*, b.*, c.*, d.name as customer_name, a.id as srf_id');
        $this->db->from('srf a');
        $this->db->join('user b', 'a.user_id = b.id');
        $this->db->join('employee c', 'b.employee_id = c.id');
        $this->db->join('customer d', 'a.fcustomer_id = d.id', 'left');
        $this->db->where('a.id', $srfId);
        $query = $this->db->get();

        return $query->row();
    }

    public function getPersonalSRF($srfId){
        $this->db->select('*');
        $this->db->from('srf_personal_detail');
        $this->db->where('srf_id', $srfId);
        $query = $this->db->get();

        return $query->row();
    }

    public function getCorporateSRF($srfId){
        $this->db->select('*');
        $this->db->from('srf_corporate_detail');
        $this->db->where('srf_id', $srfId);
        $query = $this->db->get();

        return $query->row();
    }

    public function srf_service_group($srfId){
        $this->db->select('a.*, b.group_name');
        $this->db->from('srf_group_service a');
        $this->db->join('service_group b', 'a.service_group_id = b.id');
        $this->db->where('srf_id', $srfId);
        $query = $this->db->get();
        return $query->result();
    }

    public function srf_installation_info($srfId){
        $this->db->select('*');
        $this->db->from('srf_installation a');
        $this->db->where('srf_id', $srfId);
        $query = $this->db->get();
        return $query->row();
    }

    public function srf_service_detail($srfId){
        $this->db->select('*');
        $this->db->from('srf_service a');
        $this->db->join('service_definition_new b', 'a.service_id = b.id');
        $this->db->join('service_group_new c', 'a.group_id = c.id');
        $this->db->where('srf_id', $srfId);
        $query = $this->db->get();
        $res = $query->result();

        $grouping = array();

        foreach ($res as $key => $value) {
            if(isset($grouping[$value->group_name])){
                $grouping[$value->group_name][] = $value;
            } else {
                $grouping[$value->group_name][] = $value;
            } 
        }
        
        $grouping = array_chunk($grouping, ceil(count($grouping)/2));

        return $grouping;
    }

    public function listProduct(){
        $this->db->select('*');
        $this->db->from('product');
        $query = $this->db->get();
        return $query->result();
    }

    public function savePresales($file){

        $presalesId = $this->getSalesID($this->session->userdata('email'));
        $segmen = $this->getSegmen($this->input->post('segmen'));

        $invalid = array("`","´", "„", "`", "#", "*", "&", "´", "“", "”", "´", "&acirc;€™", "{", "~", "’", "'", "°");
        $uang = array(".","_");

        $budget = addslashes(str_replace($uang, "", $this->input->post("budget")));
        $name = addslashes($this->input->post("name"));
        $latitude = addslashes($this->input->post("latitude"));
        $longitude = addslashes($this->input->post("longitude"));
        $koordinatB = addslashes($this->input->post("koordinatB"));
        $note = addslashes($this->input->post("notes"));
        $address = addslashes($this->input->post("address"));
        $instalasiB = addslashes($this->input->post("instalasiB"));
        $terminasi2 = $this->input->post('terminasiB');
        if(empty($terminasi2)) $terminasi2 = " ";

        $data = array(
            'NAME_CUSTOMER'     => $name,
            'ID_PRODUCT'        => $this->input->post('service'),
            'TYPE_SERVICE'      => $this->input->post('type_service'),
            'ALAMAT_INSTALASI1' => $address,
            'ALAMAT_INSTALASI2' => $instalasiB,
            'KOORDINAT1'        => $latitude,
            'KOORDINATLOT1'     => $longitude,
            'KOORDINAT2'        => $koordinatB,
            'TERMINASI1'        => $this->input->post('ruang_terminasi'),
            'TERMINASI2'        => $terminasi2,
            'KAPASITAS'         => $this->input->post('kapasitas'),
            'MIX'               => $this->input->post('mix'),
            'SATUAN'            => $this->input->post('satuan'),
            'KAPASITAS1'        => $this->input->post('kapasitas1'),
            'MIX1'              => $this->input->post('mix1'),
            'SATUAN1'           => $this->input->post('satuan1'),
            'INTERFACE'         => $this->input->post('interface'),
            'MEDIA'             => $this->input->post('media'),
            'PIC'               => $this->input->post('pic'),
            'EXISTING'          => $this->input->post('existing_provider'),
            'BUDGET'            => $this->input->post('budget'),
            'ID_SALES'          => $presalesId->USER_ID,
            'NAME_SALES'        => $this->session->userdata('user_name'),
            'SEGMEN'            => $segmen->presales_name,
            'AREA'              => $this->input->post('area'),
            'STATUS'            => '1',
            'PROGRESS'          => '1',
            'NOTE'              => $note,
            'TGL_INPUT'         => date('Y-m-d')
        );

        // var_dump($data); exit();

        if(!empty($file)){
            $data['PATH_UPLOAD_FILE'] = base_url().$file['path'];
            $data['FILENAME'] = $file['filename'];
        }

        $this->presales->insert('CUSTOMER', $data);
        $pcId = $this->presales->insert_id();

        return $pcId;
    }


    public function getSalesID($email){
        $this->presales->select('*');
        $this->presales->from('USER');
        $this->presales->where('EMAIL', $email);
        $r = $this->presales->get();

        return $r->row();
    }

    public function getSegmen($id){
        $this->db->select('*');
        $this->db->from('segmentation');
        $this->db->where('id', $id);
        $r = $this->db->get();

        return $r->row();
    }

    public function cekSRFORacle($party_id){
        $this->db->select('*');
        $this->db->from('srf');
        $this->db->where('customer_id', $party_id);
        $qry = $this->db->get();

        return $qry->row();
    }

    function get_customer_oracle(){
        $json = file_get_contents('http://presales.apps.moratelindo.co.id/index.php/action/customer_oracle');
        $obj = json_decode($json);
        
        $sm = array();


        foreach ($obj as $k => $v) {
            $obj[$k]->id = $v->PARTY_ID;
            $obj[$k]->customer_name = $v->PARTY_NAME;
            $obj[$k]->pic = null;
            $obj[$k]->number = null;
            $obj[$k]->file_status = 1;
            $obj[$k]->srf_id = null;
            $obj[$k]->email = null;
            $obj[$k]->account_name = null;
            $obj[$k]->supervisor_name = null;
            $obj[$k]->name = $v->PARTY_NAME;

            $srf = $this->cekSRFORacle($v->PARTY_ID);

            if(!empty($srf)){
                $obj[$k]->srf_id = $srf->id;
            }
        }


        return $obj;
    }

    function customer_oracle_detail($i){
        $json = file_get_contents('http://presales.apps.moratelindo.co.id/index.php/action/customer_oracle_detail/'.$i);
        $obj = json_decode($json);
        return $obj[0];
    }


    function team($user_id){
        $r = array();
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('leader_id', $user_id);
        $qry = $this->db->get();
        $qry = $qry->result();

        foreach ($qry as $key => $value) {
            $r[] = $value->id;
        }

        return $r;

    }


    function getListSrf(){
        if($this->session->userdata('leveluser_id')==4)
        {
            $team = $this->team($this->session->userdata('id'));
        }

        $this->db->select('a.*, c.name, d.name as customer_name');
        $this->db->from('srf a');
        $this->db->join('user b', 'a.user_id = b.id');
        $this->db->join('employee c', 'b.employee_id = c.id');
        $this->db->join('customer d', 'a.fcustomer_id = d.id', 'left');

        if($this->session->userdata('leveluser_id')==3)
        {
            // $this->db->where('d.user_id', $this->session->userdata('id'));
            $this->db->where('a.user_id', $this->session->userdata('id'));
        }
        elseif($this->session->userdata('leveluser_id')==2)
        {
            $this->db->where('b.active', true);
            $this->db->where('supervisor_id', $this->session->userdata('employee_id'));
        } elseif($this->session->userdata('leveluser_id')==4)
        {
            $this->db->where('b.active', true);
            $this->db->where_in('supervisor_id', $team);
        }
        
        $q = $this->db->get();

        return $q->result();
    }


    public function getClassDetail($class_name){
        $this->db->select('*');
        $this->db->from('customer_classification');
        $this->db->where('customer_classification', $class_name);
        $qry = $this->db->get();

        return $qry->row();
    }


    function get_data($table_name, $condition = "", $type = "", $condition_or = ""){
        $this->db->select('*');
        $this->db->from($table_name);

        if(!empty($condition)){
            $this->db->where($condition);
        }
        if(!empty($condition_or)){
            $this->db->or_where($condition_or);
        }
        $qry = $this->db->get();

        if($type == "bulk") return $qry->result();
        else return $qry->row();
        
    }

    function getDataB($param){
        if(isset($param['column'])) $this->db->select($param['column']);
        else $this->db->select('*');
        $this->db->from($param['table_name']);

        if(isset($param['join'])){
            foreach($param['join'] as $tbl){
                $this->db->join($tbl['table_name'], $tbl['condition'], $tbl['type']);
            }
        }

        if(isset($param['condition'])){
            $this->db->where($param['condition']);
        }
        if(isset($param['condition_or'])){
            $this->db->or_where($param['condition_or']);
        }

        if(isset($param['order'])){
            $this->db->order_by($param['order']['field'], $param['order']['order']);
        }

        if(isset($param['start']) && isset($param['limit'])){
            $this->db->limit($param['limit'], $param['start']);
        }
        

        $qry = $this->db->get();

        if(isset($param['type'])) return $qry->result();
        else return $qry->row();
        
    }

    function get_cust($param){
        $this->db->select('ID_CUSTOMER, NAME_CUSTOMER');
        $this->db->from('CUSTOMER');
        if(isset($param['key'])){
            $this->db->like('NAME_CUSTOMER', $param['key']);
        }
        $this->db->limit($param['limit'], $param['start']);
        $query = $this->db->get();

        return $query->result();
    }

    function total_cust(){
        $this->db->select('ID_CUSTOMER');
        $this->db->from('CUSTOMER');
        return $this->db->count_all_results();
    }

    function listpresalesinfo($id="")
    {
        $data=$this->presales->query("SELECT * FROM PRESALES WHERE ID_CUSTOMER = '".$id."'");
        $ret = $data->result();
        foreach ($ret as $idx => $row) {
            if(empty($ret[$idx]->JARAK_MAIN_ROUTE_B)){
                $ret[$idx]->JARAK_MAIN_ROUTE_B = $ret[$idx]->JARAK;
            }

            if(empty($ret[$idx]->POP_MAIN_ROUTE_B)){
                $ret[$idx]->POP_MAIN_ROUTE_B = $ret[$idx]->POP;
            }

            if(empty($ret[$idx]->PERANGKAT_B)){
                $ret[$idx]->PERANGKAT_B = $ret[$idx]->PERANGKAT;
            }
        }
        return $ret;

    }

    function listcoment($id="")
    {
        $data=$this->presales->query("SELECT A.*,DATE_FORMAT(CREATED_DATE,'%b %d %Y %h:%i %p') AS DATE ,B.* FROM COMMENT A LEFT JOIN USER B ON A.CREATED_BY=B.USER_ID  WHERE ID_CUSTOMER = '".$id."'");
        return $data->result();

    }

    function savecomment()
    {
        $presalesId = $this->getSalesID($this->session->userdata('email'));

        // $user = $this->userId();
        if($this->input->post('id_presales')==''){

        }
        else{
            $sql = "INSERT INTO COMMENT (COMMENT,ID_CUSTOMER,CREATED_BY,CREATED_DATE)
                VALUES(
                '" . $this->input->post('comment') . "',
                '" . $this->input->post('id_presales') . "',
                '". $presalesId->USER_ID ."'
                ,SYSDATE())";
        }


        $this->presales->query($sql);
        $this->presales->trans_complete();
        return true;
    }

    function updateData($table, $data, $condition){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();

        $this->db->where($condition);
        $this->db->update($table, $data);

        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }

        return true;
    }

    public function getTeam($spv_id){
        $this->presales->select('*'); 
        $this->presales->from('SALES_APPROVAL');
        $this->presales->where('SUPERVISOR_ID', $spv_id); 
        $qry = $this->presales->get();

        $ids = array();

        $res = $qry->result();

        if(!empty($res)){
            foreach ($res as $key => $value) {
                $ids[] = $value->USER_ID;
            }
        }

        return $ids; 
    }

    private function _get_datatables_customer_query1()
    {
        


        $user = $this->presalesGetData(array(
            'table' => 'USER', 
            'condition' => array('EMAIL' => $this->session->userdata('email')),
            'return' => 'array'
        ));

        // var_dump($user); exit();

        // $user = $this->userId();
        $team = array();
        if($user['ASM_FLAG'] == 1) {
            $team = $this->getTeam($user['USER_ID']);
            $team[] = $user["USER_ID"];
        }

        $column_select = array("A.*","D.FILENAME AS FILENAME_PRESALES","A.ALAMAT_INSTALASI1","A.ALAMAT_INSTALASI2","D.FILENAME_P AS FILENAME_PROPER","D.FILENAME_B AS FILENAME_BUDGET", "C.PRODUCT_NAME","COUNT(B.ID_CUSTOMER) AS COMMENTSUM");
        $column_search = array("A.ID_CUSTOMER","A.NAME_SALES","A.NAME_CUSTOMER","A.SEGMEN","C.PRODUCT_NAME","A.TYPE_SERVICE","A.ALAMAT_INSTALASI1","A.ALAMAT_INSTALASI2","A.KAPASITAS","A.BUDGET","A.FILENAME","D.FILENAME","A.TGL_INPUT","A.USER_UPDATE","A.UPDATE_DATE","A.PROGRESS");
        $order = array('A.NAME_SALES' => 'asc', 'A.TGL_INPUT' => 'desc');
        $column_order = array("A.ID_CUSTOMER","A.TGL_INPUT","A.NAME_CUSTOMER","A.SEGMEN","C.PRODUCT_NAME","A.TYPE_SERVICE","A.ALAMAT_INSTALASI1","A.ALAMAT_INSTALASI2","A.KAPASITAS","A.BUDGET","A.FILENAME","D.FILENAME","A.TGL_INPUT","A.USER_UPDATE","A.UPDATE_DATE","A.PROGRESS");
        $this->presales->select($column_select);
        $this->presales->from('CUSTOMER A');
        $this->presales->join('COMMENT B', 'A.ID_CUSTOMER = B.ID_CUSTOMER', 'LEFT');
        $this->presales->join('PRODUCT C', 'A.ID_PRODUCT = C.ID_PRODUCT', 'LEFT');
        $this->presales->join('PRESALES D', 'A.ID_CUSTOMER = D.ID_CUSTOMER', 'LEFT');

        if($user["ROLE_ID"]==4){
            $this->presales->where('A.SEGMEN', $user["DIVISI"]);
        } else if ($user["ROLE_ID"]!=1 && $user["ROLE_ID"]!=4 && $user["ROLE_ID"] != 5){
            if($user['ASM_FLAG'] == 1) {
                $this->presales->where_in('ID_SALES', $team);
            } else {
                $this->presales->where('ID_SALES', $user["USER_ID"]);
            }
        } else if ($user["ROLE_ID"] == 2){
            $this->presales->where('ID_SALES', $user["USER_ID"]);
        } else {
            //do something here;
        }

        $condition = "";

        $this->presales->group_by('A.ID_CUSTOMER');
        $i = 0;
        foreach ($column_search as $key => $item) // loop column
        {
            if(!empty($_POST['columns'][$key]['search']['value'])){

                if($item == "A.KAPASITAS"){
                    $this->presales->like("CONCAT(TRIM(A.MIX), ' ', TRIM(A.KAPASITAS),' ', TRIM(A.SATUAN))", $_POST['columns'][$key]['search']['value']);
                } elseif($item == "A.PROGRESS"){
                    if(strtolower($_POST['columns'][$key]['search']['value']) == 'ope' || strtolower($_POST['columns'][$key]['search']['value']) == 'open'){
                        $this->presales->where("A.PROGRESS", 1);
                    } elseif(strtolower($_POST['columns'][$key]['search']['value']) == 'over sl' || strtolower($_POST['columns'][$key]['search']['value']) == 'over sla'){
                        $this->presales->where("A.PROGRESS", 3);
                    } elseif(strtolower($_POST['columns'][$key]['search']['value']) == 'clos' || strtolower($_POST['columns'][$key]['search']['value']) == 'close') {
                        $this->presales->where("A.PROGRESS", 2);
                    }
                }else {
                    $this->presales->like($item, $_POST['columns'][$key]['search']['value']);
                }
            }

            if($_POST['search']['value']) // if datatable send POST for search
            {
                if(strtolower($_POST['search']['value']) == 'ope' || strtolower($_POST['search']['value']) == 'open'){
                    $this->presales->where("A.PROGRESS", 1);
                } elseif(strtolower($_POST['search']['value']) == 'over sl' || strtolower($_POST['search']['value']) == 'over sla'){
                    $this->presales->where("A.PROGRESS", 3);
                } elseif(strtolower($_POST['search']['value']) == 'clos' || strtolower($_POST['search']['value']) == 'close') {
                    $this->presales->where("A.PROGRESS", 2);
                } else {
                    if ($i === 0) // first loop
                    {
                        $condition .= "(".$item." LIKE '%". $_POST['search']['value']."%'";
                    } else {
                        $condition .= " OR ".$item." LIKE '%". $_POST['search']['value']."%'";
                        // $this->presales->or_like($item, $_POST['search']['value']);
                    }
                }
                /*if(!empty($_POST['columns'][$key]['search']['value'])){
                    var_dump('rrr'); exit;
                    $this->presales->like($item, $_POST['columns'][$key]['search']['value']);
                }*/

            }
            $i++;
        }

        $condition .= ")";

        if($condition!=")"){
            $this->presales->where($condition);
        }

        $this->presales->order_by("A.TGL_INPUT", "desc");

        // var_dump($_POST['order']); exit();
        // if(isset($_POST['order'])) // here order processing
        // {
        //     // var_dump('expression');
        //     if(empty($column_order[$_POST['order']['0']['column']])){
        //         // $this->presales->order_by("A.NAME_SALES", "asc");
        //         // var_dump('expression1');
        //         $this->presales->order_by("A.TGL_INPUT", "desc");
        //     } else {
        //         // var_dump('expression2');
        //         // var_dump($column_order[$_POST['order']['0']['column']]);
        //         // var_dump($_POST['order']['0']['dir']);
        //         $this->presales->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        //     }
        // }
        // else
        // {
        //     // $this->presales->order_by("A.NAME_SALES", "asc");
        //     $this->presales->order_by("A.TGL_INPUT", "desc");

        // }

        // exit();
    }

    function get_datatables1()
    {
        $this->_get_datatables_customer_query1();
        if($_POST['length'] != -1)
            $this->presales->limit($_POST['length'], $_POST['start']);
        $query = $this->presales->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_customer_query1();
        $query = $this->presales->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->presales->from("CUSTOMER");
        return $this->presales->count_all_results();
    }

    function presalesGetData($param){
        if(isset($param['field'])) $this->presales->select($param['field']);
        else $this->presales->select('*');
        
        $this->presales->from($param['table']);

        if(isset($param['join'])){
            foreach($param['join'] as $tbl){
                $this->presales->join($tbl['table'], $tbl['condition'], $tbl['type']);
            }
        }

        if(isset($param['condition'])){
            $this->presales->where($param['condition']);
        }
        if(isset($param['condition_or'])){
            $this->presales->or_where($param['condition_or']);
        }

        if(isset($param['order'])){
            $this->presales->order_by($param['order']['field'], $param['order']['order']);
        }

        if(isset($param['start']) && isset($param['limit'])){
            $this->presales->limit($param['limit'], $param['start']);
        }

        $qry = $this->presales->get();

        // if(isset($param['type'])) return $qry->result();
        // else return $qry->row();
        if(isset($param['return'])){
            if(isset($param['type'])) return $qry->result_array();
            else return $qry->row_array();
        } else {
            if(isset($param['type'])) return $qry->result();
            else return $qry->row();
        }
        
    }




}
