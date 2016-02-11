<?php
namespace SSCE\Models;

class Chapter extends Base {
    
    protected $_aChapters   = array();
    protected $_aPosts      = array();
    protected $_iPage       = 1;
    protected $_iTotal      = 0;
    protected $_aOrder      = array('field' => 'id', 'dir' => 'DESC');
    protected $_sChapter    = 'all';
    
    protected $_sTable      = 'chapters';
    
    private $_bNeedLoad     = true;

    
    public function setPage($iPage){
        $this->_iPage       = (int)$iPage > 1 ? (int)$iPage : 1;
        $this->_bNeedLoad   = true;
        return $this;
    }
    
    public function getPage(){
        return (int)$this->_iPage;
    }

    public function setChapter($sName){
        $this->_sChapter    = $sName;
        $this->_bNeedLoad   = true;
        return $this;
    }

    public function setOrder($sField, $sDirection){
        $this->_aOrder      = array('field'   => $sField, 'dir' => $sDirection);
        $this->_bNeedLoad   = true;
        return $this;
    }
    
    public function getPosts(){
        if ($this->_bNeedLoad) {
            $this->_load();
        }
        return $this->_aPosts;
    }
    
    public function getPostsCount(){
        if ($this->_bNeedLoad) {
            $this->_load();
        }
        return (int)$this->_iTotal;
    }
    
    private function _load(){
        $this->_bNeedLoad   = false;
        $iPPage = $this->config->project->postsppage;
        
        $this->_aPosts  = $this->db->selectPage(
            $this->_iTotal,
            "SELECT
                    p.*,
                    pl.state    AS like_state,
                    c.title     AS chapter_title,
                    c.class     AS chapter_name,
                    cm.id       AS last_comment_id,
                    cm.text     AS last_comment_text,
                    cm.cdate    AS last_comment_cdate,
                    u.nickname  AS last_comment_nickname,
                    u.gender    AS last_comment_gender,
                    u.photo     AS last_comment_photo
                FROM 
                    ?_chapters c
                JOIN
                    ?_posts p
                LEFT JOIN
                    ?_posts__likes pl
                ON
                    (pl.post_id  = p.id AND pl.user_id = ?d)
                LEFT JOIN
                    ?_comments cm
                ON
                    cm.id = (SELECT id FROM ?_comments WHERE post_id = p.id ORDER BY id DESC LIMIT 1)
                LEFT JOIN
                    ?_users u
                ON
                    u.id    = cm.user_id
                WHERE
                    ".($this->_sChapter != 'all' ? "c.class = '".mysql_real_escape_string($this->_sChapter)."' AND" : '' )."
                    c.id    = p.chapter_id AND
                    p.cdate < NOW()
                GROUP BY
                    p.id
                ORDER BY 
                    p.".$this->_aOrder['field']." ".$this->_aOrder['dir']."
                LIMIT ?d, ?d;", 
                isset($_SESSION['user'])? $_SESSION['user']['id']: 0,
                ($this->_iPage-1)*$iPPage, 
                $iPPage
            );
        return $this;
    }
    
}