<?php
/**
 * @name IndexController
 * @author jing
 * @desc 默认控制器
 */
class IndexController extends Ctrl_Base {
	
	public function init(){
		parent::auth();
		$this->model = new IndexModel();
	}

	public function indexAction() {
		
		$this->assign('name','jingwentian');
		$this->template('index/index');
		
	}
	
	public function testAction(){

		$data = $this->model->showAll();
		p($data);
	}
	
	


}
