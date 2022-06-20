<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    
class Enrollment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //load model
        $this->load->model('Enrollment_model', 'auth');
        $this->load->library('csvimport');
        $this->load->library('form_validation');
    }

 //------------- LOAD VIEW -------------//
  
function addNewEnrollment()
{
    $data = array();

    $data['faculty'] = $this->auth->getAdviser();
    $data['student'] = $this->auth->getStudentList();

    $this->load->view('templates/adminheader', $data);
    $this->load->view("admin/addNewEnrollment",  $data);
    $this->load->view('templates/adminfooter', $data);  
    
}

function editSchedule($id)
{
    $data = array();

    $data['scheduleInfo'] = $this->auth->getScheduleInfo($id);
    $data['faculty'] = $this->auth->getAdviser();
    $data['subject'] = $this->auth->getSubjectList();
    $data['section'] = $this->auth->getSectionList();

    $this->load->view('templates/adminheader', $data);
    $this->load->view("admin/editSchedule",  $data);
    $this->load->view('templates/adminfooter', $data);  
    
}

 
 //------------- FUNCTION -------------//
    
 function addEnrollment()
 {
            
     $this->form_validation->set_rules('student', 'Student', 'trim|required');
     $this->form_validation->set_rules('gradelevel', 'Grade Level', 'trim|required');
     $this->form_validation->set_rules('section', 'Section', 'trim|required');


     if ($this->form_validation->run() == FALSE) {
         $this->addNewEnrollment();
     } else {
         
         $id = $this->security->xss_clean($this->input->post('student'));
         $gradelevel = $this->security->xss_clean($this->input->post('gradelevel'));
         $section = $this->security->xss_clean($this->input->post('section'));
         $timeStamp = date('Y-m-d');

         $schoolyear =0;

         $row = $this->db->select("*")->where('status',"Active")->get("tbl_schoolyear")->row();
         if (!empty($row->id))
         {
             $schoolyear = $row->id;
         }           
         
         $chk = $this->auth->addEnrollment($id,$schoolyear,$timeStamp);

         $enrollid = $this->db->select("*")->limit(1)->order_by('id',"DESC")->get("tbl_enrollment")->row();

         $schedule = $this->auth->scheduleListingInfo($section, $schoolyear);

         foreach($schedule as $record)
         {
             $this->auth->addSchedule($enrollid->id,$record->id);
         }


         if($chk > 0)
             {
                 $this->session->set_flashdata('success', 'Student Enrolled Successfully');
             }
             else
             {
                 $this->session->set_flashdata('error', 'Student Enrolled failed');
             }

         redirect('enrollment');

     }
     
 }

                    
   
    function enrollmentListing()
    {

        $searchText = $this->security->xss_clean($this->input->post('searchText'));

        $status ="Active";
           
        $count = $this->auth->enrollmentListingCount($searchText,$status);

        $returns = $this->paginationCompress ( "enrollment/enrollmentListing/", $count, 10 );
        
        $data['userRecords'] = $this->auth->enrollmentListing($searchText, $status,$returns["page"], $returns["segment"]);
        

            $this->load->view('templates/adminheader', $data);
            $this->load->view("admin/enrollment",  $data);
            $this->load->view('templates/adminfooter', $data);

    }

    function preenrollmentListing()
    {

        $searchText = $this->security->xss_clean($this->input->post('searchText'));

        $status ="Requested";
           
        $count = $this->auth->enrollmentListingCount($searchText,$status);

        $returns = $this->paginationCompress ("enrollment/enrollmentListing/", $count, 10 );
        
        $data['userRecords'] = $this->auth->enrollmentListing($searchText, $status,$returns["page"], $returns["segment"]);
        

            $this->load->view('templates/adminheader', $data);
            $this->load->view("admin/preenrollment",  $data);
            $this->load->view('templates/adminfooter', $data);

    }

    function approvedRequest($id)
    {
        $timeStamp = date('Y-m-d');
                        
                $studentInfo = array('id'=>$id,'date_enrolled'=>$timeStamp,'status'=>'Active',);
                
                $result = $this->auth->editEnrollment($studentInfo, $id);

                $student = $this->auth->getStudentInfo($id);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Student Data Updated.');                 

                    $this->auth->SendEmailRegistration($student->firstname,$student->lastname,$student->email);

                    redirect('enrollment');
                   
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
                
                $result = $this->auth->editEnrollment($studentInfo, $id);

                $student = $this->auth->getStudentInfo($id);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Student Data Updated.');                 

                    $this->auth->SendEmailRegistrationDec($student->firstname,$student->lastname,$student->email);

                    redirect('enrollment');
                   
                }

                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');

                    $this->editStudent($id);
              
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

       public function getSubject(){
        if($this->input->post('gradelevel'))
           {
   
           echo $this->auth->getSubject($this->input->post('gradelevel'));
           }
   
       }

       public function getSection(){
        if($this->input->post('gradelevel'))
           {
   
           echo $this->auth->getSection($this->input->post('gradelevel'));
           }
   
       }

       function load_sched()
       {
        $schoolyear =0;

        $row = $this->db->select("*")->where('status',"Active")->get("tbl_schoolyear")->row();
        if (!empty($row->id))
        {
            $schoolyear = $row->id;
        }  

           $result = $this->auth->getScheduleList($this->input->post('section'),$schoolyear);
           $output = '
           
           <h3 align="center">Schedule List</h3>	
           <table class="table table-hover">
           <thead>
               <tr>
                    <th>ID</th>                     
                    <th>Subject</th>
                    <th>Room</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Teacher</th>               
               </tr>
           </thead>
           <tbody>
           ';
           if(!empty($result))
           {
               foreach($result as $record)
               {
                   $output .= '
                   <tr>
                           <td>'.$record->id.'</td>
                           <td>'.$record->subject.'</td>
                           <td>'.$record->room.'</td>
                           <td>'.$record->day.'</td>
                           <td>'.$record->time.'</td>
                           <td>'.$record->name.'</td>
                           ';
   
                               $output .= '
                       
                       </tr>
                       ';
                       
                   }
               }
                   $output .= '
   
                       </tbody>
                       </table>';
           echo $output;
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

