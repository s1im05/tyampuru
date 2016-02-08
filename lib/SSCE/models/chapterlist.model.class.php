<?php
class ChapterList_Model extends Model {
    
    protected $_aChapters   = array();


    public function __construct($aOptions){
        parent::__construct($aOptions);
        $this->_aChapters   = $this->db->select("SELECT * FROM ?_chapters ORDER BY sort;");
    }
    
    public function getList(){
        return $this->_aChapters;
    }
}