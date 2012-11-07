<?php
/**
 * Xoopreferences : Preferences Manager
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

class XooSocialNetworkPreferences
{
    public $config = array();
    public $basicConfig = array();
    public $configPath;
    public $configFile;
    private $module_dirname = 'xoosocialnetwork';

    public function __construct()
    {
        $this->configFile = 'config.' . $this->module_dirname . '.php';

        $this->configPath = XOOPS_VAR_PATH . '/configs/';

        $this->basicConfig = $this->loadBasicConfig();
        $this->config = @$this->loadConfig();

        if ( count($this->config) != count($this->basicConfig) ) {
        }
    }

    public function XooSocialNetworkPreferences()
    {

    /**
     * XooSocialNetworkPreferences::loadConfig()
     *
     * @return array
     */
    function loadConfig() {
        if ( !$config = $this->readConfig() ) {
            $config = $this->loadBasicConfig();
            $this->writeConfig($config );
        }
        return $config;
    }


    /**
     * XooSocialNetworkPreferences::loadBasicConfig()
     *
     * @return array
     */
    function loadBasicConfig()
    {
        if (file_exists($file_path = dirname(dirname( __FILE__ )) . '/include/' . $this->configFile)) {
            $config = include $file_path;
        }
        return $config;
    }

    /**
     * XooSocialNetworkPreferences::readConfig()
     *
     * @return array
     */
    function readConfig()
    {
        $file_path = $this->configPath . $this->configFile;
        XoopsLoad::load('XoopsFile');
        $file = XoopsFile::getHandler('file', $file_path);
        return eval(@$file->read());
    }

    /**
     * XooSocialNetworkPreferences::writeConfig()
     *
     * @param string $filename
     * @param array $config
     * @return array
     */
    function writeConfig($config)
    {
        $file_path = $this->configPath . $this->configFile;
        XoopsLoad::load('XoopsFile');
        $file = XoopsFile::getHandler('file', $file_path);
        return $file->write( 'return ' . var_export($config, true) . ';');
    }

}
?>