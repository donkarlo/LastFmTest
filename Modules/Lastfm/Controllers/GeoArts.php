<?php

use Modules\Lastfm\Models\Callers\CallerFactory;
use Modules\Lastfm\Models\Artist;
use Modules\Lastfm\Models\Geo;

class Controller_Lastfm {

    /**
     * 
     * @param array $args args[0] is a country name
     */
    public function Navlist($args) {
        $navlistView = new \Sol\Mvc\Views\LayoutView();
        $navlistView->addTplPath(SITE_PATH . "Modules/Lastfm/Views/Navlist.tpl");

        $country = urldecode($_REQUEST['country']);
        if (!empty($country && !ctype_alpha($country))) {
            die("Goodbye");
        }
        $startRecord = intval($args[0]);
        $limit = 5;
        $pageNum = intval($startRecord / $limit) + 1;
        $caller = CallerFactory::getDefaultCaller();
        $caller->setApiKey('d020e5a9acd044a08bfab7f0fcf9bf4c');
        $topArtists = Geo::getTopArtists($country, $limit, $pageNum);
        $navlistView->addvar("topArtists", $topArtists);

        require_once Reg::get('site_path') . 'plugins/pagination/pagination.php';
        $paginationUrl = URL . "Lastfm/GeoArts/Navlist";
        if (!emptyIs($country)) {
            $paginationUrl .= "?country=" . urlencode($country);
        }
        
        $paginationView = new \Modules\Pagination\Views\Pagination($paginationUrl, 2/* heart */, $limit, $startRecord, 100);
        

        $layout = new \Sol\Mvc\Views\SimpleLayout();
        $layout->addView($navlistView);
        $layout->addView($paginationView);
        
        return $layout;
    }

    /**
     * 
     * @param type $args
     */
    public function ArtistTopTracks($args) {
        $artistsTracksView = new \Sol\Mvc\Views\LayoutView();
        $artistsTracksView->addTplPath(SITE_PATH . "Modules/Lastfm/Views/TopTracks.tpl");

        $artistName = $args[0];
        if (!empty($artistName && !ctype_alpha($artistName))) {
            die("Goodbye");
        }
        $caller = CallerFactory::getDefaultCaller();
        $caller->setApiKey('d020e5a9acd044a08bfab7f0fcf9bf4c');
        $tracks = Artist::getTopTracks($artistName);
        $artistsTracksView->addvar("tracks", $tracks);
        $layout = new \Sol\Mvc\Views\SimpleLayout();
        $layout->addView($artistsTracksView);
        return $layout;
    }

}
