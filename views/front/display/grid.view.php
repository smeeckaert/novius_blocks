<?php

if (empty($blocks)) {
    return false;
}

if (empty($display) || empty($display->blod_structure)) {
    return false;
}

// Get the grid settings
$config = \Config::load('display', true);
$grid_columns = \Arr::get($config, 'columns', 12);
$grid_size = \Arr::get($config, 'grid_builder_size', 70);

// Append some CSS to style the grid
if (NOS_ENTRY_POINT == \Nos\Nos::ENTRY_POINT_ADMIN) {
    ?>
    <style type="text/css">
        <?= file_get_contents('static/apps/novius_blocks/css/front/display/grid.css') ?>
    </style>
    <?php
} else {
    \Nos\Nos::main_controller()->addCss('static/apps/novius_blocks/css/front/display/grid.css');
}
?>
<div class="block-display block-display-grid" id="block-display-<?= $display->blod_id ?>">
    <?php foreach ($display->blod_structure as $columns) { ?>
    <div class="grid-row">
        <?php foreach ($columns as $column) {
            $col_width = \Arr::get($column, 'w', $grid_columns);
            ?>
            <div class="grid-col" style="width: <?= \Novius\Blocks\Display::decimalToPoint((100 / $grid_columns) * $col_width) ?>%;">
                <div class="grid-row">
                    <?php
                    $row_width = 0;
                    foreach (\Arr::get($column, 'blocks') as $block) {
                        $block_width = \Arr::get($block, 'w', $grid_columns);
                        $row_width += $block_width;
                        ?>
                        <div class="grid-block" style="width: <?= \Novius\Blocks\Display::decimalToPoint($block_width * (100 / $col_width)) ?>%;">
                            <?php if ($display->blod_mode == 'fixed') {
                                // Calculates the height/widht ratio in percent
                                $height_ratio = (\Arr::get($block, 'h', $grid_columns) / \Arr::get($block, 'w', 1)) * 100;
                                ?>
                                <div class="grid-block-square" style="padding-bottom: <?= \Novius\Blocks\Display::decimalToPoint($height_ratio) ?>%;">
                                    <div class="grid-block-square-layout">
                                        <?= \Novius\Blocks\Controller_Front_Block::display_block(array_shift($blocks)); ?>
                                    </div>
                                </div>
                                <?php
                            } else {
                                // Add a spacer if the block goes to a newline (to avoid "staircase" effects)
                                if ($row_width > $col_width) {
                                    ?>
                                    <div class="spacer"></div>
                                    <?php
                                    $row_width = 0;
                                }
                                echo \Novius\Blocks\Controller_Front_Block::display_block(array_shift($blocks));
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php } ?>
</div>
