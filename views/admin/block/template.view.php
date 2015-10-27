<?php
/**
 * Novius Blocks
 *
 * @copyright  2014 Novius
 * @license    GNU Affero General Public License v3 or (at your option) any later version
 *             http://www.gnu.org/licenses/agpl-3.0.html
 * @link       http://www.novius-os.org
 */

?>
<script type="text/javascript">
    require(['jquery-nos', 'static/apps/novius_blocks/js/admin/blocks.js?v=5.0.0.0'], function ($, callback_fn) {
        $(function () {
            callback_fn.call($('#<?= $fieldset->form()->get_attribute('id') ?>'), '<?= uniqid('_this_blocks_'); ?>');
        });
    });
</script>
<div class="blocks_wrapper">
    <?php

    $templates_config = \Config::load('novius_blocks::templates', true);
    foreach ($templates_config as $name) {
        if (!is_string($name)) {
            d("Bloc $name misconfigured");
            continue;
        }
        $config  = \Novius\Blocks\Model_Block::config($name);
        $preview = \Arr::get($config, 'preview', null);

        ?>
        <div class="block_over_wrapper">
            <? if (!empty($config['title'])) { ?>
                <h3 class="block_title"><?= $config['title'] ?></h3>
            <?
            }
            if (!empty($preview)) {
                echo \View::forge($preview, array('template' => \Arr::get($config, 'template', array()), 'item' => $item), false);
            }
            ?>
            <div class="block_select">
                <label for="template_<?= $name ?>">
                    <input class="notransform" type="radio"
                           name="block_template" id="template_<?= $name ?>"
                           value="<?= $name ?>"<?= $item->block_template == $name ? ' checked' : '' ?> />
                </label>
            </div>
        </div>
    <?php
    }
    ?>
</div>