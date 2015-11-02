<?php

if (!empty($item->block_model)) {
    ?>
    <a href="<?= $item->url() ?>">
<?php
}

echo \View::forge('novius_blocks::front/block/display', compact('item', 'template'), false);


if (!empty($item->block_model)) {
    ?>
    </a>
<?php
}
