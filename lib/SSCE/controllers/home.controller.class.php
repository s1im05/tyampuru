<?php
class Home_Controller extends Controller {
    
    protected $_sTemplate   = 'home.php';
    protected $_sLayout     = 'index.php';
    
    private $_iLimit    = 50;


    public function indexAction(){
        if (!isset($_SESSION['user'])){
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
                                            $_SESSION['user']['id'],
                                            $this->_iLimit);
        
        $this->setTitle('Домашняя страница');
        $this->getView()->assign('aPostList',   $aLikes);
    }
}