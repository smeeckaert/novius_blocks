<?php
/**
 * Novius Blocks
 *
 * @copyright  2014 Novius
 * @license    GNU Affero General Public License v3 or (at your option) any later version
 *             http://www.gnu.org/licenses/agpl-3.0.html
 * @link       http://www.novius-os.org
 */

namespace Novius\Blocks;

use Fuel\Core\Input;

/**
 * Class Controller_Admin_Block_Crud
 *
 * @property Model_Block item
 * @package Novius\Blocks
 */
class Controller_Admin_Block_Crud extends \Nos\Controller_Admin_Crud
{
    /** @var $block_template used to store the block template for a new block */
    protected $block_template = null;

    protected function init_item()
    {
        parent::init_item();

        // We retrieve the get values
        $title        = \Input::get('title', null);
        $absolute_url = \Input::get('absolute_url', null);
        $summary      = \Input::get('summary', null);
        $thumbnail    = \Input::get('thumbnail', null);

        // And we set them to the item if they're not empty
        if (!empty($title)) {
            $this->item->block_title = $title;
        }
        if (!empty($summary)) {
            $this->item->wysiwygs->description = nl2br($summary);
        }
        if (!empty($thumbnail)) {
            $this->item->{'medias->image->medil_media_id'} = $thumbnail;
        }
        if (!empty($absolute_url)) {
            $this->item->block_link = str_replace(\Uri::base(), '', $absolute_url);
        }
    }

    /**
     * Return the config for setting the url of the novius-os tab
     *
     * @return Array
     */
    protected function get_tab_params()
    {
        $tabInfos = parent::get_tab_params();

        if ($this->is_new) {
            $params = array();
            foreach (array('title', 'summary', 'thumbnail', 'absolute_url') as $key) {
                $value = \Input::get($key, false);
                if ($value !== false) {
                    $params[$key] = $value;
                }
            }
            if (count($params)) {
                $tabInfos['url'] = $tabInfos['url'] . '&' . http_build_query($params);
            }
        }
        return $tabInfos;
    }

    protected function addStylesheets()
    {
        $stylesheets = \Arr::get($this->config, 'css');
        if (!empty($stylesheets)) {
            foreach ($stylesheets as $stylesheet) {
                $main_controller = \Nos\Nos::main_controller();
                if ($main_controller && method_exists($main_controller, 'addCss')) {
                    \Nos\Nos::main_controller()->addCss($stylesheet);
                } else {
                    ?>
                    <link rel="stylesheet" href="<?= $stylesheet ?>"/>
                <?php
                }
            }
        }
    }

    public function action_insert_update($id = null, $block_template = null)
    {
        if (!is_numeric($id)) {
            $block_template = $id;
            $id             = null;
        }
        // The url is changed in JS afterwards, so we need to intercept the block template at this point
        if (!empty($block_template)) {
            $item                 = $this->crud_item($id);
            $item->block_template = $block_template;
            $this->block_template = $block_template;
        }
        return parent::action_insert_update($id);
    }


    /**
     * @param null $id
     *
     * @return \Fuel\Core\View|\Nos\View
     */
    public function action_form($id = null)
    {
        $context                                              = Input::get('context', !empty($this->item) ? $this->item->block_context : null);
        $this->config['fields']['columns']['form']['options'] = \Arr::assoc_to_keyval(\Novius\Blocks\Model_Column::find('all', array('where' => array('blco_context' => $context))), 'blco_id', 'blco_title');
        $this->item                                           = $this->crud_item($id);
        $this->is_new                                         = $this->item->is_new();
        if ($this->is_new) {
            $this->init_item();
            if (!empty($this->block_template)) {
                $this->item->block_template = $this->block_template;
            }
        }

        $this->clone                                          = clone $this->item;
        //d($this->item);


        $this->checkPermission($this->is_new ? 'add' : 'edit');


        $blockConfig = $this->item->getConfig();
        $toMerge     = array('layout' => "layout.0.params", 'fields' => 'fields');
        //d($this->config['layout']);
        foreach ($toMerge as $source => $destination) {
            \Arr::set($this->config, $destination,
                \Arr::merge(
                    \Arr::get($this->config, $destination, array()),
                    \Arr::get($blockConfig, "crud.$source", array())
                )
            );
        }

        $this->config['layout_insert'] = $this->config['layout'];
        $this->config['layout_update'] = $this->config['layout'];
        // dd($this->config);

        // dd($this->config['layout']);

        $fields   = $this->fields($this->config['fields']);
        $fieldset = \Fieldset::build_from_config($fields, $this->item, $this->build_from_config());
        $fieldset = $this->fieldset($fieldset);

        $view_params             = $this->view_params();
        $view_params['fieldset'] = $fieldset;

        // We can't do this form inside the view_params() method, because additional vars (added
        // after the reference was created) won't be available from the reference
        $view_params['view_params'] = & $view_params;

        $this->addStylesheets();
        return \View::forge($this->config['views'][$this->is_new ? 'insert' : 'update'], $view_params, false);
    }

