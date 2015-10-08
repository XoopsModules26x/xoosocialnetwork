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

defined('XOOPS_ROOT_PATH') || exit('Restricted access');

/**
 * Class XooSocialNetworkPreferences
 */
class XooSocialNetworkPreferences
{
    public  $config         = array();
    public  $basicConfig    = array();
    public  $configPath;
    public  $configFile;
    private $module_dirname = 'xoosocialnetwork';

    /**
     *
     */
    protected function __construct()
    {
        $xoops            = Xoops::getInstance();
        $this->configFile = 'config.' . $this->module_dirname . '.php';

        $this->configPath = XOOPS_VAR_PATH . '/configs/' . $this->module_dirname . '/';

        $this->basicConfig = $this->loadBasicConfig();
        $this->config      = @$this->loadConfig();

        if (count($this->config) != count($this->basicConfig)) {
            $this->config = array_merge($this->basicConfig, $this->config);
            $this->writeConfig($this->config);
        }
    }

    public static function getInstance()
    {
        static $instance;
        if (null === $instance) {
            $class    = __CLASS__;
            $instance = new $class();
        }

        return $instance;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * XooSocialNetworkPreferences::loadConfig()
     *
     * @return array
     */
    public function loadConfig()
    {
        if (!$config = $this->readConfig()) {
            $config = $this->loadBasicConfig();
            $this->writeConfig($config);
        }

        return $config;
    }

    /**
     * XooSocialNetworkPreferences::loadBasicConfig()
     *
     * @return array
     */
    public function loadBasicConfig()
    {
        if (file_exists($file_path = dirname(__DIR__) . '/include/' . $this->configFile)) {
            $config = include $file_path;
        }

        return $config;
    }

    /**
     * XooSocialNetworkPreferences::readConfig()
     *
     * @return array
     */
    public function readConfig()
    {
        $file_path = $this->configPath . $this->configFile;
        XoopsLoad::load('XoopsFile');
        $file = XoopsFile::getHandler('file', $file_path);

        return eval(@$file->read());
    }

    /**
     * XooSocialNetworkPreferences::writeConfig()
     *
     * @param  array $config
     * @return array
     * @internal param string $filename
     */
    public function writeConfig($config)
    {
        if ($this->CreatePath($this->configPath)) {
            $file_path = $this->configPath . $this->configFile;
            XoopsLoad::load('XoopsFile');
            $file = XoopsFile::getHandler('file', $file_path);

            return $file->write('return ' . var_export($config, true) . ';');
        }

        return null;
    }

    /**
     * @param              $pathname
     * @param mixed|string $pathout
     * @return bool
     */
    private function CreatePath($pathname, $pathout = XOOPS_ROOT_PATH)
    {
        $xoops    = Xoops::getInstance();
        $pathname = substr($pathname, strlen(XOOPS_ROOT_PATH));
        $pathname = str_replace(DIRECTORY_SEPARATOR, '/', $pathname);

        $dest  = $pathout;
        $paths = explode('/', $pathname);

        foreach ($paths as $path) {
            if (!empty($path)) {
                $dest = $dest . '/' . $path;
                if (!is_dir($dest)) {
                    if (!mkdir($dest, 0755)) {
                        return false;
                    } else {
                        $this->WriteIndex($xoops->path('uploads'), 'index.html', $dest);
                    }
                }
            }
        }

        return true;
    }

    /**
     * @param $folder_in
     * @param $source_file
     * @param $folder_out
     * @return bool
     */
    private function WriteIndex($folder_in, $source_file, $folder_out)
    {
        if (!is_dir($folder_out)) {
            if (!$this->CreatePath($folder_out)) {
                return false;
            }
        }

        // Simple copy for a file
        if (is_file($folder_in . '/' . $source_file)) {
            return copy($folder_in . '/' . $source_file, $folder_out . '/' . basename($source_file));
        }

        return false;
    }
}
