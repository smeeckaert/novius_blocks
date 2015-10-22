<?php

return array(
    'title'    => 'Image right',
    'view'     => 'novius_blocks::templates/{name}',
    'crud'     => array(
        'layout' => array(),
        'fields' => array(),
    ),
    'template' => array(
        'main_row' => array(
            'col_left'  => array(
                'fields' => array(
                    'block_title',
                ),
            ),
            'col_right' => array(
                'fields' => array(
                    'block_title',
                ),
            ),
        ),
    ),
);