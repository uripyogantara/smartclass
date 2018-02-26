<?php

Class User_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get($where){
		$data=$this->db->get_where('user',$where);
		return $data->row_array();
	}

	public function insert($data){
		$this->db->insert('user',$data);
	}

	public function update($data,$where){
		$this->db->update('user',$data,$where);
	}

} 