<?php
class Home_Controller extends Controller {
    
    protected $_sTemplate   = 'home.php';
    protected $_sLayout     = 'index.php';
    
    private $_iLimit    = 50;


    public function indexAction(){
        $oUser   = new User_Model($this->options);
        if (!$oUser->isLogged()){
            $this->request->go('/');
        }
        
        if (isset($_POST['save'])){
            $this->_save();
        }
        
        $aLikes = $this->db->select("SELECT
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
                                            
        $aComments  = $this->db->select("SELECT
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
        $this->view->assign('aPostList',       $aLikes);
        $this->view->assign('aCommentList',    $aComments);
    }
    
    private function _save(){
        $sNickname  = isset($_POST['nickname']) ? trim($_POST['nickname']) : '';
        if ($sNickname){
            $_SESSION['user']['nickname'] = $sNickname;
        } else {
            $this->view->assign('sError', 'Ошибка сохранения поля "Никнейм"');
            return;
        }
        
        $cGender    = isset($_POST['gender'])?$_POST['gender']:'U';
        if (in_array($_POST['gender'], array('M','F','U'))){
            $_SESSION['user']['gender'] = $cGender;
        } else {
            $this->view->assign('sError', 'Ошибка сохранения поля "Пол"');
            return;
        }
        
        $this->db->query("UPDATE LOW_PRIORITY ?_users SET nickname = ?, gender = ? WHERE id = ?d LIMIT 1;", $sNickname, $cGender, $_SESSION['user']['id']);
        $this->view->assign('sSuccess', 'Успешно сохранено');
    }
}