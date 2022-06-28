<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    
class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //load model
        $this->load->model('Auth_model', 'auth');
        $this->load->library('csvimport');
        $this->load->library('form_validation');
    }

 //------------- LOAD VIEW -------------//
  
 public function home() {     
         
        $data = array();
        
        $this->load->view('templates/header', $data);
        $this->load->view('auth/home', $data);
        $this->load->view('templates/footer', $data);
    
}

public function about() {     
         
    $data = array();
    
    $this->load->view('templates/header', $data);
    $this->load->view('auth/about', $data);
    $this->load->view('templates/footer', $data);

}

public function admission() {     
         
    $data = array();
    
    $this->load->view('templates/header', $data);
    $this->load->view('auth/admission', $data);
    $this->load->view('templates/footer', $data);

}

public function academics() {     
         
    $data = array();
    
    $this->load->view('templates/header', $data);
    $this->load->view('auth/academics', $data);
    $this->load->view('templates/footer', $data);

}

public function signup() {     
         
    $data = array();
    
    $this->load->view('templates/header', $data);
    $this->load->view('auth/signup', $data);
    $this->load->view('templates/footer', $data);

}

function addAccount()
    {
               
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|callback_checkEmail');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_checkPassword');
        $this->form_validation->set_rules('copassword', 'Confirm Password', 'trim|required');
 
        if ($this->form_validation->run() == FALSE) {
            $this->signup();
        } else {
            
            $name = $this->security->xss_clean($this->input->post('name'));
            $email = $this->security->xss_clean($this->input->post('email'));
            $password = $this->security->xss_clean($this->input->post('password'));
            $timeStamp = date('Y-m-d');
            
                       
            $this->auth->setName($name);  
            $this->auth->setEmail($email);  
            $this->auth->setPassword($password);
            $this->auth->setTimeStamp($timeStamp);          
            
            $chk = $this->auth->addNewAccount();

            if($chk > 0)
                {
                    $this->session->set_flashdata('success', 'Registration Successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Registration creation failed');
                }

            redirect('login');

        }
        
    }


function preenrollment()
{
    $data = array();

    $row = $this->db->select("*")->where('accountid',$this->session->userdata('id'))->get("tbl_student")->row();
        $id = $row->id;

    $data['faculty'] = $this->auth->getAdviser();

    $schoolyear =0;

    $row = $this->db->select("*")->where('status',"Active")->get("tbl_schoolyear")->row();
    if (!empty($row->id))
    {
        $schoolyear = $row->id;
    }

    $result = $this->auth->getEnrollmentInfo($id, $schoolyear);

    if(!empty($result))
    {
       
            redirect('studentenrollment');                   
    
    }

    else
    {
        $this->load->view('templates/userheader', $data);
        $this->load->view("student/preenrollment",  $data);
        $this->load->view('templates/userfooter', $data); 

    }
    
}


public function registration() {     
         
    $data = array();

    $data['province'] = $this->auth->getProvince();
      
    $this->load->view('student/registration', $data);
    
}

public function registrationrequest() {     
         
    $data = array();

    $id = $this->session->userdata('id');
    
    $data['studentInfo'] = $this->auth->getStudentInfo($id);
    $data['province'] = $this->auth->getProvince();
    $data['city'] = $this->auth->getCityFix($id);
    $data['barangay'] = $this->auth->getBarangayFix($id);
       
   $this->load->view('student/request', $data);
   
}

public function studentaccount() {     
         
        $data = array();

        $id = $this->session->userdata('id');
    
        $data['studentInfo'] = $this->auth->getStudentInfo($id);
        $data['province'] = $this->auth->getProvince();
        $data['city'] = $this->auth->getCityFix($id);
        $data['barangay'] = $this->auth->getBarangayFix($id);
        
        $this->load->view('templates/userheader', $data);
        $this->load->view('student/account', $data);
        $this->load->view('templates/userfooter', $data);  
                 
 }

 public function studentenrollment() {     
         
    $data = array();

    $row = $this->db->select("*")->where('accountid',$this->session->userdata('id'))->get("tbl_student")->row();
        $id = $row->id;

    $schoolyear =0;

    $row = $this->db->select("*")->where('status',"Active")->get("tbl_schoolyear")->row();
    if (!empty($row->id))
    {
        $schoolyear = $row->id;
    }

    $data['studentInfo'] = $this->auth->getEnrollmentInfo($id,$schoolyear);

    $count = $this->auth->scheduleListingCount($id,$schoolyear);

        $returns = $this->paginationCompress ( "auth/studentenrollment/", $count, 10 );
        
        $data['userRecords'] = $this->auth->scheduleListing($id,$schoolyear, $returns["page"], $returns["segment"]);
    
    $this->load->view('templates/userheader', $data);
    $this->load->view('student/enrollment', $data);
    $this->load->view('templates/userfooter', $data);  
             
}

public function studentrecords() {     
         
    $data = array();

    $row = $this->db->select("*")->where('accountid',$this->session->userdata('id'))->get("tbl_student")->row();
        $id = $row->id;

    $schoolyear =0;

    $row = $this->db->select("*")->where('status',"Active")->get("tbl_schoolyear")->row();
    if (!empty($row->id))
    {
        $schoolyear = $row->id;
    }

    $data['studentInfo'] = $this->auth->getEnrollmentInfo($id,$schoolyear);

    $count = $this->auth->recordsListingCount($id,$schoolyear);

    $returns = $this->paginationCompress ( "auth/studentrecords/", $count, 10 );
        
    $data['userRecords'] = $this->auth->recordsListing($id,$schoolyear, $returns["page"], $returns["segment"]);
    
    $this->load->view('templates/userheader', $data);
    $this->load->view('student/records', $data);
    $this->load->view('templates/userfooter', $data);  
             
}


