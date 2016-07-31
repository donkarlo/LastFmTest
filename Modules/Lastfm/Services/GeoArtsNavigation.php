<?php

namespace Modules\Lastfm\Services ;

/**
 * This class is to give service to GeoArts::Navlist action.
 *
 * 
 */
class GeoArtsNavigation
{
    private $args ;
    private $request ;
    private $country = NULL ;
    private $startRecord = 1 ;
    private $paginationView = NULL ;
    private $limit = 5 ;

    public function __construct($args , $request){
        $this->args = $args ;
        $this->request = $request ;
    }

    /**
     * to get the country. Lazy loader.
     * @return string
     */
    public function getCountry(){
        if (is_null ($this->country)) {
            //Setting the country
            $country = NULL ;
            if (isset ($this->request['country'])) {//if country comes from a form
                $country = urldecode ($this->request['country']) ;
            }
            elseif (isset ($this->args[0])) {//if it comes from the url
                $country = urldecode ($this->args[0]) ;
            }
            else {//the default would be the first one
                $country = "france" ;
            }
            //Someone is messing with us.
            if ( ! empty ($country) && ! ctype_alpha (str_replace (' ' , '' , $country))) {
                die ("Goodbye") ;
            }
            $this->country = $country ;
        }
        return $this->country ;
    }

    /**
     * the prepared pagination view.
     * @return \Sol\Mvc\Views\LayoutView
     */
    public function getPaginationView(){
        if (is_null ($this->paginationView)) {
            //preparing the url for the pagination view
            $paginationUrl = URL . "Lastfm/GeoArts/Navlist" ;
            if ( ! isEmpty ($this->getCountry ())) {//although it will be never empty since we have a default value
                $paginationUrl .= "/" . urlencode ($this->getCountry ()) ;
            }
            $paginationView = new \Modules\Pagination\Views\Pagination ($paginationUrl , 5/* heart */ , $this->limit , $this->getStartRecord () , 150) ;
            $this->paginationView = $paginationView ;
        }
        return $this->paginationView ;
    }

    public function getStartRecord(){
        //Set the start record.This will be used in pagination view. 
        if (isset ($this->args[1])) {
            $startRecord = intval ($this->args[1]) ;
        }
        else {
            $startRecord = 1 ;
        }

        $this->startRecord = $startRecord ;
        return $this->startRecord ;
    }

    /**
     * Limit per each page
     * @return int
     */
    public function getLimit(){
        return $this->limit ;
    }
}