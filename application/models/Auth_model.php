<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    include('phpqrcode/qrlib.php');

   
class Auth_model extends CI_Model {
    
    function __construct(){
        parent::__construct();
        
    }
    
 
    //Declaration of a methods
   //Declaration of a methods
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

    public function setSection($section) {
        $this->_section = $section;
    }

    public function setAdviser($adviser) {
        $this->_adviser = $adviser;
    }

    public function setIDNo($idno) {
        $this->_idno = $idno;
    }

    public function setName($name) {
        $this->_name = $name;
    }

    public function setEmail($email) {
        $this->_email = $email;
    }

    public function setPassword($password) {
        $this->_password = $password;
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
    

 
    //create new user
    public function addPreEnrollment($id,$syid,$timeStamp,$etype,$strand) {

        $data = array(
            'studentid' => $id,
            'syid' => $syid,
            'type' => $etype,
            'strandid' => $strand,
            'date_requested' => $timeStamp,
            'status' => 'Requested',
        );

        $this->db->insert('tbl_enrollment', $data);
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
    
    function editStrand($strandInfo, $id)
    {       
        $this->db->where('id', $id);
        $this->db->update('tbl_strand', $strandInfo);
              
        return TRUE;
    }
    

  function deleteUser($userId, $userInfo)
    {
        $this->db->where('id', $userId);
        $this->db->update('users', $userInfo);
        
        return $this->db->affected_rows();
    }

    public function addNewAccount() {

        $data = array(
            'name' => $this->_name,
            'email' => $this->_email,
            'password' => $this->_password,
            'usertype' => 'Student',
            'date_created' => $this->_timeStamp,
        );

        $this->db->insert('tbl_account', $data);
        if (!empty($this->db->insert_id()) && $this->db->insert_id() > 0) {
            return TRUE;
            
        } else {
            return FALSE;
        }
    }

    public function addNewSchoolYear() {

        $data = array(
            'schoolyear' => date("Y", strtotime($this->_yearstart)) . ' - '.date("Y", strtotime($this->_yearend)),
            'datefrom' => $this->_yearstart,
            'dateto' => $this->_yearend,
        );

        $this->db->insert('tbl_schoolyear', $data);
        if (!empty($this->db->insert_id()) && $this->db->insert_id() > 0) {
            return TRUE;
            
        } else {
            return FALSE;
        }
    }
    
    function editSchooLYear($strandInfo, $id)
    {       
        $this->db->where('id', $id);
        $this->db->update('tbl_schoolyear', $strandInfo);
              
        return TRUE;
    }

    function editSYInactive($strandInfo)
    {       
        $this->db->update('tbl_schoolyear', $strandInfo);
              
        return TRUE;
    }

    public function addNewSection() {

        $data = array(
            'section' => $this->_section,
            'gradelevel' => $this->_gradelevel,
            'adviserid' => $this->_adviser,
            'strandid' => $this->_strandcode,
            'status' => $this->_status,
        );

        $this->db->insert('tbl_section', $data);
        if (!empty($this->db->insert_id()) && $this->db->insert_id() > 0) {
            return TRUE;
            
        } else {
            return FALSE;
        }
    }
    
    function editSection($strandInfo, $id)
    {       
        $this->db->where('id', $id);
        $this->db->update('tbl_section', $strandInfo);
              
        return TRUE;
    }

    
     function login($idno, $password) {

        $this->db->select('id as user_id, name, idno,usertype, password');
        $this->db->from('tbl_account');
        $this->db->where('idno', $idno);
        $this->db->where('password', $password);
        $this->db->where('status', 'Active');
        $this->db->limit(1);

        $query = $this->db->get();


            $result = $query->row();

                    return $result;

    }

    function getStudentInfo($id)
    {
        $this->db->select("s.id,s.idno,s.lrn,CONCAT(s.firstname, ' ',s.lastname) name,s.firstname,s.lastname,s.middlename,s.suffix,s.birthdate,s.gender,s.addid,s.address,a.province,a.city,a.barangay,s.religion,s.nationality,ac.email,s.contactno,s.mother,s.father,s.guardian,s.studenttype,s.status");
        $this->db->from('tbl_student as s');
        $this->db->join('tbl_address as a','a.id=s.addid');
        $this->db->join('tbl_account as ac','ac.id=s.accountid');
        $this->db->where('ac.id', $id);
        $query = $this->db->get();
        
        return $query->row();
    }


   
    function getEnrollmentInfo($id,$schoolyear)
    {
        $this->db->select("id,studentid,syid,status");
        $this->db->from('tbl_enrollment');
        $this->db->where('studentid', $id);
        $this->db->where('syid', $schoolyear);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    
    function scheduleListingInfo($section,$syid) {

        $this->db->select('id,syid,status');
        $this->db->from('tbl_schedule');
        $this->db->where('sectionid', $section);
        $this->db->where('syid', $syid);

        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function scheduleListingCount($id,$syid)
    {
        $this->db->select("es.id,sd.room,sd.day,concat(sd.timefrom, ' ',sd.timeto) as time,concat(a.firstname, ' ',a.lastname) as name, sd.term, sb.gradelevel,sb.subject,sc.section,sy.schoolyear,es.status");
        $this->db->from('tbl_schedule sd');
        $this->db->join('tbl_enrollsched es','es.scheduleid=sd.id');
        $this->db->join('tbl_enrollment e','e.id=es.enrollmentid');
        $this->db->join('tbl_faculty a','a.id=sd.adviserid');
        $this->db->join('tbl_subject sb','sb.id=sd.subjectid');
        $this->db->join('tbl_section sc','sc.id=sd.sectionid');
        $this->db->join('tbl_schoolyear sy','sy.id=sd.syid');
        $this->db->where('e.studentid', $id);
        $this->db->where('e.syid', $syid);
                        

        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function scheduleListing($id,$syid, $page, $segment) {

        $this->db->select("es.id,sd.room,sd.day,concat(sd.timefrom, ' ',sd.timeto) as time,concat(a.firstname, ' ',a.lastname) as name, sd.term, sb.gradelevel,sb.subject,sc.section,sy.schoolyear,es.status");
        $this->db->from('tbl_schedule sd');
        $this->db->join('tbl_enrollsched es','es.scheduleid=sd.id');
        $this->db->join('tbl_enrollment e','e.id=es.enrollmentid');
        $this->db->join('tbl_faculty a','a.id=sd.adviserid');
        $this->db->join('tbl_subject sb','sb.id=sd.subjectid');
        $this->db->join('tbl_section sc','sc.id=sd.sectionid');
        $this->db->join('tbl_schoolyear sy','sy.id=sd.syid');
        $this->db->where('e.studentid', $id);
        $this->db->where('e.syid', $syid);
      
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function recordsListingCount($id,$syid)
    {
        $this->db->select("es.id,sd.room,sd.day,concat(sd.timefrom, ' ',sd.timeto) as time,concat(a.firstname, ' ',a.lastname) as name, sd.term, sb.gradelevel,sb.subject,sc.section,sy.schoolyear,st.strandcode,es.status");
        $this->db->from('tbl_schedule sd');
        $this->db->join('tbl_enrollsched es','es.scheduleid=sd.id');
        $this->db->join('tbl_enrollment e','e.id=es.enrollmentid');
        $this->db->join('tbl_faculty a','a.id=sd.adviserid');
        $this->db->join('tbl_subject sb','sb.id=sd.subjectid');
        $this->db->join('tbl_section sc','sc.id=sd.sectionid');
        $this->db->join('tbl_schoolyear sy','sy.id=sd.syid');
        $this->db->join('tbl_strand st','st.id=sc.strandid','left');
        $this->db->where('e.studentid', $id);
        $this->db->where('e.syid<>', $syid);
        $this->db->group_by('e.id');        

        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function recordsListing($id,$syid, $page, $segment) {

        $this->db->select("es.id,sd.room,sd.day,concat(sd.timefrom, ' ',sd.timeto) as time,concat(a.firstname, ' ',a.lastname) as name, sd.term, sb.gradelevel,sb.subject,sc.section,sy.schoolyear,st.strandcode,es.status");
        $this->db->from('tbl_schedule sd');
        $this->db->join('tbl_enrollsched es','es.scheduleid=sd.id');
        $this->db->join('tbl_enrollment e','e.id=es.enrollmentid');
        $this->db->join('tbl_faculty a','a.id=sd.adviserid');
        $this->db->join('tbl_subject sb','sb.id=sd.subjectid');
        $this->db->join('tbl_section sc','sc.id=sd.sectionid');
        $this->db->join('tbl_schoolyear sy','sy.id=sd.syid');
        $this->db->join('tbl_strand st','st.id=sc.strandid','left');
        $this->db->where('e.studentid', $id);
        $this->db->where('e.syid<>', $syid);
        $this->db->group_by('e.id'); 
        
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function getTotal()
    {
        $this->db->select("(SELECT count(id) FROM tbl_student WHERE status='Active') as student,(SELECT count(id) FROM tbl_enrollment WHERE status='Active') as enrolled,(SELECT count(f.id) FROM tbl_faculty f INNER JOIN tbl_account a ON a.id=f.accountid WHERE usertype='Teacher') as teacher,(SELECT count(id) FROM tbl_section) as section,(SELECT count(id) FROM tbl_subject) as subject,(SELECT schoolyear FROM tbl_schoolyear WHERE status='Active') as schoolyear,(SELECT semester FROM tbl_semester WHERE status='Active') as semester");
        $this->db->from('tbl_student');
        $query = $this->db->get();
        
        return $query->row();
    }

    //Import CSV to mysql
    function importCases($data)
	{
		$this->db->insert_batch('tbl_cases', $data);
    }

    function selectCases()
	{
        $this->db->select('id, barangay,confirmed,active,recovered,deaths,userid,date');
        $this->db->from('tbl_cases'); 
        $this->db->order_by('date', 'DESC');
        $this->db->order_by('barangay', 'ASC');
        $this->db->limit(20);
		$query = $this->db->get();
		return $query;
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
    
    function getStrand($gradelevel)
	{
        $this->db->select('id,strandcode');
        $this->db->from('tbl_strand');
        $this->db->where('status','Active');
        $query = $this->db->get();
		

        foreach($query->result() as $row)
        {
         $output .= '<option value="'.$row->id.'">'.$row->strandcode.'</option>';
        }
        
        return $output;

		
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

    

}
?>
