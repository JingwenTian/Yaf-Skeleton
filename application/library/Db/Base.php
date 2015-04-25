<?php
class Db_Base
{
	protected $_db;
	protected $_config = '';
	protected $memcache;
	
	//应用于单库操作,在Bootstrap.php初始化DB类
	//public function __construct() {
	//	$this->_db = Yaf_Registry::get("Db");
	//}
	
	//支持跨库操作
	
	public function __construct() {
		
		$pConfig = $this->_config;
		$database = Yaf_Registry::get("config")->database->$pConfig->toArray();
		$this->_db = new Db_Medoo($database);
		$this->memcache = new Cache_Memcache();
		
	}
	
}
