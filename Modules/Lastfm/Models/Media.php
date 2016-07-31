<?php

namespace Modules\Lastfm\Models;

/**
 * This class is the parent of Artist and Track in this project. 
 * 
 * Both Artist and Track have a property called name. so name is a part of their parent, Media.
 * name is just an example Artist and Track both share the the rest properties in the definition of this class.  
 */
class Media {

    /** Name of this medium.
     *
     * @var string
     * @access	private
     */
    private $name;

    /** Possible image sizes.
     *
     * @var integer
     * @access	public
     */
    const IMAGE_UNKNOWN = -1;
    const IMAGE_SMALL = 0;
    const IMAGE_MEDIUM = 1;
    const IMAGE_LARGE = 2;
    const IMAGE_HUGE = 3;
    const IMAGE_EXTRALARGE = 4;
    const IMAGE_ORIGINAL = 5;

    /** Create a media object.
     *
     * @param string $name Name for this medium.
     * @param array $images An array of images of different sizes.
     *
     * @access	public
     */
    public function __construct($name, array $images) {
        $this->name = $name;
        $this->images = $images;
    }

    /** Returns the name of this medium.
     *
     * @return	string	The mediums name.
     * @access	public
     */
    public function getName() {
        return $this->name;
    }

    /** Returns an image URL of the specified size of this medium.
     *
     * @param	integer	$size	Image size constant. (Optional)
     * @return	string			An image URL.
     * @access	public
     */
    public function getImage($size = null) {
        if ($size !== null and array_key_exists($size, $this->images)) {
            return $this->images[$size];
        } else if ($size === null) {
            for ($size = Media::IMAGE_ORIGINAL; $size > Media::IMAGE_UNKNOWN; $size--) {
                if (array_key_exists($size, $this->images)) {
                    return $this->images[$size];
                }
            }
        }
        return null;
    }

}
