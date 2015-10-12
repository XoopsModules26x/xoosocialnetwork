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
 * @version         $Id: xoosocialnetwork.php 1397 2012-12-30 07:36:56Z DuGris $
 */

class XooSocialNetwork extends Xoops\Module\Helper\HelperAbstract
{
    /**
     * Init the module
     *
     * @return null|void
     */
    public function init()
    {
        $this->setDirname(basename(dirname(__DIR__)));
    }

    /**
     * @return mixed
     */
    public function loadConfig()
    {
        XoopsLoad::load('xoopreferences', $this->_dirname);

        return XooSocialnetworkPreferences::getInstance()->getConfig();
    }

    /**
     * @return \Xoops\Module\Helper\XoopsObjectHandler
     */
    public function snHandler()
    {
        return $this->getHandler('Sn');
    }
}
