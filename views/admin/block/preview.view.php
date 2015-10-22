<?php

if (empty($template)) {
    return '';
}
?>

<div class="block_preview">
    <?php
    foreach ($template as $rowname => $row) {
        echo \View::forge("novius_blocks::admin/block/preview/row", array('row' => $row, 'name' => $rowname, 'item' => $item), false);
    }
    ?>
</div>