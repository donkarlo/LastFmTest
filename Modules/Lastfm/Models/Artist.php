<?php

namespace Modules\Lastfm\Models;

use Modules\Lastfm\Models\Util;
use Modules\Lastfm\Models\Callers\CallerFactory;
use Modules\Lastfm\Models\Track;
use Modules\Lastfm\Models\Media;
/**
 * Responsiable for an artists affais like his top tracks ... and returning an artist domain object.
 * @todo fromSimpleXMLElement must be refactored from here to some sort of mapper class.
 */
class Artist extends Media {

    /** 
     * Create an Artist object.
     *
     * @param string	$name		Name of this artist.
     * @param array		$images		An array of cover art images of different sizes.
     *
     * @access	public
     */
    public function __construct($name, array $images) {
        parent::__construct($name, $images);
    }

    /** 
     * Get the top tracks by an artist on last.fm, ordered by popularity.
     * @link 
     * @param	string	$artistName	The artist name in question. (Required)
     * @return	array			An array of Track objects.
     * @see		Track
     *
     * @static
     * @access	public
     */
    public static function getTopTracks($artistName) {
        $xml = CallerFactory::getDefaultCaller()->call('artist.getTopTracks', array(
            'artist' => $artistName
        ));
        $tracks = array();
        foreach ($xml->children() as $track) {
            $tracks[] = Track::buildFromXml($track);
        }
        return $tracks;
    }

    /** 
     * Create an Artist object from a SimpleXMLElement object.
     *
     * @param	\SimpleXMLElement	$xml	A SimpleXMLElement object.
     * @return	Artist						An Artist object.
     *
     * @static
     * @access	public
     * @internal
     * @todo some exception handling in case of wrong results.
     * @todo find a better name for it.
     */
    public static function buildFromXml(\SimpleXMLElement $xml) {
        $images = array();
        if ($xml->image) {
            if (count($xml->image) > 1) {
                foreach ($xml->image as $image) {
                    $images[Util::toImageType($image['size'])] = Util::toString($image);
                }
            } else {
                $images[Media::IMAGE_LARGE] = Util::toString($image);
            }
        }
        if ($xml->image_small) {
            $images[Media::IMAGE_SMALL] = Util::toString($xml->image_small);
        }
        return new Artist(Util::toString($xml->name), $images);
    }
}
