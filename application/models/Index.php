<?php
class IndexModel extends Db_Base{
	protected $_db;
	protected $_table = "yunbbs_users"; 

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
