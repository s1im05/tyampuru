<?php
class Chapter_Controller extends Controller {
    
    protected $_sTitle      = 'My Test Page';
    protected $_sTemplate   = 'test.php';
    protected $_sLayout     = 'index.php';


    public function allAction($iPage = 1){
        $oChapter   = new Chapter_Model($this->getDb(), $this->getConfig());
        var_dump($oChapter->setPage($iPage)->getPosts());

        $this->assign('sChapterActive', 'all');
    }
    
    public function byNameAction($sChapter, $iPage = 1){
        $oChapter   = new Chapter_Model($this->getDb(), $this->getConfig());
        var_dump($oChapter->setPage($iPage)->setChapter($sChapter)->getPosts());
        
        $this->assign('sChapterActive', $sChapter);
    }
}