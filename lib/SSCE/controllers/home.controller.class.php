<?php
class Home_Controller extends Controller {
    
    protected $_sTemplate   = 'home.php';
    protected $_sLayout     = 'index.php';
    
    private $_iLimit    = 50;


    public function indexAction(){
        $oUser   = new User_Model($this->getDb(), $this->getConfig());
        if (!$oUser->isLogged()){
            $this->getRequest()->go('/');
        }
        
        $aLikes = $this->getDb()->select("SELECT
                                                p.*,
                                                pl.cdate AS like_date
                                            FROM
                                                ?_posts p,
                                                ?_posts__likes pl
                                            WHERE
                                                p.id        = pl.post_id AND
                                                pl.user_id  = ?d AND
                                                pl.state    = 1
                                            ORDER BY
                                                pl.cdate DESC
                                            LIMIT ?d",
                                            $oUser->id,
                                            $this->_iLimit);
                                            
        $aComments  = $this->getDb()->select("SELECT
                                                    c.*,
                                                    p.title,
                                                    p.thumb
                                                FROM
                                                    ?_comments c,
                                                    ?_posts p
                                                WHERE
                                                    p.id        = c.post_id AND
                                                    c.user_id   = ?d
                                                ORDER BY
                                                    c.cdate DESC
                                                LIMIT ?d",
                                                $oUser->id,
                                                $this->_iLimit);
        
        $this->setTitle('Домашняя страница');
        $this->getView()->assign('aPostList',       $aLikes);
        $this->getView()->assign('aCommentList',    $aComments);
    }
}