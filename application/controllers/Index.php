<?php
/**
 * @name IndexController
 * @author jing
 * @desc 默认控制器
 */
class IndexController extends Ctrl_Base {
	
	public function init(){
		parent::auth();
	}

	public function indexAction() {
		
		$this->assign('name','jingwentian');
		$this->template('index/index');
		
	}
	
	public function testsqlAction() {
		$db = new FbyLawyerModel();
		$data = $db->getLawyerList();
		d($data);
	}
	
	public function userAction(){

		$this->assign('age',25);
		$this->template('index/user');
	}
	
	


}
