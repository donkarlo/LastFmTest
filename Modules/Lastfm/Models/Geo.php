<?php

namespace Modules\Lastfm\Models;

use Modules\Lastfm\Models\Callers\CallerFactory;
use Modules\Lastfm\Models\Artist;

class Geo {

    /** Get the most popular artists on last.fm by country.
     * @link http://www.last.fm/api/show/geo.getTopArtists
     * @param	string	country		Country name
     * @param int limit Number of the artists you want per page.
     * @param int page number
     * @return array An array of Artist objects.
     *
     * @static
     * @access	public
     */
    public static function getTopArtists($country, $limit, $pageNumber) {
        $xml = CallerFactory::getDefaultCaller()->call('geo.getTopArtists', array(
            'country' => $country
            , 'limit' => $limit
            , 'page' => $pageNumber
        ));
        $artists = array();
        foreach ($xml->children() as $artist) {
            $artists[] = Artist::fromSimpleXMLElement($artist);
        }
        return $artists;
    }

}
