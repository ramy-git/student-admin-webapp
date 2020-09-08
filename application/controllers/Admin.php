<?php
header("Access-Control-Allow-Origin: *");
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('common_model');
		$this->load->library('session');
		$this->load->library('pagination');
		
	}
	
	public function index(){


		if($this->checkLogin() == 'true'){
			redirect('Admin/dashboard');
		}
		if($this->checkLogin() == 'false'){
			redirect('Admin/login');
		}


	}
	
	
	public function login(){

		if(!empty($this->session->userdata['aid'])){
			redirect('Admin/dashboard');
		}

		$this->load->view('admin/login.php');

	}


	public function register(){

		if(!empty($this->session->userdata['aid'])){
			redirect('Admin/dashboard');
		}

		$data['class'] = $this->common_model->getData('class');
		$data['class_group'] = $this->common_model->get_class_group();

		$this->load->view('admin/register.php',$data);

	}


	public function add_student(){

		$this->checkLogin();

		$data['class'] = $this->common_model->getData('class');
		$data['class_group'] = $this->common_model->get_class_group();

		$this->load->view('admin/add_student.php',$data);
	}
	
	
	public function process_login(){

	    		if($this->input->post() == true){
		
			$clause =  array('email' => $this->input->post('email'), 'password' => $this->input->post('password'));
			$check = $this->common_model->getData('user_master',$clause);

			

			if(!empty($check)){ 
				if ($check[0]->type=='student') {
				   if($check[0]->verify==0){
				   	$this->session->set_flashdata("msg",'Account Not Verify');
					redirect('Admin/login');
				   }
				}
				$this->session->set_userdata('aid',$check[0]->id);
			    $this->session->set_userdata('aname',$check[0]->name." ".$check[0]->surname);
			    $this->session->set_userdata('atype',$check[0]->type);
			    $this->session->set_userdata('aimage',$check[0]->image);
			    $this->session->set_userdata('aclass',$check[0]->class_group);

			    redirect('Admin/dashboard');
			}else{
				$this->session->set_flashdata("msg",'Wrong Username & Password');
				redirect('Admin/login');
			}
			
		}

		if($this->checkLogin() == 'true'){
			redirect('Admin/dashboard');
		}
	
		$this->load->view('welcome/login',$data);
	    
	}
	
	
	
	
	public function checkLogin()
	{
		// if(!empty($this->session->userdata['aid'])){
		// 	return "true";
		// }else{
		// 	return "false";
		// }

		if(empty($this->session->userdata['aid'])){
			redirect('Admin/login');
		}
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Admin/login');
	}
	
	public function dashboard(){

		$this->checkLogin();

		$data['student'] = $this->common_model->get_student_all();


		$this->load->view('admin/dashboard.php',$data);

	}


	public function student($offset=null){

		$this->checkLogin();

		$config['base_url'] = base_url().'Admin/student';
		$config['total_rows'] = 0;//$this->common_model->get_student_count();
		$config['per_page'] =  0;//$this->common_model->page_limit();
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();
		
		$data['offset'] = $offset;

		$data['student'] = $this->common_model->get_student_all();

		$this->load->view('admin/student.php',$data);
	}


	public function users(){

		$this->checkLogin();

		$data['user'] = $this->common_model->get_all_user();

		$this->load->view('admin/users.php',$data);
	}



	public function edit_student($student_id){

		$this->checkLogin();

		$data['student'] = $this->common_model->getData('user_master',array('id'=>base64_decode($student_id)));

		$data['class'] = $this->common_model->getData('class');
		$data['class_group'] = $this->common_model->get_class_group();

		$this->load->view('admin/edit_student.php',$data);
	}


	public function edit_user($user_id){

		$this->checkLogin();

		$data['user'] = $this->common_model->getData('user_master',array('id'=>base64_decode($user_id)));

		$this->load->view('admin/edit_user.php',$data);
	}


	public function add_user(){

		$this->checkLogin();

		$data = array();

		$this->load->view('admin/add_user.php',$data);
	}

	public function view_student($student_id){

		$this->checkLogin();

		$data['student'] = $this->common_model->getData('user_master',array('id'=>base64_decode($student_id)));

		$data['class'] = $this->common_model->getData('class');
		$data['class_group'] = $this->common_model->get_class_group();

		$this->load->view('admin/view_student.php',$data);
	}


	


	public function class_group($offset=null){

		$this->checkLogin();
		$data['class'] = $this->common_model->getData('class');
		$data['class_group'] = $this->common_model->get_class_group();
		$this->load->view('admin/class_group.php',$data);
	}


	public function process_add_class(){


		$data['name'] = $this->input->post('name');

		$check = $this->common_model->getData('class',$data);

		if ($check) {
			$this->session->set_flashdata("msg",'Error! Duplicate Name');
			redirect('Admin/class_group');
		}

		$data['created_at'] = date('Y-m-d H:i:s');

		$add_record = $this->common_model->addRecords('class',$data);

		if ($add_record) {
			$this->session->set_flashdata("msg",'Successfull !');
		}

		redirect('Admin/class_group');
	}


	public function process_add_class_group(){


		$data['name'] = $this->input->post('name');
		$data['class_id'] = $this->input->post('class_id');

		$check = $this->common_model->getData('class_group',$data);

		if ($check) {
			$this->session->set_flashdata("msg",'Error! Duplicate Entry');
			redirect('Admin/class_group');
		}

		$data['created_at'] = date('Y-m-d H:i:s');

		$add_record = $this->common_model->addRecords('class_group',$data);

		if ($add_record) {
			$this->session->set_flashdata("msg",'Successfull !');
		}

		redirect('Admin/class_group');



	}


	public function ajax_image_upload(){


		$path = 'uploadfiles/students/';

        $image = $this->input->post('image');
        $image = imagecreatefrompng($image);
        $image_name_dbx = time().'.jpg';
        $uploader = imagejpeg($image, $path.$image_name_dbx, 80);
        imagedestroy($image);


        if ($uploader) {
            $respon = array('status'=>1,'image'=>$image_name_dbx);
            echo json_encode($respon);
            die();
        }else{
            $respon = array('status'=>0);
            echo json_encode($respon);
            die();
        }
	}

	public function process_store_student_external(){

		$data['name'] = $this->input->post('name');
		$data['surname'] = $this->input->post('surname');
		$data['class_group'] = $this->input->post('class_group');
		$data['student_id'] = $this->input->post('student_id');
		$data['phone'] = $this->input->post('phone');
		$data['email'] = $this->input->post('email');
		$data['password'] = $this->input->post('password');
		$data['image'] = $this->input->post('image');
		$data['type'] = 'student';
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['updated_at'] = date('Y-m-d H:i:s');

		$check = $this->common_model->getData('user_master',array('email'=>$this->input->post('email')));

		if ($check) {
			$this->session->set_flashdata("msg",'Error! Duplicate Email');
			redirect('Admin/login');
		}

		$add_record = $this->common_model->addRecords('user_master',$data);

		if ($add_record) {
			$this->session->set_flashdata("msg",'Registration Successfull ! varificaation email send to your email adderess');
		}

		redirect('Admin/login');
		
	}


	public function process_store_student_internal(){

		$data['name'] = $this->input->post('name');
		$data['surname'] = $this->input->post('surname');
		$data['class_group'] = $this->input->post('class_group');
		$data['student_id'] = $this->input->post('student_id');
		$data['phone'] = $this->input->post('phone');
		$data['email'] = $this->input->post('email');
		$data['password'] = $this->input->post('password');
		$data['image'] = $this->input->post('image');
		$data['verify'] = $this->input->post('verify');
		$data['type'] = 'student';
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['updated_at'] = date('Y-m-d H:i:s');

		$check = $this->common_model->getData('user_master',array('email'=>$this->input->post('email')));

		if ($check) {
			$this->session->set_flashdata("msg",'Error! Duplicate Email');
			redirect('Admin/student');
		}

		$add_record = $this->common_model->addRecords('user_master',$data);

		if ($add_record) {
			$this->session->set_flashdata("msg",'Registration Successfull !');
		}

		redirect('Admin/student');
		
	}


	public function process_update_student(){

		$id = $this->input->post('id');


		$data['name'] = $this->input->post('name');
		$data['surname'] = $this->input->post('surname');
		$data['class_group'] = $this->input->post('class_group');
		$data['student_id'] = $this->input->post('student_id');
		$data['phone'] = $this->input->post('phone');
		$data['email'] = $this->input->post('email');
		$data['password'] = $this->input->post('password');
		$data['image'] = $this->input->post('image');
		$data['verify'] = $this->input->post('verify');
		$data['updated_at'] = date('Y-m-d H:i:s');


		$update = $this->common_model->updateData('user_master',$data,'id='.$id);

		if ($update) {
			$this->session->set_flashdata("msg",' Successfull !');
		}

		redirect('Admin/student');

	}


	public function process_update_user(){

		$id = $this->input->post('id');


		$data['name'] = $this->input->post('name');
		$data['surname'] = $this->input->post('surname');
		$data['email'] = $this->input->post('email');
		$data['password'] = $this->input->post('password');
		$data['image'] = $this->input->post('image');
		$data['type'] = $this->input->post('type');
		$data['updated_at'] = date('Y-m-d H:i:s');


		$update = $this->common_model->updateData('user_master',$data,'id='.$id);

		if ($update) {
			$this->session->set_flashdata("msg",' Successfull !');
		}

		redirect('Admin/users');


	}


	public function process_store_user(){


		$data['name'] = $this->input->post('name');
		$data['surname'] = $this->input->post('surname');
		$data['email'] = $this->input->post('email');
		$data['password'] = $this->input->post('password');
		$data['image'] = $this->input->post('image');
		$data['type'] = $this->input->post('type');
		$data['updated_at'] = date('Y-m-d H:i:s');
		$data['created_at'] = date('Y-m-d H:i:s');

		$check = $this->common_model->getData('user_master',array('email'=>$this->input->post('email')));

		if ($check) {
			$this->session->set_flashdata("msg",'Error! Duplicate Email');
			redirect('Admin/users');
		}

		$add = $this->common_model->addRecords('user_master',$data);

		if ($add) {
			$this->session->set_flashdata("msg",' Successfull !');
		}

		redirect('Admin/users');



	}



	


	public function success($offset=""){

		$query = $this->common_model->get_student_query();
		$paginate = $this->common_model->paginate($this->common_model->get_student_query(),"");

		$x = $this->common_model->GetPages($this->common_model->get_student_query(),$offset);

		print_r($x);


		echo "Success";

	}






	public function delete_student($student_id=""){

		$this->checkLogin();

		$check = $this->common_model->getData('user_master',array('id'=>base64_decode($student_id)));

		if ($check) {
			$delete =  $this->common_model->deleteMultipleRecord('user_master',array('id'=>$check[0]->id));

			if ($delete) {
				$this->session->set_flashdata("msg",' Successfull !');
			}
		}

		redirect('Admin/student');

	}



	public function delete_user($user_id=""){

		$this->checkLogin();

		$check = $this->common_model->getData('user_master',array('id'=>base64_decode($student_id)));

		if ($check) {
			$delete =  $this->common_model->deleteMultipleRecord('user_master',array('id'=>$check[0]->id));

			if ($delete) {
				$this->session->set_flashdata("msg",' Successfull !');
			}
		}

		redirect('Admin/users');

	}



	public function edit_class_group($class_group_id=""){

		$this->checkLogin();

		$data['class_group'] = $this->common_model->getData('class_group',array('id'=>base64_decode($class_group_id)));


		$data['class'] = $this->common_model->getData('class');


		$this->load->view('admin/edit_class_group.php',$data);

	}


	public function process_update_class_group(){


		$id = $this->input->post('id');


		$data['name'] = $this->input->post('name');
		$data['class_id'] = $this->input->post('class_id');


		$update = $this->common_model->updateData('class_group',$data,'id='.$id);

		if ($update) {
			$this->session->set_flashdata("msg",' Successfull !');
		}

		redirect('Admin/class_group');

	}



	public function edit_class($class_id=""){

		$this->checkLogin();

		$data['class'] = $this->common_model->getData('class',array('id'=>base64_decode($class_id)));


		$this->load->view('admin/edit_class.php',$data);

	}

	public function process_update_class(){

		$id = $this->input->post('id');


		$data['name'] = $this->input->post('name');


		$update = $this->common_model->updateData('class',$data,'id='.$id);

		if ($update) {
			$this->session->set_flashdata("msg",' Successfull !');
		}

		redirect('Admin/class_group');


	}



	public function delete_class_group($class_group_id){


		$check = $this->common_model->getData('user_master',array('class_group'=>base64_decode($class_group_id)));

		if ($check) {
			$this->session->set_flashdata("msg",'Error! Used  By Student');
			redirect('Admin/class_group');
		}

		$delete =  $this->common_model->deleteMultipleRecord('class_group',array('id'=>json_decode($class_group_id)));

		if ($delete) {
			$this->session->set_flashdata("msg",' Successfull !');
		}

		redirect('Admin/class_group');

	}



	public function delete_class($class_id){


		$check = $this->common_model->getData('class_group',array('class_id'=>base64_decode($class_id)));

		if ($check) {
			$this->session->set_flashdata("msg",'Error! Used  By Class Group');
			redirect('Admin/class_group');
		}

		$delete =  $this->common_model->deleteMultipleRecord('class',array('id'=>base64_decode($class_id)));

		if ($delete) {
			$this->session->set_flashdata("msg",' Successfull !');
		}

		redirect('Admin/class_group');

	}



	
	
	
	


}
