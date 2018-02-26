<?php

Class Post_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function insert($data){
		$this->db->insert('post',$data);
		return $this->db->insert_id();
	}

	public function insertDetail($data){
		$this->db->insert('detail_post',$data);
	}

	public function view($data){
		$this->db->select('post.post_id,class.class_name,class_nickname,post_time,post_type,post.post_text,post_file,user.user_id,user.user_image,user.user_name,user.user_username,post_task_tittle,post_group_max,post.post_time_span,detail_class.user_type');
		$this->db->from('post');
		$this->db->join('user','user.user_id=post.user_id');
		$this->db->join('class','class.class_id=post.class_id');
		$this->db->join('detail_class','detail_class.class_id=class.class_id');
		$this->db->where($data);
		$this->db->order_by('post.post_id','desc');
		$result=$this->db->get();
		return $result->result_array();
	}

	public function viewOne($data){
		$this->db->select('post.post_id,post_time,post_type,post.post_text,post_file,user.user_id,user.user_image,user.user_name,post_task_tittle,post_group_max,post.post_time_span');
		$this->db->from('post');
		$this->db->join('user','user.user_id=post.user_id');
		$this->db->where($data);
		$this->db->order_by('post.post_id','desc');
		$result=$this->db->get();
		return $result->row_array();
	}

	public function insertComment($data){
		$this->db->insert('comment',$data);
	}

	public function viewComment($where){
		$this->db->select('comment.comment_text, user.user_id, user.user_name,user.user_image,user.user_username,comment.comment_time,comment_id');
		$this->db->from('comment');
		$this->db->join('user','user.user_id=comment.user_id');
		$this->db->order_by('comment.comment_id','asc');
		$this->db->where($where);
		$result=$this->db->get();
		return $result->result_array();
	}

	public function insertTask($data){
		$this->db->insert('task',$data);
		return $this->db->insert_id();
	}

	public function getGroupNumber($where){
		$result=$this->db->get_where('group',$where);
		return $result->num_rows();
	}

	public function insertMemberGroup($data){
		$this->db->insert('member_group',$data);
		return $this->db->insert_id();	
	}

	public function getTaskMember($where){
		$result=$this->db->get_where('member_group',$where);
		return $result->row_array();
	}

	public function getAllTask($where){
		$result=$this->db->get_where('task',$where);
		return $result->result_array();
	}

	public function updateMemberGroup($data,$where){
		$this->db->update('member_group',$data,$where);
	}

	public function countComment($where){
		$result=$this->db->get_where('comment',$where);
		return $result->num_rows();
	}

	public function getDetail($where){
		$this->db->select('detail_post.*');
		$this->db->join('post','post.post_id=detail_post.post_id');
		$this->db->join('class','class.class_id=post.class_id');
		$result=$this->db->get_where('detail_post',$where);
		return $result->result_array();	
	}

	public function countPhotos($where){
		$this->db->select('detail_post.*');
		$this->db->join('post','post.post_id=detail_post.post_id');
		$this->db->join('class','class.class_id=post.class_id');
		$result=$this->db->get_where('detail_post',$where);
		return $result->num_rows();	
	}

	public function getClassMember($where){
		$this->db->select('user.user_id,user.user_name,user.user_image,user.user_username');
		$this->db->join('user','user.user_id=member_group.user_id');
		$this->db->order_by('user.user_id','asc');
		$result=$this->db->get_where('member_group',$where);
		return $result->result_array();	
	}

	public function countTask($where){
		$result=$this->db->get_where('member_group',$where);
		return $result->num_rows();	
	}

	public function updateTask($data,$where){
		$this->db->update('task',$data,$where);
	}

	public function updateComment($data,$where){
		$this->db->update('comment',$data,$where);
	}

	public function updatePost($data,$where){
		$this->db->update('post',$data,$where);
	}
} 