<?php

namespace Sol\Mvc\Controllers ;
/**
 * This router finds it paths by directory navigation. 
 * it ignores Modules and Controllers on it way to find the controller.
 */
class SimpleRouter extends \Sol\Mvc\Controllers\Router
{

    protected function doAfterHdlReq(){
        $route = $this->getReqStr () ;

        /**
         * url = http://DomainName.com/ModuleName/Dir1/Dir2/Dir3/ControllerFile/ActionName/Arg1/Arg2
         * $route == ModuleName/Dir1/Dir2/Dir3/ControllerFile/ActionName/Arg1/Arg2
         * step0: array("$ModuleName" ,"$Dir1","$Dir2","$Dir3","$ControllerFile","$ActionName","$Arg1","$Arg2")
         * step1: array("Modules","$ModuleName","Dir1","Dir2","Dir3","ControllerFile","ActionName","Arg1","Arg2")
         * step2: array("Modules","$ModuleName","Controllers","$Dir1","$Dir2","$Dir3","$ControllerFile","$ActionName","$Arg1","$Arg2")
         */
        $explodedRoutes = explode ("/" , $route) ;
        //step1
        array_unshift ($explodedRoutes , "Modules") ;


        //step 2
        array_splice ($explodedRoutes , 2 , 0 , array("Controllers")) ;


        if (is_array ($explodedRoutes)) {
            $pathTillHere = SITE_PATH . "" ;
            $counter = 0 ;
            foreach ($explodedRoutes as $routePart) {
                if ($counter === 0) {
                    if ($routePart === "Modules") {
                        $pathTillHere .= $routePart . DIRECTORY_SEPARATOR ;
                        array_shift ($explodedRoutes) ;
                    }
                }
                /**
                 * At this poinnt when counter=1 we expect $routePart 
                 * to be equal to Module'a name like Auth or Test
                 */
                if ($counter === 1) {
                    if ( ! is_dir ($pathTillHere . $routePart)) {
                        throw new \Exception ("Module {$routePart} does not exist.") ;
                    }
                    else {
                        //.../Modules/$ModuleName
                        $pathTillHere .= $routePart . DIRECTORY_SEPARATOR ;
                        array_shift ($explodedRoutes) ;
                    }
                }
                if ($counter === 2) {
                    if ($routePart !== "Controllers") {
                        throw new \Exception ("I except the third part of the path as a directpry named Controllers") ;
                    }
                    else {
                        //.../Modules/$ModuleName/Controllers/
                        $pathTillHere .= $routePart . DIRECTORY_SEPARATOR ;
                        array_shift ($explodedRoutes) ;
                    }
                }

                if ($counter >= 3) {
                    if (is_dir ($pathTillHere . $routePart)) {
                        $pathTillHere .= $routePart . DIRECTORY_SEPARATOR ;
                        array_shift ($explodedRoutes) ;
                    }
                    elseif (is_file ($pathTillHere . $routePart . ".php")) {
                        $this->ctrlClassName = $routePart ;
                        $this->ctrlpath = $pathTillHere . $routePart . ".php" ;
                        //Throwing away controller's name
                        array_shift ($explodedRoutes) ;
                        
                        //throwing and savingf action name
                        $this->actionName = array_shift ($explodedRoutes) ;
                        $this->actionArgs = $explodedRoutes ;
                        break;
                    }
                }
                $counter ++ ;
            }
        }
    }
}