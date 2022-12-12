<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    
class Faculty extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //load model
        $this->load->model('Faculty_model', 'auth');
        $this->load->library('csvimport');
        $this->load->library('form_validation');
    }

 //------------- LOAD VIEW -------------//
  

public function faculty() {     

            $data = array();

            $this->load->view('templates/adminheader', $data);
            $this->load->view('admin/faculty', $data);
            $this->load->view('templates/adminfooter', $data);       

}


function addNewFaculty()
{
    $data = array();

    $data['province'] = $this->auth->getProvince();

    $this->load->view('templates/adminheader', $data);
    $this->load->view("admin/addNewFaculty",  $data);
    $this->load->view('templates/adminfooter', $data);  
    
}

function editFaculty($id)
{
    $data = array();

    $data['studentInfo'] = $this->auth->getFacultyInfo($id);
    $data['province'] = $this->auth->getProvince();
    $data['city'] = $this->auth->getCityFix($id);
    $data['barangay'] = $this->auth->getBarangayFix($id);

    $this->load->view('templates/adminheader', $data);
    $this->load->view("admin/editFaculty",  $data);
    $this->load->view('templates/adminfooter', $data);  
    
}

 
 //------------- FUNCTION -------------//
    
 function addFaculty()
    {
               
        $this->form_validation->set_rules('facultytype', 'Faculty Type', 'trim|required');
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('birthdate', 'Birthdate', 'trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('contactperson', 'Contact Person', 'trim|required');
        $this->form_validation->set_rules('contactno', 'Contact No.', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|callback_checkEmail');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

 
        if ($this->form_validation->run() == FALSE) {
            $this->addNewFaculty();
        } else {
            
            //$idno = $this->security->xss_clean($this->input->post('idno'));
            $facultytype = $this->security->xss_clean($this->input->post('facultytype'));
            $firstname = $this->security->xss_clean($this->input->post('firstname'));
            $lastname = $this->security->xss_clean($this->input->post('lastname'));
            $middlename = $this->security->xss_clean($this->input->post('middlename'));
            $suffix = $this->security->xss_clean($this->input->post('suffix'));
            $birthdate = $this->security->xss_clean($this->input->post('birthdate'));
            $gender = $this->security->xss_clean($this->input->post('gender'));
            $barangay = $this->security->xss_clean($this->input->post('barangay'));
            $address = $this->security->xss_clean($this->input->post('address'));
            $contactperson = $this->security->xss_clean($this->input->post('contactperson'));
            $contactno = $this->security->xss_clean($this->input->post('contactno'));
            $email = $this->security->xss_clean($this->input->post('email'));
            $password = $this->security->xss_clean($this->input->post('password'));
            $status = $this->security->xss_clean($this->input->post('status'));
            $timeStamp = date('Y-m-d');
            $idno =0;

            $rows = $this->db->select("count(id) as idno")->get("tbl_faculty")->row();
            if (!empty($rows->idno))
            {
                $idno = $rows->idno +1;
            }

            else
            {
                $idno = 1;

            }
            
                       
            $this->auth->setIDNo($idno);  
            $this->auth->setStudentType($facultytype);
            $this->auth->setFirstname($firstname);
            $this->auth->setLastName($lastname);
            $this->auth->setMiddleName($middlename);
            $this->auth->setSuffix($suffix);
            $this->auth->setDOB($birthdate);
            $this->auth->setGender($gender);
            $this->auth->setBarangay($barangay);
            $this->auth->setAddress($address);
            $this->auth->setGuardian($contactperson);
            $this->auth->setContactNo($contactno);
            $this->auth->setEmail($email);
            $this->auth->setPassword($password);      
            $this->auth->setStatus($status);
            $this->auth->setTimeStamp($timeStamp);
            $userid=0; 
            
            $this->auth->addAccount();

            $row = $this->db->select("*")->limit(1)->order_by('id',"DESC")->get("tbl_account")->row();
            if (!empty($row->id))
            {
                $userid = $row->id;
            }

            $this->auth->setUserID($userid);
      
            $chk = $this->auth->addFaculty();

            if($chk > 0)
                {
                    

                    $this->session->set_flashdata('success', 'New Faculty Added Successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Faculty creation failed');
                }

            redirect('faculty');

        }
        
    }

    function editOldFaculty()
    {
            
            $id = $this->input->post('sid');

            $this->form_validation->set_rules('idno', 'ID No.', 'trim|required');
            $this->form_validation->set_rules('facultytype', 'Faculty Type', 'trim|required');
            $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
            $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
            $this->form_validation->set_rules('birthdate', 'Birthdate', 'trim|required');
            $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
            $this->form_validation->set_rules('address', 'Address', 'trim|required');
            $this->form_validation->set_rules('contactperson', 'Contact Person', 'trim|required');
            $this->form_validation->set_rules('contactno', 'Contact No.', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|callback_checkEmail');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');                   
                 
      
            if($this->form_validation->run() == FALSE)
            {
                
                $this->editFaculty($id);

            }
            else
            {
                $idno = $this->security->xss_clean($this->input->post('idno'));
                $facultytype = $this->security->xss_clean($this->input->post('facultytype'));
                $firstname = $this->security->xss_clean($this->input->post('firstname'));
                $lastname = $this->security->xss_clean($this->input->post('lastname'));
                $middlename = $this->security->xss_clean($this->input->post('middlename'));
                $suffix = $this->security->xss_clean($this->input->post('suffix'));
                $birthdate = $this->security->xss_clean($this->input->post('birthdate'));
                $gender = $this->security->xss_clean($this->input->post('gender'));
                $barangay = $this->security->xss_clean($this->input->post('barangay'));
                $address = $this->security->xss_clean($this->input->post('address'));
                $contactperson = $this->security->xss_clean($this->input->post('contactperson'));
                $contactno = $this->security->xss_clean($this->input->post('contactno'));
                $email = $this->security->xss_clean($this->input->post('email'));
                $status = $this->security->xss_clean($this->input->post('status'));
                $timeStamp = date('Y-m-d');
                
                
                $facultyInfo = array('idno'=>$idno,'firstname'=>$firstname,'lastname'=>$lastname,'middlename'=>$middlename,'suffix'=>$suffix,'birthdate'=>$birthdate,'gender'=>$gender,'addid'=>$barangay,'address'=>$address,'contactperson'=>$contactperson,'contactno'=>$contactno,'status'=>$status);

                $accountInfo = array('usertype'=>$facultytype);
                
                $result = $this->auth->editFaculty($facultyInfo, $id);

                $row = $this->db->select("*")->where('id',$id)->get("tbl_faculty")->row();
                $accountid = $row->accountid;
                
                if($result == true)
                {
                    $this->auth->editAccount($accountInfo, $accountid);

                    $this->session->set_flashdata('success', 'Faculty Data Updated.');

                    redirect('faculty');
                   
                }

                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');

                    $this->editFaculty($id);
              
                }
                
                
                
            }
        
    }

    function archivefaculty()
    {
            $id = $this->security->xss_clean($this->input->post('archiveid'));
                        
                $studentInfo = array('status'=>'Inactive',);

                $row = $this->db->select("*")->where('id',$id)->get("tbl_faculty")->row();
                $accountid = $row->accountid;

                $accountInfo = array('id'=>$accountid,'status'=>'Inactive',);
                
                $result = $this->auth->editFaculty($studentInfo, $id);

               

                
                if($result == true)
                {
                    $this->auth->editAccount($accountInfo, $accountid); 
                    $this->session->set_flashdata('success', 'Faculty Data Archived.');      
                             
                    redirect('faculty');
                   
                }

                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');

                    redirect('faculty');
              
                }
        
    }

    function retreievefaculty()
    {
            $id = $this->security->xss_clean($this->input->post('archiveid'));

                $studentInfo = array('status'=>'Active',);

                $row = $this->db->select("*")->where('id',$id)->get("tbl_faculty")->row();
                $accountid = $row->accountid;

                $accountInfo = array('id'=>$accountid,'status'=>'Active',);
                
                $result = $this->auth->editFaculty($studentInfo, $id);


                
                if($result == true)
                {
                    $this->auth->editAccount($accountInfo, $accountid);

                    $this->session->set_flashdata('success', 'Faculty Data Restored.');                 

                    redirect('archivedfaculty');
                   
                }

                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');

                    redirect('archivedfaculty');
              
                }
        
    }

    function dropstudent()
    {
        $id = $this->security->xss_clean($this->input->post('archiveid'));
                        
                $studentInfo = array('status'=>'Dropped',);
                
                $result = $this->auth->editEnrollment($studentInfo, $id);

                $student = $this->auth->getStudentInfo($id);

                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Drop student successfuly.');  
                    
                    $this->auth->SendEmailSubject($student->firstname,$student->lastname,$student->email);

                    redirect('myschedule');
                   
                }

                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');

                    redirect('myschedule');
              
                }
        
    }

    function restorestudent()
    {
        $id = $this->security->xss_clean($this->input->post('dcid'));
                        
                $studentInfo = array('id'=>$id,'status'=>'Active',);
                
                $result = $this->auth->editEnrollment($studentInfo, $id);

                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Student Restored.');                 

                    redirect('myschedule');
                   
                }

                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');

                    redirect('myschedule');
              
                }
        
    }
                    
    
    function facultyListing()
    {
        
        $status = 'Active';

        $searchText = $this->security->xss_clean($this->input->post('searchText'));
           
        $count = $this->auth->facultyListingCount($searchText,$status);

        $returns = $this->paginationCompress ("faculty/facultyListing/", $count, 10 );

        $data['searchText'] = $searchText;
        
        $data['userRecords'] = $this->auth->facultyListing($searchText, $status,$returns["page"], $returns["segment"]);
        

            $this->load->view('templates/adminheader', $data);
            $this->load->view("admin/faculty",  $data);
            $this->load->view('templates/adminfooter', $data);

    }

    function facultyArchivedListing()
    {
        $status = 'Inactive';

        $searchText = $this->security->xss_clean($this->input->post('searchText'));
           
        $count = $this->auth->facultyListingCount($searchText,$status);

        $returns = $this->paginationCompress ( "faculty/facultyListing/", $count, 10 );

        $data['searchText'] = $searchText;
        
        $data['userRecords'] = $this->auth->facultyListing($searchText, $status,$returns["page"], $returns["segment"]);
        

            $this->load->view('templates/adminheader', $data);
            $this->load->view("admin/archivedfaculty",  $data);
            $this->load->view('templates/adminfooter', $data);

    }

    public function myschedule() {     
         
        $data = array();

        $searchText = $this->security->xss_clean($this->input->post('searchText'));
    
        $row = $this->db->select("*")->where('accountid',$this->session->userdata('id'))->get("tbl_faculty")->row();
            $id = $row->id;
    
        $schoolyear =0;
    
        $row = $this->db->select("*")->where('status',"Active")->get("tbl_schoolyear")->row();
        if (!empty($row->id))
        {
            $schoolyear = $row->id;
        }
          
    
        $count = $this->auth->scheduleListingCount($id,$schoolyear,$searchText);
    
        $returns = $this->paginationCompress ( "faculty/myschedule/", $count, 10 );

        $data['searchText'] = $searchText;
            
        $data['userRecords'] = $this->auth->scheduleListing($id,$schoolyear,$searchText,$returns["page"], $returns["segment"]);
        
        $this->load->view('templates/teacherheader', $data);
        $this->load->view('teacher/schedule', $data);
        $this->load->view('templates/userfooter', $data);  
                 
    }

    public function myrecord() {     
         
        $data = array();

       
    
        $row = $this->db->select("*")->where('accountid',$this->session->userdata('id'))->get("tbl_faculty")->row();
            $id = $row->id;
    
        $schoolyear =0;
    
        $row = $this->db->select("*")->where('status',"Active")->get("tbl_schoolyear")->row();
        if (!empty($row->id))
        {
            $schoolyear = $row->id;
        }
          
    
        $count = $this->auth->recordListingCount($id,$schoolyear);
    
        $returns = $this->paginationCompress ( "faculty/myrecord/", $count, 10 );
            
        $data['userRecords'] = $this->auth->recordListing($id,$schoolyear, $returns["page"], $returns["segment"]);
        
        $this->load->view('templates/teacherheader', $data);
        $this->load->view('teacher/records', $data);
        $this->load->view('templates/userfooter', $data);  
                 
    }

    public function studentlist($schedid) {     
         
        $data = array();

        $searchText = $this->security->xss_clean($this->input->post('searchText'));

        $data['sched'] =$schedid;
    
        $row = $this->db->select("*")->where('accountid',$this->session->userdata('id'))->get("tbl_faculty")->row();
            $id = $row->id;
    
        $schoolyear =0;
    
        $row = $this->db->select("*")->where('status',"Active")->get("tbl_schoolyear")->row();
        if (!empty($row->id))
        {
            $schoolyear = $row->id;
        }
          
    
        $count = $this->auth->studentListingCount($schedid,$searchText);
    
        $returns = $this->paginationCompress ("faculty/studentlist/", $count, 10 );

        $data['searchText'] = $searchText;
            
        $data['userRecords'] = $this->auth->studentListing($schedid, $searchText,$returns["page"], $returns["segment"]);
        $data['totalStudent'] = $count;
        $data['sched'] = $schedid;
        
        $this->load->view('templates/teacherheader', $data);
        $this->load->view('teacher/students', $data);
        $this->load->view('templates/userfooter', $data);  
                 
    }

    function checkEmail() {

        $email = $this->security->xss_clean($this->input->post('email'));
        $id = $this->input->post('sid');

        $check = $this->db->get_where('tbl_account', array('email' => $email), 1);

        $row = $this->auth->getFacultyInfo($id);

        if(!empty($id))
        {
            $row = $this->auth->getFacultyInfo($id);

            if ($check->num_rows() > 0 && $email != $row->email) {

                $this->form_validation->set_message('checkEmail', 'This email already exists.');
    
                return FALSE;
            }
    
            else
            {
                return TRUE;
            }

            
        }
        
        else
        {

            if ($check->num_rows() > 0 ) {

                $this->form_validation->set_message('checkEmail', 'This email already exists.');
    
                return FALSE;
            }
    
            else
            {
                return TRUE;
            }
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

       public function getidno() {

        $query = $this->db->query("SELECT (count(id)+1) as idno FROM tbl_faculty");
    $data['record'] = $query->result();
    
    echo json_encode($data);

    
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

