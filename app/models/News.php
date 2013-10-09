<?php
class News extends BaseDao{
	private $tableName = 'news';
	
	public function deleteNewsFromCatId($catId){
		$data['del_flg'] = 1;
		$data['update_date'] = new Zend_Db_Expr('now()');
		$where = $this->db->quoteInto('category_id = ?', $catId);
		return $this->db->update($this->tableName, $data, $where);
	}
	
	public function getAllNews(){
		$sql = $this->db->select();
		$sql->from($this->tableName, array('news_id', 'category_id', 'title', 'image_url', 'hide'))
			->from('categories','category_name')
			->where('news.category_id = categories.category_id')
			->where('news.del_flg = 0');
			//->order('news_id DESC');
		return $this->db->fetchAll($sql);
	}
	
	public function getNewsTitleFromCat($catId, $limit=0){
		$sql = $this->db->select();
		$sql->from($this->tableName, array('news_id', 'title_no_sign', 'title','description','image_url'))
			->where('news.category_id = ?',$catId)
			->where('news.hide = 0')
			->where('news.del_flg = 0')
			->order('news_id DESC');
			if(0 != $limit){
				$sql->limit($limit);
			}
		return $this->db->fetchAll($sql);
	}
	
	public function getNewDetail($title){
		$sql = $this->db->select();
		$sql->from($this->tableName, array('news_id', 'title_no_sign', 'title','description','image_url','content'))
			->from('categories',array('category_name_no_sign','category_name'))
			->where("{$this->tableName}.category_id = categories.category_id")
			->where("{$this->tableName}.title_no_sign = ?", $title)
			->where('news.hide = 0')
			->where('news.del_flg = 0');
		return $this->db->fetchRow($sql);
	}
	
	public function getNewsFromCatName($catName, $limit=0){
		$sql = $this->db->select();
		$sql->from($this->tableName, array('news_id', 'title_no_sign', 'title','description','image_url'))
			->from('categories','category_name')
			->where('news.category_id = categories.category_id')
			->where('categories.category_name_no_sign = ?', $catName)
			->where('news.hide = 0')
			->where('news.del_flg = 0')
			->order('news_id DESC');
			if(0 != $limit){
				$sql->limit($limit);
			}
		return $this->db->fetchAll($sql);
	}
	
	public function insertNews($data){
		$this->db->insert($this->tableName, $data);
		return $this->db->lastInsertId($this->tableName);
	}
	
	public function isTitleExist($titleNoSign){
		$sql = $this->db->select();
		$sql->from($this->tableName, 'news_id')
			->where('title_no_sign = ?', $titleNoSign)
			->where('del_flg = 0');
		$ret = $this->db->fetchRow($sql);
		return empty($ret) ? false : true;
	}
	
	public function deleteNews($newsId){
		$data['del_flg'] = 1;
		$data['update_date'] = new Zend_Db_Expr('now()');
		return $this->updateNews($newsId, $data);
	}
	
	public function getNews($newId){
		$sql = $this->db->select();
		$sql->from($this->tableName, '*')
			->where('news_id = ?', $newId)
			->where('del_flg = 0');
		return $this->db->fetchRow($sql);
	}
	
	public function updateNews($newsId, $data){
		$where = $this->db->quoteInto('news_id = ?', $newsId);
		return $this->db->update($this->tableName, $data, $where);
	}
	
	public function getNewsLimit($page = 1, $limit=10){
		$sql = $this->db->select();
		$sql->from($this->tableName, array('news_id', 'category_id', 'title', 'image_url', 'hide'))
			->from('categories','category_name')
			->where('news.category_id = categories.category_id')
			->where('news.del_flg = 0')
			->limitPage($page, $limit)
			->order('news_id DESC');
		return $this->db->fetchAll($sql);
	}
}
?>