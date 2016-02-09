<?php
class Search_Controller extends Controller {
    
    protected $_sTemplate   = 'search.php';
    protected $_sLayout     = 'index.php';
    
    private $_iLimit    = 25;


    public function searchAction($sQuery, $bByTag = false){
        $sQuery = trim($sQuery);
        $iPage  = 0;
        
        $aFound = $this->_getFound($sQuery, 0, $bByTag);
        
        $this->view->assign('sChapter',     'all');
        $this->view->assign('iPage',        $iPage);
        $this->view->assign('aFound',       $aFound);
        $this->view->assign('sQuery',       $sQuery);
        $this->view->assign('bAllLoaded',   ($iPage+1)*$this->_iLimit >= $aFound['total']);
        $this->view->assign('bByTag',       false);
        
        $this->setTitle('Поиск по запросу &laquo;'.htmlspecialchars($sQuery).'&raquo;');
    }
    
    public function searchAjaxAction($sQuery, $iPage, $bByTag = false){
        
        $aFound = $this->_getFound($sQuery, $iPage, $bByTag);

        $this->view->assign('iPage',        $iPage);
        $this->view->assign('aFound',       $aFound);
        $this->view->assign('sQuery',       $sQuery);
        $this->view->assign('bAllLoaded',   ($iPage+1)*$this->_iLimit >= $aFound['total']);
        $this->view->assign('bByTag',       $bByTag);
        
        $this->setTemplate('search_list.php');
        $this->setLayout('ajax_template.php');
    }
    
    public function searchByTagAjaxAction($sQuery, $iPage){
        $this->searchAjaxAction($sQuery, $iPage, true);
    }
    
    
    public function searchByTagAction($sQuery){
        $this->searchAction($sQuery, true);
        $this->setTitle('Поиск по тэгу &laquo;'.htmlspecialchars($sQuery).'&raquo;');
        $this->view->assign('bByTag', true);
    }
    
    
    private function _getFound($sQuery, $iPage = 0, $bByTagOnly = false){
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
                                                        pl.state    AS like_state,
                                                        c.class     AS chapter_name,
                                                        c.title     AS chapter_title
                                                    FROM 
                                                        ?_chapters c
                                                    JOIN
                                                        ?_posts p
                                                    LEFT JOIN
                                                        ?_posts__likes pl
                                                    ON
                                                        (pl.post_id  = p.id AND pl.user_id = ?d)
                                                    WHERE
                                                        c.id    = p.chapter_id AND
                                                        (
                                                            p.tags LIKE '%".implode("%' OR tags LIKE '%", $aWords)."%'
                                                            ".(!$bByTagOnly ? "OR p.title LIKE '%".implode("%' OR title LIKE '%", $aWords)."%'" : '' )."
                                                        ) AND
                                                        p.cdate < NOW()
                                                    ORDER BY
                                                        p.id DESC
                                                    LIMIT ?d, ?d;",
                                                    isset($_SESSION['user'])? $_SESSION['user']['id']: 0,
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