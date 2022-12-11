<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    require_once(FCPATH.'application/libraries/Tcpdf/Tcpdf.php');

    
class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //load model
        $this->load->model('Admin_model', 'auth');
        $this->load->library('csvimport');
        $this->load->library('form_validation');
    }

 //------------- LOAD VIEW -------------//
  

 public function login() {     
        
    $isLoggedIn = $this->session->userdata('WCIisLoggedIn');
        
    if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
    {
             
        $data = array();
        
        $this->load->view('templates/header', $data);
        $this->load->view('auth/login', $data);
        $this->load->view('templates/footer', $data);
    }
    else
    {
        $usertype = $this->session->userdata('usertype');

        if($usertype == "Administrator"){
           
            redirect('dashboard');
        }    
    }

    
    }

 
    public function dashboard() {     

        $isLoggedIn = $this->session->userdata('WCIisLoggedIn');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
                           
            redirect('login');
        }
        else
        {
            $usertype = $this->session->userdata('usertype');
    
            if($usertype == "Administrator"){

                $data = array();

                $data['dashboardInfo'] = $this->auth->getTotal();

                
                $this->load->view('templates/adminheader', $data);
                $this->load->view('admin/dashboard', $data);
                $this->load->view('templates/adminfooter', $data);
        
                
            }
                
    }

}

public function strand() {     

            $data = array();

            $this->load->view('templates/adminheader', $data);
            $this->load->view('admin/strand', $data);
            $this->load->view('templates/adminfooter', $data);
               

}

function addNewStrand()
{
    $data = array();

    $this->load->view('templates/adminheader', $data);
    $this->load->view("admin/addNewStrand",  $data);
    $this->load->view('templates/adminfooter', $data);
    
    
}

function editStrand($id)
{
    $data = array();

    $data['strandInfo'] = $this->auth->getStrandInfo($id);

    $this->load->view('templates/adminheader', $data);
    $this->load->view("admin/editStrand",  $data);
    $this->load->view('templates/adminfooter', $data);  
    
}


function addNewSchoolYear()
{
    $data = array();

    $this->load->view('templates/adminheader', $data);
    $this->load->view("admin/addNewSchoolYear",  $data);
    $this->load->view('templates/adminfooter', $data);
    
    
}

function editSchoolYear($id)
{
    $data = array();

    $data['strandInfo'] = $this->auth->getSchoolYearInfo($id);

    $this->load->view('templates/adminheader', $data);
    $this->load->view("admin/editSchoolYear",  $data);
    $this->load->view('templates/adminfooter', $data);  
    
}

function addNewSection()
{
    $data = array();

    $data['faculty'] = $this->auth->getAdviser();

    $this->load->view('templates/adminheader', $data);
    $this->load->view("admin/addNewSection",  $data);
    $this->load->view('templates/adminfooter', $data);
    
    
}

