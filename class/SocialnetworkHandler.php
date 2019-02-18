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
use Xoops\Core\Database\Connection;

/**
 * Class SocialnetworkHandler
 */
class SocialnetworkHandler extends \XoopsPersistableObjectHandler
{
    /**
     * @param null|\Xoops\Core\Database\Connection $db
     */
    public function __construct(Connection $db = null)
    {
        $this->configPath = \XoopsBaseConfig::get('var-path') . '/configs/xoosocialnetwork/';
        $this->configFile = 'xoosocialnetwork';
        $this->configFileExt = '.php';

        parent::__construct($db, 'xoosocialnetwork', Socialnetwork::class, 'xoosocialnetwork_id', 'xoosocialnetwork_title');
    }

    /**
     * @return array
     */
    public function renderAdminList()
    {
        $criteria = new \CriteriaCompo();
        $criteria->setSort('xoosocialnetwork_order');
        $criteria->setOrder('asc');

        return $this->getObjects($criteria, true, false);
    }

    /**
     * @return array
     */
    public function getDisplayed()
    {
        $criteria = new \CriteriaCompo();
        $criteria->add(new \Criteria('xoosocialnetwork_display', 1));
        $criteria->setSort('xoosocialnetwork_order');
        $criteria->setOrder('asc');

        return $this->getObjects($criteria, true, false);
    }

    /**
     * @return bool|mixed
     */
    public function loadConfig()
    {
        $cached_config = $this->readConfig();
        if (empty($cached_config)) {
            $cached_config = $this->createConfig();
        }

        return $cached_config;
    }

    /**
     * @return mixed
     */
    public function readConfig()
    {
        $path_file = $this->configPath . $this->configFile . $this->configFileExt;
        \XoopsLoad::load('XoopsFile');
        $file = \XoopsFile::getHandler('file', $path_file);

        return eval(@$file->read());
    }

    /**
     * @return bool
     */
    public function createConfig()
    {
        return $this->writeConfig($this->getDisplayed());
    }

    /**
     * @param $data
     * @return bool
     */
    public function writeConfig($data)
    {
        $path_file = $this->configPath . $this->configFile . $this->configFileExt;
        \XoopsLoad::load('XoopsFile');
        $file = \XoopsFile::getHandler('file', $path_file);

        return $file->write('return ' . var_export($data, true) . ';');
    }
}
