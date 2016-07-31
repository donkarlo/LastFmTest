<?php

namespace Modules\Pagination\Views;

class Pagination extends \Sol\Mvc\Views\LayoutView{

    private $selected_thumb_num;
    private $n_rows; //number of rows
    private $n_thumb; //number of thumbs
    public $n_rows_per_thumb; //contains request url = controller.action
    private $url;
    private $selected_color = "white";
    private $bg_color = "#add8e6";
    private $border_style = "1px solid #77949d";
    private $ends_length = 3;

    function __construct($url, $n_heart_thumbs = 5, $n_rows_per_thumb = 3, $starting_row_num, $n_rows) {
        $this->n_rows = $n_rows;
        $this->n_heart_thumbs = $n_heart_thumbs;
        $this->n_rows_per_thumb = $n_rows_per_thumb;
        $this->url = $url;
        $this->starting_row_num = $starting_row_num;
        $this->selected_thumb_num = intval($this->starting_row_num / $this->n_rows_per_thumb) + 1;
        $this->addCss(URL."Modules/Pagination/Assets/Pagination.css");
        $this->addTplPath(SITE_PATH."Modules/Pagination/Views/pagination.tpl");
    }

}
