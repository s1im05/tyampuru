<?php
class Error_Controller extends Controller {
    
    public function indexAction(){
        $aPath = $this->getRequest()->getPath();
        switch ($aPath[0]) {
            case '403':
                $this->error403();
            break;
            case '404':
                $this->error404();
            break;
            default:
                $this->errorDefault();
        }
    }
    
    public function error403(){
        echo '403 Forbidden';
    }
    
    public function error404(){
        $this->setLayout('error404.php');
    }
    
    public function errorDefault(){
        echo 'Unknown Error';
    }
}