function editSection($id)
{
    $data = array();

    $data['strandInfo'] = $this->auth->getSectionInfo($id);
    $data['faculty'] = $this->auth->getAdviser();
    $data['strand'] = $this->auth->getStrandList();

    $this->load->view('templates/adminheader', $data);
    $this->load->view("admin/editSection",  $data);
    $this->load->view('templates/adminfooter', $data);  
    
}
public function changepassword() {     
        
    $isLoggedIn = $this->session->userdata('WCIisLoggedIn');
        
    if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
    {
             
        $data = array();
        
        $this->load->view('templates/header', $data);
        $this->load->view('auth/login', $data);
        $this->load->view('templates/footer', $data);
    }
    else
    {
        $usertype = $this->session->userdata('usertype');

        if($usertype == "Administrator"){

            $data = array();
           
            $this->load->view('templates/adminheader', $data);
            $this->load->view('admin/changepassword', $data);
            $this->load->view('templates/adminfooter', $data);
        }    

        else if($usertype == "Teacher"){   
            
            $data = array();
        
            $this->load->view('templates/teacherheader', $data);
            $this->load->view('admin/changepassword', $data);
            $this->load->view('templates/userfooter', $data);

        }

        else if($usertype == "Student"){    
            
            $data = array();
        
            $this->load->view('templates/userheader', $data);
            $this->load->view('admin/changepassword', $data);
            $this->load->view('templates/userfooter', $data);

        }
    }

    
    }

    public function account() {    
        
            $usertype = $this->session->userdata('usertype');
            $id = $this->session->userdata('id');
    
            if($usertype == "Administrator"){
               
                $data = array();             

                $data['accountinfo'] = $this->auth->getFacultyInfo($id);

                $this->load->view('templates/adminheader', $data);
                $this->load->view('admin/account', $data);
                $this->load->view('templates/adminfooter', $data);

             }
            
            else if($usertype == "Teacher"){
               
                $data = array();
  
                $data['accountinfo'] = $this->auth->getFacultyInfo($id);
        
                $this->load->view('templates/teacherheader', $data);
                $this->load->view('admin/account', $data);
                $this->load->view('templates/adminfooter', $data);
            }         

}

    public function myaccount() {     
        
        $isLoggedIn = $this->session->userdata('WCIisLoggedIn');
            
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            $data = array();
            
            $this->load->view('templates/header', $data);
            $this->load->view('auth/login', $data);
            $this->load->view('templates/footer', $data);

            
        }
                 
        else
        {

            $usertype = $this->session->userdata('usertype');
    
            if($usertype == "Administrator"){
               
                redirect('account');
            }
            
            else if($usertype == "Teacher"){
               
                redirect('account');
            } 

            else if($usertype == "Student"){
               
                redirect('studentaccount');
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
    
 function addStrand()
    {
               
        $this->form_validation->set_rules('strandcode', 'Strand Code', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');


 
        if ($this->form_validation->run() == FALSE) {
            $this->addNewStrand();
        } else {
            
            $strandcode = $this->security->xss_clean($this->input->post('strandcode'));
            $description = $this->security->xss_clean($this->input->post('description'));
            $status = 'Active';
            $timeStamp = date('Y-m-d');
            
                       
            $this->auth->setStrandCode($strandcode);  
            $this->auth->setDescription($description);
            $this->auth->setStatus($status);
            
            $chk = $this->auth->addNewStrand();

            if($chk > 0)
                {
                    $this->session->set_flashdata('success', 'New Strand Added Successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Strand creation failed');
                }

            redirect('strand');

        }
        
    }

    function editOldStrand()
    {
            
            $id = $this->input->post('sid');

            $this->form_validation->set_rules('strandcode', 'Strand Code', 'trim|required');
            $this->form_validation->set_rules('description', 'Description', 'trim|required');
                           
                    
      
            if($this->form_validation->run() == FALSE)
            {
                
                $this->editStrand($id);

            }
            else
            {
                $strandcode = $this->security->xss_clean($this->input->post('strandcode'));
                $description = $this->security->xss_clean($this->input->post('description'));
                
                $timeStamp = date('Y-m-d');
                
                
                $strandInfo = array('strandcode'=>$strandcode,'description'=>$description);
                
                $result = $this->auth->editStrand($strandInfo, $id);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Strand Data Updated.');

                    redirect('strand');
                   
                }

                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');

                    $this->editStrand($id);
              
                }
                
                
                
            }
        
    }

    function addSchoolYear()
    {
               
        $this->form_validation->set_rules('yearstart', 'School Year Start', 'trim|required|callback_checkSchoolyear');
        $this->form_validation->set_rules('yearend', 'School Year End', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

 
        if ($this->form_validation->run() == FALSE) {
            $this->addNewSchoolYear();
        } else {
            
            $yearstart = $this->security->xss_clean($this->input->post('yearstart'));
            $yearend = $this->security->xss_clean($this->input->post('yearend'));
            $status = $this->security->xss_clean($this->input->post('status'));
            $timeStamp = date('Y-m-d');
            
                       
            $this->auth->setYearStart($yearstart);  
            $this->auth->setYearEnd($yearend);
            $this->auth->setStatus($status);

            if($status == 'Active')
            {
                $strandInfo = array('status'=>'Inactive');
                
                $result = $this->auth->editSYInactive($strandInfo);
                
            }
            
            $chk = $this->auth->addNewSchoolYear();

            if($chk > 0)
                {
                    $this->session->set_flashdata('success', 'New School Year Added Successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'School Year creation failed');
                }

            redirect('schoolyear');

        }
        
    }

    function editOldSchoolYear()
    {
            
            $id = $this->input->post('sid');

            $this->form_validation->set_rules('yearstart', 'School Year Start', 'trim|required');
            $this->form_validation->set_rules('yearend', 'School Year End', 'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');         
                    
      
            if($this->form_validation->run() == FALSE)
            {
                
                $this->editSchoolYear($id);

            }
            else
            {
                $yearstart = $this->security->xss_clean($this->input->post('yearstart'));
                $yearend = $this->security->xss_clean($this->input->post('yearend'));
                $status = $this->security->xss_clean($this->input->post('status'));
                $timeStamp = date('Y-m-d');
                
                
                $strandInfo = array('schoolyear'=> date("Y", strtotime($yearstart)) . ' - '.date("Y", strtotime($yearend)),'datefrom'=>$yearstart,'dateto'=>$yearend,'status'=>$status);
                
                $result = $this->auth->editSchooLYear($strandInfo, $id);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'School Year Data Updated.');

                    redirect('schoolyear');
                   
                }

                else
                {
                    $this->session->set_flashdata('error', 'School Year updation failed');

                    $this->editSchoolYear($id);
              
                }
                
                
                
            }
        
    }

    function addSection()
    {
               
        $this->form_validation->set_rules('gradelevel', 'Grade Level', 'trim|required');
        $this->form_validation->set_rules('section', 'Section', 'trim|required');
        $this->form_validation->set_rules('adviser', 'Adviser', 'trim|required');
        $this->form_validation->set_rules('limit', 'Limit', 'trim|required');

 
        if ($this->form_validation->run() == FALSE) {
            $this->addNewSection();
        } else {
            
            $gradelevel = $this->security->xss_clean($this->input->post('gradelevel'));
            $section = $this->security->xss_clean($this->input->post('section'));
            $adviser = $this->security->xss_clean($this->input->post('adviser'));
            $strand = $this->security->xss_clean($this->input->post('strand'));
            $limit = $this->security->xss_clean($this->input->post('limit'));
            $status = 'Active';
            $timeStamp = date('Y-m-d');
            
                       
            $this->auth->setStrandCode($strand);  
            $this->auth->setGradelevel($gradelevel);
            $this->auth->setSection($section);
            $this->auth->setAdviser($adviser);
            $this->auth->setLimit($limit);
            $this->auth->setStatus($status);
            
            $chk = $this->auth->addNewSection();

            if($chk > 0)
                {
                    $this->session->set_flashdata('success', 'New Section Added Successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Section creation failed');
                }

            redirect('section');

        }
        
    }

    function editOldSection()
    {
            
            $id = $this->input->post('sid');

            $this->form_validation->set_rules('gradelevel', 'Grade Level', 'trim|required');
            $this->form_validation->set_rules('section', 'Section', 'trim|required');
            $this->form_validation->set_rules('adviser', 'Adviser', 'trim|required');
            $this->form_validation->set_rules('limit', 'Limit', 'trim|required');
             
                    
      
            if($this->form_validation->run() == FALSE)
            {
                
                $this->editSection($id);

            }
            else
            {
                $gradelevel = $this->security->xss_clean($this->input->post('gradelevel'));
                $section = $this->security->xss_clean($this->input->post('section'));
                $adviser = $this->security->xss_clean($this->input->post('adviser'));
                $limit = $this->security->xss_clean($this->input->post('limit'));
                $strand = $this->security->xss_clean($this->input->post('strand'));
                $status = $this->security->xss_clean($this->input->post('status'));
                $timeStamp = date('Y-m-d');
                
                
                $strandInfo = array('gradelevel'=>$gradelevel,'section'=>$section,'adviserid'=>$adviser, 'level'=>$limit,'strandid'=>$strand);
                
                $result = $this->auth->editSection($strandInfo, $id);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Section Data Updated.');

                    redirect('section');
                   
                }

                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');

                    $this->editSection($id);
              
                }

            }
        
    }
                    
        public function loginMe()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            $this->login();
        }

        else {

            $email = $this->input->post('email');
            $password = $this->input->post('password');
            
            $result = $this->auth->login($email, $password);
                   
            
            if($result->status == "Active")
            {
                      
                $sessionArray = array('id'=>$result->user_id,                    
                'name'=>$result->name,
                'password'=>$result->password,
                'usertype'=>$result->usertype,
                'WCIisLoggedIn' => TRUE
                 );

                 $this->session->set_userdata($sessionArray);

                 if($result->usertype == "Administrator")
                 {
                    redirect('dashboard');
                   
                 }

                 else if($result->usertype == "Student")
                 {
                    $student = $this->auth->getStudentData($result->user_id);

                    if(!empty($student))
                    {

                        if($student->status=="Requested")
                        {
                            redirect('registrationrequest');
                            //$this->registration($student->id);
                        
                        }

                        else if($student->status=="Active")
                        {
                            redirect('studentdashboard');

                        }  
                        
                        else
                        {
                            redirect('registration');

                        }
                    
                    }

                    else
                    {
                        redirect('registration');

                    }

                 }

                 else if($result->usertype == "Teacher")
                 {
                    redirect('teacherdashboard');

                 }
                
            }

            else if($result->status == "Inactivated")
            {
                $this->session->set_flashdata('error', 'Your account was not verified. Please verified your account.');
                
                redirect('adminpanel');

            }

            else
            {
                $this->session->set_flashdata('error', 'Username or password mismatch');
                
                redirect('adminpanel');
            }

        }
                    
        
    }

    function activeSemester($id)
    {

                $sem = array('status'=>'Inactive');
                
                $result = $this->auth->InactiveSem($sem, $id);

                        
                $studentInfo = array('status'=>'Active');
                
                $result = $this->auth->editSemester($studentInfo, $id);

                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Semester Updated.');                 

                
                    redirect('semester');
                   
                }

                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');
              
                }
        
    }

    function activeSchoolyear($id)
    {

                $sem = array('status'=>'Inactive');
                
                $result = $this->auth->InactiveSchoolyear($sem, $id);

                        
                $studentInfo = array('status'=>'Active');
                
                $result = $this->auth->editSchooLYear($studentInfo, $id);

                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'School Year Updated.');                 

                
                    redirect('schoolyear');
                   
                }

                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');
              
                }
        
    }

    function changedpassword()
    {

            $id = $this->session->userdata('id');
            $usertype = $this->session->userdata('usertype');
                        
            $this->form_validation->set_rules('password', 'New Password', 'trim|required');
            $this->form_validation->set_rules('copassword', 'Confirm Password', 'trim|required|callback_checkPassword');             
                    
      
            if($this->form_validation->run() == FALSE)
            {
                
                $this->changepassword();

            }
            else
            {
                $password = $this->security->xss_clean($this->input->post('password'));
                $copassword = $this->security->xss_clean($this->input->post('copassword'));
                
                $strandInfo = array('password'=>$password);
                
                $result = $this->auth->changepassword($strandInfo, $id);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Password was Updated.');

                    redirect('changepassword');
                   
                }

                else
                {
                    $this->session->set_flashdata('error', 'Password updation failed');

                    $this->changepassword();
              
                }
                                            
            }       
    }

    function checkSchoolyear() {

        $yearstart = new DateTime($this->input->post('yearstart'));
        $yearend = new DateTime($this->input->post('yearend'));

        $abs_diff = $yearend->diff($yearstart)->format('%a');; //3

       
        if ($abs_diff < 364) {

            $this->form_validation->set_message('checkSchoolyear', 'School Year Date must exceed to a year above.');

            return FALSE;
        }

        else
        {
            return TRUE;
        }
       
     
       } 

    function strandListing()
    {

        $searchText = $this->security->xss_clean($this->input->post('searchText'));
           
        $status ="Active";

        $count = $this->auth->strandListingCount($searchText,$status);

    
        $returns = $this->paginationCompress ("admin/strandListing/", $count, 10 );
        
        $data['userRecords'] = $this->auth->strandListing($searchText, $status,$returns["page"], $returns["segment"]);
        

            $this->load->view('templates/adminheader', $data);
            $this->load->view("admin/strand",  $data);
            $this->load->view('templates/adminfooter', $data);

    }

    function strandArchivedListing()
    {

        $searchText = $this->security->xss_clean($this->input->post('searchText'));

        $status ="Inactive";
           
        $count = $this->auth->strandListingCount($searchText,$status);

        $returns = $this->paginationCompress ("admin/strandArchivedListing/", $count, 10 );
        
        $data['userRecords'] = $this->auth->strandListing($searchText, $status,$returns["page"], $returns["segment"]);
        

            $this->load->view('templates/adminheader', $data);
            $this->load->view("admin/archivedstrand",  $data);
            $this->load->view('templates/adminfooter', $data);

    }

    function schoolyearListing()
    {

        $searchText = $this->security->xss_clean($this->input->post('searchText'));
           
        $count = $this->auth->schoolyearListingCount($searchText);

        $returns = $this->paginationCompress ("admin/schoolyearListing/", $count, 10 );
        
        $data['userRecords'] = $this->auth->schoolyearListing($searchText, $returns["page"], $returns["segment"]);
        

            $this->load->view('templates/adminheader', $data);
            $this->load->view("admin/schoolyear",  $data);
            $this->load->view('templates/adminfooter', $data);

    }

    function sectionListing()
    {

        $searchText = $this->security->xss_clean($this->input->post('searchText'));

        $status ="Active";
           
        $count = $this->auth->sectionListingCount($searchText,$status);

        $returns = $this->paginationCompress ("admin/sectionListing/", $count, 10 );
        
        $data['userRecords'] = $this->auth->sectionListing($searchText, $status, $returns["page"], $returns["segment"]);
        

            $this->load->view('templates/adminheader', $data);
            $this->load->view("admin/section",  $data);
            $this->load->view('templates/adminfooter', $data);

    }

    function sectionArchivedListing()
    {

        $searchText = $this->security->xss_clean($this->input->post('searchText'));

        $status ="Inactive";
           
        $count = $this->auth->sectionListingCount($searchText,$status);

        $returns = $this->paginationCompress ("admin/sectionArchivedListing/", $count, 10 );
        
        $data['userRecords'] = $this->auth->sectionListing($searchText, $status, $returns["page"], $returns["segment"]);
        

            $this->load->view('templates/adminheader', $data);
            $this->load->view("admin/archivedsection",  $data);
            $this->load->view('templates/adminfooter', $data);

    }

    function semesterListing()
    {
          
        $count = $this->auth->semesterListingCount();

        $returns = $this->paginationCompress ("admin/semesterListing/", $count, 10 );
        
        $data['userRecords'] = $this->auth->semesterListing($returns["page"], $returns["segment"]);
        

            $this->load->view('templates/adminheader', $data);
            $this->load->view("admin/semester",  $data);
            $this->load->view('templates/adminfooter', $data);

    }

    function archivestrand()
    {
        $id = $this->security->xss_clean($this->input->post('archiveid'));
                        
                $studentInfo = array('id'=>$id,'status'=>'Inactive',);
                
                $result = $this->auth->editStrand($studentInfo, $id);

                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Strand Data Archived.');                 

                    redirect('strand');
                   
                }

                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');

                    redirect('strand');
              
                }
        
    }

    function retrievestrand()
    {
        $id = $this->security->xss_clean($this->input->post('archiveid'));
                        
                $studentInfo = array('id'=>$id,'status'=>'Active',);
                
                $result = $this->auth->editStrand($studentInfo, $id);

                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Strand Data Retrieved.');                 

                    redirect('archivedstrand');
                   
                }

                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');

                    redirect('archivedstrand');
              
                }
        
    }

    function archivesection()
    {
        $id = $this->security->xss_clean($this->input->post('archiveid'));
                        
                $studentInfo = array('id'=>$id,'status'=>'Inactive',);
                
                $result = $this->auth->editSection($studentInfo, $id);

                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Section Data Archived.');                 

                    redirect('section');
                   
                }

                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');

                    redirect('section');
              
                }
        
    }

    function retrievesection()
    {
        $id = $this->security->xss_clean($this->input->post('archiveid'));
                        
                $studentInfo = array('id'=>$id,'status'=>'Active',);
                
                $result = $this->auth->editSection($studentInfo, $id);

                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Section Data Retrieved.');                 

                    redirect('archivedsection');
                   
                }

                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');

                    redirect('archivedsection');
              
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

