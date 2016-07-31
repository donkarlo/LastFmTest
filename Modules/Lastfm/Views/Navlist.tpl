<div class="row">
    <div class="col-sm-12">
        <form method="get" action="<?php echo URL . "Lastfm/GeoArts/Navlist/" ; ?>">
            <div class="form-group">
                <b>Please Select a country:</b>
                <select class="select form-control" name="country">
                    <option <?php if ($this->country == 'france') echo "SELECTED" ; ?> value="france">France</option>
                    <option <?php if ($this->country == 'spain') echo "SELECTED" ; ?>  value="spain">Spain</option>
                    <option <?php if ($this->country == 'germany') echo "SELECTED" ; ?>  value="germany">Germany</option>
                    <option <?php if ($this->country == 'denmark') echo "SELECTED" ; ?>  value="denmark">Denmark</option>
                    <option <?php if ($this->country == 'poland') echo "SELECTED" ; ?>  value="poland">Poland</option>
                </select>
            </div>
            <div class="form-group">
                <input class="btn btn-info btn-group-lg" type="submit" name="submit" value="submit"/>
            </div>

        </form>
    </div>
</div>
<div class="row">
    <?php if ( ! empty ($this->topArtists)): ?>
        <div class="col-sm-12">
            <table class="table">
                <thead>
                    <tr><th colspan="2">Artists  from <?php echo strtoupper ($this->country) ; ?></th></tr>
                    <tr><th>Name</th><th>Thumb</th></tr>
                </thead>
                <?php foreach ($this->topArtists as $topArtist): ?>
                    <tr>
                        <td><?php echo $topArtist->getName () ; ?></td>
                        <td>
                            <a href="<?php echo URL . "Lastfm/GeoArts/ArtistTopTracks/{$topArtist->getName ()}/{$this->country}" ; ?>">
                                <img src="<?php echo $topArtist->getImage () ; ?>" />
                            </a>
                        </td>
                    </tr>
                <?php endforeach ; ?>
            </table>
        </div>
    </div>
    <?php




 endif;
