<?php
class Bootstrap_Controller extends Controller {
    
    private $_iLastCommentCount = 5;

    public function run(){

        $oUser      = new User_Model($this->options);
        if (isset($_POST['token'])){
            $oUser->loginLoginza($_POST['token']);
        } elseif (!$oUser->isLogged()){
            $oUser->loginCookie();
        }
        
        if ($this->request->getPath() === '/logout'){
            $oUser->logout();
        }

        $oChapters  = new ChapterList_Model($this->options);
        $oTag       = new Tag_Model($this->options);
        
        $aCommentsLast  = $this->db->select("SELECT 
                                                    c.*,
                                                    p.title,
                                                    u.nickname,
                                                    u.gender
                                                FROM 
                                                    ?_comments c,
                                                    ?_posts p,
                                                    ?_users u
                                                WHERE
                                                    c.user_id   = u.id AND
                                                    c.post_id   = p.id
                                                ORDER BY
                                                    id DESC
                                                LIMIT ?d;",
                                                $this->_iLastCommentCount);

        $this->view->assign('bIsLogged', $oUser->isLogged());
        $this->view->assign('aChapters', $oChapters->getList());
        $this->view->assign('sRandomTag', $oTag->getRandomTag());
        $this->view->assign('aCommentsLast', $aCommentsLast);
    }
}