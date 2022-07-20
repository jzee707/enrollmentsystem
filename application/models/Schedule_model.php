<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    include('phpqrcode/qrlib.php');

   
class Schedule_model extends CI_Model {
    
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

    public function setSchoolYear($schoolyear) {
        $this->_schoolyear = $schoolyear;
    }

    public function setTimeStamp($timeStamp) {
        $this->_timeStamp = $timeStamp;
    }

 
    //create new user
    public function addSchedule() {

        $data = array(
            'subjectid' => $this->_subject,
            'sectionid' => $this->_section,
            'adviserid' => $this->_adviser,
            'room' => $this->_room,
            'day' => $this->_day,
            'timefrom' => $this->_timestart,
            'timeto' => $this->_timeend,
            'term' => $this->_term,
            'syid' =>  $this->_schoolyear,
            'date_created' => $this->_timeStamp
        );

        $this->db->insert('tbl_schedule', $data);
        if (!empty($this->db->insert_id()) && $this->db->insert_id() > 0) {
            return TRUE;
            
        } else {
            return FALSE;
        }
    }
    
    
    function editJHSubject($studentInfo, $id)
    {       
        $this->db->where('id', $id);
        $this->db->update('tbl_subject', $studentInfo);
              
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

    function editSchedule($scheduleInfo, $id)
    {       
        $this->db->where('id', $id);
        $this->db->update('tbl_schedule', $scheduleInfo);
              
        return TRUE;
    }
    

  function deleteUser($userId, $userInfo)
    {
        $this->db->where('id', $userId);
        $this->db->update('users', $userInfo);
        
        return $this->db->affected_rows();
    }

    function getScheduleInfo($id)
    {
        $this->db->select("sd.id,sd.room,sd.day,concat(sd.timefrom, ' - ',sd.timeto) as time,sd.timefrom,sd.timeto,concat(a.firstname, ' ',a.lastname) as name, sd.term, sb.gradelevel,sd.subjectid,sd.sectionid,sd.adviserid,sd.syid,sb.subject,sc.section,sy.schoolyear,sc.strandid,sd.status");
        $this->db->from('tbl_schedule sd');
        $this->db->join('tbl_faculty a','a.id=sd.adviserid');
        $this->db->join('tbl_subject sb','sb.id=sd.subjectid');
        $this->db->join('tbl_section sc','sc.id=sd.sectionid');
        $this->db->join('tbl_schoolyear sy','sy.id=sd.syid');
        $this->db->where('sd.id', $id);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    function scheduleListingCount($searchText = '',$status,$schoolyear,$term)
    {
        $this->db->select("sd.id,sd.room,sd.day,concat(sd.timefrom, ' - ',sd.timeto) as time,concat(a.firstname, ' ',a.lastname) as name, sd.timefrom,sd.timeto, sd.term, sb.gradelevel,sb.subject,sc.section,sy.schoolyear,sd.status");
        $this->db->from('tbl_schedule sd');
        $this->db->join('tbl_faculty a','a.id=sd.adviserid');
        $this->db->join('tbl_subject sb','sb.id=sd.subjectid');
        $this->db->join('tbl_section sc','sc.id=sd.sectionid');
        $this->db->join('tbl_schoolyear sy','sy.id=sd.syid');

        $likeCriteria = "(sb.gradelevel  LIKE '".$searchText."%'
        AND sd.status='".$status."'  AND sd.syid='".$schoolyear."'  AND sd.term IN ('".$term."','')
        OR description  LIKE '".$searchText."%'
        AND sd.status='".$status."' AND sd.syid='".$schoolyear."' AND sd.term IN ('".$term."',''))";
                            
        $this->db->where($likeCriteria);
        $this->db->order_by('sd.id','ASC');

        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function scheduleListing($searchText = '', $status,$schoolyear,$term,$page, $segment) {

        $this->db->select("sd.id,sd.room,sd.day,concat(sd.timefrom, ' - ',sd.timeto) as time,concat(a.firstname, ' ',a.lastname) as name, sd.timefrom,sd.timeto,sd.term, sb.gradelevel,sb.subject,sc.section,sy.schoolyear,sd.status");
        $this->db->from('tbl_schedule sd');
        $this->db->join('tbl_faculty a','a.id=sd.adviserid');
        $this->db->join('tbl_subject sb','sb.id=sd.subjectid');
        $this->db->join('tbl_section sc','sc.id=sd.sectionid');
        $this->db->join('tbl_schoolyear sy','sy.id=sd.syid');


        $likeCriteria = "(sb.gradelevel  LIKE '".$searchText."%'
        AND sd.status='".$status."'  AND sd.syid='".$schoolyear."'  AND sd.term IN ('".$term."','')
        OR description  LIKE '".$searchText."%'
        AND sd.status='".$status."' AND sd.syid='".$schoolyear."' AND sd.term IN ('".$term."',''))";

            $this->db->where($likeCriteria);
      
        $this->db->limit($page, $segment);
        $this->db->order_by('sd.id','ASC');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    
 
    function getRegion()
	{
        $this->db->select('id,regDesc,regCode');
        $this->db->from('tbl_region');
		
        return $this->db->get();

		
    }
    
    function getProvince()
	{
        $this->db->select('province');
        $this->db->from('tbl_address');
        $this->db->group_by('province');
		
        return $this->db->get();

		
    }

    function getCity($province)
	{
        $this->db->select('city');
        $this->db->from('tbl_address');
        $this->db->where('province',$province);
        $this->db->group_by('city');
        $this->db->order_by('city','ASC');
        $query = $this->db->get();
		
        $output = '<option value="">Select City</option>';

        foreach($query->result() as $row)
        {
         $output .= '<option value="'.$row->city.'">'.$row->city.'</option>';
        }
        
        return $output;
        
    }

    function getBarangay($city)
	{
        $this->db->select('id,barangay');
        $this->db->from('tbl_address');
        $this->db->where('city',$city);
        $this->db->group_by('barangay');
        $this->db->order_by('barangay','ASC');
        $query = $this->db->get();
		
        $output = '<option value="">Select Barangay</option>';

        foreach($query->result() as $row)
        {
         $output .= '<option value="'.$row->id.'">'.$row->barangay.'</option>';
        }
        
        return $output;
        
    }

    function getCityFix($id)
	{
        $this->db->select('city');
        $this->db->from('tbl_address');

        $likeCriteria = "(province =(Select a.province from tbl_address a 
        inner join tbl_student e on e.addid=a.id  where e.id='".$id."'))";

        $this->db->where($likeCriteria);
        $this->db->group_by('city');
        $this->db->order_by('city','ASC');
        
        return $this->db->get();

		
    }
    
