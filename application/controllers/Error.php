<?php

class ErrorController extends Yaf_Controller_Abstract {

	public function errorAction($exception) {

		$this->getView()->assign(array(
			"message"=> $exception->getMessage(),
			"module" => $this->getRequest()->getModuleName(),
			"controller"=> $this->getRequest()->getControllerName(),
			"action" => $this->getRequest()->getActionName()
		));

	}
}
