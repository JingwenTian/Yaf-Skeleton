<?php
class Db_Base
{
	public function __construct() {
		$this->_db = Yaf_Registry::get("Db");
	}	
}