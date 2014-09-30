<?php

namespace Novius\Blocks;

class Display {

    /**
     * Return a decimal with a dot
     *
     * @param $number
     * @param int $precision
     * @return mixed
     */
    public static function decimalToPoint($number, $precision = 3) {
        return str_replace(',', '.', round($number, $precision));
    }

    /**
     * Return all the available displays (views + grid models)
     *
     * @return array
     */
    public static function available() {
        return array_filter(array(
            // Get configured displays
            'views' => \Config::load('novius_blocks::displays', true),
            // Get user created displays
            'model' => \Novius\Blocks\Model_Display::find('all'),
        ));
    }
}
