<?php

return array(
    'title'    => 'Image top',
    'crud'     => array(
        'layout' => array(
            'content' => array(
                'image' => array(
                    'view'   => 'nos::form/expander',
                    'params' => array(
                        'title'    => __('Image'),
                        'nomargin' => false,
                        'options'  => array(
                            'allowExpand' => true,
                            'fieldset'    => 'image',
                        ),
                        'content'  => array(
                            'view'   => 'nos::form/fields',
                            'params' => array(
                                'fields' => array(
                                    'medias->image->medil_media_id',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
        'fields' => array(
            'medias->image->medil_media_id' => array(
                'label'    => __('Image'),
                'renderer' => 'Nos\Renderer_Media',
                'form'     => array(
                    'title' => __('Image'),
                ),
            ),
        ),
    ),
    'template' => array(
        'main_row'   => array(
            'col_left' => array(
                'fields' => array(
                    'medias->image',
                ),
            ),
        ),
        'second_row' => array(
            'col_left' => array(
                'fields' => array(
                    'block_title',
                ),
            ),
        ),
    ),
);