public function studentdashboard() {     

    $isLoggedIn = $this->session->userdata('WCIisLoggedIn');
    
    if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
    {
             
        $data = array();
        
        $this->load->view('admin/login', $data);
    }
    else
    {
        $usertype = $this->session->userdata('usertype');

        if($usertype == "Student"){

            $data = array();

            $data['dashboardInfo'] = $this->auth->getTotal();

            $this->load->view('templates/userheader', $data);
            $this->load->view('student/student', $data);
            $this->load->view('templates/userfooter', $data);
    
            
        }
            
}

}

public function teacherdashboard() {     

    $isLoggedIn = $this->session->userdata('WCIisLoggedIn');
    
    if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
    {
             
        $data = array();
        
        $this->load->view('admin/login', $data);
    }
    else
    {
        $usertype = $this->session->userdata('usertype');

        if($usertype == "Teacher"){

            $data = array();

            $data['dashboardInfo'] = $this->auth->getTotal();

            $this->load->view('templates/teacherheader', $data);
            $this->load->view('teacher/teacher', $data);
            $this->load->view('templates/userfooter', $data);
    
            
        }
            
}

}



function signout()
{
    $data = array();

    $data['title'] = "TAPAT - Add New Cases";

    $this->session->sess_destroy();

    redirect('login');
    
}

 
 //------------- FUNCTION -------------//
    
 function addEnrollment()
    {
               
        $this->form_validation->set_rules('gradelevel', 'Grade Level', 'trim|required');
        $this->form_validation->set_rules('section', 'Section', 'trim|required');

        $row = $this->db->select("*")->where('accountid',$this->session->userdata('id'))->get("tbl_student")->row();
        $id = $row->id;
 
        if ($this->form_validation->run() == FALSE) {
            $this->addNewStrand();
        } else {
            
            $gradelevel = $this->security->xss_clean($this->input->post('gradelevel'));
            $section = $this->security->xss_clean($this->input->post('section'));
            $etype = $this->security->xss_clean($this->input->post('etype'));
            $strand = $this->security->xss_clean($this->input->post('strand'));
            $timeStamp = date('Y-m-d');

            $schoolyear =0;

            $row = $this->db->select("*")->where('status',"Active")->get("tbl_schoolyear")->row();
            if (!empty($row->id))
            {
                $schoolyear = $row->id;
            }           
            
            $chk = $this->auth->addPreEnrollment($id,$schoolyear,$timeStamp,$etype,$strand);

            $enrollid = $this->db->select("*")->limit(1)->order_by('id',"DESC")->get("tbl_enrollment")->row();
 
            $schedule = $this->auth->scheduleListingInfo($section, $schoolyear);

            foreach($schedule as $record)
            {
                $this->auth->addSchedule($enrollid->id,$record->id);
            }


            if($chk > 0)
                {
                    $this->session->set_flashdata('success', 'Request Added Successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Strand creation failed');
                }

            redirect('preenrollment');

        }
        
    }

    public function getCity(){
        if($this->input->post('province'))
           {
   
           echo $this->auth->getCity($this->input->post('province'));
           }
   
       }

    public function getBarangay(){
        if($this->input->post('city'))
           {
   
           echo $this->auth->getBarangay($this->input->post('city'));
           }
   
       }

       public function getStrand(){

        if($this->input->post('gradelevel'))
        {

        echo $this->auth->getStrand($this->input->post('gradelevel'));
        }
           
       }

       function checkEmail() {

        $email = $this->security->xss_clean($this->input->post('email'));


        $check = $this->db->get_where('tbl_account', array('email' => $email,'status' => 'Active'), 1);

        if ($check->num_rows() > 0) {

            $this->form_validation->set_message('checkEmail', 'This email already exists.');

            return FALSE;
        }

        else
        {
            return TRUE;
        }
     
     
       } 

       function checkPassword() {

        $password = $this->security->xss_clean($this->input->post('password'));
        $copassword = $this->security->xss_clean($this->input->post('copassword'));

        if ($password != $copassword) {

            $this->form_validation->set_message('checkPassword', "Password and Confirm Password didn't match.");

            return FALSE;
        }

        else
        {
            return TRUE;
        }
     
     
       } 

    
    function paginationCompress($link, $count, $perPage = 10, $segment = 3) {
		$this->load->library ( 'pagination' );

		$config ['base_url'] = base_url () . $link;
		$config ['total_rows'] = $count;
		$config ['uri_segment'] = $segment;
		$config ['per_page'] = $perPage;
		$config ['num_links'] = 5;
		$config ['full_tag_open'] = '<nav><ul class="pagination">';
		$config ['full_tag_close'] = '</ul></nav>';
		$config ['first_tag_open'] = '<li class="arrow">';
		$config ['first_link'] = 'First';
		$config ['first_tag_close'] = '</li>';
		$config ['prev_link'] = 'Previous';
		$config ['prev_tag_open'] = '<li class="arrow">';
		$config ['prev_tag_close'] = '</li>';
		$config ['next_link'] = 'Next';
		$config ['next_tag_open'] = '<li class="arrow">';
		$config ['next_tag_close'] = '</li>';
		$config ['cur_tag_open'] = '<li class="active"><a href="#">';
		$config ['cur_tag_close'] = '</a></li>';
		$config ['num_tag_open'] = '<li>';
		$config ['num_tag_close'] = '</li>';
		$config ['last_tag_open'] = '<li class="arrow">';
		$config ['last_link'] = 'Last';
		$config ['last_tag_close'] = '</li>';
	
		$this->pagination->initialize ( $config );
		$page = $config ['per_page'];
		$segment = $this->uri->segment ( $segment );
	
		return array (
				"page" => $page,
				"segment" => $segment
		);
	}
    
}

