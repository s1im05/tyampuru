<?php
class Chapter_Model extends Model {
    
    protected $_aChapters   = array();
    protected $_aPostIds    = array();
    protected $_iPage       = 0;
    protected $_sChapter    = '';

    static function getChapters($oDb){
        var_dump($oDb->select("SELECT * FROM ?_chapters;"));
    }
}