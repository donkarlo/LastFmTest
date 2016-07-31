<?php

/**
 * Description of GeoTest
 *
 * @author donkarlo
 */
class GeoTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        
    }

    public function tearDown() {
        
    }

    public function testGetTopArtists() {
        $topArtists = \Modules\Lastfm\Models\Geo::getTopArtists("france", 5, 1);
        $this->assertInternalType('array', $topArtists);
        $topArtistsCount = count($topArtists);
        $this->assertLessThan($topArtistsCount, 1);
    }

}
