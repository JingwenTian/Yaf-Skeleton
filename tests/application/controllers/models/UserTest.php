<?php

require_once APPLICATION_PATH . '/tests/application/library/Test/PHPUnit/ModelTestCase.php';

class UserTest extends \Test\PHPUnit\ModelTestCase {

    public function testshowAll() {
        $model = new \IndexModel();
        $id = 1;
        $result = $model->showOne($id);
        $this->assertEquals('jingplus', $result);

        $id = 100;
        $result = $model->showOne($id);
        $this->assertFalse($result);
    }

}