<?php
class Chapter_Model extends Model {
    
    protected $_aChapters   = array();
    protected $_aPosts      = array();
    protected $_iPage       = 1;
    protected $_iTotal      = 0;
    protected $_aOrder      = array('field' => 'id', 'dir' => 'DESC');
    protected $_sChapter    = 'all';
    
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
        $iPPage = $this->getConfig()->project->postsppage;
        
        $this->_aPosts  = $this->getDb()->selectPage(
            $this->_iTotal,
            "SELECT
                    p.*,
                    c.title AS chapter_title,
                    c.class AS chapter_name
                FROM 
                    ?_posts p,
                    ?_chapters c
                WHERE
                    ".($this->_sChapter != 'all' ? "c.class = '".mysql_real_escape_string($this->_sChapter)."' AND" : '' )."
                    c.id    = p.chapter_id
                ORDER BY 
                    p.".$this->_aOrder['field']." ".$this->_aOrder['dir']."
                LIMIT ?d, ?d;", 
                ($this->_iPage-1)*$iPPage, 
                $iPPage
            );
        return $this;
    }
    
}