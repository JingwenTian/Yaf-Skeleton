<?php
abstract class Ctrl_Base extends Yaf_Controller_Abstract 
{

    public function init() {
        //更改视图模板目录
        $this->setViewPath( APPLICATION_PATH . "/application/views/".__TEMPLATE__);//echo $this->getViewPath();
		
    }
	
	public function auth() {
	
		//通过parent::auth()调用
		$this->_config = Yaf_Registry::get('config');
		$this->_req = $this->getRequest();
		
		//路由调试信息
		if($this->_config->application->debug){
			echo "<p style='background:pink;position:fixed;bottom:0;padding:3px;z-index:999;'>Current Route: ".Yaf_Dispatcher::getInstance()->getRouter()->getCurrentRoute()."<br>Current Module: ".$this->getModuleName()."<br>Current Controller: " . $this->getRequest()->getControllerName()."<br>Current Action: " . $this->getRequest()->getActionName()."<br>Params: ".json_encode($this->getRequest()->getParams())."</p>";
		}
		
		// $this->_session = Yaf_Session::getInstance();
		// $this->_session->start();
		// if(!$this->_session->has('username')){
		// 		$this->redirect('/index/');
		// }
	
	}

	/**
	 * 输出网页模板
	 * 如果传入的模板名称为空，则获取参数中的模板名称
	 * $file 加载的模板名称
	 */
	public function template($file='')
	{
		$template_dir = __TEMPLATE__?:'default/';
		if($file != '')
		{
			$file = $template_dir.$file.".phtml";
			$this->getView()->display($file);
		}
		else
		{
		    $this->getView()->display($template_dir.$this->get("template").".phtml");
		}
	}
	
	
    /**
     * 获取并分析$_GET数组某参数值
     *
     * 获取$_GET的全局超级变量数组的某参数值,并进行转义化处理，提升代码安全.注:参数支持数组
     * @access public
     * @param string  $string 所要获取$_GET的参数
     * @param string  $default_param 默认参数, 注:只有$string不为数组时有效
     * @return string $_GET数组某参数值
     */
    public function get($string, $default_param = null) {
        $param = $this->getRequest()->getParam($string, $default_param);
		$param = is_null($param) ? '' : (!is_array($param) ? trim($param) : $param);
        return $param;
    }

    /**
     * 获取并分析$_POST数组某参数值
     *
     * 获取$_POST全局变量数组的某参数值,并进行转义等处理，提升代码安全.注:参数支持数组
     * @access public
     * @param string $string    所要获取$_POST的参数
     * @param string $default_param 默认参数, 注:只有$string不为数组时有效
     * @return string    $_POST数组某参数值
     */
    public function post($string, $default_param = null) {

       $param = $this->getRequest()->getPost($string, $default_param);
       $param = is_null($param) ? '' : (!is_array($param) ? trim($param) : $param);
       return $param;
    }

	/**
     * 视图变量赋值操作
     *
     * @access public
     * @param mixted $keys 视图变量名
     * @param string $value 视图变量值
     * @return mixted
     */
    public function assign($pKey, $pVal = '') 
	{
		if(is_array($pKey))
		{
			return $this->_view->assign($pKey);
		}

        return $this->getView()->assign($pKey, $pVal);
    }
	

	
}
