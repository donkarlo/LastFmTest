<?php

namespace Sol\Mvc\Views ;

class SimpleLayout extends \Sol\Mvc\Views\Layout
{

    public function render(){
        $loggedUser = new \Modules\Auth\Models\LoggedUser();
        $user = $loggedUser->getUser();
        echo "<html>" ;
        echo "<head>" ;
        echo "<meta charset='UTF-8'/>" ;
        echo "<link rel='stylesheet' type='text/css' href='" . URL . "Layouts/Simple/Main.css" . "' />" ;
        if (is_array ($this->getCssPaths ())) {
            foreach ($this->getCssPaths () as $cssPath) {
                echo "<link rel='stylesheet' type='text/css' href='{$cssPath}' />" ;
            }
        }
        echo "<script type='text/javascript' src='" . URL . "Layouts/Simple/Main.js" . "' ></script>" ;
        if (is_array ($this->getJsPaths ())) {
            foreach ($this->getJsPaths () as $jsPath) {
                echo "<script type='text/javascript' src='{$jsPath}' ></script>" ;
            }
        }
        echo "</head>" ;
        echo "<body>" ;
        echo "Hello " . $user->getFName () . " " . $user->getLName () . "<br/>" ;
        echo "<div id='simpleHeader'>This is the header</div>" ;
        if (is_array ($this->getViews ())) {
            foreach ($this->getViews () as $view) {
                $view->render () ;
            }
        }
        echo "<div id='simpleFooter'>this is the footer</div>" ;
        echo "</body>" ;
        echo "</html>" ;
    }
}