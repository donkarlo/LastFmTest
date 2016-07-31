<?php

/**
 * Description of ArtistTest
 *
 * @author donkarlo
 */

class ArtistTest extends PHPUnit_Framework_TestCase {
    public function setUp() {
    }

    public function tearDown() {
        
    }
    
    public function testGetTopTracks(){
        $tracks = \Modules\Lastfm\Models\Artist::getTopTracks('madonna');
        $this->assertInternalType('array',$tracks);
        $tracksCount = count($tracks);
        $this->assertLessThan($tracksCount,1);
    }

}
