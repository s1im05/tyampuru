<?php
namespace SSCE\Controllers;

class Post extends Base {
    
    protected $_sTemplate   = 'post.php';
    protected $_sLayout     = 'index.php';


    public function byIdAction($iPostId, $sName = ''){
        
        $oUser   = new \SSCE\Models\User($this->options);
        $this->_getComments($iPostId, $oUser);
        
        $oPost      = new \SSCE\Models\Post($this->options);
        $oPost->id  = $iPostId;

        if (sizeof($oPost->data) === 0){
            $this->request->go404();
        }
        
        $oChapter       = new \SSCE\Models\Chapter($this->options);
        $oChapter->id   = $oPost->chapter_id;

        $oPost->chapter_name    = $oChapter->class;
        $oPost->chapter_title   = $oChapter->title;
        
        $this->db->query("UPDATE LOW_PRIORITY ?_posts SET views = views+1 WHERE id = ?d LIMIT 1;", $iPostId);
        
        if ($oUser->isLogged()){ // check if post liked
            $oPost->like_state    = $this->db->selectCell("SELECT state FROM ?_posts__likes WHERE state = 1 AND post_id = ?d AND user_id = ?d LIMIT 1;", $iPostId, $oUser->id);
        }

        $this->setTitle($oPost->chapter_title.' &ndash; '.$oPost->title);
        $this->view->assign('sChapter',    $oChapter->class);
        $this->view->assign('aPost',       $oPost->data);
    }
    
    private function _getComments($iPostId, $oUser){
        if ($oUser->isLogged() && isset($_POST['comment']) && trim($_POST['comment'])){
            $iId    = $this->db->query("INSERT INTO 
                                                    ?_comments 
                                                SET
                                                    post_id     = ?d,
                                                    user_id     = ?d,
                                                    text        = ?",
                                                $iPostId,
                                                $oUser->id,
                                                trim($_POST['comment']) );
            $this->db->query("UPDATE LOW_PRIORITY ?_posts SET comments = comments+1 WHERE id = ?d LIMIT 1;", $iPostId);                                    
            $this->view->assign('bCommentAdded',    true);
            $this->view->assign('iLastAdded',       $iId);
        }
        $aCommentList   = $this->db->select("SELECT 
                                                        c.*,
                                                        u.nickname,
                                                        u.gender,
                                                        u.photo
                                                    FROM 
                                                        ?_comments c,
                                                        ?_users u
                                                    WHERE
                                                        c.post_id   = ?d AND
                                                        c.user_id   = u.id
                                                    ORDER BY
                                                        c.id;",
                                                    $iPostId);
        $this->view->assign('aCommentList', $aCommentList);
    }
    
    
    
    public function likeAction($iPostId){
        $this->_statusChange($iPostId, true);
    }
    
    public function dislikeAction($iPostId){
        $this->_statusChange($iPostId, false);
    }
    
    private function _statusChange($iPostId, $bLike){
        $oUser   = new \SSCE\Models\User($this->options);
        if (!$oUser->isLogged()){
            $this->request->go404();
        }
        
        if (!$aPost = $this->db->selectRow("SELECT * FROM ?_posts WHERE id = ?d LIMIT 1;", $iPostId)){
            $this->request->go404();
        }
        
        if ($aRow  = $this->db->selectRow("SELECT * FROM ?_posts__likes WHERE post_id = ?d AND user_id = ?d AND state != ?d LIMIT 1;", $iPostId, $oUser->id, $bLike ? 1 : 0)){
            $this->db->query("UPDATE LOW_PRIORITY ?_posts__likes SET state = ?d, cdate = NOW() WHERE post_id = ?d AND user_id = ?d LIMIT 1;", $bLike ? 1 : 0, $iPostId, $oUser->id);
        } elseif ($bLike) {
            $this->db->query("INSERT INTO ?_posts__likes SET state = 1, cdate = NOW(), post_id = ?d, user_id = ?d;", $iPostId, $oUser->id);
        }
        
        $iLikes = (int)$this->db->selectCell("SELECT SUM(state) FROM ?_posts__likes WHERE post_id = ?d GROUP BY post_id", $iPostId);
        $this->db->query("UPDATE LOW_PRIORITY 
                                ?_posts 
                            SET 
                                likes = ?d
                            WHERE 
                                id = ?d 
                            LIMIT 1;", $iLikes, $iPostId);

        $this->setLayout('ajax.php');
        $this->view->assign('sRequest', $iLikes);
    }
}