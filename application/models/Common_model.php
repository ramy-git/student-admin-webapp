<?php	

class Common_model extends CI_model{	
	
	public function __construct(){		
	
		$this->load->database();		
	}
	
	public function getData($tblName, $dataget='', $limits ='', $orderby='', $orderformat ='DESC', $orDatget='' ) {

		$this->db->select('*');
		if($dataget != ''){					
			foreach ($dataget as $field => $value)					
				$this->db->where($field, $value);
		}	
		if($orDatget != ''){					
			foreach ($orDatget as $field => $value)				
			$this->db->or_where($field, $value);	
		}												
		if ($limits != ''){				
			$this->db->limit($limits);
		}	
		if ($orderby != ''){
			$this->db->order_by($orderby, $orderformat);
		}						
		$query = $this->db->get($tblName);			
		return $query->result();		
	}

   // single record		
	public function getDataSingle($tableName, $dataget, $returnType = ''){
		if($dataget != ''){					
			foreach ($dataget as $field => $value)					
				$this->db->where($field, $value);
		}
		$result = $this->db->get($tableName);
		if ($result->num_rows() > 0) {		
			if ($returnType == 'array')					
				return $result->row_array();
			else					
				return $result->row();
		}		
			else			
				return FALSE;		
	}
	

	public function getRow($tableName, $colName, $id, $returnType = '') {
		$this->db->where($colName, $id);	
		$result = $this->db->get($tableName);
		if ($result->num_rows() > 0) {		
			if ($returnType == 'array')					
				return $result->row_array();
			else					
				return $result->row();
		}		
			else			
				return FALSE;		
	}
		
	/*  Search */
	public function getSearchData($tblName, $search){	

		$this->db->or_where('company_name', $search);	
		$this->db->or_where('company_type', $search);	
		$this->db->or_where('job_profile', $search);
		$this->db->or_where('qualification', $search);	
		$query = $this->db->get($tblName);		
		return $query->result();		
	}
		
	/* Updates */

	public function	updateData($tblName, $data, $clause){
		$this->db->set($data);			
		$this->db->where($clause);			
		$this->db->update($tblName);			
		return $this->db->affected_rows();		
	}	
	
	
	function getAllLeavesWithStatus($userId){
	    $query= $this->db->query("SELECT * FROM `leaves` where `hr_id`='".$userId."' and approve_decline !=''");
        return $query->result();
	}
		
			
	/* Insert */

	function addRecord($tblName, $data){		
		$this-> db->insert($tblName, $data);
		return $this->db->affected_rows();	
	}
	
	function addRecords($tblName, $data){		
		$this-> db->insert($tblName, $data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}
	 
	

	/* Delete */
	
	public function deleteRecord($tblName, $uid){
		$this->db->where($uid);		
		$this->db->delete($tblName);   	
		return $this->db->affected_rows();
	}
	
	public function deleteMultipleRecord($tblName, $dataget) {

       $this->db->where($dataget);
    
       $this->db->delete($tblName);
    
       return TRUE;
    
    }
	/*get count */
	public function getCount($tblName,$clause){
		if($clause != ''){					
			foreach ($clause as $field => $value)					
			$this->db->where($field, $value);
		}
		$query = $this->db->get($tblName);			
		return $query->num_rows();
	}
	
	public function isUserExit($tblName,$clause){
		if($clause != ''){					
			foreach ($clause as $field => $value)					
			$this->db->where($field, $value);
		}
		$query = $this->db->get($tblName);			
		if($query->num_rows() >0){
			return true;
		}else{
			return false;
		}
	}
	public function getDetailsByEmail($tblName,$clause){
		if($clause != ''){					
			foreach ($clause as $field => $value)					
			$this->db->where($field, $value);
		}
		$query = $this->db->get($tblName);			
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
		}
	}
	
	public function getsystemTradeVolume(){
	    
	   $query = $this->db->query('SELECT record_master.Id FROM record_master
INNER JOIN account_master ON record_master.account_id = account_master.account_id WHERE account_master.account_type=1;');
       return $query->num_rows();;
	}



	public function get_data_limited($tbl="",$limit="",$start=""){

	$this->db->select('*');
    $this->db->from($tbl);
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
	}



	public function getData_limited($tblName, $dataget='', $limits ='', $start ='', $orderby='', $orderformat ='DESC', $orDatget='' ) {

		$this->db->select('*');
		if($dataget != ''){					
			foreach ($dataget as $field => $value)					
				$this->db->where($field, $value);
		}	
		if($orDatget != ''){					
			foreach ($orDatget as $field => $value)				
			$this->db->or_where($field, $value);	
		}												
		if ($limits != ''){				
			$this->db->limit($limits,$start);
		}	
		if ($orderby != ''){
			$this->db->order_by($orderby, $orderformat);
		}						
		$query = $this->db->get($tblName);			
		return $query->result();		
	}


	public function paginate($query,$url){

		$this->load->library('pagination');

		$count_all = count($query->get()->result());
		$limit = 10;

		$config['base_url'] = $url;
		$config['total_rows'] = $count_all;
		$config['per_page'] = $limit;
		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}


	public function GetPages($query,$start=""){
		if ($start=="") {
			$start=0;
		}
		return $query->limit(10, $start)->get()->result();

	}


	public function get_student_pages($offset=null){

		$limit = $this->common_model->page_limit();

		$this->db->select('*');
	    $this->db->from('user_master');
	    $this->db->where('type','student');
	    $this->db->limit($limit, $offset);
	    $this->db->order_by('id', 'desc');
	    return $this->db->get()->result();

	}

	public function get_student_count(){

		$this->db->select('*');
	    $this->db->from('user_master');
	    $this->db->where('type','student');
	    return count($this->db->get()->result());

	}

	public function page_limit(){
		return 1;
	}



	public function get_student_all(){

		


		$sql_array = array('user_master.*',
            'class.name as class_name',
            'class_group.name as class_group_name'
    		);
        $this->db->select(implode(",",$sql_array))
         ->from('user_master')
         ->join('class_group', 'class_group.id = user_master.class_group','left')
         ->join('class', 'class.id = class_group.class_id','left')
         ->where('user_master.type','student')
         ->order_by('user_master.id','desc');

         if ($this->session->userdata('atype')=='student') {
			$this->db->where('user_master.class_group',$this->session->userdata('aclass'));
		}

         return $this->db->get()->result();
	}


	public function get_all_user(){

			$sql_array = array('user_master.*'
    		);
        $this->db->select(implode(",",$sql_array))
         ->from('user_master')
         ->where('user_master.type !=','student')
         ->order_by('user_master.id','desc');
         return $this->db->get()->result();
	}

	public function get_class_group(){

		$sql_array = array('class_group.*',
            'class.name as class_name'
    );
        $this->db->select(implode(",",$sql_array))
         ->from('class_group')
         ->join('class', 'class_group.class_id = class.id','left');
         return $this->db->get()->result();
	}
	
	
	/* End Of Class*/
}
?>	