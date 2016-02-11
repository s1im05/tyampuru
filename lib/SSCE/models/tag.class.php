<?php
namespace SSCE\Models;

class Tag extends Base {
    
    public function getRandomTag(){
        $aTags  = explode("\n", $this->db->selectCell("SELECT tags FROM ?_posts WHERE cdate < NOW() AND tags != '' ORDER BY RAND() LIMIT 1;"));
        return  trim($aTags[0]);
    }
}