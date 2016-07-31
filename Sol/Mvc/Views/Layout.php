<?php

namespace Sol\Mvc\Views ;

/**
 * Description of Layout
 *
 * @author Noondreams.com <web@noondreams.com>
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
        return $this->cssPaths ;
    }

    function getJsPaths(){
        return $this->jsPaths ;
    }

    public function render(){
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