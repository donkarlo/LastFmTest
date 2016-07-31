Please Select a country:
<form method="get" action="<?php echo URL . "Lastfm/GeoArts/Navlist/"; ?>">
    <select name="country">
        <option value="iran">Iran</option>
        <option value="france">France</option>
        <option value="japan">Japan</option>
    </select>
    <input type="submit" name="submit" value="submit"/>
</form>
<?php if (!empty($this->topArtists)): ?>
    <table>
        <thead>
            <tr><th colspan="3">Artists  from <?php $country ?></th></tr>
            <tr><th>Name</th><th>Thumb</th></tr>
        </thead>
        <?php foreach ($this->topArtists as $topArtist): ?>
            <tr>
                <td><?php $topArtist->getName(); ?></td>
                <td>
                    <a href="<?php echo URL . "Lastfm/GeoArts/ArtistTopTracks/{$topArtist->getName()}"; ?>"><?php $topArtist->getImage(); ?></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif;
