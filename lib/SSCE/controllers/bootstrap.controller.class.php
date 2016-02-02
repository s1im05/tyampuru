<?php
class Bootstrap_Controller extends Controller {

    public function run(){

        if (isset($_POST['token'])){
            $this->_login($_POST['token']);
        }
        
        if ($this->getRequest()->getPath() === '/logout'){
            unset($_SESSION['user']);
            header("Location: {$_SERVER['HTTP_REFERER']}");
            die();
        }
        
        $oChapters  = new ChapterList_Model($this->getDb(), $this->getConfig());
        $oTag       = new Tag_Model($this->getDb(), $this->getConfig());
        
        $this->assign('aChapters', $oChapters->getList());
        $this->assign('sRandomTag', $oTag->getRandomTag());
    }
    
    
    private function _login($sToken){
        if (isset($sToken)){
            $sUrl   = "http://loginza.ru/api/authinfo?token={$sToken}";
            if (($oData   = json_decode(file_get_contents($sUrl))) && !isset($oData->error_type)){
                if (!($_SESSION['user']    = $this->getDb()->selectRow("SELECT * FROM ?_users WHERE identity = ? LIMIT 1;", $oData->identity))){
                    if ($iId    = $this->getDb()->query("INSERT INTO
                                                ?_users
                                            SET
                                                `identity`      = ?,
                                                `nickname`      = ?,
                                                `last_name`     = ?,
                                                `first_name`    = ?,
                                                `email`         = ?,
                                                `dob`           = ?,
                                                `gender`        = ?,
                                                `web`           = ?,
                                                `photo`         = ?",
                                                $oData->identity,
                                                isset($oData->nickname)&&($oData->nickname!='')?$oData->nickname:(isset($oData->name->last_name)||isset($oData->name->first_name)?$oData->name->first_name.' '.$oData->name->last_name:''),
                                                isset($oData->name->last_name)?$oData->name->last_name:'',
                                                isset($oData->name->first_name)?$oData->name->first_name:'',
                                                isset($oData->email)?$oData->email:'',
                                                isset($oData->dob)?$oData->dob:'0000-00-00',
                                                isset($oData->gender)?$oData->gender:'U',
                                                isset($oData->web->default)?$oData->web->default:'',
                                                isset($oData->photo)?$oData->photo:'')){
                        $_SESSION['user']   = $this->getDb()->selectRow("SELECT * FROM ?_users WHERE identity = ? LIMIT 1;", $oData->identity);
                    }
                }
            }
        }
        return $this;
    }
}