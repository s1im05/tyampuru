<?php
class Bootstrap_Controller extends Controller {

    public function run(){

        $oUser      = new User_Model($this->getDb(), $this->getConfig());
        if (isset($_POST['token'])){
            $oUser->login($_POST['token']);
        }
        
        if ($this->getRequest()->getPath() === '/logout'){
            User_Model::logout();
        }
        
        $oChapters  = new ChapterList_Model($this->getDb(), $this->getConfig());
        $oTag       = new Tag_Model($this->getDb(), $this->getConfig());
        
        $this->assign('bIsLogged', User_Model::isLogged());
        $this->assign('aChapters', $oChapters->getList());
        $this->assign('sRandomTag', $oTag->getRandomTag());
    }
}