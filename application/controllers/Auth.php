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

            $name = $this->security->xss_clean($this->input->post('name'));
            $email = $this->security->xss_clean($this->input->post('email'));
            $password = $this->security->xss_clean($this->input->post('password'));

            $data['name'] = $name;
            $data['email'] = $email;
            $data['password'] = $password;
    
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

            $name = $this->security->xss_clean($this->input->post('name'));
            $email = $this->security->xss_clean($this->input->post('email'));
            $password = $this->security->xss_clean($this->input->post('password'));
            $timeStamp = date('Y-m-d');
 
        if ($this->form_validation->run() == FALSE) {
           
            $data = array();

            $data['name'] = $name;
            $data['email'] = $email;
            $data['password'] = $password;
    
            $this->load->view('templates/header', $data);
            $this->load->view('auth/signup', $data);
            $this->load->view('templates/footer', $data);

        } else {
            
            
            
                       
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

    $semester = "";
    
    $row1 = $this->db->select("*")->where('status',"Active")->get("tbl_semester")->row();
    if (!empty($row1->id))
    {
        $semester = $row1->semester;
    }

    $result = $this->auth->getEnrollmentInfo($id, $schoolyear,$semester);

    if(!empty($result))
    {
       
            redirect('studentenrollment');                   
    
    }

    else
    {

        $data['grade'] = $this->auth->getGradeLevel($semester);

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

    $semester = "";
    
    $row1 = $this->db->select("*")->where('status',"Active")->get("tbl_semester")->row();
    if (!empty($row1->id))
    {
        $semester = $row1->semester;
    }

    $data['studentInfo'] = $this->auth->getEnrollmentInfo($id,$schoolyear,$semester);

    $count = $this->auth->scheduleListingCount($id,$schoolyear,$semester);

        $returns = $this->paginationCompress ( "auth/studentenrollment/", $count, 10 );
        
        $data['userRecords'] = $this->auth->scheduleListing($id,$schoolyear, $semester,$returns["page"], $returns["segment"]);
    
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

    $semester = "";
    
    $row1 = $this->db->select("*")->where('status',"Active")->get("tbl_semester")->row();
    if (!empty($row1->id))
    {
        $semester = $row1->semester;
    }


    $data['studentInfo'] = $this->auth->getEnrollmentInfo($id,$schoolyear,$semester);

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
        $id = $this->session->userdata('id');

        if($usertype == "Student"){

            $data = array();

            $data['dashboardInfo'] = $this->auth->getTotal($id);

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
        $id = $this->session->userdata('id');

        if($usertype == "Teacher"){

            $data = array();

            $data['dashboardInfo'] = $this->auth->getTotalFaculty($id);

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
        $this->form_validation->set_rules('sectionid', 'Section', 'trim|required');

        $row = $this->db->select("*")->where('accountid',$this->session->userdata('id'))->get("tbl_student")->row();
        $id = $row->id;
 
        if ($this->form_validation->run() == FALSE) {
            $this->preenrollment();
        } else {
            
            $gradelevel = $this->security->xss_clean($this->input->post('gradelevel'));
            $section = $this->security->xss_clean($this->input->post('sectionid'));
            $etype = $this->security->xss_clean($this->input->post('stype'));
            $strand = $this->security->xss_clean($this->input->post('strand'));
            $schedid = $this->security->xss_clean($this->input->post('schedid'));
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
            
            $chk = $this->auth->addPreEnrollment($id,$schoolyear,$timeStamp,$etype,$strand,$semester);

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
                $this->session->set_flashdata('success', 'Request Added Successfully');
            }
            else
            {
                $this->session->set_flashdata('error', 'Strand creation failed');
            }

            redirect('preenrollment');

        }
        
    }

    public function getSection(){

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

        /* $query = $this->db->query("SELECT sc.id,sc.section 
        FROM tbl_section sc INNER JOIN tbl_schedule sd ON sd.sectionid=sc.id WHERE sc.gradelevel='".$gradelevel."' GROUP BY sc.id ORDER BY sc.id"); */

            $this->db->select("id,section,level");
            $this->db->from('tbl_section');

            $likeCriteria = "(gradelevel = '".$gradelevel."')"; 

            $this->db->where($likeCriteria);


            $this->db->group_by('id');
            $this->db->order_by('id','ASC');
            $query = $this->db->get();

            foreach($query->result() as $row)
            {
                $row1 = $this->db->select("count(DISTINCT e.id) as counter,sd.sectionid")->where('e.status',"Active")->where('e.term',$semester)->where('e.syid',$schoolyear)->where('sd.sectionid',$row->id)->join("tbl_schedule sd","sd.id=es.scheduleid")->join("tbl_enrollment e","e.id=es.enrollmentid")->join("tbl_section s","s.id=sd.sectionid")->get("tbl_enrollsched es")->row();

                if (!empty($row1->counter))
                {
                    if (intval($row->level) > intval($row1->counter))
                    {
                  
                        $data['record'] = $row->id;
                    
                        echo json_encode($data);

                        break;
                    
                    }
                
                }

                else
                {

                    $data['record'] = $row->id;
                
                    echo json_encode($data);

                    break;

                }      

            }
   
    }

    public function getSectionStudent(){
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


        echo $this->auth->getSectionStudent($this->input->post('gradelevel'),$schoolyear,$semester);
        }

    }

    public function getSectionIrreg(){

        $query = $this->db->query("SELECT sc.id,sc.section 
        FROM tbl_section sc INNER JOIN tbl_schedule sd ON sd.sectionid=sc.id WHERE sc.gradelevel='".$this->input->post('gradelevel')."' AND sc.strandid='".$this->input->post('strand')."'  GROUP BY sc.id ORDER BY sc.id ASC LIMIT 1");

        $data['record'] = $query->result();
    
        echo json_encode($data);
   
    }

       public function getSectionStudentIrreg(){
        if($this->input->post('gradelevel'))
        {

        echo $this->auth->getSectionStudentIrreg($this->input->post('gradelevel'),$this->input->post('strand'));
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

       function load_allsched()
       {
        $schoolyear =0;

        $row = $this->db->select("*")->where('status',"Active")->get("tbl_schoolyear")->row();
        if (!empty($row->id))
        {
            $schoolyear = $row->id;
        }  

           $result = $this->auth->getAllScheduleList($this->input->post('gradelevel'),$this->input->post('strand'),$schoolyear);
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
                           <td > <input type="hidden" name="schedid[]" value="'. $record->id.'" >'.$record->id.'</td>
                           <td> '.$record->subject.'</td>
                           <td>'. $record->room.'" '.$record->room.'</td>
                           <td>'. $record->idv.'" '.$record->day.'</td>
                           <td>'. $record->id.'" '.date("h:i A", strtotime($record->timefrom)) . ' - ' . date("h:i A", strtotime($record->timeto)).'</td>
                           <td> '.$record->name.'</td>
                           <td><a class="btn btn-sm btn-info" id="removeSched" title="Add Subject">Add Subject</a></td>
                           

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

        $rowsection = $this->db->select("sc.id,sc.section")->limit(1)->order_by("sc.section","ASC")->group_by("sc.section")->where('sc.gradelevel',$this->input->post('gradelevel'))->join("tbl_schedule sd","sd.sectionid=sc.id")->get("tbl_section sc")->row();

           $result = $this->auth->getScheduleList($rowsection->id,$schoolyear);
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

