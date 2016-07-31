<?php

namespace Sol\Mvc\Views ;

/**
 * Description of LayoutView
 *
 * @author Noondreams.com <web@noondreams.com>
 */
class LayoutView
{
    private $vars ;
    private $tplPaths ;
    private $cssPaths ;
    private $jsPaths ;

    public function addvar($name , $val){
        $this->vars[$name] = $val ;
    }

    public function addCss($cssPath){
        $this->cssPaths[] = $cssPath ;
    }

    /**
     * echos some html code
     */
    public function render(){
        if (is_array ($this->getVars ())) {
            foreach ($this->getVars () as $varName => $varValue) {
                $$varName = $varValue ;
                $this->$varName = $varValue ;
            }
        }
        if (is_array ($this->getTplPaths ())) {
            foreach ($this->getTplPaths () as $tplPath) {
                include $tplPath ;
            }
        }
    }

    /**
     * 
     * @param array $keys
     * @param NULL|integer $intIndex
     */
    public function getVars(array $keys = NULL , $intIndex = NULL){
        $returnValue = NULL ;
        if ( ! is_null ($keys)) {
            $returnValue = $this->vars ;
            foreach ($keys as $key) {
                if (isset ($returnValue[$key])) {
                    $returnValue = $returnValue[$key] ;
                }
                else {
                    $returnValue = NULL ;
                    break;
                }
            }
        }
        else {
            $returnValue = $this->vars ;
        }
        if (is_array ($returnValue)) {
            if ( ! is_null ($intIndex)) {
                $counter = 0 ;
                foreach ($returnValue as $value) {
                    if ($counter === $intIndex) {
                        $returnValue = $value ;
                        break ;
                    }
                    $counter ++ ;
                }
            }
        }

        return $returnValue ;
    }

    function addTplPath($path){
        $this->tplPaths[] = $path ;
    }

    function getTplPaths(){
        return $this->tplPaths ;
    }
}