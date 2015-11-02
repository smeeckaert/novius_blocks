<?php
return array(
    'name'       => 'Custom Block App',
    'version'    => '1.0',
    'provider'   => array(
        'name' => 'Novius',
    ),
    'namespace'  => "Custom\Blocks",
    'permission' => array(),
    'extends'    => array('novius_blocks'),
    'icons'      => array(
        64 => 'static/apps/novius_blocks/img/64-blocks.png',
        32 => 'static/apps/novius_blocks/img/32-blocks.png',
        16 => 'static/apps/novius_blocks/img/16-blocks.png',
    ),
    'launchers'  => array(),
    'enhancers'  => array(),

);
