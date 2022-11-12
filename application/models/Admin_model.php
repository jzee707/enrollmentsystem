<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

   
class Admin_model extends CI_Model {
    
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

    public function setYearStart($yearstart) {
        $this->_yearstart = $yearstart;
    }

    public function setYearEnd($yearend) {
        $this->_yearend = $yearend;
    }
    
    public function setLimit($limit) {
        $this->_limit = $limit;
    }

    public function setStatus($status) {
        $this->_status = $status;
    }
    

 
    //create new user
    public function addNewStrand() {

        $data = array(
            'strandcode' => $this->_strandcode,
            'description' => $this->_description,
        );

        $this->db->insert('tbl_strand', $data);
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

    function editSemester($strandInfo, $id)
    {       
        $this->db->where('id', $id);
        $this->db->update('tbl_semester', $strandInfo);
              
        return TRUE;
    }

    function changepassword($strandInfo, $id)
    {       
        $this->db->where('id', $id);
        $this->db->update('tbl_account', $strandInfo);
              
        return TRUE;
    }

    function InactiveSem($strandInfo,$id)
    {       
        $this->db->where('id<>', $id);
        $this->db->update('tbl_semester', $strandInfo);
              
        return TRUE;
    }

    function InactiveSchoolyear($strandInfo,$id)
    {       
        $this->db->where('id<>', $id);
        $this->db->update('tbl_schoolyear', $strandInfo);
              
        return TRUE;
    }
    

  function deleteUser($userId, $userInfo)
    {
        $this->db->where('id', $userId);
        $this->db->update('users', $userInfo);
        
        return $this->db->affected_rows();
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
            'level' => $this->_limit,
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

    
     function login($email, $password) {

        $this->db->select('id as user_id, name, email,usertype, password');
        $this->db->from('tbl_account');
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $this->db->where('status', 'Active');
        $this->db->limit(1);

        $query = $this->db->get();


            $result = $query->row();

                    return $result;

    }

    
    function getStrandInfo($id)
    {
        $this->db->select("id,strandcode,description,status");
        $this->db->from('tbl_strand');
        $this->db->where('id', $id);
        $query = $this->db->get();
        
        return $query->row();
    }

    function getSchoolYearInfo($id)
    {
        $this->db->select('id,schoolyear,datefrom,dateto,status');
        $this->db->from('tbl_schoolyear');
        $this->db->where('id', $id);
        $query = $this->db->get();
        
        return $query->row();
    }

    function getSectionInfo($id)
    {
        $this->db->select("s.id,s.section,s.adviserid,s.gradelevel,concat(f.firstname, ' ',f.lastname) as name,s.strandid,st.strandcode,s.level,s.status");
        $this->db->from('tbl_section s');
        $this->db->join('tbl_faculty f','f.id=s.adviserid');
        $this->db->join('tbl_strand st','st.id=s.strandid','left');
        $this->db->where('s.id', $id);
        $query = $this->db->get();
        
        return $query->row();
    }

    function getStudentData($id)
    {
        $this->db->select("id,firstname,lastname,status");
        $this->db->from('tbl_student');
        $this->db->where('accountid', $id);
        $query = $this->db->get();
        
        return $query->row();
    }

    function getStudentInfo($id)
    {
        $this->db->select("s.id,s.idno,s.lrn,CONCAT(s.firstname, ' ',s.lastname) name,s.firstname,s.lastname,s.middlename,s.suffix,s.birthdate,s.gender,s.addid,s.address,a.province,a.city,a.barangay,s.religion,s.nationality,s.contactno,s.mother,s.father,s.guardian,s.studenttype,s.status");
        $this->db->from('tbl_student as s');
        $this->db->join('tbl_address as a','a.id=s.addid');
        $this->db->where('s.id', $id);
        $query = $this->db->get();
        
        return $query->row();
    }

    function getFacultyInfo($id)
    {
        $this->db->select("s.id,s.idno,CONCAT(s.firstname, ' ',s.lastname) name,s.firstname,s.lastname,s.middlename,s.suffix,s.birthdate,s.gender,s.addid,s.address,a.province,a.city,a.barangay,ac.email,s.contactno,s.contactperson,ac.usertype,s.status");
        $this->db->from('tbl_faculty as s');
        $this->db->join('tbl_address as a','a.id=s.addid');
        $this->db->join('tbl_account as ac','ac.id=s.accountid');
        $this->db->where('ac.id', $id);
        $this->db->where('ac.usertype<>', 'Student');
        $query = $this->db->get();
        
        return $query->row();
    }

    function getTotal()
    {
        $this->db->select("(SELECT count(id) FROM tbl_student WHERE status='Active') as student,(SELECT count(id) FROM tbl_enrollment WHERE status='Active') as enrolled,(SELECT count(f.id) FROM tbl_faculty f INNER JOIN tbl_account a ON a.id=f.accountid WHERE a.usertype='Teacher' and f.status='Active') as teacher,(SELECT count(id) FROM tbl_section) as section,(SELECT count(id) FROM tbl_subject) as subject,(SELECT schoolyear FROM tbl_schoolyear WHERE status='Active') as schoolyear,(SELECT semester FROM tbl_semester WHERE status='Active') as semester");
        $this->db->from('tbl_student');
        $query = $this->db->get();
        
        return $query->row();
    }
    
        function strandListingCount($searchText = '',$status)
    {
        $this->db->select('id,strandcode,description,status');
        $this->db->from('tbl_strand');


            $likeCriteria = "(description LIKE '".$searchText."%'
                            AND status='".'Active'."'
                            OR strandcode  LIKE '".$searchText."%'
                            AND status='".$status."')";
                            
       $this->db->where($likeCriteria);

        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function strandListing($searchText = '', $status,$page, $segment) {

        $this->db->select('id,strandcode,description,status');
        $this->db->from('tbl_strand');
        
        $likeCriteria = "(description LIKE '".$searchText."%'
                            AND status='".$status."'
                            OR strandcode  LIKE '".$searchText."%'
                            AND status='".$status."')";

            $this->db->where($likeCriteria);
           
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function schoolyearListingCount($searchText = '')
    {
        $this->db->select('id,schoolyear,status');
        $this->db->from('tbl_schoolyear');


        $likeCriteria = "(schoolyear LIKE '".$searchText."%')";
                            
       $this->db->where($likeCriteria);

        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function schoolyearListing($searchText = '', $page, $segment) {

        $this->db->select('id,schoolyear,datefrom,dateto,status');
        $this->db->from('tbl_schoolyear');
        
        $likeCriteria = "(schoolyear LIKE '".$searchText."%')";

            $this->db->where($likeCriteria);
           
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
   

    function sectionListingCount($searchText)
    {
        $this->db->select("s.id,s.section,s.gradelevel,concat(f.firstname, ' ',f.lastname) as name,st.strandcode,s.level,s.status");
        $this->db->from('tbl_section s');
        $this->db->join('tbl_faculty f','f.id=s.adviserid');
        $this->db->join('tbl_strand st','st.id=s.strandid','left');

        $likeCriteria = "(s.section LIKE '".$searchText."%' AND s.status='".'Active'."' OR s.gradelevel LIKE '".$searchText."%' AND s.status='".'Active'."' OR concat(f.firstname, ' ',f.lastname) LIKE '".$searchText."%' AND s.status='".'Active'."')";
                            
        $this->db->where($likeCriteria);
        $this->db->order_by("s.id","ASC");

        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function sectionListing($searchText, $page, $segment) {

        $this->db->select("s.id,s.section,s.gradelevel,concat(f.firstname, ' ',f.lastname) as name,st.strandcode,s.level,s.status");
        $this->db->from('tbl_section s');
        $this->db->join('tbl_faculty f','f.id=s.adviserid');
        $this->db->join('tbl_strand st','st.id=s.strandid','left');

        $likeCriteria = "(s.section LIKE '".$searchText."%' AND s.status='".'Active'."' 
        OR s.gradelevel LIKE '".$searchText."%' AND s.status='".'Active'."' 
        OR concat(f.firstname, ' ',f.lastname) LIKE '".$searchText."%' AND s.status='".'Active'."'
        OR st.strandcode LIKE '".$searchText."%' AND s.status='".'Active'."')";

        $this->db->where($likeCriteria);
        $this->db->order_by("s.id","ASC");
           
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function semesterListingCount()
    {
        $this->db->select('id,semester,status');
        $this->db->from('tbl_semester');


        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function semesterListing($page, $segment) {

        $this->db->select('id,semester,status');
        $this->db->from('tbl_semester');
        
           
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




}
?>
