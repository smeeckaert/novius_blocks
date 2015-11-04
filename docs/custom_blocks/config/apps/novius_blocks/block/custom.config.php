<?php

return array(
    'title'    => 'Custom',
    'view'     => 'dev_blocks::image_left',
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
                                    'medias->image3->medil_media_id',
                                ),
                            ),
                        ),
                    ),
                ),
                'link'  => array(
                    'view'   => 'nos::form/expander',
                    'params' => array(
                        'title'    => __('Link'),
                        'nomargin' => false,
                        'options'  => array(
                            'allowExpand' => true,
                        ),
                        'content'  => array(
                            'view'   => 'nos::form/fields',
                            'params' => array(
                                'fields' => array(
                                    'block_link_title',
                                    'block_link_new_page',
                                    'block_link_search',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
        'fields' => array(
            'medias->image->medil_media_id'  => array(
                'label'    => __('Image Top'),
                'renderer' => 'Nos\Renderer_Media',
                'form'     => array(
                    'title' => __('Image'),
                ),
            ),
            'medias->image2->medil_media_id' => array(
                'label'    => __('Image bottom left'),
                'renderer' => 'Nos\Renderer_Media',
                'form'     => array(
                    'title' => __('Image'),
                ),
            ),
            'medias->image3->medil_media_id' => array(
                'label'    => __('Image bottom right'),
                'renderer' => 'Nos\Renderer_Media',
                'form'     => array(
                    'title' => __('Image'),
                ),
            ),
        ),
    ),
    'template' => array(
        'main_row' => array(
            'col_left'  => array(
                'width'  => 8,
                'fields' => array(
                    'block_title',
                ),
            ),
            'col_right' => array(
                'right_first_row'  => array(
                    'col_right' => array(
                        'fields' => array(
                            'medias->image',
                        ),
                    ),
                ),
                'right_second_row' => array(
                    'col_left'  => array(
                        'width'  => 4,
                        'fields' => array(
                            'medias->image2',
                        ),
                    ),
                    'col_right' => array(
                        'fields' => array(
                            'medias->image3',
                        ),
                    ),
                ),
            ),
        ),
    ),
);