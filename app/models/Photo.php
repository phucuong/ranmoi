<?php
class Photo extends BaseDao{
	private $tableName = 'photos';
	
	public function getAllPhoto(){
		$sql = $this->db->select();
		$sql->from($this->tableName, array('photo_id', 'photo_url', 'order'))
			->order('order ASC');
		return $this->db->fetchAll($sql);
	}
	
	public function insertPhoto($data){
		$this->db->insert($this->tableName, $data);
		return $this->db->lastInsertId($this->tableName);
	}
	
	public function deletePhoto($photoId){
		$where = $this->db->quoteInto('photo_id = ?', $photoId);
		return $this->db->delete($this->tableName, $where);
	}
	
	public function getPhoto($photoId){
		$sql = $this->db->select();
		$sql->from($this->tableName, array('photo_id', 'photo_url', 'order'))
			->where('photo_id = ?', $photoId);
		return $this->db->fetchRow($sql);
	}
}
?>