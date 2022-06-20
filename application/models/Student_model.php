<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    include('phpqrcode/qrlib.php');

   
class Student_model extends CI_Model {
    
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

    public function setPassword($password) {
        $this->_password = $password;
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

    public function setStatus($status) {
        $this->_status = $status;
    }

 
    //create new user
    public function addStudent() {

        $data = array(
            'idno' => $this->_idno,
            'lrn' => $this->_lrn,
            'studenttype' => $this->_studenttype,
            'firstname' => $this->_firstname,
            'middlename' => $this->_middlename,
            'lastname' => $this->_lastname,
            'suffix' => $this->_suffix,
            'birthdate' => $this->_dob,
            'gender' => $this->_gender,
            'nationality' => $this->_nationality,
            'religion' => $this->_religion,
            'addid' => $this->_barangay,
            'address' => $this->_address,
            'accountid' => $this->_userID,
            'mother' => $this->_mother,
            'father' => $this->_father,
            'guardian' => $this->_guardian,
            'contactno' => $this->_contactno,
            'date_created' => $this->_timeStamp,
            'date_requested' => $this->_timeStamp,
            'status' => $this->_status
        );

        $this->db->insert('tbl_student', $data);
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
            'usertype' => 'Student',
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
    
    
    
    function editStudent($studentInfo, $id)
    {       
        $this->db->where('id', $id);
        $this->db->update('tbl_student', $studentInfo);
              
        return TRUE;
    }

  function deleteUser($userId, $userInfo)
    {
        $this->db->where('id', $userId);
        $this->db->update('users', $userInfo);
        
        return $this->db->affected_rows();
    }

    function getStudentInfo($id)
    {
        $this->db->select("s.id,s.idno,s.lrn,CONCAT(s.firstname, ' ',s.lastname) name,s.firstname,s.lastname,s.middlename,s.suffix,s.birthdate,s.gender,s.addid,s.address,a.province,a.city,a.barangay,s.religion,s.nationality,ac.email,s.contactno,s.mother,s.father,s.guardian,s.studenttype,s.status");
        $this->db->from('tbl_student as s');
        $this->db->join('tbl_address as a','a.id=s.addid');
        $this->db->join('tbl_account as ac','ac.id=s.accountid');
        $this->db->where('s.id', $id);
        $query = $this->db->get();
        
        return $query->row();
    }

    
        function studentsListingCount($searchText = '',$status)
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

    function studentListing($searchText = '', $page, $segment,$status) {

        $this->db->select("id,idno,lrn,CONCAT(firstname, ' ',lastname) name,firstname,lastname,middlename,suffix,birthdate,gender,address,contactno,studenttype,status");
        $this->db->from('tbl_student');
        
        $likeCriteria = "(CONCAT(firstname, ' ',lastname)  LIKE '".$searchText."%'
        AND status='".$status."'
        OR CONCAT(lastname, ' ',firstname)  LIKE '".$searchText."%'
        AND status='".$status."'
        OR CONCAT(lastname, ' ',firstname)  LIKE '".$searchText."%'
        AND status='".$status."')";

            $this->db->where($likeCriteria);
       
        

        $this->db->order_by('id', 'ASC');
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

    public function SendEmailRegistration($firstname,$lastname,$email) {   
        
        $subject = "Pre-Registration";
        $message = "
        <p>Good Day! ". $firstname . ' ' . $lastname.'.'."</p>
         
        <p>Thank you for submitting a request for registration! Now that your request has been approved.
        You may proceed to login and enroll your selected subjects.

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
        
        $subject = "Pre-Registration";
        $message = "
        <p>Good Day! ". $firstname . ' ' . $lastname.'.'."</p>
         
        <p>Thank you for submitting a request for registration! Sorry to inform you that your request was declined.
        You may submit another registration form.

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
