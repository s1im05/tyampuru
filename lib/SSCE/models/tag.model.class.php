<?php
class Tag_Model extends Model {
    
    public function getRandomTag(){
        $aTags  = explode("\n", $this->getDb()->selectCell("SELECT tags FROM ?_posts WHERE cdate < NOW() AND tags != '' ORDER BY RAND() LIMIT 1;"));
        return  trim($aTags[0]);
    }
}