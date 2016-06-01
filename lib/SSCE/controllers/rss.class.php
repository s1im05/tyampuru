<?php
namespace SSCE\Controllers;

class Rss extends Base {
    
    protected $_sLayout     = 'rss.php';

    public function rssAction(){
        $aRss   = array(
            'title'         => $this->view->lang(array('en' => 'Tyampuru! Only the best stuff from Internet!'), 'Тямпуру! Все только самое отборное и интересное!'),
            'description'   => '',
            'items'         => $this->db->select("SELECT
                                                            p.id,
                                                            p.title,
                                                            p.title_en,
                                                            p.announce AS description,
                                                            p.cdate AS date,
                                                            p.tags,
                                                            p.tags_en
                                                        FROM
                                                            ?_posts p
                                                        WHERE
                                                            p.cdate < NOW()
                                                        ORDER BY
                                                            p.cdate DESC
                                                        LIMIT 50;"));
        if ( !empty( $aRss['items'] ) ) {
            foreach ( $aRss['items'] as $iKey => $aVal ) {
                $aRss['items'][$iKey]['description']    = str_replace( '<img','<img style="max-width: 570px;"', $aVal['description']);
                $aRss['items'][$iKey]['tags']           = Helpers\prepareTags($aVal['tags']);
                $aRss['items'][$iKey]['tags_en']           = Helpers\prepareTags($aVal['tags_en']);
            }
        }
        $this->view->assign('aRss', $aRss);
    }

}