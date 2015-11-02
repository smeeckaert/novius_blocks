<div class="content">
    <?php

    if (!empty($fields)) {
        foreach ($fields as $field) {
            try {
                $value = $item->$field;
            } catch (Exception $e) {
                $value = "";
            }
            ?>
            <div class="item <?= \Inflector::friendly_title($field) ?>">
                <?php
                if (is_string($value)) {
                    echo $value;
                } else {
                    echo \View::forge("novius_blocks::common/content_class", array('value' => $value), false);
                }
                ?>
            </div>
        <?php
        }
    }
    ?>

</div>