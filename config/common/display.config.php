<?php
/**
 * Novius Blocks
 *
 * @copyright  2014 Novius
 * @license    GNU Affero General Public License v3 or (at your option) any later version
 *             http://www.gnu.org/licenses/agpl-3.0.html
 * @link       http://www.novius-os.org
 */

return array(
    'data_mapping' => array(
        'blod_title' => array(
            'title' => __('Displays'),
        ),
    ),
    'controller'   => 'display/crud',
    'actions'      => array(),
    'i18n'         => array(
        // Crud
        'notification item added'                  => __('Right, your new display is ready.'),
        'notification item deleted'                => __('The display has been deleted.'),

        // General errors
        'notification item does not exist anymore' => __('This display doesn’t exist any more. It has been deleted.'),
        'notification item not found'              => __('We cannot find this display.'),

        // Deletion popup
        'deleting item title'                      => __('Deleting the display ‘{{title}}’'),

        # Delete action's labels
        'deleting button N items'                  => n__(
            'Yes, delete this display',
            'Yes, delete these {{count}} displays'
        ),
    ),
    'actions'      => array(
        'add' => array(
            'label' => __('Add a display'),
        ),
    ),
);
