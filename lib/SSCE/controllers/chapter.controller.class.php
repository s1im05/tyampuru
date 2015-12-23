<?php
class Chapter_Controller extends Controller {
    
    protected $_sTitle      = 'My Test Page';
    protected $_sTemplate   = 'test.php';
    protected $_sLayout     = 'index.php';


    public function allAction($iPage = 0){

        $this->assign('sChapterActive', 'all');
    }
    
    public function byNameAction($sChapter, $iPage = 0){
        
        $this->assign('sChapterActive', $sChapter);
    }
}