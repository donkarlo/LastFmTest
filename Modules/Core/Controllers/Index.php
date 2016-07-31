<?php

/**
 * Description of Index
 *
 * 
 */
class Index
{

    public function __construct(){
        ;
    }

    /**
     * Render the home page
     */
    public function Index(){
        $view = new \Sol\Mvc\Views\LayoutView() ;
        $view->addTplPath (SITE_PATH . "Modules/Core/Views/Index.tpl") ;

        $layout = new \Sol\Mvc\Views\SimpleLayout() ;
        $layout->addView ($view) ;
        $layout->render () ;
    }
}