<?php
/**
 * @name IndexController
 * @author jing
 * @desc 默认控制器
 */
class IndexController extends Ctrl_Base {
	
	public function init(){
		
	}

	public function indexAction() {
		
		$this->assign('name','jingwentian');
		$this->template('index/index');
		
	}
	
	public function testsqlAction() {
		$db = new IndexModel();
		$data = $db->showUsers();
		d($data);
	}
	
	public function userAction(){
		d('hi');
	}


}
