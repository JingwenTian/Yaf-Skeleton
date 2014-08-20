<?php
class IndexModel extends Db_Base{

	protected $_db;
	//protected $_table = "yunbbs_users"; 
	protected $_table = "fby_lawyer"; 
	//protected $_database = "jing";
	
	//public function __construct(){        
    //  	$this->database_name = $this->_database;
    //}	

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
