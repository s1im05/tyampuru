<?php
class SSCE_View {
    
    protected $_sTemplate;
    protected $_sLayout;
    
    
    public function __construct(){

    }
    
    public function assign(){
        
    }
    
    public function render(){
        
    }
    
    
    public function setTemplate($sTemplate){
        $this->_sTemplate = $sTemplate;
        return $this;
    }
    
    public function getTemplate(){
        return $this->_sTemplate;
    }
    
    public function setLayout($sLayout){
        $this->_sLayout = $sLayout;
        return $this;
    }
    
    public function getLayout(){
        return $this->_sLayout;
    }
}