<?php
class Bootstrap_Controller extends Controller {

    public function indexAction(){
        if ($this->getRequest()->isOk()) {
            // echo 'bootstraped';
        }
    }
}