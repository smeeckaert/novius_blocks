<?php

$config = \Config::load('novius_blocks::controller/front/block', true);
$type = \Arr::get($config, 'type', 'foundation');

if (empty($template)) {
    return '';
}
?>

<div class="<?= $item->block_template ?>">
    <?php
    foreach ($template as $rowname => $row) {
        echo \View::forge("novius_blocks::front/block/type/$type/row", array('row' => $row, 'name' => $rowname, 'type' => $type, 'item' => $item), false);
    }
    ?>
</div>
