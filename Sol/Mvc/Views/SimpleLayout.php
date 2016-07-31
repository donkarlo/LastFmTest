<?php

namespace Sol\Mvc\Views ;

/**
 * The simple layout has just a footer and a header. 
 * It is just to test things. Don't put your other layouts in here.
 */
class SimpleLayout extends \Sol\Mvc\Views\Layout
{

    public function render(){
        echo "<!DOCTYPE html>" ;
        echo "<html>" ;
        echo "<head>" ;
        echo "<meta charset='UTF-8'/>" ;
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>" ;
        echo "<link rel='stylesheet' type='text/css' href='" . URL . "Layouts/Simple/Main.css" . "' />" ;
        echo "<link rel='stylesheet' type='text/css' href='" . URL . "Libs/Bootstrap/css/bootstrap.min.css" . "' />" ;
        echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">';
        if (is_array ($this->getCssPaths ())) {
            foreach ($this->getCssPaths () as $cssPath) {
                echo "<link rel='stylesheet' type='text/css' href='{$cssPath}' />" ;
            }
        }
        echo "<script type='text/javascript' src='" . URL . "Layouts/Simple/Main.js" . "' ></script>" ;
        echo "<script type='text/javascript' src='" . URL . "Libs/Jquery/js/jquery-1.12.min.js" . "' ></script>" ;
        echo "<script type='text/javascript' src='" . URL . "Libs/Bootstrap/js/bootstrap.min.js" . "' ></script>" ;
        if (is_array ($this->getJsPaths ())) {
            foreach ($this->getJsPaths () as $jsPath) {
                echo "<script type='text/javascript' src='{$jsPath}' ></script>" ;
            }
        }
        echo "</head>" ;
        echo "<body>" ;
        echo "<div class='container-fluid'>" ;
        echo "<div id='simpleHeader'><h3>Music is my passion.</h3></div>" ;
        if (is_array ($this->getViews ())) {
            foreach ($this->getViews () as $view) {
                $view->render () ;
            }
        }
        echo "<div id='simpleFooter'>The footer from the simple layout</div>" ;
        echo "</div>" ;
        echo "</body>" ;
        echo "</html>" ;
    }
}