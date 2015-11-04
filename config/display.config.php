<?php

return array(
    // Number of columns for the grid
    'columns'           => 12,

    // Force the blocks to be displayed as squares (proportional height) in front
    'force_grid_square' => false,

    // The view used to generate the frontend grid
    'view'              => 'novius_blocks::front/display/grid-config',
    // The view used to generate the backend grid
    'preview'           => 'novius_blocks::front/display/grid',

    // The front end framework used to display blocs and views
    'type'              => 'foundation',
);