    function getBarangayFix($id)
	{
        $this->db->select('id,barangay');
        $this->db->from('tbl_address');

        $likeCriteria = "(city =(Select a.city from tbl_address a 
        inner join tbl_student e on e.addid=a.id  where e.id='".$id."'))";

        $this->db->where($likeCriteria);
        $this->db->group_by('barangay');
        $this->db->order_by('barangay','ASC');
        return $this->db->get();

		
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
        $this->db->select('st.id,st.strandcode');
        $this->db->from('tbl_strand st');
        $this->db->join('tbl_section s','s.strandid=st.id');
        $this->db->where('st.status','Active');
        
        return $this->db->get();

		
    }

    function getStrand($gradelevel)
	{
        $this->db->select('st.id,st.strandcode,st.description');
        $this->db->from('tbl_strand st');
        $this->db->join('tbl_section s','s.strandid=st.id');
        $this->db->where('s.gradelevel', $gradelevel);
        $this->db->where('s.status','Active');
        $this->db->group_by('st.id');
        $this->db->order_by('st.strandcode','ASC');
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
        $this->db->order_by('subject','ASC');
        $query = $this->db->get();

        $output = '<option selected disabled value="">Select Subject</option>';	

        foreach($query->result() as $row)
        {
         $output .= '<option value="'.$row->id.'">'.$row->subject.'</option>';
        }
        
        return $output;

		
    }

    function getSubjectSHS($gradelevel,$strand)
	{
        $this->db->select('id,subject,description');
        $this->db->from('tbl_subject');
        $this->db->where('gradelevel',$gradelevel);
        $this->db->where('strandid',$strand);
        $this->db->where('status','Active');
        $this->db->order_by('subject','ASC');
        $query = $this->db->get();

        $output = '<option selected disabled value="">Select Subject</option>';	

        foreach($query->result() as $row)
        {
         $output .= '<option value="'.$row->id.'">'.$row->subject.'</option>';
        }
        
        return $output;

		
    }

    function getSection($gradelevel)
	{
        $this->db->select('id,section');
        $this->db->from('tbl_section');
        $this->db->where('gradelevel',$gradelevel);
        $this->db->where('status','Active');
        $query = $this->db->get();

        $output = '<option selected disabled value="">Select Section</option>';
		
        foreach($query->result() as $row)
        {
         $output .= '<option value="'.$row->id.'">'.$row->section.'</option>';
        }
        
        return $output;

		
    }

    function getGradeLevel()
	{
        $this->db->select('s.gradelevel');
        $this->db->from('tbl_section s');
        $this->db->group_by('s.gradelevel');
        $this->db->order_by('s.gradelevel','ASC');
 
        return $this->db->get();
		
    }

    function getSectionSHS($gradelevel,$strand)
	{
        $this->db->select('id,section');
        $this->db->from('tbl_section');
        $this->db->where('gradelevel',$gradelevel);
        $this->db->where('strandid',$strand);
        $this->db->where('status','Active');
        $query = $this->db->get();
		
        $output = '<option selected disabled value="">Select Section</option>';

        foreach($query->result() as $row)
        {
         $output .= '<option value="'.$row->id.'">'.$row->section.'</option>';
        }
        
        return $output;

		
    }

    function getSubjectList($id)
	{
        $this->db->select('id,subject');
        $this->db->from('tbl_subject ');


        $likeCriteria = "(gradelevel =(SELECT s.gradelevel FROM tbl_schedule sc INNER JOIN tbl_subject s ON s.id=sc.subjectid WHERE sc.id ='". $id ."') AND status='Active')";

        $this->db->where($likeCriteria);
		
        return $this->db->get();

		
    }

    function getSectionList($id)
	{
        $this->db->select('id,section');
        $this->db->from('tbl_section');
        
        $likeCriteria = "(gradelevel =(SELECT s.gradelevel FROM tbl_schedule sc INNER JOIN tbl_section s ON s.id=sc.sectionid WHERE sc.id ='". $id ."') AND status='Active')";

        $this->db->where($likeCriteria);
		
        return $this->db->get();

		
    }


}
?>
