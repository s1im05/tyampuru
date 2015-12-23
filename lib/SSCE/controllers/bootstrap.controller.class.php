<?php
class Bootstrap_Controller extends Controller {

    public function run(){
        $oChapters  = new ChapterList_Model($this->getDb(), $this->getConfig());
        $this->assign('aChapters', $oChapters->getList());
    }
}