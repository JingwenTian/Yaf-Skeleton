<?php
abstract class Ctrl_Base extends Yaf_Controller_Abstract 
{

    public function init() {
        //更改视图模板目录
        $this->setViewPath( APPLICATION_PATH . "/application/views/default/");
        //echo $this->getViewPath();
    }

	/**
	 * 输出网页模板
	 * 如果传入的模板名称为空，则获取参数中的模板名称
	 * $file 加载的模板名称
	 */
	public function template($file='')
	{
		if($file != '')
		{
			$file = $file.".phtml";
			$this->getView()->display($file);
		}
		else
		{
		    $this->getView()->display($this->get("template").".phtml");
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

    /**
     * 优雅输出print_r()函数所要输出的内容
     *
     * 用于程序调试时,完美输出调试数据,功能相当于print_r().当第二参数为true时(默认为:false),功能相当于var_dump()。
     * 注:本方法一般用于程序调试
     * @access public
     * @param array $data         所要输出的数据
     * @param boolean $option     选项:true或 false
     * @return array            所要输出的数组内容
     */
    public function p($data, $option = false) {

        //当输出print_r()内容时
        if(!$option){
            echo '<pre>';
            print_r($data);
            echo '</pre>';
        } else {
            ob_start();
            var_dump($data);
            $output = ob_get_clean();

            $output = str_replace('"', '', $output);
            $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);

            echo '<pre>', $output, '</pre>';
        }

        exit;
    }
}