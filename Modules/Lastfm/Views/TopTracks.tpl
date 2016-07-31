<h1>Tracks of this artist:</h1>
<?php if (!empty($this->tracks)): ?>
    <table>
        <thead>
            <tr><th colspan="1">To Tracks of this artist</th></tr>
            <tr><th>Name</th></tr>
        </thead>
        <?php foreach ($this->tracks as $track): ?>
            <tr><td><?php $track->getName(); ?></td></tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>