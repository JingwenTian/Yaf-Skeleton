<?php
/**
 * @name IndexController
 * @author jing
 * @desc 默认控制器
 */
class IndexController extends Ctrl_Base {


	public function indexAction($name = "Stranger") {
		//1. fetch query
		$get = $this->getRequest()->getQuery("get", "default value");

		//2. fetch model
		$model = new SampleModel();

		//3. assign
		$this->getView()->assign("content", $model->selectSample());
		$this->getView()->assign("name", $name);

		$indexModel = new IndexModel();
		$co = $indexModel->showUsers();
		var_dump($co);


        return TRUE;
	}


}
