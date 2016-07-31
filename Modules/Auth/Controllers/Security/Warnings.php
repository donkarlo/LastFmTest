<?php

/**
 * Description of Warnings
 *
 * @author Noondreams.com <web@noondreams.com>
 */
class Warnings
{

    public function showBasic(){
//        echo "Hey I am watching you. You are doing something insecure.";
        //Forms an html partion containing the html tag + head + body
        $layout = new \Sol\Mvc\Views\SimpleLayout() ;
        $layout->addJs (URL . "Modules/Auth/Assets/Js/Alert.js") ;
        $layout->addCss (URL . "Modules/Auth/Assets/Css/Warnings.css") ;

        //Forms something similar to Layout but as a legal child of body/html tag
        $layoutView = new \Sol\Mvc\Views\LayoutView() ;
        $layoutView->addTplPath (SITE_PATH . "Modules/Auth/Views/Security/Warnings/Simple.tpl") ;
        $layoutView->addVar ("name" , "Mohammad") ;

        $layout->addView ($layoutView) ;
        $layout->render () ;
    }
}