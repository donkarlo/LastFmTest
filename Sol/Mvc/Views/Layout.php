<?php

namespace Sol\Mvc\Views ;

/**
 * Description of Layout
 *
 * 
 */
class Layout
{
    private $views ;
    private $cssPaths ;
    private $jsPaths ;

    public function addCss($cssPath){
        $this->cssPaths[] = $cssPath ;
    }

    public function addJs($jsPath){
        $this->jsPaths[] = $jsPath ;
    }

    function getCssPaths(){
        if (is_array ($this->getViews ())) {
            foreach ($this->getViews () as $view)
                if (is_array ($view->getCssPaths ())) {
                    foreach ($view->getCssPaths () as $cssPath) {
                        $this->cssPaths[] = $cssPath ;
                    }
                }
        }
        return $this->cssPaths ;
    }

    function getJsPaths(){
        if (is_array ($this->getViews ())) {
            foreach ($this->getViews () as $view)
                if (is_array ($view->getJsPaths ())) {
                    foreach ($view->getJsPaths () as $jsPath) {
                        $this->jsPaths[] = $jsPath ;
                    }
                }
        }
        return $this->jsPaths ;
    }

    public function render(){
        echo "<!DOCTYPE html>";
        echo "<html>" ;
        echo "<head>" ;
        echo "</head>" ;
        echo "<body>" ;
        if (is_array ($this->getViews ())) {
            foreach ($this->getViews () as $view) {
                $view->render () ;
            }
        }
        echo "</body>" ;
        echo "</html>" ;
    }

    public function addView(LayoutView $view){
        $this->views[] = $view ;
    }

    function getViews(){
        return $this->views ;
    }
}