<?php
class Search_Controller extends Controller {
    
    protected $_sTemplate   = 'search.php';
    protected $_sLayout     = 'index.php';
    
    private $_iLimit    = 50;


    public function searchAction($sQuery){
        $sQuery = trim($sQuery);
        $this->setTitle('Поиск по запросу &laquo;'.htmlspecialchars($sQuery).'&raquo;');
        
        $this->view->assign('sChapter', 'all');
        $this->view->assign('sQuery',   $sQuery);
        $this->view->assign('bByTag',   false);
    }
    
    public function searchAjaxAction($sQuery, $iPage, $bByTag = false){
        
        $aFound = $this->_doSearch($sQuery, $iPage, $bByTag);

        $this->view->assign('iPage',        $iPage);
        $this->view->assign('aPostList',    $aFound['data']);
        $this->view->assign('bAllLoaded',   ($iPage+1)*$this->_iLimit >= $aFound['total']);
        $this->view->assign('sQuery',       $sQuery);
        
        $this->setTemplate('search_list.php');
        $this->setLayout('ajax_template.php');
    }
    
    public function searchByTagAjaxAction($sQuery, $iPage){
        $this->searchAjaxAction($sQuery, $iPage, true);
    }
    
    
    public function searchByTagAction($sQuery){
        $this->searchAction($sQuery);
        $this->setTitle('Поиск по тэгу &laquo;'.htmlspecialchars($sQuery).'&raquo;');
        $this->view->assign('bByTag',   true);
    }
    
    
    private function _doSearch($sQuery, $iPage = 0, $bByTagOnly = false){
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
                if ($aData  = $this->db->selectPage($iCnt, 
                                                    "SELECT
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
                                                        id DESC
                                                    LIMIT ?d, ?d;", 
                                                    $this->_iLimit*$iPage, 
                                                    $this->_iLimit)){
                    return array(
                        'total' => $iCnt, 
                        'data'  => $aData
                    );
                }
            }
            return array(
                'total' => 0, 
                'data'  => array()
            );
        }
    }
}