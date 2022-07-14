<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    
class Schedule extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //load model
        $this->load->model('Schedule_model', 'auth');
        $this->load->library('csvimport');
        $this->load->library('form_validation');
    }

 //------------- LOAD VIEW -------------//
  
function addNewSchedule()
{
    $data = array();

    $data['faculty'] = $this->auth->getAdviser();
    $data['grade'] = $this->auth->getGradeLevel();

    $this->load->view('templates/adminheader', $data);
    $this->load->view("admin/addNewSchedule",  $data);
    $this->load->view('templates/adminfooter', $data);  
    
}

function editSchedule($id)
{
    $data = array();

    $data['scheduleInfo'] = $this->auth->getScheduleInfo($id);
    $data['faculty'] = $this->auth->getAdviser();
    $data['subject'] = $this->auth->getSubjectList();
    $data['section'] = $this->auth->getSectionList();
    $data['strand'] = $this->auth->getStrandList();

    $this->load->view('templates/adminheader', $data);
    $this->load->view("admin/editSchedule",  $data);
    $this->load->view('templates/adminfooter', $data);  
    
}

 
 //------------- FUNCTION -------------//
    
 function addSchedule()
    {
               
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
        $this->form_validation->set_rules('section', 'Section', 'trim|required');
        $this->form_validation->set_rules('gradelevel', 'Grade Level', 'trim|required');
        $this->form_validation->set_rules('adviser', 'Adviser', 'trim|required');
        $this->form_validation->set_rules('room', 'Room', 'trim|required');
        $this->form_validation->set_rules('day', 'Day', 'trim|required');
        $this->form_validation->set_rules('timestart', 'Time Start', 'trim|required');
        $this->form_validation->set_rules('timeend', 'Time End', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

 
        if ($this->form_validation->run() == FALSE) {
            $this->addNewSchedule();
        } else {
            
            $subject = $this->security->xss_clean($this->input->post('subject'));
            $section = $this->security->xss_clean($this->input->post('section'));
            $gradelevel = $this->security->xss_clean($this->input->post('gradelevel'));
            $adviser = $this->security->xss_clean($this->input->post('adviser'));
            $room = $this->security->xss_clean($this->input->post('room'));
            $day = strtoupper($this->security->xss_clean($this->input->post('day')));
            $timestart = $this->security->xss_clean($this->input->post('timestart'));
            $term = $this->security->xss_clean($this->input->post('term'));
            $timeend = $this->security->xss_clean($this->input->post('timeend'));
            $status = $this->security->xss_clean($this->input->post('status'));
            $timeStamp = date('Y-m-d');

            $schoolyear = 0;

            $row = $this->db->select("*")->where('status',"Active")->get("tbl_schoolyear")->row();
		if (!empty($row->id))
		{
			$schoolyear = $row->id;
		}
            
                       
            $this->auth->setSubject($subject);  
            $this->auth->setSection($section);
            $this->auth->setGradeLevel($gradelevel);
            $this->auth->setAdviser($adviser);
            $this->auth->setRoom($room);
            $this->auth->setDay($day);
            $this->auth->setTimeStart($timestart);
            $this->auth->setTimeEnd($timeend);
            $this->auth->setTerm($term);
            $this->auth->setStatus($status);
            $this->auth->setSchoolYear($schoolyear);
            $this->auth->setTimeStamp($timeStamp);
            
            $chk = $this->auth->addSchedule();

            if($chk > 0)
                {

                    $this->session->set_flashdata('success', 'New Schedule Added Successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Schedule creation failed');
                }

            redirect('schedule');

        }
        
    }

    function editOldSchedule()
    {
        $id = $this->input->post('sid');
               
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
        $this->form_validation->set_rules('section', 'Section', 'trim|required');
        $this->form_validation->set_rules('gradelevel', 'Grade Level', 'trim|required');
        $this->form_validation->set_rules('adviser', 'Adviser', 'trim|required');
        $this->form_validation->set_rules('room', 'Room', 'trim|required');
        $this->form_validation->set_rules('day', 'Day', 'trim|required');
        $this->form_validation->set_rules('timestart', 'Time Start', 'trim|required');
        $this->form_validation->set_rules('timeend', 'Time End', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

 
        if ($this->form_validation->run() == FALSE) {
            $this->editSchedule($id);
        } else {
            
            $subject = $this->security->xss_clean($this->input->post('subject'));
            $section = $this->security->xss_clean($this->input->post('section'));
            $gradelevel = $this->security->xss_clean($this->input->post('gradelevel'));
            $adviser = $this->security->xss_clean($this->input->post('adviser'));
            $room = $this->security->xss_clean($this->input->post('room'));
            $day = strtoupper($this->security->xss_clean($this->input->post('day')));
            $timestart = $this->security->xss_clean($this->input->post('timestart'));
            $term = $this->security->xss_clean($this->input->post('term'));
            $timeend = $this->security->xss_clean($this->input->post('timeend'));
            $status = $this->security->xss_clean($this->input->post('status'));
            $timeStamp = date('Y-m-d');

            $schoolyear = 0;

            $row = $this->db->select("*")->where('status',"Active")->get("tbl_schoolyear")->row();
		if (!empty($row->id))
		{
			$schoolyear = $row->id;
		}
            
                       
           
        $studentInfo = array('subjectid'=>$subject,'sectionid'=>$section,'room'=>$room,'day'=>$day,'timefrom'=>$timestart,'timeto'=>$timeend,'adviserid'=>$adviser,'syid'=>$schoolyear,'term'=>$term,'status'=>$status);
                
        $result = $this->auth->editSchedule($studentInfo, $id);
        
        if($result == true)
        {
            $this->session->set_flashdata('success', 'Schedule Data Updated.');

            redirect('schedule');
           
        }

        else
        {
            $this->session->set_flashdata('error', 'User updation failed');

            $this->editSchedule($id);
      
        }

        }
        
    }

    function editOldJHSubject()
    {
            
            $id = $this->input->post('sid');
                    
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
        $this->form_validation->set_rules('section', 'Section', 'trim|required');
        $this->form_validation->set_rules('gradelevel', 'Grade Level', 'trim|required');
        $this->form_validation->set_rules('adviser', 'Adviser', 'trim|required');
        $this->form_validation->set_rules('room', 'Room', 'trim|required');
        $this->form_validation->set_rules('day', 'Day', 'trim|required');
        $this->form_validation->set_rules('timestart', 'Time Start', 'trim|required');
        $this->form_validation->set_rules('timeend', 'Time End', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');
      
      
            if($this->form_validation->run() == FALSE)
            {
                $this->edit($id);
              

            }
            else
            {

                $subject = $this->security->xss_clean($this->input->post('subject'));
                $section = $this->security->xss_clean($this->input->post('section'));
                $gradelevel = $this->security->xss_clean($this->input->post('gradelevel'));
                $adviser = $this->security->xss_clean($this->input->post('adviser'));
                $room = $this->security->xss_clean($this->input->post('room'));
                $day = $this->security->xss_clean($this->input->post('day'));
                $timestart = $this->security->xss_clean($this->input->post('timestart'));
                $term = $this->security->xss_clean($this->input->post('term'));
                $timeend = $this->security->xss_clean($this->input->post('timeend'));
                $status = $this->security->xss_clean($this->input->post('status'));
                $timeStamp = date('Y-m-d');
              
                
                $studentInfo = array('subject'=>$subject,'description'=>$description,'gradelevel'=>$gradelevel,'type'=>'JHS','status'=>$status);
                
                $result = $this->auth->editJHSubject($studentInfo, $id);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Subject Data Updated.');

                    redirect('jhsubject');
                   
                }

                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');

                    $this->editJHSubject($id);
              
                }
                
                
                
            }
        
    }

    function archiveschedule($id)
    {
                        
                $studentInfo = array('id'=>$id,'status'=>'Inactive',);
                
                $result = $this->auth->editSchedule($studentInfo, $id);

                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Schedule Data Archived.');                 

                    redirect('archivedschedule');
                   
                }

                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');

                    redirect('archivedschedule');
              
                }
        
    }

    function retreieveschedule($id)
    {
                        
                $studentInfo = array('id'=>$id,'status'=>'Active',);
                
                $result = $this->auth->editSchedule($studentInfo, $id);

                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Schedule Data Restored.');                 

                    redirect('schedule');
                   
                }

                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');

                    redirect('schedule');
              
                }
        
    }
                    
   
    function scheduleListing()
    {
        $status = 'Active';

        $searchText = $this->security->xss_clean($this->input->post('searchText'));

        
        $schoolyear =0;
    
        $row = $this->db->select("*")->where('status',"Active")->get("tbl_schoolyear")->row();
        if (!empty($row->id))
        {
            $schoolyear = $row->id;
        }
           
        $count = $this->auth->scheduleListingCount($searchText,$status,$schoolyear);

        $returns = $this->paginationCompress ( "schedule/scheduleListing/", $count, 10 );
        
        $data['userRecords'] = $this->auth->scheduleListing($searchText, $status,$schoolyear,$returns["page"], $returns["segment"]);
        

            $this->load->view('templates/adminheader', $data);
            $this->load->view("admin/schedule",  $data);
            $this->load->view('templates/adminfooter', $data);

    }

    function scheduleArchivedListing()
    {

        $status = 'Inactive';

        $searchText = $this->security->xss_clean($this->input->post('searchText'));
           
        
        $schoolyear =0;
    
        $row = $this->db->select("*")->where('status',"Active")->get("tbl_schoolyear")->row();
        if (!empty($row->id))
        {
            $schoolyear = $row->id;
        }
           
        $count = $this->auth->scheduleListingCount($searchText,$status,$schoolyear);

        $returns = $this->paginationCompress ( "schedule/scheduleListing/", $count, 10 );
        
        $data['userRecords'] = $this->auth->scheduleListing($searchText, $status,$schoolyear,$returns["page"], $returns["segment"]);
        

            $this->load->view('templates/adminheader', $data);
            $this->load->view("admin/archivedschedule",  $data);
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

       public function getSubject(){
        if($this->input->post('gradelevel'))
           {
   
           echo $this->auth->getSubject($this->input->post('gradelevel'));
           }
   
       }

       public function getSubjectSHS(){
        if($this->input->post('gradelevel'))
           {
   
           echo $this->auth->getSubject($this->input->post('gradelevel'),$this->input->post('strand'));
           }
   
       }

       public function getSectionSHS(){
        if($this->input->post('gradelevel'))
           {
   
           echo $this->auth->getSectionSHS($this->input->post('gradelevel'),$this->input->post('strand'));
           }
   
       }

       public function getSection(){
        if($this->input->post('gradelevel'))
           {
   
           echo $this->auth->getSection($this->input->post('gradelevel'));
           }
   
       }

       public function getStrand(){
        if($this->input->post('gradelevel'))
           {
   
           echo $this->auth->getStrand($this->input->post('gradelevel'));
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

