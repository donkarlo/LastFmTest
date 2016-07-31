<?php

namespace Modules\Pagination\Views ;
/**
 * To hnadle pagination. An old class I have written years ago. 
 * When I was wrting it, Only I and the god knew what I did. Now only god knows :(
 */
class Pagination extends \Sol\Mvc\Views\LayoutView
{
    protected $selected_thumb_num=1 ;
    protected $n_rows ; //number of rows
    protected $n_thumbs ; //number of thumbs
    protected $n_rows_per_thumb ; //contains request url = controller.action
    protected $url ;
    protected $selected_color = "white" ;
    protected $bg_color = "#add8e6" ;
    protected $border_style = "1px solid #77949d" ;
    protected $ends_length = 3 ;

    function __construct($url , $n_heart_thumbs = 5 , $n_rows_per_thumb = 3 , $starting_row_num , $n_rows){
        $this->n_rows = $n_rows ;
        $this->n_heart_thumbs = $n_heart_thumbs ;
        $this->n_rows_per_thumb = $n_rows_per_thumb ;
        $this->url = $url ;
        $this->starting_row_num = $starting_row_num ;
        $this->selected_thumb_num = intval ($this->starting_row_num / $this->n_rows_per_thumb) + 1 ;

        $this->addvar ("selected_thumb_num" , $this->selected_thumb_num) ;
        $this->addvar ("n_rows" , $this->n_rows) ;
        $this->addvar ("n_thumbs" , $this->n_thumbs) ;
        $this->addvar ("n_rows_per_thumb" , $this->n_rows_per_thumb) ;
        $this->addvar ("url" , $this->url) ;
        $this->addvar ("selected_color" , $this->selected_color) ;
        $this->addvar ("bg_color" , $this->bg_color) ;
        $this->addvar ("border_style" , $this->border_style) ;
        $this->addvar ("ends_length" , $this->ends_length) ;
        
        $this->addCss (URL . "Modules/Pagination/Assets/Pagination.css") ;
//        die(URL . "Modules/Pagination/Assets/Pagination.css");
        $this->addTplPath (SITE_PATH . "Modules/Pagination/Views/pagination.tpl") ;
    }
}