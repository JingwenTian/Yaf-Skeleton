<?php
class IndexModel extends Db_Base{

	protected $_db;
	protected $_table = "blank"; 
	protected $database = "jing";//此处为配置文件中的多库标识
	
	public function __construct() {
		$this->_config = $this->database;
		parent::__construct();
	}

	public function showAll() {

		return $this->_db->select("$this->_table","*");

	}
	
	public function showOne($id) {
		
		return $this->_db->get("$this->_table", "*", [
			"id" => $id
		]);
		
	}
}
