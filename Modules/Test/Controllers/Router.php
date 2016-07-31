<?php

namespace Modules\Test\Controllers ;

class Router extends \Sol\Mvc\Controllers\Router
{

    protected function doAfterHdlReq(){
        $argsStr = str_replace ("Auth/Signup/Modify" , "" , $this->reqStr) ;
        $argsStr = trim ($argsStr , "/") ;
        $this->actionArgs = explode ("/" , $argsStr) ;
        $this->ctrlObj->Modify ($this->actionArgs) ;
    }

    protected function getCtrlPath(){
        if (is_null ($this->ctrlpath)) {
            $this->ctrlpath = "Test/Test" ;
        }
        return $this->ctrlpath ;
    }
}