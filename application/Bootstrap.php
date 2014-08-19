<?php
/**
 * @name Bootstrap
 * @author jing
 */
class Bootstrap extends Yaf_Bootstrap_Abstract{

	private $_config;

    public function _initConfig() 
	{
		$this->_config = Yaf_Application::app()->getConfig();
		Yaf_Registry::set('config', $this->_config);
	}

	public function _initPlugin(Yaf_Dispatcher $dispatcher) 
	{
		$objSamplePlugin = new SamplePlugin();
		$dispatcher->registerPlugin($objSamplePlugin);
	}

	public function _initRoute(Yaf_Dispatcher $dispatcher) 
	{
		$router = Yaf_Dispatcher::getInstance()->getRouter();
        $route_config = new Yaf_Config_Ini(APPLICATION_PATH . "/conf/route.ini");
        $router->addConfig($route_config->routes);
	}
	
	public function _initView(Yaf_Dispatcher $dispatcher)
	{
		//$view= new Smarty_Adapter(null, Yaf_Registry::get("config")->get("smarty"));
		//Yaf_Dispatcher::getInstance()->setView($view);
	}

	public function _initDefaultDbAdapter()
	{
		$Db = new Db_Medoo($this->_config->database->option->toArray());
		Yaf_Registry::set('Db',$Db);
	}

	public function _initErrors()
	{
        if($this->_config->application->debug){
            error_reporting (-1);
            /*报错是否开启，On开启*/
            ini_set('display_errors','On');
            @set_error_handler('handleError', E_ALL);
        }else{
            error_reporting (-1);
            set_error_handler('handleError', E_ALL);
        }
    }


}
