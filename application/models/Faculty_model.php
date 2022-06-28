<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    include('phpqrcode/qrlib.php');

   
class Faculty_model extends CI_Model {
    
    function __construct(){
        parent::__construct();
        
    }
    
 
    //Declaration of a methods
   //Declaration of a methods
    public function setUserID($userID) {
        $this->_userID = $userID;
    }

    public function setFirstname($firstname) {
        $this->_firstname = $firstname;
    }
 
    public function setMiddleName($middlename) {
        $this->_middlename = $middlename;
    }

    public function setLastName($lastname) {
        $this->_lastname = $lastname;
    }

    public function setSuffix($suffix) {
        $this->_suffix = $suffix;
    }
 
    public function setEmail($email) {
        $this->_email = $email;
    }
 
    public function setContactNo($contactno) {
        $this->_contactno = $contactno;
    }
 
    public function setGender($gender) {
        $this->_gender = $gender;
    }

    public function setAddress($address) {
        $this->_address = $address;
    }
    
    public function setPurok($purok) {
        $this->_purok = $purok;
    }
 
    public function setDOB($dob) {
        $this->_dob = $dob;
    }
 
    public function setTimeStamp($timeStamp) {
        $this->_timeStamp = $timeStamp;
    }

    public function setRegion($region) {
        $this->_region = $region;
    }

    public function setProvince($province) {
        $this->_province = $province;
    }

    public function setCity($city) {
        $this->_city = $city;
    }

    public function setBarangay($barangay) {
        $this->_barangay = $barangay;
    }

    public function setLRN($lrn) {
        $this->_lrn = $lrn;
    }

    public function setIDNo($idno) {
        $this->_idno = $idno;
    }

    public function setStudentType($studenttype) {
        $this->_studenttype = $studenttype;
    }

    public function setMother($mother) {
        $this->_mother = $mother;
    }

    public function setFather($father) {
        $this->_father = $father;
    }

    public function setGuardian($guardian) {
        $this->_guardian = $guardian;
    }

    public function setReligion($religion) {
        $this->_religion = $religion;
    }

    public function setNationality($nationality) {
        $this->_nationality = $nationality;
    }

    public function setPassword($password) {
        $this->_password = $password;
    }

    public function setStatus($status) {
        $this->_status = $status;
    }

 
    //create new user
    public function addFaculty() {

        $data = array(
            'idno' => $this->_idno,
            'firstname' => $this->_firstname,
            'middlename' => $this->_middlename,
            'lastname' => $this->_lastname,
            'suffix' => $this->_suffix,
            'birthdate' => $this->_dob,
            'gender' => $this->_gender,
            'addid' => $this->_barangay,
            'accountid' => $this->_userID,
            'address' => $this->_address,
            'contactperson' => $this->_guardian,
            'contactno' => $this->_contactno,
            'date_created' => $this->_timeStamp
        );

        $this->db->insert('tbl_faculty', $data);
        if (!empty($this->db->insert_id()) && $this->db->insert_id() > 0) {
            return TRUE;
            
        } else {
            return FALSE;
        }
    }

    public function addAccount() {

        $data = array(
            'email' => $this->_email,
            'name' => $this->_firstname . ' ' . $this->_lastname,
            'usertype' => $this->_studenttype,
            'password' => $this->_password,
            'date_created' => $this->_timeStamp
        );

        $this->db->insert('tbl_account', $data);
        if (!empty($this->db->insert_id()) && $this->db->insert_id() > 0) {
            return TRUE;
            
        } else {
            return FALSE;
        }
    }
    
    
    
    function editFaculty($facultyInfo, $id)
    {       
        $this->db->where('id', $id);
        $this->db->update('tbl_faculty', $facultyInfo);
              
        return TRUE;
    }

    function editAccount($facultyInfo, $id)
    {       
        $this->db->where('id', $id);
        $this->db->update('tbl_account', $facultyInfo);
              
        return TRUE;
    }

