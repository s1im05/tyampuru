<?php
namespace SSCE\Controllers;

class Chapter extends Base {
    
    protected $_sTemplate   = 'chapter.php';
    protected $_sLayout     = 'index.php';


    public function allAction($iPage = 1){
        $this->setTitle('Прикольные картинки и гифки из всех разделов');
        $this->_process('all', $iPage);
    }
    
    public function byNameAction($sChapter, $iPage = 1){
        if ($aChapters  = $this->view->getVar('aChapters')){
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
        $oChapter   = new \SSCE\Models\Chapter($this->options);
        $oChapter->setChapter($sChapter)->setPage($iPage);
        
        $aPosts     = $oChapter->getPosts();
        $iPageCount = (int)ceil($oChapter->getPostsCount()/$this->config->project->postsppage);
        if ($oChapter->getPage() > $iPageCount) {
            $this->request->go404();
        }

        $this->view->assign('sChapter',       $sChapter);
        $this->view->assign('aPostList',      $aPosts);
        $this->view->assign('iPageActive',    $oChapter->getPage());
        $this->view->assign('iPagesCount',    $iPageCount);
    }
}