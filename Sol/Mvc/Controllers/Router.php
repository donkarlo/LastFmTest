<?php

namespace Sol\Mvc\Controllers;
/**
 * This class is responsible to find path to controller and run an action of it with given arguments.
 */
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
        $this->doAfterHdlReq();
        if (!empty($this->ctrlpath)) {
            require_once $this->ctrlpath;
            $ctrlClassName = $this->ctrlClassName;
            $this->ctrlObj = new $ctrlClassName();
            $actionName = $this->actionName;
            $response = $this->ctrlObj->$actionName($this->actionArgs);
            if ($response instanceof \Sol\Mvc\Views\Layout) {
                $response->render();
            }
        } else {
            require_once SITE_PATH . 'Modules/Core/Controllers/Index.php';
            $indexController = new \Index();
            $indexController->Index();
        }
    }

    protected function getReqStr() {
        return $this->reqStr;
    }

}
