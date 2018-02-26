<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->library('zip');
		$this->load->model('class_model');
		$this->load->model('post_model');
		$this->load->library('email');
	}

	public function email(){
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
		$this->email->to('uripyogantara@gmail.com');
		$this->email->subject('Test email from CI and Gmail');
		$this->email->message('This is a test.');
		$this->email->send();
	}

	public function index(){	
		if (empty($this->session->userdata('user_id'))) {
			$this->load->view('index');
		}else{
			/*class user untuk di navbar*/
			$where = array('detail_class.user_id' =>  $this->session->userdata('user_id'),'detail_class.flag_del'=>1);
			$data['all_class']=$this->class_model->getClassUser($where);
			$this->load->view('home',$data);
		}
		
	}

	public function viewPostHome(){
		$where = array(
				'detail_class.user_id' => $this->session->userdata('user_id'),
				'post.flag_del' => 1
		);
		$data['post']=$this->post_model->view($where);
		$i=0;
		foreach ($data['post'] as  $value) {
			
			$whereDetail = array(
				'post.post_id' => $value['post_id'],
				'post.flag_del' => 1
			);

			$whereComment = array(
				'post_id' => $value['post_id'],
				'flag_del' => 1
			);

			$data['post'][$i]['countComment']=$this->post_model->countComment($whereComment); 
			$data['post'][$i]['comment']=$this->post_model->viewComment($whereComment);
			$data['post'][$i]['detailPost']=$this->post_model->getDetail($whereDetail);

			$whereGroup = array(
				'post_id' => $value['post_id'], 
				'user_id' => $this->session->userdata('user_id')
			);

			$member_group=$this->post_model->getTaskMember($whereGroup);
			$data['post'][$i]['task']=$member_group['task_id'];

			$where = array(
				'post_id' => $value['post_id'], 
				'task_id IS NOT' =>  NULL
			);

			$data['post'][$i]['countTask']=$this->post_model->countTask($where);

			$data['post'][$i]['member']=$this->post_model->getClassMember($where);
			$i++;
		}
		$this->load->view('viewPostHome',$data);
	}

	public function addClass(){
		if (empty($this->session->userdata('user_id'))) {
			redirect('../');
		}
		$where = array('detail_class.user_id' =>  $this->session->userdata('user_id'),'detail_class.flag_del'=>1);
		$data['all_class']=$this->class_model->getClassUser($where);
		$this->load->view('formClass',$data);
	}

	public function setPicture(){
		if (empty($this->session->userdata('user_id'))) {
			redirect('../');
		}
		$where = array('detail_class.user_id' =>  $this->session->userdata('user_id'),'detail_class.flag_del'=>1);
		$data['all_class']=$this->class_model->getClassUser($where);
		$this->load->view('wizards',$data);
	}
}
	