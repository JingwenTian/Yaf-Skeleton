<?php

namespace Test\PHPUnit;

/**
 * 测试基类
 */
class TestCase extends \PHPUnit_Framework_TestCase {

    /**
     * yaf运行实例
     * 
     * @var \Yaf\Application
     */
    protected $_application = null;

    /**
     * 构造方法，初始化yaf运行实例
     */
    public function __construct() {
        $this->_application = $this->getApplication();
        parent::__construct();
    }

    /**
     * 设置application
     */
    public function setApplication() {
        $application = new \Yaf_Application(APPLICATION_PATH . "/conf/application.ini");
        $application->bootstrap();
        \Yaf_Registry::set('application', $application);
    }

    /**
     * 获取application
     * 
     * @return \Yaf\Application
     */
    public function getApplication() {
        $application = \Yaf_Registry::get('application');
        if (!$application) {
            $this->setApplication();
        }

        return \Yaf_Registry::get('application');
    }

}