    function editEnrollment($facultyInfo, $id)
    {       
        $this->db->where('id', $id);
        $this->db->update('tbl_enrollsched', $facultyInfo);
              
        return TRUE;
    }

  function deleteUser($userId, $userInfo)
    {
        $this->db->where('id', $userId);
        $this->db->update('users', $userInfo);
        
        return $this->db->affected_rows();
    }

    function getFacultyInfo($id)
    {
        $this->db->select("s.id,s.idno,CONCAT(s.firstname, ' ',s.lastname) name,s.firstname,s.lastname,s.middlename,s.suffix,s.birthdate,s.gender,s.addid,s.address,a.province,a.city,a.barangay,ac.email,s.contactno,s.contactperson,ac.usertype,s.status");
        $this->db->from('tbl_faculty as s');
        $this->db->join('tbl_address as a','a.id=s.addid');
        $this->db->join('tbl_account as ac','ac.id=s.accountid');
        $this->db->where('s.id', $id);
        $this->db->where('ac.usertype<>', 'Student');
        $query = $this->db->get();
        
        return $query->row();
    }
    
        function facultyListingCount($searchText = '',$status)
    {
        $this->db->select('id,idno,firstname,middlename,lastname,suffix,status');
        $this->db->from('tbl_student');


            $likeCriteria = "(CONCAT(firstname, ' ',lastname)  LIKE '".$searchText."%'
                            AND status='".$status."'
                            OR CONCAT(lastname, ' ',firstname)  LIKE '".$searchText."%'
                            AND status='".$status."')";
                            
       $this->db->where($likeCriteria);
       $query = $this->db->order_by('id','ASC');

        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function facultyListing($searchText = '', $status,$page, $segment) {

        $this->db->select("f.id,f.idno,CONCAT(f.firstname, ' ',f.lastname) name,f.firstname,f.lastname,f.middlename,f.suffix,f.birthdate,f.gender,f.address,f.contactno,a.usertype,f.status");
        $this->db->from('tbl_faculty f');
        $this->db->join('tbl_account a','a.id=f.accountid');
        
        $likeCriteria = "(CONCAT(f.firstname, ' ',f.lastname)  LIKE '".$searchText."%'
        AND f.status='".$status."'  AND a.usertype<>'".'Student'."' 
        OR CONCAT(f.lastname, ' ',f.firstname)  LIKE '".$searchText."%'
        AND f.status='".$status."'  AND a.usertype<>'".'Student'."' )";

            $this->db->where($likeCriteria);
       
        

