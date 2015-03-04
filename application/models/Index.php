<?php
class IndexModel extends Db_Base{

	protected $_db;
	protected $_table = "fby_lawyer"; 
	protected $database = "news";//此处为配置文件中的多库标识
	
	public function __construct() {
		$this->_config = $this->database;
		parent::__construct();
	}

	public function showUsers(){

		return $this->_db->select("$this->_table","*");

		// $datas = $database->select("account", [
		// 	"user_name",
		// 	"email"
		// ], [
		// 	"user_id[>]" => 100
		// ]);
	}
}
