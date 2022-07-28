<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Enrollment_model extends CI_Model {
    
    function __construct(){
        parent::__construct();
        
    }
    
 
    public function setUserID($userID) {
        $this->_userID = $userID;
    }

    public function setStrandCode($strandcode) {
        $this->_strandcode = $strandcode;
    }

    public function setDescription($description) {
        $this->_description = $description;
    }

    public function setGradelevel($gradelevel) {
        $this->_gradelevel = $gradelevel;
    }

    public function setSubject($subject) {
        $this->_subject = $subject;
    }

    public function setSection($section) {
        $this->_section = $section;
    }

    public function setAdviser($adviser) {
        $this->_adviser = $adviser;
    }

    public function setRoom($room) {
        $this->_room = $room;
    }
    
    public function setDay($day) {
        $this->_day = $day;
    }

    public function setTimeStart($timestart) {
        $this->_timestart = $timestart;
    }

    public function setTimeEnd($timeend) {
        $this->_timeend = $timeend;
    }

    public function setIDNo($idno) {
        $this->_idno = $idno;
    }

    public function setTerm($term) {
        $this->_term = $term;
    }

    public function setYearStart($yearstart) {
        $this->_yearstart = $yearstart;
    }

    public function setYearEnd($yearend) {
        $this->_yearend = $yearend;
    }

    public function setStatus($status) {
        $this->_status = $status;
    }

    public function setTimeStamp($timeStamp) {
        $this->_timeStamp = $timeStamp;
    }

    

 
    public function addEnrollment($id,$syid,$timeStamp,$etype,$strand,$semester,$status) {

        $data = array(
            'studentid' => $id,
            'syid' => $syid,
            'type' => $etype,
            'strandid' => $strand,
            'term' => $semester,
            'date_requested' => $timeStamp,
            'date_enrolled' => $timeStamp,
            'status' => $status,
        );

        $this->db->insert('tbl_enrollment', $data);
        if (!empty($this->db->insert_id()) && $this->db->insert_id() > 0) {
            return TRUE;
            
        } else {
            return FALSE;
        }
    }
    
    
    function editEnrollment($studentInfo, $id)
    {       
        $this->db->where('id', $id);
        $this->db->update('tbl_enrollment', $studentInfo);
              
        return TRUE;
    }

    function deleteEnrollment($id)
    {       
        $this->db->where('enrollmentid', $id);
        $this->db->delete('tbl_enrollsched');
              
        return TRUE;
    }

     function addSHSubject() {

        $data = array(
            'subject' => $this->_subject,
            'description' => $this->_description,
            'gradelevel' => $this->_gradelevel,
            'type' => 'SHS'
        );

        $this->db->insert('tbl_subject', $data);
        if (!empty($this->db->insert_id()) && $this->db->insert_id() > 0) {
            return TRUE;
            
        } else {
            return FALSE;
        }
    }

    public function addSchedule($id,$syid) {

        $data = array(
            'enrollmentid' => $id,
            'scheduleid' => $syid,

        );

        $this->db->insert('tbl_enrollsched', $data);
        if (!empty($this->db->insert_id()) && $this->db->insert_id() > 0) {
            return TRUE;
            
        } else {
            return FALSE;
        }
    }
    

  function deleteUser($userId, $userInfo)
    {
        $this->db->where('id', $userId);
        $this->db->update('users', $userInfo);
        
        return $this->db->affected_rows();
    }

    function getScheduleInfo($id)
    {
        $this->db->select("sd.id,sd.room,sd.day,concat(sd.timefrom, ' - ',sd.timeto) as time,sd.timefrom,sd.timeto,concat(a.firstname, ' ',a.lastname) as name, sd.term, sb.gradelevel,sd.subjectid,sd.sectionid,sd.adviserid,sd.syid,sb.subject,sc.section,sy.schoolyear,sd.status");
        $this->db->from('tbl_schedule sd');
        $this->db->join('tbl_faculty a','a.id=sd.adviserid');
        $this->db->join('tbl_subject sb','sb.id=sd.subjectid');
        $this->db->join('tbl_section sc','sc.id=sd.sectionid');
        $this->db->join('tbl_schoolyear sy','sy.id=sd.syid');
        $this->db->where('sd.id', $id);
        $query = $this->db->get();
        
        return $query->row();
    }

    function getEnrollmentInfo($id)
    {
        $this->db->select("e.id,e.studentid,e.strandid,e.type,sd.sectionid,e.status,sc.gradelevel");
        $this->db->from('tbl_enrollment e');
        $this->db->join('tbl_enrollsched es','es.enrollmentid=e.id');
        $this->db->join('tbl_schedule sd','sd.id=es.scheduleid');
        $this->db->join('tbl_section sc','sc.id=sd.sectionid');
        $this->db->where('e.id', $id);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    function enrollmentListingCount($searchText,$status,$schoolyear,$term)
    {
        $this->db->select("e.id,concat(s.firstname, ' ',s.lastname) as student,sc.gradelevel,sc.section,e.term,sy.schoolyear,s.accountid,st.strandcode,e.date_requested,e.date_enrolled,e.status");
        $this->db->from('tbl_schedule sd');
        $this->db->join('tbl_enrollsched es','es.scheduleid=sd.id');
        $this->db->join('tbl_enrollment e','e.id=es.enrollmentid');
        $this->db->join('tbl_student s','s.id=e.studentid');
        $this->db->join('tbl_faculty a','a.id=sd.adviserid');
        $this->db->join('tbl_subject sb','sb.id=sd.subjectid');
        $this->db->join('tbl_section sc','sc.id=sd.sectionid');
        $this->db->join('tbl_schoolyear sy','sy.id=e.syid');
        $this->db->join('tbl_strand st','st.id=sc.strandid','left');


        $likeCriteria = "(concat(s.firstname, ' ',s.lastname)  LIKE '".$searchText."%'
        AND e.status='".$status."' AND e.syid='".$schoolyear."' AND e.term IN ('".$term."',''))";
                            
        $this->db->where($likeCriteria);
        $this->db->group_by('e.id');

        $query = $this->db->get();
        return $query->num_rows();
    }

    function enrollmentListing($searchText, $status,$schoolyear, $term,$page, $segment) {

        $this->db->select("e.id,concat(s.firstname, ' ',s.lastname) as student,sc.gradelevel,sc.section,e.term,st.strandcode,sy.schoolyear,s.accountid,e.date_requested,e.date_enrolled,e.status");
        $this->db->from('tbl_schedule sd');
        $this->db->join('tbl_enrollsched es','es.scheduleid=sd.id');
        $this->db->join('tbl_enrollment e','e.id=es.enrollmentid');
        $this->db->join('tbl_student s','s.id=e.studentid');
        $this->db->join('tbl_section sc','sc.id=sd.sectionid');
        $this->db->join('tbl_schoolyear sy','sy.id=e.syid');
        $this->db->join('tbl_strand st','st.id=sc.strandid','left');


        $likeCriteria = "(concat(s.firstname, ' ',s.lastname)  LIKE '".$searchText."%'
        AND e.status='".$status."' AND e.syid='".$schoolyear."' AND e.term IN ('".$term."',''))";

        $this->db->where($likeCriteria);
        $this->db->group_by('e.id');
      
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    
 
    function getAdviser()
	{
        $this->db->select("f.id,concat(f.firstname, ' ',f.lastname) name,f.status");
        $this->db->from('tbl_faculty f');
        $this->db->join('tbl_account a','a.id=f.accountid');
        $this->db->where('a.usertype','Teacher');
        $this->db->where('f.status','Active');
		
        return $this->db->get();

		
    }

    function getStrandList()
	{
        $this->db->select('id,strandcode');
        $this->db->from('tbl_strand');
        $this->db->where('status','Active');
		
        return $this->db->get();

		
    }

    function getStrand($gradelevel)
	{
        $this->db->select('s.id,s.strandcode,s.description');
        $this->db->from('tbl_strand s');
        $this->db->join('tbl_section sc','sc.strandid=s.id');
        $this->db->join('tbl_schedule sd','sd.sectionid=sc.id');
        $this->db->where('sd.status','Active');
        $this->db->group_by('s.strandcode');
        $this->db->order_by('strandcode','ASC');
        $query = $this->db->get();

        $output = '<option selected disabled value="">Select Strand</option>';
		
        foreach($query->result() as $row)
        {
         $output .= '<option value="'.$row->id.'">'.$row->strandcode.'</option>';
        }
        
        return $output;
		
    }


    function getSubject($gradelevel)
	{
        $this->db->select('id,subject,description');
        $this->db->from('tbl_subject');
        $this->db->where('gradelevel',$gradelevel);
        $this->db->where('status','Active');
        $query = $this->db->get();
		

        foreach($query->result() as $row)
        {
         $output .= '<option value="'.$row->id.'">'.$row->subject.'</option>';
        }
        
        return $output;

		
    }

    function getSection($gradelevel,$schoolyear,$semester)
	{
        $this->db->select("id,section,level");

        $this->db->from('tbl_section');
        
        $likeCriteria = "(gradelevel = '".$gradelevel."')"; 

        $this->db->where($likeCriteria);


        $this->db->group_by('id');
        $this->db->order_by('id','ASC');
        $query = $this->db->get();
		
        $output = '<option selected disabled value="">Select Section</option>';

        foreach($query->result() as $row)
        {
            $row1 = $this->db->select("count(DISTINCT e.id) as counter,sd.sectionid")->where('e.status',"Active")->where('e.term',$semester)->where('e.syid',$schoolyear)->where('sd.sectionid',$row->id)->join("tbl_schedule sd","sd.id=es.scheduleid")->join("tbl_enrollment e","e.id=es.enrollmentid")->join("tbl_section s","s.id=sd.sectionid")->get("tbl_enrollsched es")->row();
        
            if (!empty($row1->counter))
            {
                if (intval($row->level) > intval($row1->counter))
                {
                    $output .= '<option  value="'.$row->id.'">'.$row->section.'</option>';
                   
                }
               
            }

            else
            {
                $output .= '<option  value="'.$row->id.'">'.$row->section.'</option>';

            }      
  
        }
        
        return $output;

        
		
    }

    function getSectionEdit($id)
	{
        
        $this->db->select('sc.id,sc.section');
        $this->db->from('tbl_section sc');
        $this->db->join('tbl_schedule sd','sd.sectionid=sc.id');
        $this->db->join('tbl_enrollsched es','es.scheduleid=.sd.id');
		$this->db->where('es.enrollmentid',$id);
        $this->db->group_by('sc.id');
        $this->db->order_by('sc.id','ASC');

        return $this->db->get();
		
    }

    function getSectionSHS($gradelevel,$schoolyear,$semester,$strand)
	{

        $this->db->select("id,section,level");

        $this->db->from('tbl_section');
        
        $likeCriteria = "(gradelevel = '".$gradelevel."' AND strandid = '".$strand."')"; 

        $this->db->where($likeCriteria);


        $this->db->group_by('id');
        $this->db->order_by('id','ASC');
        $query = $this->db->get();
		
        $output = '<option selected disabled value="">Select Section</option>';

        foreach($query->result() as $row)
        {
            $row1 = $this->db->select("count(DISTINCT e.id) as counter,sd.sectionid")->where('e.status',"Active")->where('e.term',$semester)->where('e.syid',$schoolyear)->where('sd.sectionid',$row->id)->join("tbl_schedule sd","sd.id=es.scheduleid")->join("tbl_enrollment e","e.id=es.enrollmentid")->join("tbl_section s","s.id=sd.sectionid")->get("tbl_enrollsched es")->row();
        
            if (!empty($row1->counter))
            {
                if (intval($row->level) > intval($row1->counter))
                {
                    $output .= '<option  value="'.$row->id.'">'.$row->section.'</option>';
                   
                }
               
            }

            else
            {
                $output .= '<option  value="'.$row->id.'">'.$row->section.'</option>';

            }      
  
        }
        
        return $output;


        /* $this->db->select('sc.id,sc.section');
        $this->db->from('tbl_section sc');
        $this->db->join('tbl_schedule sd','sd.sectionid=sc.id');
		$this->db->where('sc.gradelevel',$gradelevel);
        $this->db->where('sc.strandid',$strand);
        $this->db->group_by('sc.id');
        $this->db->order_by('sc.id','ASC');
        $query = $this->db->get();
		
        $output = '<option selected disabled value="">Select Section</option>';

        foreach($query->result() as $row)
        {
         $output .= '<option disabled selected value="'.$row->id.'">'.$row->section.'</option>';
        }
        
        return $output; */
    }

    function getGradeLevel($semester)
	{
        $this->db->select('s.gradelevel');
        $this->db->from('tbl_schedule sc');
        $this->db->join('tbl_section s','sc.sectionid=s.id');

        if($semester == "2nd")
        {
            $likeCriteria = "(s.gradelevel ='Grade 11' OR s.gradelevel ='Grade 12')";

        $this->db->where($likeCriteria);
            
        }

        $this->db->group_by('s.gradelevel');
        $this->db->order_by('s.gradelevel','ASC');
  
        return $this->db->get();
		
    }

    

    function scheduleListingInfo($section,$syid,$semester,$gradelevel) {

        $this->db->select('id,syid,status');
        $this->db->from('tbl_schedule');
        $this->db->where('sectionid', $section);
        $this->db->where('syid', $syid);

        if($gradelevel == "Grade 11" || $gradelevel == "Grade 12")
        {
            $this->db->where('term', $semester);

        }

        else
        {
            $this->db->where('term', '');


        }
       

        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function getSubjectList()
	{
        $this->db->select('id,subject');
        $this->db->from('tbl_subject');
        $this->db->where('status','Active');
		
        return $this->db->get();

		
    }

    function getSectionList()
	{
        $this->db->select('id,section');
        $this->db->from('tbl_section');
        $this->db->where('status','Active');
		
        return $this->db->get();		
    }

/*     function getStudentList()
	{
        $this->db->select("id,concat(firstname, ' ',lastname) as name, status");
        $this->db->from('tbl_student');   

        $likeCriteria = "(id  NOT IN (SELECT studentid FROM tbl_enrollment WHERE status='Active' AND syid=(SELECT id FROM tbl_schoolyear WHERE status='Active') AND term=(SELECT semester FROM tbl_semester WHERE status='Active')) AND status='Active')";

        $this->db->where($likeCriteria);
        $this->db->order_by('name','ASC');

		
        return $this->db->get();
		
    } */

    function getStudentList($id)
	{
        $this->db->select("id,concat(firstname, ' ',lastname) as name, status");
        $this->db->from('tbl_student');   

        $likeCriteria = "(id  NOT IN (SELECT studentid FROM tbl_enrollment WHERE status='Active' AND syid=(SELECT id FROM tbl_schoolyear WHERE status='Active') AND term=(SELECT semester FROM tbl_semester WHERE status='Active')) AND status='Active' 
        OR id =(SELECT studentid FROM tbl_enrollment WHERE id='".$id."' AND status='Active') AND status='Active')";

        $this->db->where($likeCriteria);
        $this->db->order_by('name','ASC');

		
        return $this->db->get();
		
    }

    function getScheduleList($gradelevel,$section,$schoolyear,$semester) {

        $this->db->select("sd.id,sd.room,sd.day,concat(sd.timefrom, ' - ',sd.timeto) as time,sd.timefrom,sd.timeto,concat(a.firstname, ' ',a.lastname) as name, sd.term, sb.gradelevel,sb.subject,sc.section,sy.schoolyear,sd.status");
        $this->db->from('tbl_schedule sd');
        $this->db->join('tbl_faculty a','a.id=sd.adviserid');
        $this->db->join('tbl_subject sb','sb.id=sd.subjectid');
        $this->db->join('tbl_section sc','sc.id=sd.sectionid');
        $this->db->join('tbl_schoolyear sy','sy.id=sd.syid');

        $likeCriteria;

        if($gradelevel != "Grade 11" ||  $gradelevel != "Grade 12")
        {
            $likeCriteria = "(sb.gradelevel = '".$gradelevel."' AND sd.sectionid='".$section."' AND sd.syid='".$schoolyear."' AND sd.term = '".''."')";

        }

        else if($gradelevel == "Grade 11" || $semester == "2nd")
        {
            $likeCriteria = "(sb.gradelevel = '".$gradelevel."' AND sd.sectionid='".$section."' AND sd.syid='".     $schoolyear."' AND sd.term IN ('".'1st'."','".'2nd'."'))";


        }

        else if($gradelevel == "Grade 12" || $semester == "1nd")
        {
            $likeCriteria = "(sb.gradelevel = '".'Grade 11'."' AND sd.sectionid='".$section."' AND sd.syid='".     $schoolyear."' AND sd.term = '".'2nd'."' 
            OR sb.gradelevel = '".'Grade 12'."' AND sd.sectionid='".$section."' AND sd.syid='".     $schoolyear."' AND sd.term = '".$semester."' )";


        }

        else if($gradelevel == "Grade 12" || $semester == "2nd")
        {
            $likeCriteria = "(sb.gradelevel = '".$gradelevel."' AND sd.sectionid='".$section."' AND sd.syid='".     $schoolyear."' AND sd.term IN ('".'1st'."','".'2nd'."'))";


        }

        else if($gradelevel == "Grade 11" || $semester == "1st")
        {
            $likeCriteria = "(sb.gradelevel = '".$gradelevel."' AND sd.sectionid='".$section."' AND sd.syid='".$schoolyear."' AND sd.term= '".$semester."')";

        }
         

        $this->db->where($likeCriteria);  

        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function getAllScheduleList($gradelevel,$strand,$schoolyear,$semester) {

        $this->db->select("sd.id,sd.room,sd.day,concat(sd.timefrom, ' - ',sd.timeto) as time,sd.timefrom,sd.timeto,concat(a.firstname, ' ',a.lastname) as name, sd.term, sb.gradelevel,sb.subject,sc.section,sy.schoolyear,sd.status");
        $this->db->from('tbl_schedule sd');
        $this->db->join('tbl_faculty a','a.id=sd.adviserid');
        $this->db->join('tbl_subject sb','sb.id=sd.subjectid');
        $this->db->join('tbl_section sc','sc.id=sd.sectionid');
        $this->db->join('tbl_schoolyear sy','sy.id=sd.syid');

        $likeCriteria;

        if($gradelevel == "Grade 11")
        {
            $likeCriteria = "(sb.gradelevel = 'Grade 11' AND sb.strandid='".$strand."' AND sd.syid='".$schoolyear."' AND sd.term= '".$semester."')";

        }

        else if($gradelevel == "Grade 12")
        {
            $likeCriteria = "(sb.gradelevel = 'Grade 11' AND sb.strandid='".$strand."' AND sd.syid='".$schoolyear."'  AND sd.term= '".$semester."' OR sb.gradelevel = 'Grade 12' AND sb.strandid='".$strand."' AND sd.syid='".$schoolyear."'  AND sd.term= '".$semester."')";

        }

        $this->db->where($likeCriteria);
       
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function getStudentInfo($id)
    {
        $this->db->select("s.id,s.idno,s.lrn,CONCAT(s.firstname, ' ',s.lastname) name,s.firstname,s.lastname,s.middlename,s.suffix,s.birthdate,s.gender,s.addid,s.address,a.province,a.city,a.barangay,s.religion,s.nationality,ac.email,s.contactno,s.mother,s.father,s.guardian,s.studenttype,s.status");
        $this->db->from('tbl_student as s');
        $this->db->join('tbl_address as a','a.id=s.addid');
        $this->db->join('tbl_account as ac','ac.id=s.accountid');
        $this->db->join('tbl_enrollment as e','e.studentid=s.id');
        $this->db->where('e.id', $id);
        $query = $this->db->get();
        
        return $query->row();
    }

    public function SendEmailRegistration($firstname,$lastname,$email) {   
        
        $subject = "Pre-Enrollment";
        $message = "
        <p>Good Day! ". $firstname . ' ' . $lastname.'.'."</p>
         
        <p>Thank you for submitting a request for pre-enrollment! Now that your request has been approved.
        You may proceed to login or verify your selected subjects on administrator/registrar.

        <p>Keep Safe,</p>

        <p>Western Colleges Inc.</p>";
		
	
        $this->load->config('email');
        $this->load->library('email');

		$this->email->set_newline("\r\n");

        $this->email->from('wcihighschool2022@gmail.com');
        $this->email->to($email);
        $this->email->subject($subject);
		$this->email->message($message); 


		 if($this->email->send()){


		}

		else{
   		show_error($this->email->print_debugger());
		
        } 
        
   
    }

    public function SendEmailRegistrationDec($firstname,$lastname,$email) {   
        
        $subject = "Pre-Enrollment";
        $message = "
        <p>Good Day! ". $firstname . ' ' . $lastname.'.'."</p>
         
        <p>Thank you for submitting a request for pre-enrollment! Sorry to inform you that your request was declined.
        You may submit another request.

        <p>Keep Safe,</p>

        <p>Western Colleges Inc.</p>";
		
	
        $this->load->config('email');
        $this->load->library('email');

		$this->email->set_newline("\r\n");

        $this->email->from('wcihighschool2022@gmail.com');
        $this->email->to($email);
        $this->email->subject($subject);
		$this->email->message($message); 


		 if($this->email->send()){


		}

		else{
   		show_error($this->email->print_debugger());
		
        } 
        
   
    }


}
?>
