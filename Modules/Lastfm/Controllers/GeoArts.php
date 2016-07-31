<?php

use Modules\Lastfm\Models\Callers\CallerFactory ;
use Modules\Lastfm\Models\Artist ;
use Modules\Lastfm\Models\Geo ;

/**
 * This controller is responsiable for showing the list of top artists geographically as well as their top tracks.
 */
class GeoArts
{

    /**
     * This action is responsiable for requesting top artists of a given country.
     * @param array $args args[0] is a country name
     * @return \Sol\Mvc\Views\SimpleLayout
     */
    public function Navlist($args){
        //to service this action with wordy tasks
        $navlistServicer = new \Modules\Lastfm\Services\GeoArtsNavigation ($args , $_REQUEST) ;

        //Creating the navlist view. A layout view is a view which is placed inside a view
        $navlistView = new \Sol\Mvc\Views\LayoutView() ;
        $navlistView->addTplPath (SITE_PATH . "Modules/Lastfm/Views/Navlist.tpl") ;


        //pageNum is to be used as parameter for the  getTopArtists remote function
        $pageNum = intval ($navlistServicer->getStartRecord () / $navlistServicer->getLimit ()) + 1 ;

        //Making the caller ready
        $caller = CallerFactory::getDefaultCaller () ;
        $caller->setApiKey ('d020e5a9acd044a08bfab7f0fcf9bf4c') ;

        //getting the top artists by country and the given parameters
        $topArtists = Geo::getTopArtists ($navlistServicer->getCountry () , $navlistServicer->getLimit () , $pageNum) ;

        //passing the top artists to the view
        $navlistView->addvar ("topArtists" , $topArtists) ;

        //Passing the country name to the view
        $navlistView->addvar ("country" , $navlistServicer->getCountry ()) ;



        //Defining layout and adding it the nessacary views to it so it can render them by order
        $layout = new \Sol\Mvc\Views\SimpleLayout() ;
        $layout->addView ($navlistView) ;
        $layout->addView ($navlistServicer->getPaginationView ()) ;

        //returning layout object as the response to the caller
        return $layout ;
    }

    /**
     * This action is responsiable for showing the top tracks of an artist by a given artist name.
     * @todo also needs a sevicer
     * @param type $args
     * @return \Sol\Mvc\Views\SimpleLayout
     */
    public function ArtistTopTracks($args){
        //Creating the artist top tracks view
        $artistsTracksView = new \Sol\Mvc\Views\LayoutView() ;
        $artistsTracksView->addTplPath (SITE_PATH . "Modules/Lastfm/Views/TopTracks.tpl") ;

        //The artist name
        $artistName = $args[0] ;
        if ( ! empty ($artistName) && ! ctype_alpha (str_replace (' ' , '' , $artistName))) {
            die ("Goodbye") ;
        }
        $artistsTracksView->addvar ("artistName" , $artistName) ;
        //Making the caller ready
        $caller = CallerFactory::getDefaultCaller () ;
        $caller->setApiKey ('d020e5a9acd044a08bfab7f0fcf9bf4c') ;

        //getting the top artists by country and the given parameters
        $tracks = Artist::getTopTracks ($artistName) ;

        //adding the retrieved tracks to the view
        $artistsTracksView->addvar ("tracks" , $tracks) ;

        //to return back
        if (isset ($args[1])) {//if it comes from the url
            $country = urldecode ($args[1]) ;
        }
        $artistsTracksView->addvar ("country" , $country) ;

        //defining the layout and adding 
        $layout = new \Sol\Mvc\Views\SimpleLayout() ;
        $layout->addView ($artistsTracksView) ;

        //returning layout object as the response to the caller
        return $layout ;
    }
}