        $this->db->order_by('id', 'ASC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function scheduleListingCount($id,$syid)
    {
        $this->db->select("es.scheduleid as id,sd.room,sd.day,concat(sd.timefrom, ' ',sd.timeto) as time,concat(a.firstname, ' ',a.lastname) as name, sd.term, sb.gradelevel,sb.subject,sc.section,sy.schoolyear,st.strandcode,es.status");
        $this->db->from('tbl_schedule sd');
        $this->db->join('tbl_enrollsched es','es.scheduleid=sd.id');
        $this->db->join('tbl_enrollment e','e.id=es.enrollmentid');
        $this->db->join('tbl_faculty a','a.id=sd.adviserid');
        $this->db->join('tbl_subject sb','sb.id=sd.subjectid');
        $this->db->join('tbl_section sc','sc.id=sd.sectionid');
        $this->db->join('tbl_schoolyear sy','sy.id=sd.syid');
        $this->db->join('tbl_strand st','st.id=sc.strandid','left');
        $this->db->where('sd.adviserid', $id);
        $this->db->where('e.syid=', $syid);
                

        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function scheduleListing($id,$syid, $page, $segment) {

        $this->db->select("es.scheduleid as id,sd.room,sd.day,concat(sd.timefrom, ' ',sd.timeto) as time,concat(a.firstname, ' ',a.lastname) as name, sd.term, sb.gradelevel,sb.subject,sc.section,sy.schoolyear,st.strandcode,es.status");
        $this->db->from('tbl_schedule sd');
        $this->db->join('tbl_enrollsched es','es.scheduleid=sd.id');
        $this->db->join('tbl_enrollment e','e.id=es.enrollmentid');
        $this->db->join('tbl_faculty a','a.id=sd.adviserid');
        $this->db->join('tbl_subject sb','sb.id=sd.subjectid');
        $this->db->join('tbl_section sc','sc.id=sd.sectionid');
        $this->db->join('tbl_schoolyear sy','sy.id=sd.syid');
        $this->db->join('tbl_strand st','st.id=sc.strandid','left');
        $this->db->where('sd.adviserid', $id);
        $this->db->where('e.syid=', $syid);
        
        
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function recordListingCount($id,$syid)
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
        $this->db->where('sd.adviserid', $id);
        $this->db->where('e.syid<>', $syid);
                

        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function recordListing($id,$syid, $page, $segment) {

        $this->db->select("es.id,sd.room,sd.day,concat(sd.timefrom, ' ',sd.timeto) as time,concat(a.firstname, ' ',a.lastname) as name, sd.term, sb.gradelevel,sb.subject,sc.section,sy.schoolyear,st.strandcode,es.status");
        $this->db->from('tbl_schedule sd');
        $this->db->join('tbl_enrollsched es','es.scheduleid=sd.id');
        $this->db->join('tbl_enrollment e','e.id=es.enrollmentid');
        $this->db->join('tbl_faculty a','a.id=sd.adviserid');
        $this->db->join('tbl_subject sb','sb.id=sd.subjectid');
        $this->db->join('tbl_section sc','sc.id=sd.sectionid');
        $this->db->join('tbl_schoolyear sy','sy.id=sd.syid');
        $this->db->join('tbl_strand st','st.id=sc.strandid','left');
        $this->db->where('sd.adviserid', $id);
        $this->db->where('e.syid<>', $syid);
        
        
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function studentListingCount($schedid)
    {
        $this->db->select("es.id,s.idno,concat(s.firstname, ' ',s.lastname) as name, s.address,e.type,es.status");
        $this->db->from('tbl_enrollment e');
        $this->db->join('tbl_enrollsched es','es.enrollmentid=e.id');
        $this->db->join('tbl_schedule sd','sd.id=es.scheduleid');
        $this->db->join('tbl_faculty a','a.id=sd.adviserid');
        $this->db->join('tbl_subject sb','sb.id=sd.subjectid');
        $this->db->join('tbl_student s','s.id=e.studentid');
        $this->db->join('tbl_section sc','sc.id=sd.sectionid');
        $this->db->join('tbl_schoolyear sy','sy.id=sd.syid');
        $this->db->join('tbl_strand st','st.id=sc.strandid','left');
        $this->db->where('es.scheduleid', $schedid);

                

        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function studentListing($schedid, $page, $segment) {

        $this->db->select("es.id,s.idno,concat(s.firstname, ' ',s.lastname) as name, s.address,e.type,es.status");
        $this->db->from('tbl_enrollment e');
        $this->db->join('tbl_enrollsched es','es.enrollmentid=e.id');
        $this->db->join('tbl_schedule sd','sd.id=es.scheduleid');
        $this->db->join('tbl_faculty a','a.id=sd.adviserid');
        $this->db->join('tbl_subject sb','sb.id=sd.subjectid');
        $this->db->join('tbl_student s','s.id=e.studentid');
        $this->db->join('tbl_section sc','sc.id=sd.sectionid');
        $this->db->join('tbl_schoolyear sy','sy.id=sd.syid');
        $this->db->join('tbl_strand st','st.id=sc.strandid','left');
        $this->db->where('es.scheduleid', $schedid);
        
        
        $this->db->limit($page, $segment);
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
        inner join tbl_faculty e on e.addid=a.id  where e.id='".$id."'))";

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
        inner join tbl_faculty e on e.addid=a.id  where e.id='".$id."'))";

        $this->db->where($likeCriteria);
        $this->db->group_by('barangay');
        $this->db->order_by('barangay','ASC');
        return $this->db->get();

		
    }
    


}
?>
