<?php
namespace Modules\Lastfm\Models;
use Modules\Lastfm\Models\Media;
use Modules\Lastfm\Models\Util;
class Track extends Media {

    /** The artist of this track.
     *
     * @var mixed
     * @access	private
     */
    private $artist;
    /** The tracks id.
     *
     * @var integer
     * @access	private
     */
    private $id;

    /** Create an album object.
     *
     * @param mixed		$artist		An artist object or string
     * @param string	$name		Name of this track.
     * @param integer	$id			ID of this track.
     *
     * @access	public
     */
    public function __construct($artist, $name,$id) {
        parent::__construct($name,array());
        $this->artist = $artist;
        $this->id = $id;
    }

    /** Returns the artist of this track.
     *
     * @return	mixed	An {@link de.felixbruns.lastfm.Artist Artist} object or the artists name.
     * @access	public
     */
    public function getArtist() {
        return $this->artist;
    }

    /** Returns the ID of this track.
     *
     * @return	integer	The ID of this track.
     * @access	public
     */
    public function getId() {
        return $this->id;
    }

    /** Create a Track object from a SimpleXMLElement.
     *
     * @param	SimpleXMLElement	$xml	A SimpleXMLElement.
     * @return	Track						A Track object.
     *
     * @static
     * @access	public
     * @internal
     */
    public static function fromSimpleXMLElement(SimpleXMLElement $xml) {
        $images = array();
        if (count($xml->image) > 1) {
            foreach ($xml->image as $image) {
                $images[Util::toImageType($image['size'])] = Util::toString($image);
            }
        } else {
            $images[Media::IMAGE_UNKNOWN] = Util::toString($xml->image);
        }
        if ($xml->artist) {
            if ($xml->artist->name) {
                $artist = new Artist(Util::toString($xml->artist->name),array());
            } else {
                $artist = Util::toString($xml->artist);
            }
        } else if ($xml->creator) {
            $artist = Util::toString($xml->creator);
        } else {
            $artist = '';
        }
        if ($xml->name) {
            $name = Util::toString($xml->name);
        } else if ($xml->title) {
            $name = Util::toString($xml->title);
        } else {
            $name = '';
        }
        return new Track($artist, $name, Util::toInteger($xml->id));
    }

}