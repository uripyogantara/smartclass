<?php

Class Class_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function insert($data){
		$this->db->insert('class',$data);
		return $this->db->insert_id();
	}

	public function updateClass($data,$where){
		$this->db->update('class',$data,$where);
	}

	public function updateDetailClass($data,$where){
		$this->db->update('detail_class',$data,$where);
	}

	public function insertDetail($data){
		$this->db->insert('detail_class',$data);
	}

	public function view($data){
		$this->db->join('user','class.created_by=user.user_id');
		$result=$this->db->get_where('class',$data);
		return $result->row_array();
	}

	public function viewDetail($data){
		$result=$this->db->get_where('detail_class',$data);
		return $result->row_array();
	}

	public function viewAllDetail($where){
		$result=$this->db->get_where('detail_class',$where);
		return $result->result_array();	
	}

	public function getClassUser($where){
		$this->db->select('class.`class_name`,user.user_username, class.`class_image`, class.`class_nickname`,user.user_id,user.user_name,user.user_image,detail_class.user_type,detail_class.detail_class_id');
		$this->db->from('detail_class');
		$this->db->join('class','class.class_id=detail_class.class_id');
		$this->db->join('user','user.user_id=detail_class.user_id');
		$this->db->where($where);
		$result=$this->db->get();
		return $result->result_array();
	}

	public function countMember($where){
		$this->db->select('class.`class_name`, class.`class_image`, class.`class_nickname`,user.user_id,user.user_name,user.user_image,detail_class.user_type');
		$this->db->from('detail_class');
		$this->db->join('class','class.class_id=detail_class.class_id');
		$this->db->join('user','user.user_id=detail_class.user_id');
		$this->db->where($where);
		$result=$this->db->get();
		return $result->num_rows();	
	}

	public function search($keyword){
		$sql="SELECT class_name,class_nickname,class_image,class_type_name,COUNT(detail_class.`detail_class_id`) AS jumlah
				FROM class
				INNER JOIN class_type ON class_type.`class_type_id`=class.`class_type`
				INNER JOIN detail_class ON detail_class.`class_id`=class.`class_id`
				WHERE (class.`class_name` LIKE '%$keyword%' OR class.`class_nickname` LIKE '%$keyword%')
					and class.`flag_del`=1
				GROUP BY class.`class_id`";
		$result=$this->db->query($sql);
		return $result->result_array();
	}
} 