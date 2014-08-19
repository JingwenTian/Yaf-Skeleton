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
		
		//常量
		define('__TEMPLATE__','default/');//当前主题
		define('__PUBLIC__','/public');//公共文件目录
		define('__CSS__',__PUBLIC__.'/css/'.__TEMPLATE__); //当前模板CSS文件目录
		define('__JS__',__PUBLIC__.'/js/'.__TEMPLATE__);//当前模板JS文件目录
		define('__IMG__',__PUBLIC__.'/images/'.__TEMPLATE__);//当前模板图片目录
		define('__LIBS__',__PUBLIC__.'/libs/');//公共库目录
		
		//关闭自动加载模板
		Yaf_Dispatcher::getInstance()->autoRender(FALSE);
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
		if($this->config->application->debug){
			define('DEBUG_MODE',false);
			ini_set('display_errors', 'On');
		}
		else{
			define('DEBUG_MODE',false);
			ini_set('display_errors', 'Off');
		}
    }


}
