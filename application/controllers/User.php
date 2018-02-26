<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->model('class_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}

	public function insert(){
		$this->form_validation->set_rules('user_username', 'Username', 'required|is_unique[user.user_username]');
		$this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email|is_unique[user.user_email]');

		if ($this->form_validation->run() == FALSE){
            $msg['success']=false;
            echo json_encode($msg);	

            // $msg['error']=validation_errors();
            // $nama=validation_errors();
            echo validation_errors();;
        }else{
			$data = array(
				'user_name' 	=> $this->input->post('user_name'), 
				'user_email' 	=> $this->input->post('user_email'), 
				'user_pw' 		=> md5($this->input->post('password')), 
				'user_username' => $this->input->post('user_username'),  
				'user_flag_del'	=> '1',
				'user_image'	=> 'default.jpg'
			);

			$this->user_model->insert($data);

			$data_login = array(
				'user_username' =>  $this->input->post('user_username'),
				'user_pw'		=> md5($this->input->post('password'))
			);

			$data=$this->user_model->get($data_login);

			$session = array(
				'username' 			=> $data['user_username'],
				'user_id'			=> $data['user_id'],
				'user_email'		=> $data['user_email'],
				'user_name'			=> $data['user_name'],
				'user_image'		=> $data['user_image']
			);
			$this->session->set_userdata($session);
			$config['useragent'] = 'CodeIgniter';
			$config['protocol'] = 'smtp';
			//$config['mailpath'] = '/usr/sbin/sendmail';
			$config['smtp_host'] = 'ssl://smtp.googlemail.com';
			$config['smtp_user'] = 'classsmart36@gmail.com';
			$config['smtp_pass'] = 'praktikum';
			$config['smtp_port'] = 465; 
			$config['smtp_timeout'] = 5;
			$config['wordwrap'] = TRUE;
			$config['wrapchars'] = 76;
			$config['mailtype'] = 'html';
			$config['charset'] = 'utf-8';
			$config['validate'] = FALSE;
			$config['priority'] = 3;
			$config['crlf'] = "\r\n";
			$config['newline'] = "\r\n";
			$config['bcc_batch_mode'] = FALSE;
			$config['bcc_batch_size'] = 200;

			$this->load->library('email'); // Note: no $config param needed
			$this->email->initialize($config);
			$this->email->from('classsmart36@gmail.com', 'classsmart36@gmail.com');
			$this->email->to($data['user_email']);
			$this->email->subject('Welcome To SmartClass');
			$message='Selamat Bergabung '.$data['user_name'];
			$this->email->message($message);
			$this->email->send();
			redirect('../index.php/welcome/setPicture');
		
			$msg['success']=true;
			echo json_encode($msg);
		}
	}

	public function editPicture(){

		$file_name=$this->session->userdata('user_id')."_".$this->session->userdata('username')."_".time();

		$config = array(
			'upload_path' 	=> 'images/user', 
			'allowed_types'	=> 'jpg|png|gif',
			'max_size'		=> 100000,
			'file_name'		=> $file_name,
			'overwrite'		=> true
		);
		$data = array(
    		'user_address' 	=> $this->input->post('user_address'),
    		'user_hp'		=> $this->input->post('user_hp'),
    		'user_birth'	=> $this->input->post('user_birth'),
    	);

		$this->load->library('upload',$config);
		if (isset($_FILES['picture']['name'][0])) {
			if ( ! $this->upload->do_upload('picture')){
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
	        }else{
	        	$dataDoc = array('upload_data' => $this->upload->data());
	        	$data['user_image']=$dataDoc['upload_data']['file_name'];
			}
		}else{
			$data['user_image']=$this->input->post('user_image');
		}
		// print_r($data);
		$this->session->set_userdata('user_image',$data['user_image']);
		$where = array('user_id' => $this->session->userdata('user_id'));
		$this->user_model->update($data,$where);
		redirect(base_url());

	}

	public function update(){
		// print_r($_POST);
		$username=$this->uri->segment(3);
		$data = array(
			'user_name' => $this->input->post('user_name'), 
			'user_address' => $this->input->post('user_address'), 
			'user_hp' => $this->input->post('user_hp'), 
			'user_email' => $this->input->post('user_email'), 
			'user_birth' => $this->input->post('user_birth'), 
		);

		$where = array('user_id' => $this->session->userdata('user_id'), );

		$this->user_model->update($data,$where);
		$this->session->set_userdata($data);
		redirect('../user/view/'.$username);
	}

	public function view(){
		$username=$this->uri->segment(3);
		$where = array('user_username' => $username );
		$data['user']=$this->user_model->get($where);
		$where = array('detail_class.user_id' =>  $data['user']['user_id']);
		$data['class_member']=$this->class_model->getClassUser($where);
		// echo "<pre>";
		// print_r($data);
		$where = array('detail_class.user_id' =>  $this->session->userdata('user_id'));
		$data['all_class']=$this->class_model->getClassUser($where);
		$this->load->view('user/profile_user',$data);
	}
	
}
	