<?php 
class IndexController extends Ctrl_Base {
	
	//www.website.com/data/index/index

	public function init()
	{
		//trace
		p("<p style='background:pink;position:fixed;bottom:0;padding:3px;z-index:999;'>Current Module: ".$this->getModuleName().'<br>'.
		  "Current Controller: " . $this->getRequest()->getControllerName().'<br>'.
		  "Current Action: " . $this->getRequest()->getActionName().'</p>');


		  
	}

	public function indexAction()
	{
		
		p('hello world!');
	}


}