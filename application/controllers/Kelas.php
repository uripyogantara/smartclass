<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {

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
/*
==================================================================================================
post_type = 1 (post biasa)
			2 (share_materi)
			3 (kumpul_tugas_individu)
			4 (kumpul_tugas_kelompok)
==================================================================================================
*/
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->library('zip');
		$this->load->model('class_model');
		$this->load->model('post_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		if (empty($this->session->userdata('user_id'))) {
			redirect('../');
		}
		date_default_timezone_set('Asia/Singapore');
	}

	public function insert(){
		$this->form_validation->set_rules('class_nickname', 'Nick Name', 'required|is_unique[class.class_nickname]');

		if ($this->form_validation->run() == FALSE){
            $msg['success']=false;
            echo json_encode($msg);	
        }else{
        	$config['upload_path']='./images/class/profile';
			$config['allowed_types']= 'jpg|png|gif';
			$config['max_size']= 100000;
			$new_name = $this->input->post('class_nickname').'_'.time();
			$config['file_name'] = $new_name;
			$config['overwrite']=true;

			$this->load->library('upload',$config);
			if ( ! $this->upload->do_upload('class_image')){
				$error = array('error' => $this->upload->display_errors());
				$msg['success']=false;
	            echo json_encode($msg);	
	        }else{
	        	$data_gambar = array('upload_data' => $this->upload->data());
	        	$data = array(
					'class_name' 		=> $this->input->post('class_name'),
					'class_nickname'	=> $this->input->post('class_nickname'),
					'class_pw'			=> md5($this->input->post('class_pw')),
					'class_type'		=> $this->input->post('class_type'),
					'class_info'		=> $this->input->post('class_info'),
					'class_token'		=> md5(time()),
					'class_image'		=> $data_gambar['upload_data']['file_name'],
					'class_cover'		=> 'default.jpg',
					'created_by'		=> $this->session->userdata('user_id'),
					'created_at'		=> date('Y-m-d H:i:s')
				);

				$class_id=$this->class_model->insert($data);

				$dataDetail = array(
					'class_id' 		=> $class_id,
					'user_id'		=> $this->session->userdata('user_id'),
					'user_type'		=> 1
				);

				$this->class_model->insertDetail($dataDetail);
				$this->session->set_flashdata('success','Kelas Berhasil Ditambahkan');
		        $msg['success']=true;
				echo json_encode($msg);		
	        }	
        }
		
	}

	public function updateClass(){
		$nickname=$this->uri->segment(3);
		$data = array(
			'class_name' 		=> $this->input->post('class_name'),
			'class_type'		=> $this->input->post('class_type'),
			'class_info'		=> $this->input->post('class_info'),
		);

		$where = array(
			'class_nickname' => $this->uri->segment(3), 
		);

		$this->class_model->updateClass($data,$where);
		redirect("kelas/about/$nickname");
	}

	public function allClass(){
		/*class user untuk di navbar*/
		$where = array('detail_class.user_id' =>  $this->session->userdata('user_id'),'detail_class.flag_del'=>1);
		$data['all_class']=$this->class_model->getClassUser($where);

		foreach ($data['all_class'] as $key => $value) {
			$where = array(
				'class.class_nickname' => $value['class_nickname'], 
				'detail_class.flag_del'	=> '1'

			);
			$data['all_class'][$key]['member']=$this->class_model->getClassUser($where);
		}

		// echo "<pre>";
		// print_r($data['all_class']);
		$this->load->view('class/all_class',$data);
	}

	public function destroyClass(){
		$where = array('class_id' =>  $this->input->post('id'));
		$data = array('flag_del' => 0, );

		$this->class_model->updateClass($data,$where);
		$this->class_model->updateDetailClass($data,$where);
	}

	public function view(){
		/*mencari data kelas berdasarkan token*/
		$nickname=$this->uri->segment(3);
		$where = array('class_nickname' =>  $nickname,'flag_del' =>1);
		$data['class']=$this->class_model->view($where);
		if (empty($data['class'])) {
			$this->load->view('error/html/error_404');
		}else{
			/*mencari detail kelas untuk menentukan apa user sudah join*/
			$dataDetail = array(
				'class_id' 	=> $data['class']['class_id'],
				'user_id'	=> $this->session->userdata('user_id'),
				'flag_del' => '1'
			);
			$data['detail_class']=$this->class_model->viewDetail($dataDetail);


			/*class user untuk di navbar*/
			$where = array('detail_class.user_id' =>  $this->session->userdata('user_id'),'detail_class.flag_del'=>1);
			$data['all_class']=$this->class_model->getClassUser($where);

			/*menghitung jumlah member*/
			$where = array(
				'class.class_nickname' => $nickname, 
				'detail_class.flag_del' =>1
			);
			$data['count_member']=$this->class_model->countMember($where);

			/*menghitung jumlah photos*/
			$where = array(
				'class_nickname' =>  $nickname,
				'post.flag_del'	=> 1
			);
			$data['count_photos']=$this->post_model->countPhotos($where);
			$this->load->view('class/viewClass',$data);
		}	
	}

	public function changeCover(){
		$nickname=$this->uri->segment(3);
		$where = array('class_nickname' =>  $nickname);
		$file_name=$nickname.'_cover'.time();
		$config = array(
			'upload_path' 	=> './images/class/cover', 
			'allowed_types'	=> 'jpg|jpeg|png|gif',
			'max_size'		=> 1000000,
			'file_name'		=> $file_name,
			'overwrite'		=> true
		);

		$this->load->library('upload',$config);

		if (!$this->upload->do_upload('image_cover')) {
			$error = array('error' => $this->upload->display_error());
			$msg['success']=false;
	        echo json_encode($msg);
		}else{	
			$data_file  = array('upload_data' => $this->upload->data());
			$data = array('class_cover' =>  $data_file['upload_data']['file_name']);
			$this->class_model->updateClass($data,$where);
			$msg['success']=true;
	        echo json_encode($msg);
		}
	}

	public function about(){
		$nickname=$this->uri->segment(3);
		$where = array('class_nickname' =>  $nickname);
		$data['class']=$this->class_model->view($where);
		
		/*mencari detail kelas untuk menentukan apa user sudah join*/
		$dataDetail = array(
			'class_id' 	=> $data['class']['class_id'],
			'user_id'	=> $this->session->userdata('user_id'),
			'flag_del' => '1'
		);
		$data['detail_class']=$this->class_model->viewDetail($dataDetail);


		/*class user untuk di navbar*/
		$where = array('detail_class.user_id' =>  $this->session->userdata('user_id'),'detail_class.flag_del'=>1);
		$data['all_class']=$this->class_model->getClassUser($where);

		/*menghitung jumlah member*/
		$where = array(
			'class.class_nickname' => $nickname, 
			'detail_class.flag_del' =>1
		);
		$data['count_member']=$this->class_model->countMember($where);

		/*menghitung jumlah photos*/
		$where = array(
			'class_nickname' =>  $nickname,
			'post.flag_del'	=> 1
		);
		$data['count_photos']=$this->post_model->countPhotos($where);
		$this->load->view('class/about',$data);
	}

	public function photos(){
		$nickname=$this->uri->segment(3);
		$where = array('class_nickname' =>  $nickname);
		$data['class']=$this->class_model->view($where);

		/*melihat daftar photo*/
		$where['post.flag_del']=1;
		$data['detail_post']=$this->post_model->getDetail($where);

		/*mencari detail kelas untuk menentukan apa user sudah join*/
		$dataDetail = array(
			'class_id' 	=> $data['class']['class_id'],
			'user_id'	=> $this->session->userdata('user_id'),
			'flag_del' => '1'
		);
		$data['detail_class']=$this->class_model->viewDetail($dataDetail);


		/*class user untuk di navbar*/
		$where = array('detail_class.user_id' =>  $this->session->userdata('user_id'),'detail_class.flag_del'=>1);
		$data['all_class']=$this->class_model->getClassUser($where);

		/*menghitung jumlah member*/
		$where = array(
			'class.class_nickname' => $nickname, 
			'detail_class.flag_del' =>1
		);
		$data['count_member']=$this->class_model->countMember($where);

		/*menghitung jumlah photos*/
		$where = array(
			'class_nickname' =>  $nickname,
			'post.flag_del'	=> 1
		);
		$data['count_photos']=$this->post_model->countPhotos($where);
		$this->load->view('class/photos',$data);
	}

	public function member(){
		$nickname=$this->uri->segment(3);
		$where = array('class_nickname' =>  $nickname);
		$data['class']=$this->class_model->view($where);

		/*mencari detail kelas untuk menentukan apa user sudah join*/
		$dataDetail = array(
			'class_id' 	=> $data['class']['class_id'],
			'user_id'	=> $this->session->userdata('user_id'),
			'flag_del' => '1'
		);
		
		$data['detail_class']=$this->class_model->viewDetail($dataDetail);

		/*class user untuk di navbar*/
		$where = array('detail_class.user_id' =>  $this->session->userdata('user_id'),'detail_class.flag_del'=>1);
		$data['all_class']=$this->class_model->getClassUser($where);

		/*menghitung jumlah member*/
		$where = array(
			'class.class_nickname' => $nickname, 
			'detail_class.flag_del' =>1
		);
		$data['count_member']=$this->class_model->countMember($where);

		/*menghitung jumlah photos*/
		$where = array(
			'class_nickname' =>  $nickname,
			'post.flag_del'	=> 1
		);
		$data['count_photos']=$this->post_model->countPhotos($where);

		/*melihat daftar member*/
		$where = array(
			'class.class_nickname' => $nickname, 
			'detail_class.flag_del' =>1
		);
		$data['all_member']=$this->class_model->getClassUser($where);


		foreach ($data['all_member'] as $key => $value) {
			$where = array('detail_class.user_id' =>  $value['user_id']);
			$data['all_member'][$key]['class_member']=$this->class_model->getClassUser($where);
		}
		// echo "<pre>";
		// print_r($data['all_member']);

		$this->load->view('class/member',$data);
	}

	public function removeMember(){
		$data = array('flag_del' => 0 );
		$where = array('detail_class_id' => $this->input->post('id'),);
		$this->class_model->updateDetailClass($data,$where);
		$msg['success']=true;
		echo json_encode($msg);
	}

	public function viewPost(){
		/*mencari data kelas berdasarkan token*/
		$nickname 		=$this->uri->segment(3);
		$where 			= array('class_nickname' =>  $nickname);
		$data['class']=$this->class_model->view($where);

		/*mencari detail kelas untuk menentukan apa user sudah join*/
		$dataDetail = array(
			'class_id' 	=> $data['class']['class_id'],
			'user_id'	=> $this->session->userdata('user_id'),
			'flag_del'	=> 1
		);
		
		$data['detail_class']=$this->class_model->viewDetail($dataDetail);


		/*class user untuk di navbar*/
		$where = array('detail_class.user_id' =>  $this->session->userdata('user_id'),'detail_class.flag_del'=>1);
		$data['all_class']=$this->class_model->getClassUser($where);


		/*mengambil comment data post */
		$where = array(
			'post.class_id' 		=> $data['class']['class_id'] ,
			'detail_class.user_id' 	=> $this->session->userdata('user_id'),
			'post.flag_del' 		=> 1
		);
		$data['post']=$this->post_model->view($where);
		$i=0;
		foreach ($data['post'] as  $value) {
			
			$where = array(
				'post_id' => $value['post_id'],
				'flag_del' => 1
			);

			$whereDetail = array(
				'post.post_id' => $value['post_id'],
				'detail_post.flag_del' => 1
			);
			$data['post'][$i]['countComment']=$this->post_model->countComment($where); 
			$data['post'][$i]['comment']=$this->post_model->viewComment($where);
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
		// echo "<pre>";
		// print_r($data['post']);
		$this->load->view('class/viewPost',$data);
	}

	public function join(){
		$token=$this->uri->segment(3);
		$data = array('class_token' =>  $token);
		$result['class']=$this->class_model->view($data);
		$nickname=$result['class']['class_nickname'];
		$class_type=$result['class']['class_type'];

		if ($class_type==2) {
			$cekclass = array(
				'class_token' => $token,
				'class_pw'	=> md5($this->input->post('class_pw'))
			);
			$result['class']=$this->class_model->view($cekclass);
			if (empty($result['class'])) {
				$this->session->set_flashdata('error','Password Salah');
				redirect("../kelas/view/$nickname");
			}
		}

		/*
		mengecek apakah user sudah di grup atau belum
		*/
		$dataDetail = array(
			'class_id' 	=> $result['class']['class_id'],
			'user_id'	=> $this->session->userdata('user_id'),
			'flag_del'	=> '1'
		);
		$result['detail_class']=$this->class_model->viewDetail($dataDetail);

		/*
		Jika data kosong maka akan diinsert, apabila sudah join tidak diinsert
		*/
		if (empty($result['detail_class'])) {
			$dataDetail = array(
				'class_id' 	=> $result['class']['class_id'],
				'user_id'	=> $this->session->userdata('user_id'),
				'user_type'	=> '0'
			);
			$this->class_model->insertDetail($dataDetail);
		}
		redirect("../kelas/view/$nickname");
	}

	public function post(){
		/*
		==================================================
		Insert ke post
		=================================================*/
		$token=$this->uri->segment(3);
		$data = array(
    		'class_id' 	=> $this->input->post('class_id'),
    		'user_id'	=> $this->session->userdata('user_id'),
    		'post_time'	=> date('Y-m-d H:i:s'),
    		'post_type'	=> '1',
    		'post_text'	=> $this->input->post('post_text'),
    	);
		$config['upload_path']='./materi';
		$config['allowed_types']= 'pdf|doc|docx|ppt|pptx';
		$config['max_size']= 100000;
		$config['overwrite']=true;
		$this->load->library('upload',$config);
		if (isset($_FILES['task']['name'][0])) {
			if ( ! $this->upload->do_upload('task')){
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
	        }else{
	        	$dataDoc = array('upload_data' => $this->upload->data());
	        	$data['post_file']=$dataDoc['upload_data']['file_name'];
			}
		}
    	
    	$post_id=$this->post_model->insert($data);
    	$username=$this->session->userdata('username');


    	/*======================================================
						proses upload file
		Jika ngga ada gambar, maka ga insert ke detail
    	=======================================================*/
    	$config['upload_path']='./images/post';
		$config['allowed_types']= 'jpg|png|gif';
		$config['max_size']= 100000;
		$config['overwrite']=true;
		// print_r($_FILES);
		$this->load->library('upload',$config);
		if (isset($_FILES['picture']['name'][0]) && !empty($_FILES['picture']['name'][0])) {
			$tempFile=$_FILES['picture'];
			foreach ($tempFile['name'] as $key => $value) {
				$_FILES['images']['name']= $tempFile['name'][$key];
		        $_FILES['images']['type']= $tempFile['type'][$key];
		        $_FILES['images']['tmp_name']= $tempFile['tmp_name'][$key];
		        $_FILES['images']['error']= $tempFile['error'][$key];
		        $_FILES['images']['size']= $tempFile['size'][$key];

		        $new_name = time()."_".$username."_".$tempFile['name'][$key];
				$config['file_name'] = $new_name;
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload('images')){
					$error = array('error' => $this->upload->display_errors());
					print_r($error);
		        }else{
		        	$data_gambar = array('upload_data' => $this->upload->data());
		        	$dataDetail =  array(
		        		'detail_post_image'	=> $data_gambar['upload_data']['file_name'],
		        		'post_id'			=> $post_id
		        	);

		        	$this->post_model->insertDetail($dataDetail);

		        }
			}# code...
		}
			
			
        $msg['success']=true;
        echo json_encode($msg);
		// redirect("../kelas/view/$token");
	}

	public function comment(){
		$token=$this->uri->segment(3);
		$data = array(
			'post_id' 	=> $this->input->post('post_id'),
			'user_id'	=> $this->session->userdata('user_id'),
			'comment_text'	=> $this->input->post('comment_text'),
			'comment_time'	=> date('Y-m-d H:i:s'),
			'flag_del'	=> '1',
		);

		$this->post_model->insertComment($data);
		$msg['success']=true;
        echo json_encode($msg);
	}

	public function makeTask(){
		$token=$this->uri->segment(3);
		$data = array(
    		'class_id' 	=> $this->input->post('class_id'),
    		'user_id'	=> $this->session->userdata('user_id'),
    		'post_time'	=> date('Y-m-d H:i:s'),
    		'post_type'	=> $this->input->post('post_type'),
    		'post_text'	=> $this->input->post('post_text'),
    		'post_time_span' => strftime('%Y-%m-%d %H:%M:%S', strtotime($_POST['post_time_span'])),
    		'post_task_tittle' => $this->input->post('post_task_tittle')
    	);

		if (!empty($this->input->post('post_group_max'))) {
			$data['post_group_max']=$this->input->post('post_group_max');
		}

    	$post_id=$this->post_model->insert($data);

    	$dataDetail = array(
			'class_id' 	=> $this->input->post('class_id'),
		);

		$result=$this->class_model->viewAllDetail($dataDetail);
    	// print_r($result);
    	foreach ($result as $key => $value) {
    		$data = array(
    			'post_id' 	=> $post_id,
    			'user_id'	=> $value['user_id']
    		);
    		$this->post_model->insertMemberGroup($data);
    	}
    	$msg['success']=true;
        echo json_encode($msg);
		// print_r($data);
		// echo strftime('%Y-%m-%d %H:%M:%S', strtotime($_POST['post_time_span']));
	}

	public function uploadTugas(){
		$nickname=$this->uri->segment(3);
		$where = array('class_nickname' =>  $nickname);
		$class=$this->class_model->view($where);
		// print_r($class);
		$post_id=$this->uri->segment(4);
		$where  = array('post_id' => $post_id, );
		$data = $this->post_model->viewOne($where);
		if ($data['post_type']==3) {
			$this->load->view('class/view_kerjakan_tugas_individu');
		}else if ($data['post_type']==4) {
			$where  = array(
				'post_id' 	=> $post_id,
				'task_id'	=> NULL
			 );
			$data['member']=$this->post_model->getClassMember($where);
			$this->load->view('class/view_kerjakan_tugas_kelompok',$data);
		}
	}

	public function doUploadTask(){
		$post_id=$this->uri->segment(3);
		$where  = array('post_id' => $post_id, );
		$data_post = $this->post_model->viewOne($where);
		$file_name=$data_post['post_task_tittle']."_".$this->session->userdata('username').'_'.time();

		$config = array(
			'upload_path' 	=> './task', 
			'allowed_types'	=> 'doc|docx|pdf',
			'max_size'		=> 1000000,
			'file_name'		=> $file_name,
			'overwrite'		=> true
		);

		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('task')) {
			$error = array('error' => $this->upload->display_error());
			print_r("error");
		}else{
			$data  = array('upload_data' => $this->upload->data());

			$data_insert = array(
				'task_group_name'	=> "tes",
				'task_file' 		=> $data['upload_data']['file_name'],
				'task_upload_time'	=> date('Y-m-d H:i:s'),
				'task_user_id'		=> $this->session->userdata('user_id'),
				'post_id'		=> $post_id
			);

			$task_id=$this->post_model->insertTask($data_insert);

			if ($data_post['post_type']==3) {
				$data_update = array(
					'task_id' => $task_id,
				);
				$where = array(
					'user_id' 	=> $this->session->userdata('user_id'), 
					'post_id'	=> $post_id
				);
				$this->post_model->updateMemberGroup($data_update,$where);	
				// echo "string";
			}else {
				foreach ( $this->input->post('member_group') as $key => $value) {
					$data_update = array(
						'task_id' => $task_id,
					);
					$where = array(
						'user_id' 	=> $value, 
						'post_id'	=> $post_id
					);
					$this->post_model->updateMemberGroup($data_update,$where);	
				}
			}
		}
		$msg['success']=true;
        echo json_encode($msg);
	}

	public function reuploadTask(){
		$this->load->view('class/view_reupload');
	}

	public function doReuploadTask(){
		$post_id=$this->uri->segment(3);
		$where  = array('post_id' => $post_id, );
		$data_post = $this->post_model->viewOne($where);
		$file_name=$data_post['post_task_tittle']."_".$this->session->userdata('user_id')."_".$this->session->userdata('username');

		$config = array(
			'upload_path' 	=> './task', 
			'allowed_types'	=> 'doc|docx|pdf',
			'max_size'		=> 1000000,
			'file_name'		=> $file_name,
			'overwrite'		=> true
		);

		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('task')) {
			$error = array('error' => $this->upload->display_error());
			print_r("error");
		}else{
			$where = array(
				'post_id' => $post_id,
				'user_id' => $this->session->userdata('user_id')
			);
			$data_member=$this->post_model->getTaskMember($where);
			$data_file  = array('upload_data' => $this->upload->data());
			$where = array(
				'task_id' => $data_member['task_id'],
			);
			$data = array(
				'task_file' => $data_file['upload_data']['file_name'], 
			);
			$this->post_model->updateTask($data,$where);
		}
		$msg['success']=true;
        echo json_encode($msg);
	}

	public function downloadTask(){
		$post_id=$this->uri->segment(3);
		$where = array('post_id' => $post_id, );
		$task=$this->post_model->getAllTask($where);
		echo "<pre>";
		print_r($task);
		foreach ($task as $key => $value) {
			$path = 'task/'.$value['task_file'];
			$this->zip->read_file($path, TRUE);
		}
			
		// $path = 'task/_1_uripyogantara.pdf';
		// $this->zip->read_file($path, TRUE);
		$post=$this->post_model->viewOne($where);
		$this->zip->download($post['post_task_tittle'].'.zip');
	}

	public function deleteComment(){
		
		$data = array(
			'flag_del' => 0, 
		);

		$where = array(
			'comment_id' => $this->uri->segment(3), 
		);
		$this->post_model->updateComment($data,$where);
		$msg['success']=true;
        echo json_encode($msg);
	}

	public function deletePost(){
		
		$data = array(
			'flag_del' => 0, 
		);

		$where = array(
			'post_id' => $this->uri->segment(3), 
		);
		$this->post_model->updatePost($data,$where);
		$msg['success']=true;
        echo json_encode($msg);
	}

	public function search(){
		$keyword = $this->input->get('keyword');
		// $name = $this->input->get('keyword');

		$data['kelas']= $this->class_model->search($keyword);
		/*class user untuk di navbar*/
		$where = array('detail_class.user_id' =>  $this->session->userdata('user_id'));
		$data['all_class']=$this->class_model->getClassUser($where);
		$this->load->view('class/search',$data);
	}

	
}
