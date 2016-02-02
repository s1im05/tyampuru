<?php
class Post_Controller extends Controller {
    
    protected $_sTemplate   = 'post.php';
    protected $_sLayout     = 'index.php';


    public function byIdAction($iPostId, $sName = ''){
        $oPost      = new Post_Model($this->getDb(), $this->getConfig());
        $oPost->id  = $iPostId;
        
        $oChapter       = new Chapter_Model($this->getDb(), $this->getConfig());
        $oChapter->id   = $oPost->chapter_id;

        $oPost->chapter_name    = $oChapter->class;
        $oPost->chapter_title   = $oChapter->title;
        
        if (isset($_SESSION['user'])){ // check if post liked
            $oPost->like_state    = $this->getDb()->selectCell("SELECT state FROM ?_posts__likes WHERE state = 1 AND post_id = ?d AND user_id = ?d LIMIT 1;", $iPostId, $_SESSION['user']['id']);
        }

        $this->setTitle($oPost->chapter_title.' &ndash; '.$oPost->title);
        $this->getView()->assign('sChapter',    $oChapter->class);
        $this->getView()->assign('aPost',       $oPost->data);
    }
    
    public function likeAction($iPostId){
        if (!isset($_SESSION['user'])){
            $this->getRequest()->go404();
        }
        if (!$aRow  = $this->getDb()->selectRow("SELECT * FROM ?_posts__likes WHERE post_id = ?d AND user_id = ?d LIMIT 1;", $iPostId, $_SESSION['user']['id'])){
            $this->getDb()->query("INSERT INTO ?_posts__likes SET state = 1, cdate = NOW(), post_id = ?d, user_id = ?d;", $iPostId, $_SESSION['user']['id']);
        } else {
            $this->getDb()->query("UPDATE LOW_PRIORITY ?_posts__likes SET state = 1, cdate = NOW() WHERE post_id = ?d AND user_id = ?d LIMIT 1;", $iPostId, $_SESSION['user']['id']);
        }

        $this->setLayout('ajax.php');
        $this->getView()->assign('sRequest', 'like');
    }
    
    public function dislikeAction($iPostId){
        if (!isset($_SESSION['user'])){
            $this->getRequest()->go404();
        }
        if ($aRow  = $this->getDb()->selectRow("SELECT * FROM ?_posts__likes WHERE post_id = ?d AND user_id = ?d LIMIT 1;", $iPostId, $_SESSION['user']['id'])){
            $this->getDb()->query("UPDATE LOW_PRIORITY ?_posts__likes SET state = 0, cdate = NOW() WHERE post_id = ?d AND user_id = ?d LIMIT 1;", $iPostId, $_SESSION['user']['id']);
        }

        $this->setLayout('ajax.php');
        $this->getView()->assign('sRequest', 'dislike');
    }
}