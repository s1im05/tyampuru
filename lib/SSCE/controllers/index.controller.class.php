<?php
// can contain only IndexAction
class Index_Controller extends Controller {
    
    protected $_sTitle      = 'My Test Page';
    protected $_sTemplate   = 'test.php';


    public function indexAction(){
        $this->assign('test','zzz');
    }
}