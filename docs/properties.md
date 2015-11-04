#Novius Blocks - Add new block properties


## EAV

EAVs are enabled on the model block. If you have a simple field to create, you can simply declare it in you field
list and it will be properly saved.

Example of block configuration
```php
<?php
return array(
    'crud'     => array(
        'layout' => array(
            'content' => array(
                'image' => array(
                    'view'   => 'nos::form/expander',
                    'params' => array(
                        'content'  => array(
                            'view'   => 'nos::form/fields',
                            'params' => array(
                                'fields' => array(
                                    'subtitle',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
        'fields' => array(
            'subtitle'                       => array(
                'label' => __('Subtitle'),
            ),
        ),
    ),
);
```