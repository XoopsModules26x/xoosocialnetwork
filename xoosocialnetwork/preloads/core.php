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
 * @version         $Id$
 */

defined('XOOPS_ROOT_PATH') or die('Restricted access');

class XooSocialNetworkCorePreload extends XoopsPreloadItem
{    static public function eventCoreHeaderAddmeta($args)
    {        $xoops = Xoops::getInstance();
        $sn_module = Xoosocialnetwork::getInstance();
        if ( isset($xoops->module) && is_object($xoops->module) && basename( $xoops->getEnv('PHP_SELF') ) != 'index.php') {            if (XooSocialNetworkCorePreload::isActive()) {                if ( $xoops->getEnv('QUERY_STRING') ) {                    $url = XOOPS_URL . $xoops->getEnv('PHP_SELF') . '?' . urlencode($xoops->getEnv('QUERY_STRING'));                } else {                    $url = XOOPS_URL . $xoops->getEnv('PHP_SELF');
                }

                $sn_handler = $sn_module->getHandler('xoosocialnetwork_sn');
                foreach ( $sn_handler->loadConfig() as $k => $v ) {                    $sn[$k]['xoosocialnetwork_title']      = $v['xoosocialnetwork_title'];
                    $sn[$k]['xoosocialnetwork_image_link'] = $v['xoosocialnetwork_image_link'];                    $sn[$k]['xoosocialnetwork_url']        = $v['xoosocialnetwork_url'] . '?';
                    $sn[$k]['xoosocialnetwork_url']       .= $v['xoosocialnetwork_query_url'] . '=';
                    $sn[$k]['xoosocialnetwork_url']       .= $url;
                    if ( $v['xoosocialnetwork_query_title'] != '' ) {                        $sn[$k]['xoosocialnetwork_url']       .= '&amp;';
                        $sn[$k]['xoosocialnetwork_url']       .= $v['xoosocialnetwork_query_title'] . '=' ;
                        $sn[$k]['xoosocialnetwork_url']       .= rawurlencode( $xoops->tpl()->_tpl_vars['xoops_pagetitle'] ) ;
                    }
                }
                if ( count($sn)>0 ) {
                    $xoops->tpl()->assign('xoosocialnetwork', $sn );
                }
            }
        }
    }

    static function eventCoreIncludeCommonEnd($args)
    {
        $path = dirname(dirname(__FILE__));
        XoopsLoad::addMap(array(
            'xoosocialnetwork' => $path . '/class/xoosocialnetwork.php',
        ));
    }

    static private function isActive()
    {        $xoops = Xoops::getInstance();
        $module_handler = $xoops->getHandlerModule();
        $module = $module_handler->getByDirname('xoosocialnetwork');
        return ($module && $module->getVar('isactive')) ? true : false;
    }
}
?>