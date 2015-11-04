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
    'css'            => array('static/apps/novius_blocks/css/admin/block.css'),
    'controller_url' => 'admin/novius_blocks/block/crud',
    'model'          => 'Novius\Blocks\Model_Block',
    'block_type'     => array(
        'collapse_when_selected' => true,
    ),
    'layout'         => array(
        'large'   => true,
        'save'    => 'save',
        'title'   => 'block_title',
        'content' => array(
            'template' => array(
                'view'   => 'nos::form/expander',
                'params' => array(
                    'title'    => __('Block type'),
                    'nomargin' => true,
                    'options'  => array(
                        'allowExpand' => true,
                    ),
                    'content'  => array(
                        'view'   => 'novius_blocks::admin/block/template',
                        'params' => array(
                            'fields' => array(
                                'block_template',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'fields'         => array(
        'block_id'            => array(
            'label'     => 'ID: ',
            'form'      => array(
                'type' => 'hidden',
            ),
            'dont_save' => true,
        ),
        'block_title'         => array(
            'label'      => __('Title'),
            'form'       => array(
                'type' => 'text',
            ),
            'validation' => array('required'),
        ),

        'block_template'      => array(
            'label'      => '',
            'validation' => array(
                'required',
            ),
        ),
        'block_link_title'    => array(
            'label' => __('Text of the link'),
        ),
        'block_link_new_page' => array(
            'label' => __('Open in a new page'),
            'form'  => array(
                'type'  => 'checkbox',
                'value' => 1,
            ),
        ),
        'block_link_search'   => array(
            'label'            => __('Lien'),
            'renderer'         => 'Novius\Renderers\Renderer_ModelSearch',
            'dont_save'        => true,
            'renderer_options' => array(
                'names'    => array(
                    'id'       => 'block_model_id',
                    'model'    => 'block_model',
                    'external' => 'block_link',
                ),
                'external' => true,
            ),
            'populate'         => function ($item) {
                    return array(
                        'model'    => $item->block_model,
                        'id'       => $item->block_model_id,
                        'external' => $item->block_link,
                    );
                },
        ),
        'block_model_id'      => array(),
        'block_model'         => array(),
        'block_link'          => array(),
    )
);