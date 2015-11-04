<?php

$config = Config::load('novius_blocks::display', true);
$type   = \Arr::get($config, 'type', 'foundation');
echo \View::forge("novius_blocks::front/display/grid-$type", compact('blocks', 'enhancer_args', 'display'), false);