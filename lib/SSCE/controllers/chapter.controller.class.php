<?php
class Chapter_Controller extends Controller {
    
    protected $_sTitle      = 'My Test Page';
    protected $_sTemplate   = 'test.php';
    protected $_sLayout     = 'index.php';


    public function allAction(){
        $this->assign('test','all');
    }
    
    public function byNameAction(){
        var_dump($this->getRequest()->getParams());
    }
}