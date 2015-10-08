<?php
/**
 * Xoosocialnetwork module
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         Xoosocialnetwork
 * @since           2.6.0
 * @author          Laurent JEN (Aka DuGris)
 * @version         $Id: core.php 1428 2013-01-15 01:10:52Z DuGris $
 */

use Xoops\Core\PreloadItem;

/**
 * Class XooSocialNetworkPreload
 */
class XooSocialNetworkPreload extends PreloadItem
{
    /**
     * @param $args
     */
    public static function eventCoreHeaderAddmeta($args)
    {
        $xoops    = Xoops::getInstance();
        $snModule = XooSocialNetwork::getInstance();
        if (null !== $xoops->module && is_object($xoops->module) && basename($xoops->getEnv('PHP_SELF')) != 'index.php') {
            if (XooSocialNetworkPreload::isActive()) {
                $url = $xoops->getEnv('HTTPS') ? 'https://' : 'http://';
                $url .= $xoops->getEnv('SERVER_NAME');
                if ($xoops->getEnv('QUERY_STRING')) {
                    $url .= $xoops->getEnv('PHP_SELF') . '?' . urlencode($xoops->getEnv('QUERY_STRING'));
                } else {
                    $url .= $xoops->getEnv('PHP_SELF');
                }

                $snHandler = $snModule->SNHandler();
                foreach ($snHandler->loadConfig() as $k => $v) {
                    $sn[$k]['xoosocialnetwork_title']      = $v['xoosocialnetwork_title'];
                    $sn[$k]['xoosocialnetwork_image_link'] = $v['xoosocialnetwork_image_link'];
                    $sn[$k]['xoosocialnetwork_url']        = $v['xoosocialnetwork_url'] . '?';
                    $sn[$k]['xoosocialnetwork_url'] .= $v['xoosocialnetwork_query_url'] . '=';
                    $sn[$k]['xoosocialnetwork_url'] .= $url;
                    if ($v['xoosocialnetwork_query_title'] != '') {
                        $sn[$k]['xoosocialnetwork_url'] .= '&amp;';
                        $sn[$k]['xoosocialnetwork_url'] .= $v['xoosocialnetwork_query_title'] . '=';
                        $sn[$k]['xoosocialnetwork_url'] .= rawurlencode($xoops->tpl()->_tpl_vars['xoops_pagetitle']);
                    }
                }
                if (count($sn) > 0) {
                    $xoops->tpl()->assign('xoosocialnetwork', $sn);
                }
            }
        }
    }

    /**
     * @param $args
     */
    public static function eventCoreIncludeCommonEnd($args)
    {
        $path = dirname(__DIR__);
        XoopsLoad::addMap(array(
                              'xoosocialnetwork' => $path . '/class/helper.php',));
    }

    /**
     * @return bool
     */
    private static function isActive()
    {
        $xoops          = Xoops::getInstance();
        $module_handler = $xoops->getHandlerModule();
        $module         = $module_handler->getByDirname('xoosocialnetwork');

        return ($module && $module->getVar('isactive')) ? true : false;
    }
}
