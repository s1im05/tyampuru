<?php
namespace SSCE\Models;

class Tag extends Base {
    
    public function getRandomTag(){
        $sLn    = $this->view->lang(array('en' => '_en'), '');
        $aTags  = explode("\n", $this->db->selectCell("SELECT tags{$sLn} FROM ?_posts WHERE cdate < NOW() AND tags{$sLn} != '' ORDER BY RAND() LIMIT 1;"));
        return  trim($aTags[0]);
    }
}