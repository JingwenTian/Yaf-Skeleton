<?php 
class Cache_Memcache {

	private $memcache = null;

	public function __construct() {
	  //$this->memcache = new Memcache;
	  //$this->memcache->connect(MEMCACHE_HOST, MEMCACHE_PORT);
		$this->memcache = new \Memcached;
		$this->memcache->addServer(MEMCACHE_HOST, MEMCACHE_PORT,true);
		if(MEMCACHE_OPEN === true){
			$this->memcache->close();
			unset($this->memcache);
		}
	}

	/**
	 * @desc设置
	 */
	public function setcache($key,$data,$time=''){
		$time = $time?$time:MEMCACHE_TIME;
		$this->memcache->set(md5(MEMCACHE_PRE.$key), $data, 0, $time);
	}
		
	/**
	 * @desc获取
	 */
	public function getcache($key){
		return $this->memcache->get(md5(MEMCACHE_PRE.$key));
	}	
		
	/**
	 * @desc删除
	 */
	public function delcache($key){
		$this->memcache->delete(md5(MEMCACHE_PRE.$key));
	}
	
	
}
?>
