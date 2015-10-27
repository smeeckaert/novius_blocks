/**
 * Novius Blocks
 *
 * @copyright  2014 Novius
 * @license    GNU Affero General Public License v3 or (at your option) any later version
 *             http://www.gnu.org/licenses/agpl-3.0.html
 * @link http://www.novius-os.org
 */

define(
    [
        'jquery-nos-wysiwyg',
        'jquery-nos',
        'tinymce'
    ],
    function ($) {
        "use strict";
        return function (uniqid) {
            var $container = $(this);
            // The radio which allows to select the template

            // Resize the content of the expander when expandaned
            $container.find('.block_over_wrapper').parents('.expander').find('.ui-expander-content').nosOnShow('bind', function () {
                equalizeAll();
            });

            // We make the templates clickables
            $container.find('.block_over_wrapper').each(function (e) {
                var $wrapper = $(this);
                var $checkbox = $(this).find('input[name="block_template"]');
                if ($checkbox.is(':checked')) {
                    $wrapper.addClass('on');
                }


                var $preview = $wrapper.find('.block_preview');
                if ($preview.length) {
                    equalizeBlock($preview);
                }

                $wrapper.css('cursor', 'pointer').click(function (ev) {
                    var $this = $(this);
                    var $this_checkbox = $this.find('input[name="block_template"]');
                    if (!$this_checkbox.is(':checked')) {
                        var $block_over_wrapper = $container.find('.block_over_wrapper');
                        $block_over_wrapper.removeClass('on');
                        $this_checkbox.prop('checked', true);
                        $wrapper.addClass('on');
                        setTemplate($container, $checkbox);
                    }
                    ev.preventDefault();
                });
            });

            // Equalize the templates when images are loaded
            $container.find('img').on('load', function () {
                equalizeAll();
            });

            // Equalize each block and then the templates containers
            function equalizeAll() {
                $container.find('.block_over_wrapper').each(function (e) {
                    equalizeBlock($(this).find('.block_preview'));
                });
                equalizeTemplates();
            }


            // Equalize every template container to match the same height
            function equalizeTemplates() {
                var max_height = 0;
                $container.find('.block_over_wrapper').css('min-height', '');
                $container.find('.block_over_wrapper').each(function () {
                    if ($(this).height() > max_height) {
                        max_height = $(this).height();
                    }
                });
                $container.find('.block_over_wrapper').css('min-height', max_height);
            }

            equalizeTemplates();

            // Equalize each part of a block
            function equalizeBlock($block) {
                var paddingBlock = parseInt($block.find('.content').css('padding'));
                $block.find('.col,.content').css('height', '');
                $block.find('.col:not(.c12)').each(function () {
                    var $col = $(this);
                    var $siblings = $col.siblings('.col');
                    var heights = [$col.height()];
                    if ($siblings.length) {
                        $siblings.each(function () {
                            heights.push($(this).height());
                        });
                    }
                    var height = Math.max.apply(null, heights);
                    $col.css('height', height + 'px');
                    $col.children('.content').css('height', (height - 2 * paddingBlock) + 'px');
                });
            }

            function getURLParameter(name) {
                return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search) || [, ""])[1].replace(/\+/g, '%20')) || null
            }

            // Change the block type by reloading the current tab
            function setTemplate($container, $selected) {
                var tplName = $selected.val();
                var tabUrl = getURLParameter('tab');

                var paramsPos = tabUrl.indexOf('?');
                var params = null;
                if (paramsPos >= 0) {
                    params = tabUrl.substr(paramsPos + 1);
                    tabUrl = tabUrl.substr(0, paramsPos);
                }
                tabUrl += '/' + tplName;
                if (params) {
                    tabUrl += '?' + params;
                }

                $container.nosTabs('update', {
                    url   : tabUrl,
                    reload: true
                });
            }
        }
    }
);