    /**
     * Get the compatible models we search with some text
     *
     * @param string $model_key
     */
    public function action_autocomplete_model($config_key = 'no')
    {
        // We load the config of the compatible models
        $models = \Config::load('novius_blocks::connection_model', true);
        $filter = \Fuel\Core\Input::post('search', '');

        // We assure that the model is compatible with the block
        if (!isset($models[$config_key])) {
            return \Response::json(array());
        }

        $model_config = $models[$config_key];
        $model        = $model_config['model'];

        $table = $model::table();

        $show = \Fuel\Core\DB::select(
            array($model_config['autocomplete_value'], 'value'),
            array($model_config['autocomplete_label'], 'label')
        )->from($table);

        // We search the results
        if (strlen($filter) > 0
            && isset($model_config['search_autocomplete_fields'])
            && is_array($model_config['search_autocomplete_fields'])
            && count($model_config['search_autocomplete_fields'])
        ) {
            $show->where_open();
            foreach ($model_config['search_autocomplete_fields'] as $field) {
                $show->or_where($field, 'LIKE', '%' . $filter . '%');
            }
            $show->where_close();
        }

        if (isset($model_config['autocomplete_callback']) && is_callable($model_config['autocomplete_callback'])) {
            $show = $model_config['autocomplete_callback']($show);
        }

        $show = (array)$show->distinct(true)->execute()->as_array();

        return \Response::json($show);
    }

    /**
     * @param $config_key
     * @param $model_id
     * @param $wrapper_dialog
     *
     * @return bool|\Fuel\Core\View
     */
    public function action_retrieve_model($config_key, $model_id, $wrapper_dialog)
    {
        $models = \Config::load('novius_blocks::connection_model', true);
        if (!isset($models[$config_key])) {
            return false;
        }
        $model_config = $models[$config_key];
        $class_name   = $model_config['model'];
        if (!$item = $class_name::find($model_id)) {
            return false;
        }

        return \View::forge('novius_blocks::admin/block/retrieve_model', array(
            'item'           => $item,
            'config'         => $model_config,
            'wrapper_dialog' => $wrapper_dialog,
            'item_id'        => $model_id,
        ), false);
    }

    /**
     * @param $config_key
     * @param $model_id
     *
     * @return bool|\Fuel\Core\View
     */
    public function action_get_model_assoc_infos()
    {
        $config_key = \Input::get('key', false);
        $model_id   = \Input::get('id', false);
        if (empty($config_key) || empty($model_id)) {
            exit();
        }
        $models = \Config::load('novius_blocks::connection_model', true);
        if (!isset($models[$config_key])) {
            exit();
        }
        $model_config = $models[$config_key];
        $class_name   = $model_config['model'];
        if (!$item = $class_name::find($model_id)) {
            exit();
        }

        $return = \View::forge('novius_blocks::admin/block/model_assoc_infos', array(
            'item'    => $item,
            'config'  => $model_config,
            'item_id' => $model_id,
        ), false);
        \Response::forge($return)->send(true);
        exit();
    }
}
