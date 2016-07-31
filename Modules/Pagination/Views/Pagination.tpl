<?php
//the heart legnth must be an odd number
if ($this->n_thumbs % 2 == 0)
    $this->n_thumbs += 1;

$thumb_num_heart_start = $this->selected_thumb_num - intval($this->n_heart_thumbs / 2);
$thumb_num_heart_end = $this->selected_thumb_num + intval($this->n_heart_thumbs / 2);


if ($thumb_num_heart_start <= 0)
    $thumb_num_heart_start = 1;

//The index of last shown num
if ($this->n_rows % $this->n_rows_per_thumb == 0)
    $this->thumb_num_end = $this->n_rows / $this->n_rows_per_thumb;
else
    $this->thumb_num_end = intval($this->n_rows / $this->n_rows_per_thumb) + 1;
?>
<ul class="pagination">

    <?php
    for ($thumb_num = 1; $thumb_num <= $this->ends_length; $thumb_num++) {
        if ($thumb_num < $thumb_num_heart_start) {
            ?>
            <li>
                <a href = "<?php echo $this->url . '/' . ($thumb_num - 1) * $this->n_rows_per_thumb ?>"> <?php echo $thumb_num; ?> </a>
            </li>
    <?php }//if  ?>
    <?php }//for  ?>


<?php if ($thumb_num < $thumb_num_heart_start) { ?>
        <li>...</li>
    <?php } ?>
    <!-- The Beating Heart -->
    <?php
    for ($thumb_num = $thumb_num_heart_start; $thumb_num <= $thumb_num_heart_end; $thumb_num++) {
        $num_rows_till_here_lower = ($thumb_num - 1) * ($this->n_rows_per_thumb);
        $num_rows_till_here = ($thumb_num) * ($this->n_rows_per_thumb);
        ?>
        <?php if (($this->n_rows >= $num_rows_till_here) || ($this->n_rows >= $num_rows_till_here_lower && $this->n_rows <= $num_rows_till_here && $this->n_rows % $this->n_rows_per_thumb != 0)) { ?>
            <li>
                <a style="<?php if ($thumb_num == $this->selected_thumb_num) echo 'background-color:' . $this->selected_color; ?> " href = "<?php echo $this->url . '/' . ($thumb_num - 1) * $this->n_rows_per_thumb; ?>"> <?php echo $thumb_num; ?> </a>
            </li>
        <?php $thumb_num_heart_ended = $thumb_num; ?>
    <?php }//if  ?>
    <?php }//for  ?>
    <!-- END of The Beating Heart -->
    <?php
    $thumb_num = $this->thumb_num_end - $this->ends_length + 1;
    ?>

    <?php if ($thumb_num_heart_ended < ($thumb_num - 1)) { ?>
        <li>...</li>
    <?php } ?>
    <?php
    for (; $thumb_num <= $this->thumb_num_end; $thumb_num++) {
        if ($thumb_num_heart_end < $thumb_num) {
            ?>
            <li>
                <a href = "<?php echo $this->url . '/' . ($thumb_num - 1) * $this->n_rows_per_thumb; ?>"> <?php echo $thumb_num; ?> </a>
            </li>
    <?php }//if  ?>
<?php }//for  ?>

</ul>
<p style="clear: both;"></p>