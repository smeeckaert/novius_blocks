<div class="row <?= $name ?>">
    <?php

    $rowSize = 12;
    foreach ($row as $colname => $col) {
        $colSize = \Arr::get($col, 'width', $rowSize);
        $rowSize -= $colSize;
        if ($rowSize <= 0) {
            $rowSize = 12;
        }
        ?>
        <div class="col c<?= $colSize ?>">
            <?php
            if (!isset($col['fields'])) {
                echo \View::forge("novius_blocks::admin/block/preview/row", array('row' => $col, 'name' => $colname, 'item' => $item), false);

            } else {
                ?>
                <div class="content">
                    Fields

                </div>
            <?php
            }
            ?>
        </div>

    <?php
    }
    ?>
</div>