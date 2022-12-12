<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    
class Subject extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //load model
        $this->load->model('Subject_model', 'auth');
        $this->load->library('csvimport');
        $this->load->library('form_validation');
    }

 //------------- LOAD VIEW -------------//
  

public function jhsubject() {     

            $data = array();

            $this->load->view('templates/adminheader', $data);
            $this->load->view('admin/student', $data);
            $this->load->view('templates/adminfooter', $data);       

}


function addNewJHSubject()
{
    $data = array();  

    $this->load->view('templates/adminheader', $data);
    $this->load->view("admin/addNewJHSubject",  $data);
    $this->load->view('templates/adminfooter', $data);  
    
}

function editJHSubject($id)
{
    $data = array();

    $data['subjectInfo'] = $this->auth->getJHSubjectInfo($id);

    $this->load->view('templates/adminheader', $data);
    $this->load->view("admin/editJHSubject",  $data);
    $this->load->view('templates/adminfooter', $data);  
    
}

function addNewSHSubject()
{
    $data = array();

    $data['strand'] = $this->auth->getStrandList();

    $this->load->view('templates/adminheader', $data);
    $this->load->view("admin/addNewSHSubject",  $data);
    $this->load->view('templates/adminfooter', $data);  
    
}

function editSHSubject($id)
{
    $data = array();

    $data['subjectInfo'] = $this->auth->getSHSubjectInfo($id);
    $data['strand'] = $this->auth->getStrandList();

    $this->load->view('templates/adminheader', $data);
    $this->load->view("admin/editSHSubject",  $data);
    $this->load->view('templates/adminfooter', $data);  
    
}

 
 //------------- FUNCTION -------------//
    
 function addJHSubject()
    {
               
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required|callback_checkSubject');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        $this->form_validation->set_rules('gradelevel', 'Grade Level', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

 
        if ($this->form_validation->run() == FALSE) {
            $this->addNewJHSubject();
        } else {
            
            $subject = $this->security->xss_clean($this->input->post('subject'));
            $description = $this->security->xss_clean($this->input->post('description'));
            $gradelevel = $this->security->xss_clean($this->input->post('gradelevel'));
            $strand = $this->security->xss_clean($this->input->post('strand'));
            $status = $this->security->xss_clean($this->input->post('status'));
            $timeStamp = date('Y-m-d');
            
                       
            $this->auth->setSubject($subject);  
            $this->auth->setDescription($description);
            $this->auth->setGradeLevel($gradelevel);          
            $this->auth->setStatus($status);
            
            $chk = $this->auth->addJHSubject();

            if($chk > 0)
                {

                    $this->session->set_flashdata('success', 'New Subject Added Successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Subject creation failed');
                }

            redirect('jhsubject');

        }
        
    }

    function editOldJHSubject()
    {
            
            $id = $this->input->post('sid');
                    
            $this->form_validation->set_rules('subject', 'Subject', 'trim|required|callback_checkSubjectEdit');
            $this->form_validation->set_rules('description', 'Description', 'trim|required');
            $this->form_validation->set_rules('gradelevel', 'Grade Level', 'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
      
      
            if($this->form_validation->run() == FALSE)
            {
                $this->editJHSubject($id);
              

            }
            else
            {


                $subject = $this->security->xss_clean($this->input->post('subject'));
                $description = $this->security->xss_clean($this->input->post('description'));
                $gradelevel = $this->security->xss_clean($this->input->post('gradelevel'));
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
                    
    function addSHSubject()
    {
               
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required|callback_checkSubject');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        $this->form_validation->set_rules('gradelevel', 'Grade Level', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

 
        if ($this->form_validation->run() == FALSE) {
            $this->addNewSHSubject();
        } else {
            
            $subject = $this->security->xss_clean($this->input->post('subject'));
            $description = $this->security->xss_clean($this->input->post('description'));
            $gradelevel = $this->security->xss_clean($this->input->post('gradelevel'));
            $strand = $this->security->xss_clean($this->input->post('strand'));
            $status = $this->security->xss_clean($this->input->post('status'));
            $timeStamp = date('Y-m-d');
            
                       
            $this->auth->setSubject($subject);  
            $this->auth->setDescription($description);
            $this->auth->setGradeLevel($gradelevel);
            $this->auth->setStrand($strand);
            $this->auth->setStatus($status);
            
            $chk = $this->auth->addSHSubject();

            if($chk > 0)
                {

                    $this->session->set_flashdata('success', 'New Subject Added Successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Subject creation failed');
                }

            redirect('shsubject');

        }
        
    }

    function editOldSHSubject()
    {
            
            $id = $this->input->post('sid');
                    
            $this->form_validation->set_rules('subject', 'Subject', 'trim|required|callback_checkSubjectEdit');
            $this->form_validation->set_rules('description', 'Description', 'trim|required');
            $this->form_validation->set_rules('gradelevel', 'Grade Level', 'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
      
      
            if($this->form_validation->run() == FALSE)
            {
                $this->editSHSubject($id);
              

            }
            else
            {


                $subject = $this->security->xss_clean($this->input->post('subject'));
                $description = $this->security->xss_clean($this->input->post('description'));
                $gradelevel = $this->security->xss_clean($this->input->post('gradelevel'));
                $strand = $this->security->xss_clean($this->input->post('strand'));
                $status = $this->security->xss_clean($this->input->post('status'));
                $timeStamp = date('Y-m-d');
              
                
                $studentInfo = array('subject'=>$subject,'description'=>$description,'gradelevel'=>$gradelevel,'strandid'=>$strand,'type'=>'SHS','status'=>$status);
                
                $result = $this->auth->editJHSubject($studentInfo, $id);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Subject Data Updated.');

                    redirect('shsubject');
                   
                }

                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');

                    $this->editSHSubject($id);
              
                }
                
                
                
            }
        
    }

    function archiveshsubject()
    {
        $id = $this->security->xss_clean($this->input->post('archiveid'));
                        
                $studentInfo = array('id'=>$id,'status'=>'Inactive',);
                
                $result = $this->auth->editJHSubject($studentInfo, $id);

                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'SHS Subject Data Archived.');                 

                    redirect('shsubject');
                   
                }

                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');

                    redirect('shsubject');
              
                }
        
    }

    function retrieveshsubject()
    {
        $id = $this->security->xss_clean($this->input->post('archiveid'));
                        
                $studentInfo = array('id'=>$id,'status'=>'Active',);
                
                $result = $this->auth->editJHSubject($studentInfo, $id);

                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'SHS Subject Data Retrieved.');                 

                    redirect('archivedshsubject');
                   
                }

                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');

                    redirect('archivedshsubject');
              
                }
        
    }

    function archivejhsubject()
    {
        $id = $this->security->xss_clean($this->input->post('archiveid'));
                        
                $studentInfo = array('id'=>$id,'status'=>'Inactive',);
                
                $result = $this->auth->editJHSubject($studentInfo, $id);

                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'JHS Subject Data Archived.');                 

                    redirect('jhsubject');
                   
                }

                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');

                    redirect('jhsubject');
              
                }
        
    }

    function retrievejhsubject()
    {
        $id = $this->security->xss_clean($this->input->post('archiveid'));
                        
                $studentInfo = array('id'=>$id,'status'=>'Active',);
                
                $result = $this->auth->editJHSubject($studentInfo, $id);

                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'JHS Subject Data Retrieved.');                 

                    redirect('archivedjhsubject');
                   
                }

                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');

                    redirect('archivedjhsubject');
              
                }
        
    }

    function jhsubjectListing()
    {

        $searchText = $this->security->xss_clean($this->input->post('searchText'));

        $status ="Active";
           
        $count = $this->auth->jhsubjectListingCount($searchText,$status);

        $returns = $this->paginationCompress ( "subject/jhsubjectListing/", $count, 10 );

        $data['searchText'] = $searchText;
        
        $data['userRecords'] = $this->auth->jhsubjectListing($searchText, $status, $returns["page"], $returns["segment"]);
        

            $this->load->view('templates/adminheader', $data);
            $this->load->view("admin/jhsubject",  $data);
            $this->load->view('templates/adminfooter', $data);

    }

    function jhsArchivedListing()
    {

        $searchText = $this->security->xss_clean($this->input->post('searchText'));

        $status ="Inactive";
           
        $count = $this->auth->jhsubjectListingCount($searchText,$status);

        $returns = $this->paginationCompress ( "subject/jhsArchivedListing/", $count, 10 );

        $data['searchText'] = $searchText;
        
        $data['userRecords'] = $this->auth->jhsubjectListing($searchText, $status, $returns["page"], $returns["segment"]);
        

            $this->load->view('templates/adminheader', $data);
            $this->load->view("admin/archivedjhsubject",  $data);
            $this->load->view('templates/adminfooter', $data);

    }

    function shsubjectListing()
    {

        $searchText = $this->security->xss_clean($this->input->post('searchText'));
           
        $status ="Active";

        $count = $this->auth->shsubjectListingCount($searchText,$status);

        $returns = $this->paginationCompress ( "subject/shsubjectListing/", $count, 10 );

        $data['searchText'] = $searchText;
        
        $data['userRecords'] = $this->auth->shsubjectListing($searchText, $status, $returns["page"], $returns["segment"]);
        

            $this->load->view('templates/adminheader', $data);
            $this->load->view("admin/shsubject",  $data);
            $this->load->view('templates/adminfooter', $data);

    }

    function shsArchivedListing()
    {

        $searchText = $this->security->xss_clean($this->input->post('searchText'));
           
        $status ="Inactive";

        $count = $this->auth->shsubjectListingCount($searchText,$status);

        $returns = $this->paginationCompress ( "subject/shsArchivedListing/", $count, 10 );

        $data['searchText'] = $searchText;
        
        $data['userRecords'] = $this->auth->shsubjectListing($searchText, $status, $returns["page"], $returns["segment"]);
        

            $this->load->view('templates/adminheader', $data);
            $this->load->view("admin/archivedshsubject",  $data);
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

       function checkSubject() {

        $subject = $this->security->xss_clean($this->input->post('subject'));
        $description = $this->security->xss_clean($this->input->post('description'));
        $gradelevel = $this->security->xss_clean($this->input->post('gradelevel'));
        $strand = $this->security->xss_clean($this->input->post('strand'));

        if($strand == "")
        {
            $strand = 0;

        }


        $check = $this->db->get_where('tbl_subject', array('subject' => $subject,'description' => $description,'gradelevel' => $gradelevel,'strandid' => $strand), 1);

        if ($check->num_rows() > 0) {

            $this->form_validation->set_message('checkSubject', 'This Subject already exists.');

            return FALSE;
        }

        else
        {
            return TRUE;
        }
     
     
       } 

       function checkSubjectEdit() {

        $subject = $this->security->xss_clean($this->input->post('subject'));
        $description = $this->security->xss_clean($this->input->post('description'));
        $gradelevel = $this->security->xss_clean($this->input->post('gradelevel'));
        $strand = $this->security->xss_clean($this->input->post('strand'));
       
       
        $check = $this->db->get_where('tbl_subject', array('subject' => $subject,'description' => $description,'gradelevel' => $gradelevel), 1);

        $id = $this->input->post('sid');

        $row = 0;

        if(!empty($id))
        {
            $row = $this->auth->getJHSubjectInfo($id);

            if ($check->num_rows() > 0 && $subject != $row->subject && $description != $row->description) {

                $this->form_validation->set_message('checkSubjectEdit', 'This Subject already exists.');
    
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

                $this->form_validation->set_message('checkSubjectEdit', 'This Subject already exists.');
    
                return FALSE;
            }
    
            else
            {
                return TRUE;
            }

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

