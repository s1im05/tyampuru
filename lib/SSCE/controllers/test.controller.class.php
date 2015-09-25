<?php
class Test_Controller extends Controller {
    
    protected $_sTitle  = 'My Test Page';
    
    public function run(){
        echo $this->getTitle();
    }
}