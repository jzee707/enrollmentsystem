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

    $id = "";
    $semester = "";

    $row1 = $this->db->select("*")->where('status',"Active")->get("tbl_semester")->row();
            if (!empty($row1->id))
            {
                $semester = $row1->semester;
            }

    $data['faculty'] = $this->auth->getAdviser();
    $data['student'] = $this->auth->getStudentList($id);
    $data['grade'] = $this->auth->getGradeLevel($semester);


    $this->load->view('templates/adminheader', $data);
    $this->load->view("admin/addNewEnrollment",  $data);
    $this->load->view('templates/adminfooter', $data);  
    
}

function editEnrollment($id)
{
    $data = array();

    $data['enrollmentInfo'] = $this->auth->getEnrollmentInfo($id);
    $data['section'] = $this->auth->getSectionEdit($id);
    $data['faculty'] = $this->auth->getAdviser();
    $data['student'] = $this->auth->getStudentList($id);
    $data['grade'] = $this->auth->getGradeLevel("");


    $this->load->view('templates/adminheader', $data);
    $this->load->view("admin/editEnrollment",  $data);
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
         $etype = $this->security->xss_clean($this->input->post('stype'));
         $strand = $this->security->xss_clean($this->input->post('strand'));
         $status = $this->security->xss_clean($this->input->post('status'));
         $schedid = $this->security->xss_clean($this->input->post('schedid'));
         $timeStamp = date('Y-m-d');


         $row = $this->db->select("*")->where('status',"Active")->get("tbl_schoolyear")->row();
         if (!empty($row->id))
         {
             $schoolyear = $row->id;
         }      
         
         $semester = "";

         if($gradelevel == "Grade 11" || $gradelevel == "Grade 12")
        {
            $row1 = $this->db->select("*")->where('status',"Active")->get("tbl_semester")->row();
            if (!empty($row1->id))
            {
                $semester = $row1->semester;
            }
        }

        else
        {
            $semester = "";

        }
       
         
         $chk = $this->auth->addEnrollment($id,$schoolyear,$timeStamp,$etype,$strand,$semester,$status);

         $enrollid = $this->db->select("*")->limit(1)->order_by('id',"DESC")->get("tbl_enrollment")->row();

         if($etype == "Regular")
         {

          $schedule = $this->auth->scheduleListingInfo($section, $schoolyear,$semester,$gradelevel);

          foreach($schedule as $record)
          {
              $this->auth->addSchedule($enrollid->id,$record->id);
          }

         }

         else
         {
            for ($i = 0; $i < count($schedid) ; $i++) 
            {
                $this->auth->addSchedule($enrollid->id, $schedid[$i]);
          
            }

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


 function editOldEnrollment()
    {
        $sid = $this->input->post('sid');
               
        $this->form_validation->set_rules('student', 'Student', 'trim|required');
        $this->form_validation->set_rules('gradelevel', 'Grade Level', 'trim|required');
        $this->form_validation->set_rules('section', 'Section', 'trim|required');

 
        if ($this->form_validation->run() == FALSE) {
            $this->editEnrollment($id);
        } else {
            
            $id = $this->security->xss_clean($this->input->post('student'));
            $gradelevel = $this->security->xss_clean($this->input->post('gradelevel'));
            $section = $this->security->xss_clean($this->input->post('section'));
            $etype = $this->security->xss_clean($this->input->post('stype'));
            $strand = $this->security->xss_clean($this->input->post('strand'));
            $status = $this->security->xss_clean($this->input->post('status'));
            $timeStamp = date('Y-m-d');

            $schoolyear = 0;

            $row = $this->db->select("*")->where('status',"Active")->get("tbl_schoolyear")->row();
            if (!empty($row->id))
            {
                $schoolyear = $row->id;
            }

            $semester = "";

            if($gradelevel == "Grade 11" || $gradelevel == "Grade 12")
            {
                $row1 = $this->db->select("*")->where('status',"Active")->get("tbl_semester")->row();
                if (!empty($row1->id))
                {
                    $semester = $row1->semester;
                }
            }

            else
            {
                $semester = "";

            }

                                            
            $enrollmentInfo = array('studentid'=>$id,'type'=>$etype,'strandid'=>$strand,'status'=>$status);

            $this->auth->deleteEnrollment($sid);
                    
            $result = $this->auth->editEnrollment($enrollmentInfo, $sid);

            $schedule = $this->auth->scheduleListingInfo($section, $schoolyear,$semester,$gradelevel);

            foreach($schedule as $record)
            {
                $this->auth->addSchedule($sid,$record->id);
            }
        
            if($result == true)
            {
                $this->session->set_flashdata('success', 'Enrollment Data Updated.');

                redirect('enrollment');
            }

            else
            {
                $this->session->set_flashdata('error', 'User updation failed');

                
        
            }

          

        }
        
    }

 function archiveenrollment($id)
 {
                     
             $studentInfo = array('id'=>$id,'status'=>'Inactive',);
             
             $result = $this->auth->editEnrollment($studentInfo, $id);

             
             if($result == true)
             {
                 $this->session->set_flashdata('success', 'Faculty Data Archived.');                 

                 redirect('archivedenrollment');
                
             }

             else
             {
                 $this->session->set_flashdata('error', 'User updation failed');

                 redirect('archivedenrollment');
           
             }
     
 }

 function retreieveenrollment($id)
 {
                     
             $studentInfo = array('id'=>$id,'status'=>'Active',);
             
             $result = $this->auth->editEnrollment($studentInfo, $id);

             
             if($result == true)
             {
                 $this->session->set_flashdata('success', 'Faculty Data Restored.');                 

                 redirect('enrollment');
                
             }

             else
             {
                 $this->session->set_flashdata('error', 'User updation failed');

                 redirect('enrollment');
           
             }
     
 }


    function enrollmentListing()
    {

        $searchText = $this->security->xss_clean($this->input->post('searchText'));

        $status ="Active";

        $schoolyear =0;
    
        $row = $this->db->select("*")->where('status',"Active")->get("tbl_schoolyear")->row();
        if (!empty($row->id))
        {
            $schoolyear = $row->id;
        }

        $semester = "";
    
        $row1 = $this->db->select("*")->where('status',"Active")->get("tbl_semester")->row();
        if (!empty($row1->id))
        {
            $semester = $row1->semester;
        }
           
        $count = $this->auth->enrollmentListingCount($searchText,$status,$schoolyear,$semester);

        $returns = $this->paginationCompress ( "enrollment/enrollmentListing/", $count, 10 );
        
        $data['userRecords'] = $this->auth->enrollmentListing($searchText, $status,$schoolyear,$semester,$returns["page"], $returns["segment"]);
        

            $this->load->view('templates/adminheader', $data);
            $this->load->view("admin/enrollment",  $data);
            $this->load->view('templates/adminfooter', $data);

    }

    function enrollmentArchivedListing()
    {

        $searchText = $this->security->xss_clean($this->input->post('searchText'));

        $status ="Inactive";

        $schoolyear =0;
    
        $row = $this->db->select("*")->where('status',"Active")->get("tbl_schoolyear")->row();
        if (!empty($row->id))
        {
            $schoolyear = $row->id;
        }

        $semester = "";
    
        $row1 = $this->db->select("*")->where('status',"Active")->get("tbl_semester")->row();
        if (!empty($row1->id))
        {
            $semester = $row1->semester;
        }
           
        $count = $this->auth->enrollmentListingCount($searchText,$status,$schoolyear,$semester);

        $returns = $this->paginationCompress ( "enrollment/enrollmentArchivedListing/", $count, 10 );
        
        $data['userRecords'] = $this->auth->enrollmentListing($searchText, $status,$schoolyear,$semester,$returns["page"], $returns["segment"]);
        

            $this->load->view('templates/adminheader', $data);
            $this->load->view("admin/archivedenrollment",  $data);
            $this->load->view('templates/adminfooter', $data);

    }

    function preenrollmentArchivedListing()
    {

        $searchText = $this->security->xss_clean($this->input->post('searchText'));

        $status ="Declined";

        $schoolyear =0;
    
        $row = $this->db->select("*")->where('status',"Active")->get("tbl_schoolyear")->row();
        if (!empty($row->id))
        {
            $schoolyear = $row->id;
        }

        $semester = "";
    
        $row1 = $this->db->select("*")->where('status',"Active")->get("tbl_semester")->row();
        if (!empty($row1->id))
        {
            $semester = $row1->semester;
        }
           
        $count = $this->auth->enrollmentListingCount($searchText,$status,$schoolyear,$semester);

        $returns = $this->paginationCompress ( "enrollment/preenrollmentArchivedListing/", $count, 10 );
        
        $data['userRecords'] = $this->auth->enrollmentListing($searchText, $status,$schoolyear,$semester,$returns["page"], $returns["segment"]);
        

            $this->load->view('templates/adminheader', $data);
            $this->load->view("admin/archivedpreenrollment",  $data);
            $this->load->view('templates/adminfooter', $data);

    }

    function preenrollmentListing()
    {

        $searchText = $this->security->xss_clean($this->input->post('searchText'));

        $status ="Requested";
        $schoolyear =0;
    
        $row = $this->db->select("*")->where('status',"Active")->get("tbl_schoolyear")->row();
        if (!empty($row->id))
        {
            $schoolyear = $row->id;
        }

        $semester = "";
    
        $row1 = $this->db->select("*")->where('status',"Active")->get("tbl_semester")->row();
        if (!empty($row1->id))
        {
            $semester = $row1->semester;
        }
           
        $count = $this->auth->enrollmentListingCount($searchText,$status,$schoolyear,$semester);

        $returns = $this->paginationCompress ( "enrollment/preenrollmentListing/", $count, 10 );
        
        $data['userRecords'] = $this->auth->enrollmentListing($searchText, $status,$schoolyear,$semester,$returns["page"], $returns["segment"]);
        

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

    function restoreRequest($id)
    {
                        
                $studentInfo = array('id'=>$id,'status'=>'Requested',);
                
                $result = $this->auth->editEnrollment($studentInfo, $id);

                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Enrollment Data Updated.');                 

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
            $schoolyear = 0;
            $gradelevel = $this->input->post('gradelevel');

            $row = $this->db->select("*")->where('status',"Active")->get("tbl_schoolyear")->row();
            if (!empty($row->id))
            {
                $schoolyear = $row->id;
            }

            $semester = "";

            if($gradelevel == "Grade 11" || $gradelevel == "Grade 12")
            {
                $row1 = $this->db->select("*")->where('status',"Active")->get("tbl_semester")->row();
                if (!empty($row1->id))
                {
                    $semester = $row1->semester;
                }
            }

            else
            {
                $semester = "";

            }

   
           echo $this->auth->getSection($this->input->post('gradelevel'),$schoolyear,$semester);
           }
   
       }


       public function getSectionSHS(){
        if($this->input->post('gradelevel'))
           {

            $schoolyear = 0;
            $gradelevel = $this->input->post('gradelevel');

            $row = $this->db->select("*")->where('status',"Active")->get("tbl_schoolyear")->row();
            if (!empty($row->id))
            {
                $schoolyear = $row->id;
            }

            $semester = "";

            if($gradelevel == "Grade 11" || $gradelevel == "Grade 12")
            {
                $row1 = $this->db->select("*")->where('status',"Active")->get("tbl_semester")->row();
                if (!empty($row1->id))
                {
                    $semester = $row1->semester;
                }
            }

            else
            {
                $semester = "";

            }
   
           echo $this->auth->getSectionSHS($this->input->post('gradelevel'),$schoolyear,$semester,$this->input->post('strand'));
           }
   
       }

       public function getStrand(){
        if($this->input->post('gradelevel'))
           {
   
           echo $this->auth->getStrand($this->input->post('gradelevel'));
           }
   
       }

       function load_allsched()
       {
        $schoolyear =0;
        
        $schedid = $this->input->post('schedid');

        $row = $this->db->select("*")->where('status',"Active")->get("tbl_schoolyear")->row();
        if (!empty($row->id))
        {
            $schoolyear = $row->id;
        }  

        $semester = "";

        $row1 = $this->db->select("*")->where('status',"Active")->get("tbl_semester")->row();
        if (!empty($row1->id))
        {
            $semester = $row1->semester;
        }

           $result = $this->auth->getAllScheduleList($this->input->post('gradelevel'),$this->input->post('strand'),$schoolyear,$semester);
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
                    <th>Grade Level</th> 
                       
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
                    <td>'.date("h:i A", strtotime($record->timefrom)) . ' - ' . date("h:i A", strtotime($record->timeto)).'</td>
                    <td>'.$record->name.'</td>
                    <td>'.$record->gradelevel.'</td>
                    <td><a class="btn btn-sm btn-info" id="addSched" title="Add Subject">Add Subject</a></td>

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

       function load_sched()
       {

        $schoolyear = 0;

        $row = $this->db->select("*")->where('status',"Active")->get("tbl_schoolyear")->row();
        if (!empty($row->id))
        {
            $schoolyear = $row->id;
        }  

        $semester = "";

        $row1 = $this->db->select("*")->where('status',"Active")->get("tbl_semester")->row();
        if (!empty($row1->id))
        {
            $semester = $row1->semester;
        }

           $result = $this->auth->getScheduleList($this->input->post('gradelevel'),$this->input->post('section'),$schoolyear,$semester);
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
                           <td>'.date("h:i A", strtotime($record->timefrom)) . ' - ' . date("h:i A", strtotime($record->timeto)).'</td>
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

       function load_schedirg()
       {

        $etype = $this->input->post('etype');

        $schoolyear =0;

        $row = $this->db->select("*")->where('status',"Active")->get("tbl_schoolyear")->row();
        if (!empty($row->id))
        {
            $schoolyear = $row->id;
        }  

        $row1 = $this->db->select("*")->where('status',"Active")->get("tbl_semester")->row();
        if (!empty($row1->id))
        {
            $semester = $row1->semester;
        }

           $result = $this->auth->getScheduleList($this->input->post('gradelevel'),$this->input->post('section'),$schoolyear,$semester);
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
                    <th class="text-center"></th>                 
               </tr>
           </thead>
           <tbody id="table_data">
           ';
           if(!empty($result))
           {
               foreach($result as $record)
               {
                   $output .= '
                   <tr>
                           <td><input type="hidden" name="schedid[]" value="'. $record->id.'" >'.$record->id.'</td>
                           <td>'.$record->subject.'</td>
                           <td>'.$record->room.'</td>
                           <td>'.$record->day.'</td>
                           <td>'.date("h:i A", strtotime($record->timefrom)) . ' - ' . date("h:i A", strtotime($record->timeto)).'</td>
                           <td>'.$record->name.'</td>
                           <td><a class="btn btn-sm btn-info" name="btn-remove" id="btn-remove" title="Remove Subject"><i class="fa fa-trash"></i></a></td>

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

