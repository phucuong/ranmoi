<?php
	
abstract class BaseDao{
	protected $db = null;
	
	public function __construct(){
		$this->db = $this->getDb();
	}
	
	protected function getDb(){
		return Zend_Registry::get('db');
	}
}