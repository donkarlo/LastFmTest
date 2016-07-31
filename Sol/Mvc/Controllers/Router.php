<?php

namespace Sol\Mvc\Controllers;

abstract class Router {

    abstract protected function doAfterHdlReq();

    /**
     * Abbr request string, To strore request string
     * a string like myHost.com/arg1/arg2/... 
     * @var string 
     */
    private $reqStr = NULL;

    /**
     * Will hold the string path to controller
     * @var string 
     */
    protected $ctrlpath = NULL;

    /**
     * Contains a controller class name
     * @var mixed 
     */
    protected $ctrlClassName = NULL;

    /**
     * Contains a controller object
     * @var mixed 
     */
    protected $ctrlObj = NULL;

    /**
     * contains the name of the action or metrhod of controller class
     * @var string
     */
    protected $actionName = NULL;

    /**
     * Contains an array of sent args
     * @var array
     */
    protected $actionArgs = NULL;

    /**
     *
     * @var \Sol\Mvc\Controllers\Router
     */
    private $router;

    public function __construct($reqStr = NULL) {
        $this->reqStr = trim($reqStr, "/");
    }

    public function hdlReq() {
        if (strpos($this->reqStr, "Test/Test") === 0) {
            if (strpos($this->reqStr, "Test/Test/Divide") === 0) {
                $router = new \Modules\Test\Controllers\Router();
                $this->ctrlObj = new \Modules\Test\Controllers\Test();

                $argsStr = str_replace("Test/Test/Divide", "", $this->reqStr);
                $argsStr = trim($argsStr, "/");

                $this->actionArgs = explode("/", $argsStr);
                try {
                    $this->ctrlObj->Divide($this->actionArgs);
                } catch (\Exception $error) {
                    var_dump($error);
                }
            } elseif (strpos($this->reqStr, "Test/Test/IsObj") === 0) {
                $this->ctrlObj = new \Modules\Test\Controllers\Test();

                $argsStr = str_replace("Test/Test/IsObj", "", $this->reqStr);
                $argsStr = trim($argsStr, "/");

                $this->actionArgs = explode("/", $argsStr);
                try {
                    $this->ctrlObj->IsObj($this->actionArgs);
                } catch (\Exception $error) {
                    var_dump($error);
                }
            }
        }
        //If it didnt hit any of the above 
        else {
//            $controllerObj = new $className() ;
//            $controllerObj->$action ($args) ;
            $this->doAfterHdlReq();
        }
        require_once $this->ctrlpath;
        $ctrlClassName = $this->ctrlClassName;
        $this->ctrlObj = new $ctrlClassName();
        $actionName = $this->actionName;
        $response = $this->ctrlObj->$actionName($this->actionArgs);
        if ($response instanceof \Sol\Mvc\Views\Layout) {
            $response->render();
        }
    }

    private function getActionName() {
        if (is_null($this->actionName)) {
            $result = str_replace($this->getCtrlPath(), "", $this->getReqStr());
            $resExpl = explode("/", $result);
            $this->actionName = $resExpl[0];
        }
        return $this->actionName;
    }

    protected function getReqStr() {
        return $this->reqStr;
    }

}
