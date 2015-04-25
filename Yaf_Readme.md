##`Yaf_Controller_Abstract`

	(1)获取当前控制器所属的模块名: $this->getModuleName();

	(2)获取当前的请求 $this->getRequest()

		$this->getRequest()->getQuery("get", "default value");

	(3)获取当前的响应 $this->getResponse()
		
	(4)获取当前视图引擎 $this->getView()

	(5)更改视图模板目录 
		public funciton init() {
			$this->setViewPath(APPLICATION_PATH . "/application/views/default/");//绝对目录
		}

	(6)获取当前模板目录 $this->getViewPath()

	(7)渲染视图模板 $this->render("test.phtml")
		class IndexController extends Yaf_Controller_Abstract {
			public funciton init() {
				/* 首先关闭自动渲染 */
				Yaf_Dispatcher::getInstance()->disableView();
			}
			public function indexAction() {
				$this->initView();
				/* 自己输出响应 */
				echo $this->render("test.phtml");
			}
		}

	(8)渲染视图模板 
		class IndexController extends Yaf_Controller_Abstract {
			public funciton init() {
				/* 首先关闭自动渲染 */
				Yaf_Dispatcher::getInstance()->disableView();
			}
			public function indexAction() {
				$this->initView();
				/* 自己输出响应 */
				$this->display("test.phtml", array("name" => "value"));
			}
		}

	(9)将当前请求转给另外一个动作处理
		if($user_not_login) {
			$this->forward("login");
		}

	(10)重定向请求到新的路径
		if($user_not_login)
			$this->redirect("/login/");
		}

##`Yaf_Request_Abstract`

	(1)获取当前的异常对象 Yaf_Request_Abstract::getException()

		public funciton errorAction() {
			$exception = $this->getRequest()->getException();
		}

	(2)获取当前请求被路由到的模块名 Yaf_Request_Abstract::getModuleName()

		class ErrorController extends Yaf_Controller_Abstract {
			public funciton errorAction() {
				echo "current Module:" . $this->getRequest()->getModuleName();
			}
		}

	(3)获取当前请求被路由到的控制器名. Yaf_Request_Abstract::getControllerName()
	
		class ErrorController extends Yaf_Controller_Abstract {
			public funciton errorAction() {
				echo "current Controller:" . $this->getRequest()->getControllerName();
			}
		}

	(4)获取当前请求被路由到的动作(Action)名. Yaf_Request_Abstract::getActionName()
		class ErrorController extends Yaf_Controller_Abstract {
			public funciton errorAction() {
				echo "current Action:" . $this->getRequest()->getActionName();
			}
		}

	(5)获取当前请求中的所有路由参数 Yaf_Request_Abstract::getParams()

		路由参数不是指$_GET或者$_POST, 而是在路由过程中, 路由协议根
		据Request Uri分析出的请求参数.
		比如, 对于默认的路由协议Yaf_Route_Static, 路由如下请求URL: http://www.domain.com/
		module/controller/action/name1/value1/name2/value2/ 路由结束后将会得到俩个路由参数,
		name1和name2, 值分别是value1, value2.

		$this->getRequest()->getParams()

	(6)获取当前请求中的路由参数 Yaf_Request_Abstract::getParam()
		public funciton indexAction() {
			echo "user id:" . $this->getRequest()->getParam("userid", 0);
		}
	
	(7)为当前的请求,设置路由参数. Yaf_Request_Abstract::setParam()
		public funciton indexAction() {
			$this->getRequest()->setParam("userid", 0);
		}
		
	(8)获取当前请求的类型, 可能的返回值为GET,POST,HEAD,PUT,CLI等.
		Yaf_Request_Abstract::getMethod()
		
		public funciton indexAction() {
			if ($this->getRequest()->getMethod() == "CLI") {
				echo "running in cli mode";
			}
		}

	(9)获取当前请求是否为CLI请求 / 获取当前请求是否为GET请求
		if ($this->getRequest()->isCli()) {
			echo "running in Cli mode";
		}
				
		if ($this->getRequest()->isGet()) {
			echo "running in Get mode";
		}
	

