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

?>
<div class="block-display block-display-grid block-display-<?= $display->blod_id ?>">
    <?php foreach ($display->blod_structure as $columns) { ?>
        <div class="row">
            <?php foreach ($columns as $column) {
                $col_width = \Arr::get($column, 'w', $grid_columns);
                ?>
                <div class="large-<?= $col_width ?> columns">
                    <div class="row">
                        <?php
                        $row_width = 0;
                        foreach (\Arr::get($column, 'blocks') as $block) {
                            $block_width = \Arr::get($block, 'w', $grid_columns);
                            $row_width += $block_width;
                            ?>
                            <div class="block column"
                                 style="width: <?= \Novius\Blocks\Display::decimalToPoint($block_width * (100 / $col_width)) ?>%;">
                                <?php if ($display->blod_mode == 'fixed') {
                                    // Calculates the height/widht ratio in percent
                                    $height_ratio = (\Arr::get($block, 'h', $grid_columns) / \Arr::get($block, 'w', 1)) * 100;
                                    ?>
                                    <div class="grid-block-square"
                                         style="height: 0; padding-bottom: <?= \Novius\Blocks\Display::decimalToPoint($height_ratio) ?>%; width: 100%; position: relative; overflow: hidden;">
                                        <div class="grid-block-square-layout"
                                             style="width: 100%; height: 100%; position: absolute; left: 0;">
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
