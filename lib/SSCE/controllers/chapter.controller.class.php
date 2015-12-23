<?php
class Chapter_Controller extends Controller {
    
    protected $_sTemplate   = 'chapter.php';
    protected $_sLayout     = 'index.php';


    public function allAction($iPage = 1){
        $this->setTitle('Прикольные картинки и гифки из всех разделов');
        $this->_process('all', $iPage);
    }
    
    public function byNameAction($sChapter, $iPage = 1){
        if ($aChapters  = $this->getView()->getVar('aChapters')){
            foreach ($aChapters as $aVal){
                if ($aVal['class'] === $sChapter){
                $this->setTitle("Прикольные картинки и гифки из раздела &laquo;{$aVal['title']}&raquo;");
                    break;
                } 
            }
        }
        $this->_process($sChapter, $iPage);
    }
    
    
    private function _process($sChapter, $iPage){
        $oChapter   = new Chapter_Model($this->getDb(), $this->getConfig());
        $oChapter->setChapter($sChapter)->setPage($iPage);
        
        $aPosts     = $oChapter->getPosts();
        $iPageCount = (int)ceil($oChapter->getPostsCount()/$this->getConfig()->project->postsppage);
        if ($oChapter->getPage() > $iPageCount) {
            $this->getRequest()->go404();
        }

        $this->assign('sChapter',       $sChapter);
        $this->assign('aPostList',      $aPosts);
        $this->assign('iPageActive',    $oChapter->getPage());
        $this->assign('iPagesCount',    $iPageCount);
    }
}