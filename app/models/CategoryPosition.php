<?php
class CategoryPosition extends BaseDao{
	private $tableName = 'category_position';
	
	public function getPosFromCatId($catId){
		$sql = $this->db->select();
		$sql->from($this->tableName, array('position_id', 'order'))
			->from('positions','position_name')
			->where('category_position.position_id = positions.position_id')
			->where('category_position.category_id = ?', $catId);
		return $this->db->fetchAll($sql);
	}
	
	public function insertCatPos($data){
		$this->db->insert($this->tableName, $data);
		return $this->db->lastInsertId($this->tableName);
	}
	
	public function updateCatPos($catId, $posId, $data){
		$where = array($this->db->quoteInto('category_id = ?', $catId),
						$this->db->quoteInto('position_id = ?', $posId));
		return $this->db->update($this->tableName, $data, $where);
	}
	
	public function isPosExist($catId, $posId){
		$sql = $this->db->select();
		$sql->from($this->tableName,'category_position_id')
			->where('category_id = ?', $catId)
			->where('position_id = ?', $posId);
		$ret = $this->db->fetchRow($sql);
		return empty($ret) ? false : true;
	}
	
	public function deleteCatPos($catId, $posId){
		$where = array($this->db->quoteInto('category_id = ?', $catId),
						$this->db->quoteInto('position_id = ?', $posId));
		return $this->db->delete($this->tableName, $where);
	}
}
?>