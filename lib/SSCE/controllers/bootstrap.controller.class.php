<?php
class Bootstrap_Controller extends Controller {

    public function run(){
        $oChapters  = new ChapterList_Model($this->getDb(), $this->getConfig());
        $oTag       = new Tag_Model($this->getDb(), $this->getConfig());
        
        $this->assign('aChapters', $oChapters->getList());
        $this->assign('sRandomTag', $oTag->getRandomTag());
    }
}