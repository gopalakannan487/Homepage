<?php 
	class User_model extends CI_Model{
		public function store($data){
			$this->db->insert('user',$data);
			return true;
		}
		public function getUser($email){
			return $this->db->where('email',$email)->get('user')->row();
		}
	}


?>
