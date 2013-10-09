<?php
class Category extends BaseDao{
	private $tableName = 'categories';
	
	public function getAllCategory(){
		$sql = $this->db->select();
		$sql->from($this->tableName, array('category_id', 'category_name', 'hide', 'category_id_father'))
			->where('del_flg = 0')
			->order('category_id DESC');
		return $this->db->fetchAll($sql);
	}
	
	public function getCateLever1($position = 1){
		$sql = $this->db->select();
		$sql->from($this->tableName, array('category_id', 'category_name','category_name_no_sign', 'category_id_father'))
			->from('category_position','order')
			->where("{$this->tableName}.category_id = category_position.category_id")
			->where('category_id_father = 0')
			->where('category_position.position_id = ?',$position)
			->where('hide = 0')
			->where('del_flg = 0')
			->order('category_position.order ASC');
		return $this->db->fetchAll($sql);
	}
	
	public function insertCategory($data){
		$this->db->insert($this->tableName, $data);
		return $this->db->lastInsertId($this->tableName);
	}
	
	public function updateCategory($data, $catId){
		$where = $this->db->quoteInto('category_id = ?', $catId);
		return $this->db->update($this->tableName, $data, $where);
	}
	
	public function getCategory($catId){
		$sql = $this->db->select();
		$sql->from($this->tableName, array('category_id', 'category_name', 'hide', 'category_id_father'))
			->where('category_id = ?', $catId)
			->where('del_flg = 0');
		return $this->db->fetchRow($sql);
	}
	
	public function getFatherCategory($catId){
		$sql = $this->db->select();
		$sql->from($this->tableName, array('category_id', 'category_name', 'hide', 'category_id_father'))
			->where('category_id_father = ?', $catId)
			->where('del_flg = 0');
		return $this->db->fetchAll($sql);
	}
	
	public function getVisibleFatherCategory($catId){
		$sql = $this->db->select();
		$sql->from($this->tableName, array('category_id', 'category_name', 'category_name_no_sign', 'hide', 'category_id_father'))
			->where('category_id_father = ?', $catId)
			->where('hide = 0')
			->where('del_flg = 0');
		return $this->db->fetchAll($sql);
	}
	
	public function deleteCategory($catId){
		$data['del_flg'] = 1;
		$data['update_date'] = new Zend_Db_Expr('now()');
		$where = $this->db->quoteInto('category_id = ?', $catId);
		return $this->db->update($this->tableName, $data, $where);
	}
}
?>