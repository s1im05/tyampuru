<?php
namespace SSCE\Controllers;

class Bootstrap extends Base {
    
    private $_iLastCommentCount = 5;

    public function run(){
        
        if (isset($_GET['lang'])) {
            $this->request->setLang(substr($_GET['lang'], 0, 2))->refresh();
        }
        
        $oUser  = $this->doLogin();
        
        $oChapters  = new \SSCE\Models\ChapterList($this->options);
        $oTag       = new \SSCE\Models\Tag($this->options);
        
        $aCommentsLast  = $this->db->select("SELECT 
                                                    c.*,
                                                    p.title,
                                                    p.title_en,
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
    
    public function run_admin(){
        $oUser = $this->doLogin();
    }
    
    private function doLogin(){
        $oUser      = new \SSCE\Models\User($this->options);

        if (isset($_POST['token'])){
            $oUser->loginLoginza($_POST['token']);
        } elseif (!$oUser->isLogged()){
            $oUser->loginCookie();
        }
        
        if ($this->request->getPath() === '/logout'){
            $oUser->logout();
        }
        
        return $oUser;
    }
}