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
		
		$this->getView()->assign('name','jingwentian');
		$this->template('index/index');
		
	}


}
