<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/30/2015
 * Time: 4:44 PM
 * @category: Libraries
 * @author: Kardiwan@moratelindo.co.id
 */

class Apps {

    public function __construct()
    {
        // Instantiate the CI libraries so we can work with them
        $this->ci =& get_instance();

        // Cookie from Single Sign On Application
        $cookie = base64_decode($_COOKIE['SSOID']);
        $crop   = explode('+', $cookie);
        $email  = explode('@', $crop[1]);

        $this->userId       = $crop[0];
        $this->userEmail    = $crop[1];
        $this->userFullname = $crop[2];
        $this->userName     = $email[0];
    }

    public function info()
    {
        $data['apps_brand']         = 'ESS';
        $data['apps_name']          = 'Employee Self Service';
        $data['apps_company']       = 'PT. Mora Telematika Indonesia';
        $data['apps_company_brand'] = 'Moratelindo';

        // Get Data SSO
        $data['apps_user_id']       = $this->userId;
        $data['apps_user_name']     = $this->userName;
        $data['apps_user_email']    = $this->userEmail;
        $data['apps_user_fullname'] = $this->userFullname;

        // Get Data API HRIS
        $json = file_get_contents('http://morahrd.moratelindo.co.id/karyawan/index.php/employeeRestserver/employee/id/'.$this->userId);
        $obj = json_decode($json);

        $data['obj_employee_id']    = $obj->employee_id;
        $data['obj_employee_no']    = $obj->employee_no;
        $data['obj_fullname']       = $obj->fullname;
        $data['obj_photo']          = $obj->photo;
        $data['obj_position_title'] = $obj->position_title;
        $data['obj_level']          = $obj->level;
        $data['obj_grade']          = $obj->grade;
        $data['obj_department']     = $obj->department;
        $data['obj_location']       = $obj->location;

        return $data;
    }

}

/* End of file Apps.php */
/* Location: ./application/libraries/Apps.php */