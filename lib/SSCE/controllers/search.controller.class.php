<?php
class Search_Controller extends Controller {
    
    protected $_sTemplate   = 'search.php';
    protected $_sLayout     = 'index.php';
    
    private $_iLimit    = 50;


    public function searchAction($sQuery){
        $sQuery = trim($sQuery);
        $this->setTitle('Поиск по запросу &laquo;'.htmlspecialchars($sQuery).'&raquo;');
        
        $this->getView()->assign('sChapter',    'all');
        $this->getView()->assign('aPostList',   $this->_doSearch($sQuery));
    }
    
    public function searchByTagAction($sQuery){
        $sQuery = trim($sQuery);
        $this->setTitle('Поиск по тэгу &laquo;'.htmlspecialchars($sQuery).'&raquo;');
        
        $this->getView()->assign('sChapter',    'all');
        $this->getView()->assign('aPostList',   $this->_doSearch($sQuery, true));
    }
    
    private function _doSearch($sQuery, $bByTagOnly = false){
        if (isset($sQuery)){
            $sText  = substr(trim($sQuery), 0, 50);
            $aWords = array();
            if ($aTmp  = explode(' ', $sText)){
                foreach ($aTmp as $sWord){
                    if ((trim( $sWord ) != '') && (mb_strlen(trim( $sWord )) > 2 )){
                        $aWords[]   = mysql_real_escape_string($sWord);
                    }
                }
                $aWords = array_unique($aWords);
            } else {
                $aWords[]   = $sText;
            }
            if (!empty($aWords)){
                if ($aData  = $this->getDB()->select("SELECT
                                                            p.*,
                                                            c.class AS chapter_name,
                                                            c.title AS chapter_title
                                                        FROM
                                                            ?_posts p,
                                                            ?_chapters c
                                                        WHERE
                                                            c.id    = p.chapter_id AND
                                                            (
                                                                p.tags LIKE '%".implode("%' OR tags LIKE '%", $aWords)."%'
                                                                ".(!$bByTagOnly ? "OR p.title LIKE '%".implode("%' OR title LIKE '%", $aWords)."%'" : '' )."
                                                            ) AND
                                                            p.cdate < NOW()
                                                        ORDER BY
                                                            RAND()
                                                        LIMIT ?d;", $this->_iLimit)){
                    return $aData;
                }
            }
            return null;
        }
    }
}