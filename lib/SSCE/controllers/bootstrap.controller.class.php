<?php
class Bootstrap_Controller extends Controller {
    
    public function run(){
        if ($this->getRequest()->isOk()) {
            var_dump(1);
        }
    }
}