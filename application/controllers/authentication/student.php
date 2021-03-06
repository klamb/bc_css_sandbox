<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('student_model');
		$this->load->library('message');
	}	
	
	
	public function index(){
		
		$data['current_page'] = 'login';
		$this->load->view('student/student_login_form', $data);
		
	}
	
	public function login(){
		
		
		
		$email = $this->input->post('email', TRUE);
		$password = $this->input->post('password', TRUE);
		
		$student = $this->student_model->authenticate($email, $password);
		
		if (empty($student)):
			$data['current_page'] = "index";
			$this->message->set("You have entered incorrect login information. Please try again:", "error");
			$this->load->view('student/student_login_form', $data);
		else:
			//We only want one result (and should only be passed one result)
			//$student = $student[0];

			$session_data = array('student_id' => $student->student_id
								  );
			
			$this->session->set_userdata($session_data);
			//echo 'Logged in as ' . $this->session->userdata('student_id');
			redirect('student/');
			
		endif;
		
	}
	
	public function fb_login(){	
		$this->load->library('fb_connect');
		$user_id = $this->fb_connect->get_user_id();
		
		if(!$user_id):
			$login = $this->fb_connect->get_login_url();
			redirect($login);
		endif;
		
		$user_profile = $this->fb_connect->get_user_info($user_id);
		
		if($user_profile):
			$uid = $user_profile['id'];
			$first_name = $user_profile['first_name'];
			$last_name = $user_profile['last_name'];
			$email = $user_profile['email'];
			$education = $user_profile['education'];
			
			//Check valid bc student
			$is_bc_student = strstr(json_encode($education), "Boston College");
			if(!$is_bc_student):
				$this->message->set("Sorry, You're not a BC student", "error");
				$data['current_page'] = "index";
				$this->load->view('student/student_login_form', $data);
				return;
			endif;
		
			$student = $this->student_model->oauth_authenticate($uid, $email, $first_name, $last_name);
			if($student):
				$session_data = array('student_id' => $student->student_id);
				$this->session->set_userdata($session_data);
				redirect('student/');
			endif;
		endif;
		
		$this->message->set("We were unable to authenticate you through Facebook", "error");
		$this->load->view('student/student_login_form');
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect('/');
	}
	
}

/* End of file authentication/student.php */
/* Location: ./application/controllers/authentication/student.php */