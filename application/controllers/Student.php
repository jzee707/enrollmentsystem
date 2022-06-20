<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    
class Student extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //load model
        $this->load->model('Student_model', 'auth');
        $this->load->library('csvimport');
        $this->load->library('form_validation');
    }

 //------------- LOAD VIEW -------------//
  

public function student() {     

            $data = array();

            $this->load->view('templates/adminheader', $data);
            $this->load->view('admin/student', $data);
            $this->load->view('templates/adminfooter', $data);       

}


function addNewStudent()
{
    $data = array();

    $data['province'] = $this->auth->getProvince();

    $this->load->view('templates/adminheader', $data);
    $this->load->view("admin/addNewStudent",  $data);
    $this->load->view('templates/adminfooter', $data);  
    
}

function editStudent($id)
{
    $data = array();

    $data['studentInfo'] = $this->auth->getStudentInfo($id);
    $data['province'] = $this->auth->getProvince();
    $data['city'] = $this->auth->getCityFix($id);
    $data['barangay'] = $this->auth->getBarangayFix($id);

    $this->load->view('templates/adminheader', $data);
    $this->load->view("admin/editStudent",  $data);
    $this->load->view('templates/adminfooter', $data);  
    
}

 
 //------------- FUNCTION -------------//
    
 function addStudent()
    {
               
        $this->form_validation->set_rules('lrn', 'LRN', 'trim|required');
        $this->form_validation->set_rules('studenttype', 'Student Type', 'trim|required');
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('birthdate', 'Birthdate', 'trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('religion', 'Religion', 'trim|required');
        $this->form_validation->set_rules('nationality', 'Nationality', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('mother', 'Mothers Name', 'trim|required');
        $this->form_validation->set_rules('father', 'Fathers Name', 'trim|required');
        $this->form_validation->set_rules('guardian', 'Guardian', 'trim|required');
        $this->form_validation->set_rules('contactno', 'Contact No.', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

 
        if ($this->form_validation->run() == FALSE) {
            $this->addNewStudent();
        } else {
            
            $idno = $this->security->xss_clean($this->input->post('idno'));
            $lrn = $this->security->xss_clean($this->input->post('lrn'));
            $studenttype = $this->security->xss_clean($this->input->post('studenttype'));
            $firstname = $this->security->xss_clean($this->input->post('firstname'));
            $lastname = $this->security->xss_clean($this->input->post('lastname'));
            $middlename = $this->security->xss_clean($this->input->post('middlename'));
            $suffix = $this->security->xss_clean($this->input->post('suffix'));
            $birthdate = $this->security->xss_clean($this->input->post('birthdate'));
            $gender = $this->security->xss_clean($this->input->post('gender'));
            $religion = $this->security->xss_clean($this->input->post('religion'));
            $nationality = $this->security->xss_clean($this->input->post('nationality'));
            $barangay = $this->security->xss_clean($this->input->post('barangay'));
            $address = $this->security->xss_clean($this->input->post('address'));
            $mother = $this->security->xss_clean($this->input->post('mother'));
            $father = $this->security->xss_clean($this->input->post('father'));
            $guardian = $this->security->xss_clean($this->input->post('guardian'));
            $contactno = $this->security->xss_clean($this->input->post('contactno'));
            $email = $this->security->xss_clean($this->input->post('email'));
            $password = $this->security->xss_clean($this->input->post('password'));
            $status = $this->security->xss_clean($this->input->post('status'));
            $timeStamp = date('Y-m-d');
            $userid=0;    
                       
            $this->auth->setIDNo($idno);  
            $this->auth->setLRN($lrn);
            $this->auth->setStudentType($studenttype);
            $this->auth->setFirstname($firstname);
            $this->auth->setLastName($lastname);
            $this->auth->setMiddleName($middlename);
            $this->auth->setSuffix($suffix);
            $this->auth->setDOB($birthdate);
            $this->auth->setGender($gender);
            $this->auth->setReligion($religion);
            $this->auth->setNationality($nationality);
            $this->auth->setBarangay($barangay);
            $this->auth->setAddress($address);
            $this->auth->setMother($mother);
            $this->auth->setFather($father);
            $this->auth->setGuardian($guardian);
            $this->auth->setContactNo($contactno);  
            $this->auth->setEmail($email);  
            $this->auth->setPassword($password);       
            $this->auth->setStatus($status);
            $this->auth->setTimeStamp($timeStamp);    
            
            $this->auth->addAccount();

            $row = $this->db->select("*")->limit(1)->order_by('id',"DESC")->get("tbl_account")->row();
            if (!empty($row->id))
            {
                $userid = $row->id;
            }

            $this->auth->setUserID($userid);
      
            $chk = $this->auth->addStudent();

            if($chk > 0)
                {

                    $this->session->set_flashdata('success', 'New Student Added Successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Student creation failed');
                }

            redirect('student');

        }
        
    }

    function editOldStudent()
    {
            
            $id = $this->input->post('sid');
                    
            $this->form_validation->set_rules('idno', 'ID No.', 'trim|required');
            $this->form_validation->set_rules('lrn', 'LRN', 'trim|required');
            $this->form_validation->set_rules('studenttype', 'Student Type', 'trim|required');
            $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
            $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
            $this->form_validation->set_rules('birthdate', 'Birthdate', 'trim|required');
            $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
            $this->form_validation->set_rules('religion', 'Religion', 'trim|required');
            $this->form_validation->set_rules('nationality', 'Nationality', 'trim|required');
            $this->form_validation->set_rules('address', 'Address', 'trim|required');
            $this->form_validation->set_rules('mother', 'Mothers Name', 'trim|required');
            $this->form_validation->set_rules('father', 'Fathers Name', 'trim|required');
            $this->form_validation->set_rules('guardian', 'Guardian', 'trim|required');
            $this->form_validation->set_rules('contactno', 'Contact No.', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
      
      
            if($this->form_validation->run() == FALSE)
            {
                $this->editStudent($id);
              

            }
            else
            {


                $idno = $this->security->xss_clean($this->input->post('idno'));
                $lrn = $this->security->xss_clean($this->input->post('lrn'));
                $studenttype = $this->security->xss_clean($this->input->post('studenttype'));
                $firstname = $this->security->xss_clean($this->input->post('firstname'));
                $lastname = $this->security->xss_clean($this->input->post('lastname'));
                $middlename = $this->security->xss_clean($this->input->post('middlename'));
                $suffix = $this->security->xss_clean($this->input->post('suffix'));
                $birthdate = $this->security->xss_clean($this->input->post('birthdate'));
                $gender = $this->security->xss_clean($this->input->post('gender'));
                $religion = $this->security->xss_clean($this->input->post('religion'));
                $nationality = $this->security->xss_clean($this->input->post('nationality'));
                $barangay = $this->security->xss_clean($this->input->post('barangay'));
                $address = $this->security->xss_clean($this->input->post('address'));
                $mother = $this->security->xss_clean($this->input->post('mother'));
                $father = $this->security->xss_clean($this->input->post('father'));
                $guardian = $this->security->xss_clean($this->input->post('guardian'));
                $contactno = $this->security->xss_clean($this->input->post('contactno'));
                $email = $this->security->xss_clean($this->input->post('email'));
                $status = $this->security->xss_clean($this->input->post('status'));
                $timeStamp = date('Y-m-d');
              
                
                $studentInfo = array('idno'=>$idno,'lrn'=>$lrn,'studenttype'=>$studenttype,'firstname'=>$firstname,'lastname'=>$lastname,'middlename'=>$middlename,'suffix'=>$suffix,'birthdate'=>$birthdate,'gender'=>$gender,'religion'=>$religion,'nationality'=>$nationality,'addid'=>$barangay,'address'=>$address,'mother'=>$mother,'father'=>$father,'guardian'=>$guardian,'contactno'=>$contactno,'status'=>$status,);
                
                $result = $this->auth->editStudent($studentInfo, $id);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Student Data Updated.');

                    redirect('student');
                   
                }

                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');

                    $this->editStudent($id);
              
                }
                
                
                
            }
        
    }

    function addReStudent()
    {
               
        $this->form_validation->set_rules('lrn', 'LRN', 'trim|required');
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('birthdate', 'Birthdate', 'trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('religion', 'Religion', 'trim|required');
        $this->form_validation->set_rules('nationality', 'Nationality', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('mother', 'Mothers Name', 'trim|required');
        $this->form_validation->set_rules('father', 'Fathers Name', 'trim|required');
        $this->form_validation->set_rules('guardian', 'Guardian', 'trim|required');
        $this->form_validation->set_rules('contactno', 'Contact No.', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

 
        if ($this->form_validation->run() == FALSE) {
            $this->addNewStudent();
        } else {
            
            $lrn = $this->security->xss_clean($this->input->post('lrn'));
            $idno = '';
            $studenttype = 'New';
            $firstname = $this->security->xss_clean($this->input->post('firstname'));
            $lastname = $this->security->xss_clean($this->input->post('lastname'));
            $middlename = $this->security->xss_clean($this->input->post('middlename'));
            $suffix = $this->security->xss_clean($this->input->post('suffix'));
            $birthdate = $this->security->xss_clean($this->input->post('birthdate'));
            $gender = $this->security->xss_clean($this->input->post('gender'));
            $religion = $this->security->xss_clean($this->input->post('religion'));
            $nationality = $this->security->xss_clean($this->input->post('nationality'));
            $barangay = $this->security->xss_clean($this->input->post('barangay'));
            $address = $this->security->xss_clean($this->input->post('address'));
            $mother = $this->security->xss_clean($this->input->post('mother'));
            $father = $this->security->xss_clean($this->input->post('father'));
            $guardian = $this->security->xss_clean($this->input->post('guardian'));
            $contactno = $this->security->xss_clean($this->input->post('contactno'));
            $status = $this->security->xss_clean($this->input->post('status'));
            $timeStamp = date('Y-m-d');
            $userid=  $this->session->userdata('id');    
                       
            $this->auth->setIDNo($idno);  
            $this->auth->setLRN($lrn);
            $this->auth->setStudentType($studenttype);
            $this->auth->setFirstname($firstname);
            $this->auth->setLastName($lastname);
            $this->auth->setMiddleName($middlename);
            $this->auth->setSuffix($suffix);
            $this->auth->setDOB($birthdate);
            $this->auth->setGender($gender);
            $this->auth->setReligion($religion);
            $this->auth->setNationality($nationality);
            $this->auth->setBarangay($barangay);
            $this->auth->setAddress($address);
            $this->auth->setMother($mother);
            $this->auth->setFather($father);
            $this->auth->setGuardian($guardian);
            $this->auth->setContactNo($contactno);   
            $this->auth->setUserID($userid); 
            $this->auth->setStatus($status);
            $this->auth->setTimeStamp($timeStamp);    
            
            $chk = $this->auth->addStudent();

            if($chk > 0)
                {

                    $this->session->set_flashdata('success', 'New Student Added Successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Student creation failed');
                }

            redirect('registrationrequest');

        }
        
    }

    function approvedRequest($id)
    {
                        
                $studentInfo = array('id'=>$id,'status'=>'Active',);
                
                $result = $this->auth->editStudent($studentInfo, $id);

                $student = $this->auth->getStudentInfo($id);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Student Data Updated.');                 

                    $this->auth->SendEmailRegistration($student->firstname,$student->lastname,$student->email);

                    redirect('student');
                   
                }

                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');

                    $this->editStudent($id);
              
                }
        
    }

    function declinedRequest($id)
    {
                        
                $studentInfo = array('id'=>$id,'status'=>'Declined',);
                
                $result = $this->auth->editStudent($studentInfo, $id);

                $student = $this->auth->getStudentInfo($id);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Student Data Updated.');                 

                    $this->auth->SendEmailRegistrationDec($student->firstname,$student->lastname,$student->email);

                    redirect('student');
                   
                }

                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');

                    $this->editStudent($id);
              
                }
        
    }

    function archivestudent($id)
    {
                        
                $studentInfo = array('id'=>$id,'status'=>'Inactive',);
                
                $result = $this->auth->editStudent($studentInfo, $id);

                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Student Data Archived.');                 

                    redirect('student');
                   
                }

                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');

                    redirect('student');
              
                }
        
    }

    function retrievestudent($id)
    {
                        
                $studentInfo = array('id'=>$id,'status'=>'Active',);
                
                $result = $this->auth->editStudent($studentInfo, $id);

                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Student Data Restored.');                 

                    redirect('student');
                   
                }

                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');

                    redirect('student');
              
                }
        
    }
                    
    

    function studentListing()
    {
        $status = 'Active';

        $searchText = $this->security->xss_clean($this->input->post('searchText'));
           
        $count = $this->auth->studentsListingCount($searchText,$status); 

        $returns = $this->paginationCompress ( "student/studentListing/", $count, 10);
        
        $data['userRecords'] = $this->auth->studentListing($searchText, $returns["page"], $returns["segment"],$status);
        

            $this->load->view('templates/adminheader', $data);
            $this->load->view("admin/student",  $data);
            $this->load->view('templates/adminfooter', $data);

    }

    function prestudentListing()
    {

        $status = 'Requested';

        $searchText = $this->security->xss_clean($this->input->post('searchText'));

        $count = $this->auth->studentsListingCount($searchText,$status);

        $returns = $this->paginationCompress ("student/studentListing/", $count, 10);
        
        $data['userRecords'] = $this->auth->studentListing($searchText, $returns["page"], $returns["segment"],$status);
        
        
        $data['userRecords'] = $this->auth->studentListing($searchText, $returns["page"], $returns["segment"],$status);
        

            $this->load->view('templates/adminheader', $data);
            $this->load->view("admin/preregistration",  $data);
            $this->load->view('templates/adminfooter', $data);

    }

    function studentArchivedListing()
    {
        $status = 'Inactive';

        $searchText = $this->security->xss_clean($this->input->post('searchText'));
           
        $count = $this->auth->studentsListingCount($searchText,$status); 

        $returns = $this->paginationCompress ( "student/studentListing/", $count, 10);
        
        $data['userRecords'] = $this->auth->studentListing($searchText, $returns["page"], $returns["segment"],$status);
        

            $this->load->view('templates/adminheader', $data);
            $this->load->view("admin/archivedstudent",  $data);
            $this->load->view('templates/adminfooter', $data);

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

