
<h1>
    <a class="btn btn-info" href="<?php echo URL . "Lastfm/GeoArts/Navlist/{$this->country}" ?>">Back</a>
    Top tracks of <b><?php echo $this->artistName ; ?></b>
</h1>
<?php if ( ! empty ($this->tracks)): ?>
    <table class="table">
        <thead>
            <tr><th>Name</th></tr>
        </thead>
        <?php foreach ($this->tracks as $track): ?>
            <tr><td><?php echo $track->getName () ; ?></td></tr>
        <?php endforeach ; ?>
    </table>
<?php endif ; ?>