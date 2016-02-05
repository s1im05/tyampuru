<?php
class Bootstrap_Controller extends Controller {

    public function run(){

        $oUser      = new User_Model($this->getDb(), $this->getConfig());
        if (isset($_POST['token'])){
            $oUser->loginLoginza($_POST['token']);
        } elseif (!$oUser->isLogged()){
            $oUser->loginCookie();
        }
        
        if ($this->getRequest()->getPath() === '/logout'){
            $oUser->logout();
        }
        
        $oChapters  = new ChapterList_Model($this->getDb(), $this->getConfig());
        $oTag       = new Tag_Model($this->getDb(), $this->getConfig());
        
        $this->assign('bIsLogged', $oUser->isLogged());
        $this->assign('aChapters', $oChapters->getList());
        $this->assign('sRandomTag', $oTag->getRandomTag());
    }
}