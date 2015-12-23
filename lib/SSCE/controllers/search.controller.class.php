<?php
class Search_Controller extends Controller {
    
    protected $_sTemplate   = 'search.php';
    protected $_sLayout     = 'index.php';


    public function searchAction($sQuery){
        $this->setTitle('Поиск по запросу: &laquo;'.htmlspecialchars($sQuery).'&raquo;');
    }

}