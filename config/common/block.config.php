<?php
/**
 * Novius Blocks
 *
 * @copyright  2014 Novius
 * @license    GNU Affero General Public License v3 or (at your option) any later version
 *             http://www.gnu.org/licenses/agpl-3.0.html
 * @link       http://www.novius-os.org
 */


return array(
    'controller'   => 'block/crud',
    'data_mapping' => array(
        'block_title'    => array(
            'title' => __('Title'),
        ),
        'block_template' => array(
            'title' => __('Type'),
            'value' => function ($item) {
                    $config = \Novius\Blocks\Model_Block::config($item->block_template);
                    return \Arr::get($config, 'title', '');
                },
        ),
    ),
    'actions'      => array(
        'add' => array(
            'label' => __('Add a block'),
        ),
    ),
);
