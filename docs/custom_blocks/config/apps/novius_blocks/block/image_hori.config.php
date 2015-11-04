<?php

return array(
    'title'    => 'Two images',
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
                'label'    => __('Image left'),
                'renderer' => 'Nos\Renderer_Media',
                'form'     => array(
                    'title' => __('Image left'),
                ),
            ),
            'medias->image2->medil_media_id' => array(
                'label'    => __('Image right'),
                'renderer' => 'Nos\Renderer_Media',
                'form'     => array(
                    'title' => __('Image right'),
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
                'width'      => 6,
                'properties' => array('data-property' => 'value'),
                'fields'     => array(
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