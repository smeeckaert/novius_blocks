<div class="content">
    <?php

    if (!empty($fields)) {
        foreach ($fields as $field) {
            try {
                $value = $item->$field;
            } catch (Exception $e) {
                $value = "Can't access field $field";
            }
            ?>
            <div class="item <?= $field ?>">
                <?php
                if (is_string($value)) {
                    echo $value;
                } else {
                    echo \View::forge("novius_blocks::admin/block/preview/content_class", array('value' => $value), false);
                }
                ?>
            </div>
        <?php
        }
    }
    ?>

</div>