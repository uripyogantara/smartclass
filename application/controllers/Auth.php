<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->model('user_model');

	}

	public function login(){
		$data_login = array(
			'user_username' =>  $this->input->post('user_username'),
			'user_pw'		=> md5($this->input->post('user_pw')),
		);

		$data=$this->user_model->get($data_login);
		$msg['success']=true;
		if (!empty($data)) {
			$session = array(
				'username' 			=> $data['user_username'],
				'user_id'			=> $data['user_id'],
				'user_address'		=> $data['user_address'],
				'user_hp'			=> $data['user_hp'],
				'user_name'			=> $data['user_name'],
				'user_birth'		=> $data['user_birth'],
				'user_image'		=> $data['user_image']
			);
			$this->session->set_userdata($session);
			$msg['success']=true;
		}else{
			$msg['success']=false;
		}
		echo json_encode($msg);
	}

	public function logout(){
		session_destroy();
		redirect('../');
	}

}
