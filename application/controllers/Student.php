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

public function registration() {     
         
    $data = array();

    $data['province'] = $this->auth->getProvince();
      
    $this->load->view('student/registration', $data);
    
}

 
 //------------- FUNCTION -------------//
    
 function addStudent()
    {
               
        $this->form_validation->set_rules('lrn', 'LRN', 'trim|required|callback_checkLRN');
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
        $this->form_validation->set_rules('email', 'Email', 'trim|required|callback_checkEmail');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

 
        if ($this->form_validation->run() == FALSE) {
            $this->addNewStudent();
        } else {
            

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
                    

            $this->form_validation->set_rules('lrn', 'LRN', 'trim|required|callback_checkLRN');
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
            $this->form_validation->set_rules('email', 'Email', 'trim|required|callback_checkEmail');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
      
      
            if($this->form_validation->run() == FALSE)
            {
                $this->editStudent($id);
              

            }
            else
            {



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
              
                
                $studentInfo = array('lrn'=>$lrn,'studenttype'=>$studenttype,'firstname'=>$firstname,'lastname'=>$lastname,'middlename'=>$middlename,'suffix'=>$suffix,'birthdate'=>$birthdate,'gender'=>$gender,'religion'=>$religion,'nationality'=>$nationality,'addid'=>$barangay,'address'=>$address,'mother'=>$mother,'father'=>$father,'guardian'=>$guardian,'contactno'=>$contactno,'status'=>$status,);
                
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
               
        $this->form_validation->set_rules('lrn', 'LRN', 'trim|required|callback_checkLRN');
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
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

        $this->form_validation->set_rules('chk4', 'Data Privacy Policy', 'required|callback_checkDPP');


 
        if ($this->form_validation->run() == FALSE) {
            $this->registration();
        } else {
            
            $lrn = $this->security->xss_clean($this->input->post('lrn'));
            $idno = '';
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

    function approvedRequest()
    {
        $id = $this->security->xss_clean($this->input->post('archiveid'));

                $studentInfo = array('status'=>'Active',);
                
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

    function declinedRequest()
    {
        $id = $this->security->xss_clean($this->input->post('dcid'));

                        
                $studentInfo = array('status'=>'Declined',);
                
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

    function archivestudent()
    {
                        
        $id = $this->security->xss_clean($this->input->post('archiveid'));

        $studentInfo = array('status'=>'Inactive',);

        $row = $this->db->select("*")->where('id',$id)->get("tbl_student")->row();
        $accountid = $row->accountid;

        $accountInfo = array('status'=>'Inactive',);
        
        $result = $this->auth->editStudent($studentInfo, $id);

        
        if($result == true)
        {
            $this->auth->editAccount($accountInfo, $accountid);

            $this->session->set_flashdata('success', 'Student Data Archived.');                 

            redirect('student');
            
        }

        else
        {
            $this->session->set_flashdata('error', 'User updation failed');

            redirect('student');
        
        }
        
    }

    function retrievestudent()
    {
                                           
        $id = $this->security->xss_clean($this->input->post('archiveid'));

        
                $row = $this->db->select("*")->where('id',$id)->get("tbl_student")->row();
                $accountid = $row->accountid;
                $status = $row->status;

                $studentInfo;

                if($status == "Inactive")
                {
                    $studentInfo = array('status'=>'Active',);
                    
                }

                else if($status == "Declined")
                {
                    $studentInfo = array('status'=>'Requested',);

                }

                $accountInfo = array('status'=>'Active',);

                $result = $this->auth->editStudent($studentInfo, $id);

                
                if($result == true)
                {
                    $this->auth->editAccount($accountInfo, $accountid);

                    $this->session->set_flashdata('success', 'Student Data Restored.');                 

                    redirect('student');
                   
                }

                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');

                    redirect('student');
              
                }
        
    }

    public function getStudentData() {

        $id = $this->security->xss_clean($this->input->post('id'));

        $query = $this->db->query("SELECT s.id,s.idno,s.lrn,CONCAT(s.firstname, ' ',s.lastname) name,s.firstname,s.lastname,s.middlename,s.suffix,s.birthdate,s.gender,s.addid,s.address,a.province,a.city,a.barangay,s.religion,s.nationality,ac.email,s.contactno,s.mother,s.father,s.guardian,s.studenttype,s.status
        FROM tbl_student s INNER JOIN tbl_address a ON a.id=s.addid INNER JOIN tbl_account ac ON ac.id=s.accountid WHERE s.id='".$id."'");
        $data['record'] = $query->result();
    
        echo json_encode($data);

    
    }
                    
    

    function studentListing()
    {
        $status = 'Active';

        $searchText = $this->security->xss_clean($this->input->post('searchText'));
           
        $count = $this->auth->studentsListingCount($searchText,$status); 

        $returns = $this->paginationCompress ( "student/studentListing/", $count, 10);

        $data['searchText'] = $searchText;
        
        $data['userRecords'] = $this->auth->studentListing($searchText, $returns["page"], $returns["segment"],$status);
        $data['totalStudent'] = $count;

            $this->load->view('templates/adminheader', $data);
            $this->load->view("admin/student",  $data);
            $this->load->view('templates/adminfooter', $data);

    }

    function prestudentListing()
    {

        $status = 'Requested';

        $searchText = $this->security->xss_clean($this->input->post('searchText'));

        $count = $this->auth->studentsListingCount($searchText,$status);

        $returns = $this->paginationCompress ("student/prestudentListing/", $count, 10);

        $data['searchText'] = $searchText;
        $data['totalStudent'] = $count;
        
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

        $returns = $this->paginationCompress ( "student/studentArchivedListing/", $count, 10);

        $data['searchText'] = $searchText;
        
        $data['userRecords'] = $this->auth->studentListing($searchText, $returns["page"], $returns["segment"],$status);
        

            $this->load->view('templates/adminheader', $data);
            $this->load->view("admin/archivedstudent",  $data);
            $this->load->view('templates/adminfooter', $data);

    }

    function registrationArchivedListing()
    {
        $status = 'Declined';

        $searchText = $this->security->xss_clean($this->input->post('searchText'));
           
        $count = $this->auth->studentsListingCount($searchText,$status); 

        $returns = $this->paginationCompress ( "student/registrationArchivedListing/", $count, 10);

        $data['searchText'] = $searchText;
        
        $data['userRecords'] = $this->auth->studentListing($searchText, $returns["page"], $returns["segment"],$status);
        

            $this->load->view('templates/adminheader', $data);
            $this->load->view("admin/archivedpreregistration",  $data);
            $this->load->view('templates/adminfooter', $data);

    }

    function checkLRN() {


        $lrn = $this->security->xss_clean($this->input->post('lrn'));
        $id = $this->input->post('sid');

        $check = $this->db->get_where('tbl_student', array('lrn' => $lrn), 1);

        $id = $this->input->post('sid');

        $row = 0;

        if(!empty($id))
        {
            $row = $this->auth->getStudentInfo($id);

            if ($check->num_rows() > 0 && $lrn != $row->lrn) {

                $this->form_validation->set_message('checkLRN', 'This LRN already exists.');
    
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

                $this->form_validation->set_message('checkLRN', 'This LRN already exists.');
    
                return FALSE;
            }
    
            else
            {
                return TRUE;
            }
        }
     
     
       }

       function checkEmail() {

        $email = $this->security->xss_clean($this->input->post('email'));
       
        $check = $this->db->get_where('tbl_account', array('email' => $email), 1);

        $id = $this->input->post('sid');

        $row = 0;

        if(!empty($id))
        {
            $row = $this->auth->getStudentInfo($id);

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

       function checkDPP() {


        $chk1 = $this->security->xss_clean($this->input->post('chk1'));
        $chk2 = $this->security->xss_clean($this->input->post('chk2'));
        $chk3 = $this->security->xss_clean($this->input->post('chk3'));
        $chk4 = $this->security->xss_clean($this->input->post('chk4'));

        if($chk1 == "" && $chk2 == "" && $chk3 == "" && $chk4 != "")
        {
            $this->form_validation->set_message('checkDPP', 'Kindly check the data privacy policy.');

        }
        
        else if($chk4 == "")
        {
            $this->form_validation->set_message('checkDPP', 'Data Privacy Field is required.');

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

