<?php
class ChapterList_Model extends Model {
    
    protected $_aChapters   = array();


    public function __construct($oDb, $oConfig){
        parent::__construct($oDb, $oConfig);
        
        $this->_aChapters   = $oDb->select("SELECT * FROM ?_chapters ORDER BY sort;");
    }
    
    public function getList(){
        return $this->_aChapters;
    }
}