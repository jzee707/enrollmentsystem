<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

   
class Subject_model extends CI_Model {
    
    function __construct(){
        parent::__construct();
        
    }
    
 
    //Declaration of a methods
   //Declaration of a methods
    public function setUserID($userID) {
        $this->_userID = $userID;
    }

    public function setSubject($subject) {
        $this->_subject = $subject;
    }
 
    public function setDescription($description) {
        $this->_description = $description;
    }

    public function setGradeLevel($gradelevel) {
        $this->_gradelevel = $gradelevel;
    }

    public function setStrand($strand) {
        $this->_strand = $strand;
    }


    public function setStatus($status) {
        $this->_status = $status;
    }

 
    //create new user
    public function addJHSubject() {

        $data = array(
            'subject' => $this->_subject,
            'description' => $this->_description,
            'gradelevel' => $this->_gradelevel,           
            'type' => 'JHS'
        );

        $this->db->insert('tbl_subject', $data);
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
            'strandid' => $this->_strand,
            'type' => 'SHS'
        );

        $this->db->insert('tbl_subject', $data);
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

    function getJHSubjectInfo($id)
    {
        $this->db->select("id,subject,description,gradelevel,type,status");
        $this->db->from('tbl_subject');
        $this->db->where('id', $id);
        $query = $this->db->get();
        
        return $query->row();
    }

    function getSHSubjectInfo($id)
    {
        $this->db->select('s.id,s.gradelevel,s.subject,s.description,s.status,st.id as strandcode');
        $this->db->from('tbl_subject s');
        $this->db->join('tbl_strand st','st.id=s.strandid','left');
        $this->db->where('s.id', $id);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    function jhsubjectListingCount($searchText)
    {
        $this->db->select('id,gradelevel,subject,description,status');
        $this->db->from('tbl_subject');


            $likeCriteria = "(subject  LIKE '".$searchText."%'
                            AND status='".'Active'."' AND type='".'JHS'."'
                            OR description  LIKE '".$searchText."%'
                            AND status='".'Active'."' AND type='".'JHS'."' OR gradelevel LIKE '".$searchText."%'
                            AND status='".'Active'."' AND type='".'JHS'."')";
                            
       $this->db->where($likeCriteria);
       $this->db->order_by("id","ASC");

        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function jhsubjectListing($searchText, $page, $segment) {

        $this->db->select('id,gradelevel,subject,description,status');
        $this->db->from('tbl_subject');


        $likeCriteria = "(subject  LIKE '".$searchText."%'
        AND status='".'Active'."' AND type='".'JHS'."'
        OR description  LIKE '".$searchText."%'
        AND status='".'Active'."' AND type='".'JHS'."' OR gradelevel LIKE '".$searchText."%'
        AND status='".'Active'."' AND type='".'JHS'."')";

        $this->db->where($likeCriteria);    
        $this->db->order_by("id","ASC");   
      
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function shsubjectListingCount($searchText)
    {
        $this->db->select('s.id,s.gradelevel,s.subject,s.description,s.status,st.strandcode');
        $this->db->from('tbl_subject s');
        $this->db->join('tbl_strand st','st.id=s.strandid','left');

        $likeCriteria = "(s.subject  LIKE '".$searchText."%'
        AND s.status='".'Active'."' AND s.type='".'SHS'."'  OR s.description  LIKE '".$searchText."%'
        AND s.status='".'Active'."' AND s.type='".'SHS'."'  OR s.gradelevel LIKE '".$searchText."%'
        AND s.status='".'Active'."' AND s.type='".'SHS'."'  OR st.strandcode  LIKE '".$searchText."%'
        AND s.status='".'Active'."' AND s.type='".'SHS'."')";
                            
       $this->db->where($likeCriteria);
       $this->db->order_by("s.id","ASC");

        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function shsubjectListing($searchText, $page, $segment) {

        $this->db->select('s.id,s.gradelevel,s.subject,s.description,s.status,st.strandcode');
        $this->db->from('tbl_subject s');
        $this->db->join('tbl_strand st','st.id=s.strandid','left');

        $likeCriteria = "(s.subject  LIKE '".$searchText."%'
        AND s.status='".'Active'."' AND s.type='".'SHS'."'  OR s.description  LIKE '".$searchText."%'
        AND s.status='".'Active'."' AND s.type='".'SHS'."'  OR s.gradelevel LIKE '".$searchText."%'
        AND s.status='".'Active'."' AND s.type='".'SHS'."'  OR st.strandcode  LIKE '".$searchText."%'
        AND s.status='".'Active'."' AND s.type='".'SHS'."')";

        $this->db->where($likeCriteria);
        $this->db->order_by("s.id","ASC");
      
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function getStrandList()
	{
        $this->db->select('id,strandcode');
        $this->db->from('tbl_strand');
        $this->db->where('status','Active');
		
        return $this->db->get();
		
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

}
?>
