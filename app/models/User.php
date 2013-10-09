<?php
class User extends BaseDao{
	private $tableName = 'users';
	
	public function getUserInfo($userId){
		$sql = $this->db->select();
		$sql->from($this->tableName, array('user_id', 'fullname', 'email'))
			->where('user_id = ?', $userId);
		return $this->db->fetchRow($sql);
	}
	
	public function getOldPass($userId){
		$sql = $this->db->select();
		$sql->from($this->tableName, 'password');
		return $this->db->fetchRow($sql);
	}
	
	public function updateUser($userId, $data){
		$where = $this->db->quoteInto('user_id = ?', $userId);
		return $this->db->update($this->tableName, $data, $where);
	}
	
	public function login($email, $password){
		$sql = $this->db->select();
		$sql->from($this->tableName, array('user_id', 'fullname', 'email'))
			->where('email = ?', $email)
			->where('password = ?', $password);
		return $this->db->fetchRow($sql);
	}
}
?>