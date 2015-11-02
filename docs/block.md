#Novius Blocks - Add a new block type

## General considerations

In order to add a new block, you can either extend the configuration in local/config or create an extension app.

You can find an example custom application in the [custom_blocks/](custom_blocks/) folder.

## Enabling blocks

This list of enabled blocks are located in templates.config.php. It's a one dimension array containing the names of
enabled blocks.

## Configuring a block

To configure a block you need to create a config file named block/BLOCK_NAME.config.php

### title

The displayed title of the block.

### view

(optionnal)

The view used to display the block in front office.

### preview

(optionnal)

The view used to display the block in back office.

### crud

This key can contain two elements _layout_ and _fields_ corresponding to the respective keys in a CRUD controller
configuration.

This is where you can add custom fields and expander.

Some fields are available, allowing you to create a single link to a model and are defined in the
file [controller/admin/block/crud.config.php](../config/controller/admin/block/crud.config.php).

Example of configuration
```php
<?php
return array(
'crud'     => array(
        'layout' => array(
            'content' => array(
                'image' => array(
                    'view'   => 'nos::form/expander',
                    'params' => array(
                        'title'    => __('Image'),
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
                'link'  => array(
                    'view'   => 'nos::form/expander',
                    'params' => array(
                        'title'    => __('Link'),
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
                'renderer' => 'Nos\Renderer_Media',
                'form'     => array(
                    'title' => __('Image'),
                ),
            ),
        ),
    ),
);
```

### template

The template will be used by the application to display the block in front or backoffice.

It represents the structure of a block and the fields contained in it.

It's a collection of rows, containing columns.

Each column can either contain a list of rows or a set of properties:

* width : The width of the column, other columns will complete the row if necessary.
* fields : The list of fields to display
* properties : A list of properties to add to the column element

#### Basic configuration

This is an example of a 2 rows x 1 column block
```php
return array(
    'template' => array(
        'main_row'   => array( // First row
            'col_left' => array( // First column
                'fields' => array( // List of column field
                    'block_title',
                ),
            ),
        ),
        'second_row' => array( // Second row
            'col_left' => array( // Second row first column
                'fields' => array(
                    'block_title',
                ),
            ),
        ),
    ),
);
```

This is an example of a 1 rows x 2 column block

```php
<?php
return array(
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
                    'medias->image2',
                ),
            ),
        ),
    ),
);
```