##`Yaf_Response_Abstract`

	(1)设置响应的Body Yaf_Response_Abstract::setBody()
		//要响应的字符串, 一般是一段HTML, 或者是一段JSON(返回给Ajax请求)
		public function init() {
			$this->getResponse()->setBody("Hello World");
		}
	
	(2)往已有的响应body后附加新的内  Yaf_Response_Abstract::appendBody()
		
		public funciton init() {
			$this->getResponse()->appendBody("Hello World");
		}

	(3)往已有的响应body前插入新的内容 Yaf_Response_Abstract::prependBody()
	
		public funciton init() {
			$this->getResponse()->prependBody("Hello World");
		}
	
	(4)获取已经设置的响应body	Yaf_Response_Abstract::getBody()

		public funciton init() {
			echo $this->getResponse()->getBody();
		}

	(5)清除已经设置的响应body Yaf_Response_Abstract::clearBody()

		public funciton init() {
			$this->getResponse()->clearBody();
		}
	
	(6)发送响应给请求端 Yaf_Response_Abstract::response()

		public funciton init() {
			$this->getResponse()->response();//成功返回TRUE, 失败返回FALSE
		}

	(7)重定向请求到新的路径 Yaf_Response_Abstract::setRedirect()
		//和Yaf_Controller_Abstract::forward不同, 这个重定向是HTTP 301重定向
		public funciton init() {
			$this->getResponse()->setRedirect("http://domain.com/");
		}

##`Yaf_View_Interface`

	(1)为视图引擎分配一个模板变量 Yaf_View_Simple::assign()
		$this->getView()->assign($params)->assign("foo", "bar");

	(2)渲染一个视图模板 Yaf_View_Simple::render()
		echo $this->getView()->render($this->_script_path . "/test.phtml");

	(3)设置模板的基目录
	默认的Yaf_Dispatcher会设置此目录为APPLICATION_PATH . "/views".

		public funciton indexAction() {
			$this->getView()->setScriptPath("/tmp/views/"); //视图模板的基目录, 绝对地址
		}

	(4)获取当前的模板目录 Yaf_View_Simple::getScriptPath()

		public funciton indexAction() {
			echo $this->getView()->getScriptPath();
		}

	(5)为视图引擎分配一个模板变量 Yaf_View_Simple::__set()
	
		public funciton init() {
			$this->getView()->name = "value";
		}

	(6)获取视图引擎的一个模板变量值 Yaf_View_Simple::__get()

		public function init() {
			$this->initView();
		}
		public funciton indexAction() {
			//通过__get直接获取变量值
			echo $this->_view->name;
		}

	(7)获取视图引擎的一个模板变量值 Yaf_View_Simple::get()

		public function init() {
			$this->initView();
		}
		public funciton indexAction() {
			echo $this->_view->get("name");
		}

##`Yaf_Registry`

	(1)往全局注册表添加一个新的项 Yaf_Registry::set()
		获取注册表中寄存的项 Yaf_Registry::get()

		/** 存入 */
		Yaf_Registry::set('config', Yaf_Application::app()->getConfig());
		/* 之后可以在任何地方获取到 */
		$config->Yaf_Registry::get("config");	

	(2)查询某一项目是否存在于注册表中 Yaf_Registry::has()

		/** 存入 */
		Yaf_Registry::set('config', Yaf_Application::app()->hasConfig());
		assert(Yaf_Registry::has("config"));

	(3)删除存在于注册表中的名为$name的项目 Yaf_Registry::del()

		/** 存入 */
		Yaf_Registry::set('config', Yaf_Application::app()->delConfig());
		Yaf_Registry::del("config");

