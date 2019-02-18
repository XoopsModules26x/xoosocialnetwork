<?php

namespace XoopsModules\Xoosocialnetwork;

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
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         Xoosocialnetwork
 * @since           2.6.0
 * @author          Laurent JEN (Aka DuGris)

 */
use Xoops\Core\Request;

/**
 * Class Socialnetwork
 */
class Socialnetwork extends \XoopsObject
{
    // constructor

    public function __construct()
    {
        $this->initVar('xoosocialnetwork_id', XOBJ_DTYPE_INT, 0, false, 11);
        $this->initVar('xoosocialnetwork_title', XOBJ_DTYPE_TXTBOX, '', true, 100);
        $this->initVar('xoosocialnetwork_url', XOBJ_DTYPE_TXTBOX, '', true, 100);
        $this->initVar('xoosocialnetwork_image', XOBJ_DTYPE_TXTBOX, 'blank.gif', true, 100);
        $this->initVar('xoosocialnetwork_query_url', XOBJ_DTYPE_TXTBOX, '', true, 20);
        $this->initVar('xoosocialnetwork_query_title', XOBJ_DTYPE_TXTBOX, '', true, 20);
        $this->initVar('xoosocialnetwork_display', XOBJ_DTYPE_INT, 1, true, 1);
        $this->initVar('xoosocialnetwork_order', XOBJ_DTYPE_INT, 1, true, 3);

        // Pour autoriser le html
        //        $this->initVar('dohtml', XOBJ_DTYPE_INT, 1, false);
    }

    /**
     * @return bool
     */
    public function setView()
    {
        $this->setVar('xoosocialnetwork_display', 1);

        return true;
    }

    /**
     * @return bool
     */
    public function setHide()
    {
        $this->setVar('xoosocialnetwork_display', 0);

        return true;
    }

    /**
     * @param null $keys
     * @param null $format
     * @param null $maxDepth
     * @return array
     */
    public function getValues($keys = null, $format = null, $maxDepth = null)
    {
        $xoops = \Xoops::getInstance();
        $helper = \XoopsModules\Xoosocialnetwork\Helper::getInstance();
        $sn_config = $helper->loadConfig();

        $ret = parent::getValues();
        if ('blank.gif' !== $ret['xoosocialnetwork_image']) {
            $ret['xoosocialnetwork_image_link'] = $xoops->url('modules/xoosocialnetwork/assets/icons/' . $sn_config['xoosocialnetwork_theme']) . '/' . $ret['xoosocialnetwork_image'];
        }

        return $ret;
    }

    public function cleanVarsForDB()
    {
        $system = \System::getInstance();
        foreach (parent::getValues() as $k => $v) {
            if ('dohtml' !== $k) {
                if (XOBJ_DTYPE_STIME == $this->vars[$k]['data_type'] || XOBJ_DTYPE_MTIME == $this->vars[$k]['data_type'] || XOBJ_DTYPE_LTIME == $this->vars[$k]['data_type']) {
                    $value0 = $system->cleanVars($_POST[$k], 'date', date('Y-m-d'), 'date') + $system->cleanVars($_POST[$k], 'time', date('u'), 'int');
                    //TODO should we use here getString??
                    $value = Request::getString('date', date('Y-m-d'), $_POST[$k]) + Request::getInt('time', date('u'), $_POST[$k]);

                    $this->setVar($k, isset($_POST[$k]) ? $value : $v);
                } elseif (XOBJ_DTYPE_INT == $this->vars[$k]['data_type']) {
                    $value = Request::getInt($k, $v, 'POST'); //$system->cleanVars($_POST, $k, $v, 'int');
                    $this->setVar($k, $value);
                } elseif (XOBJ_DTYPE_ARRAY == $this->vars[$k]['data_type']) {
                    $value = Request::getArray($k, $v, 'POST'); //$system->cleanVars($_POST, $k, $v, 'array');
                    $this->setVar($k, $value);
                } else {
                    $value = Request::getString($k, $v, 'POST'); //$system->cleanVars($_POST, $k, $v, 'string');
                    $this->setVar($k, $value);
                }
            }
        }
    }
}
