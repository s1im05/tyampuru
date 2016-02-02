<?php
class Post_Controller extends Controller {
    
    protected $_sTemplate   = 'post.php';
    protected $_sLayout     = 'index.php';


    public function byIdAction($iId, $sName = ''){
        $oPost      = new Post_Model($this->getDb(), $this->getConfig());
        $oPost->id  = $iId;
        
        $oChapter       = new Chapter_Model($this->getDb(), $this->getConfig());
        $oChapter->id   = $oPost->chapter_id;

        $oPost->chapter_name    = $oChapter->class;
        $oPost->chapter_title   = $oChapter->title;

        $this->setTitle($oPost->chapter_title.' &ndash; '.$oPost->title);
        $this->getView()->assign('sChapter',    $oChapter->class);
        $this->getView()->assign('aPost',       $oPost->data);
    }
}