##`Yaf_Dispatcher`
	
	(1)关闭自动Render. 
	默认是开启的, 在动作执行完成以后, Yaf会自动render以动作名命名的视图模板文件.
		/**
		 * Controller的init方法会被自动首先调用
		 */
		public function init() {
			/**
			 * 如果是Ajax请求, 则关闭HTML输出
			 */
			if ($this->getRequest()->isXmlHttpRequest()) {
				Yaf_Dispatcher::getInstance()->disableView();
			}
		}
	
	(2)开启自动Render. 
	默认是开启的, 在动作执行完成以后, Yaf会自动render以动作名命名的视图模板文件.
		/**
		 * Controller的init方法会被自动首先调用
		 */
		public function init() {
			/**
			 * 如果不是Ajax请求, 则开启HTML输出
			 */
			if (!$this->getRequest()->isXmlHttpRequest()) {
				Yaf_Dispatcher::getInstance()->enableView();
			}
		}

	(3)开启/关闭自动渲染功能. 
	在开启的情况下(Yaf默认开启), Action执行完成以后, Yaf会自动调用View引擎去渲染该Action对应的视图模板.
		public function init() {
			if ($this->getRequest()->isXmlHttpRequest()) {
				//如果是Ajax请求, 关闭自动渲染, 由我们手工返回Json响应
				Yaf_Dispatcher::getInstance()->autoRender(FALSE);
			}
		}

	(4)是否返回Response对象
	如果启用, 则Response对象在分发完成以后不会自动输出给请求端, 而是交给程序员自己控制输出.
		$application = new Yaf_Application("config.ini");
		/* 关闭自动响应, 交给rd自己输出*/
		$response =
		$application->getDispatcher()->returnResponse(TRUE)->getApplication()->run();
		/** 输出响应*/
		$response->response();

	(5)注册一个插件. Yaf_Dispatcher::registerPlugin()

	

##`Yaf_Loader`
>Yaf_Loader类为Yaf提供了自动加载功能

	(1)导入一个PHP文件 Yaf_Loader::import

		//绝对路径
		Yaf_Loader::import("/usr/local/foo.php);
		//相对路径, 会在APPLICATION_PATH."/library"


##`Yaf_Router`
	
	(1)给路由器增加一个名为$name的路由协议 Yaf_Router::addRoute()
		$router->addRoute('dummy', $route);
	(2)给路由器通过配置增加一簇路由协议 Yaf_Config::addConfig()
	(3)获取当前路由器中的所有路由协议 Yaf_Router::getRoutes()
	(4)获取当前路由器的路由协议栈中名为$name的协议 Yaf_Router::getRoute()
	(5)获取路由匹配成功, 路由生效的路由协议名 Yaf_Router::getCurrentRoute()
	(6)判断一个Module名, 是否是申明存在的Module Yaf_Router::isModuleName()
		$routes = Yaf_Dispatcher::getInstance()->isModuleNamer("Index")

##`Yaf_Session`
	
	设置SESSION: Yaf_Session::getInstance()->set('username',$_POST['username']);
	获取SESSION: Yaf_Session::getInstance()->get('username')
	销毁SESSION: Yaf_Session::getInstance()->del('yaf_username');

---

##fetch model

	$model = new SampleModel();


##assign
	$this->getView()->assign("content", $model->selectSample());
	$this->getView()->assign("name", $name);
	$this->_view->assign(array("sex"=>"female","age"=>"24"));
	$this->getView()->assign(array(
		'fieldName'  => $fieldName,
		'allClass'   => $allClass,
		'allMajor'	 => $allMajor,
		'sex'        => $sex,
		'pagination' => $pagination));


##SQL(medoo)

	//...

##SQL(2)

	(1)$this->sql = "SELECT * FROM";
	  return $this->_db->getAll($this->sql); 返回所有
	  return $this->_db->getRow($this->sql); 返回一条
	
	(2)增
	$data['name'] = 'jingwentian';
	return $this->_db->insert($table_name, $data);
	
	return $this->_db->insertMulti($tble_name, $data);
	//多数据插入:  $data数据，必须是形如 $array[索引][字段名]才能正确执行
	
	return $this->_db->replace($tble_name, $data);
	//如果数据存在则更新,如果不存在则创建
	
	(3)删
	$sql = "DELETE FROM table WHERE field=?";
	$db->execute($sql);
	
	
	(4)改
	$data['name'] = 'jingwentian';
	$condition = 'id=1';
	return $this->_db->update($this->_table,$data,$condition);
	
	
	(5)查
	return $this->_db->select($fields, $tables, $where = '', $group_by = '', $having = '', $order_by = '', $limit = '', $master = false);
	
	(6)返回最后写入的记录编号
	
	return $this->_db->lastId();
	
	(7)获取最近一次查询的sql语句
	return $this->_db->lastSql();




		

