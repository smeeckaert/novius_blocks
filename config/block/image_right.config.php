<?php

return array(
    'title'    => 'Image right',
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
                                    'medias->image2->medil_media_id',
                                    'subtitle',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
        'fields' => array(
            'medias->image->medil_media_id'  => array(
                'label'    => '',
                'renderer' => 'Nos\Renderer_Media',
                'form'     => array(
                    'title' => __('Image'),
                ),
            ),
            'medias->image2->medil_media_id' => array(
                'label'    => '',
                'renderer' => 'Nos\Renderer_Media',
                'form'     => array(
                    'title' => __('Image'),
                ),
            ),
            'subtitle'                       => array(
                'label' => __('Subtitle'),
            ),
        ),
    ),
    'template' => array(
        'main_row' => array(
            'col_left'  => array(
                'width'  => 6,
                'fields' => array(
                    'title',
                    'medias->image',
                ),
            ),
            'col_right' => array(
                'fields' => array(
                    'subtitle',
                    'medias->image2',
                ),
            ),
        ),
    ),
);