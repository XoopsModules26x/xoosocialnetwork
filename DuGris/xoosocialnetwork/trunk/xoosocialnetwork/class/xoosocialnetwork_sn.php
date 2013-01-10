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

class Xoosocialnetwork_sn extends XoopsObject
{
    // constructor
	public function __construct()
	{
		$this->initVar('xoosocialnetwork_id'          , XOBJ_DTYPE_INT     , 0            , false , 11);
		$this->initVar('xoosocialnetwork_title'       , XOBJ_DTYPE_TXTBOX  , ''           , true  , 100);
		$this->initVar('xoosocialnetwork_url'         , XOBJ_DTYPE_TXTBOX  , ''           , true  , 100);
		$this->initVar('xoosocialnetwork_image'       , XOBJ_DTYPE_TXTBOX  , ''           , true  , 100);
		$this->initVar('xoosocialnetwork_query_url'   , XOBJ_DTYPE_TXTBOX  , ''           , true  , 20);
		$this->initVar('xoosocialnetwork_query_title' , XOBJ_DTYPE_TXTBOX  , ''           , true  , 20);
		$this->initVar('xoosocialnetwork_display'     , XOBJ_DTYPE_INT     , 1            , true  , 1);
		$this->initVar('xoosocialnetwork_order'       , XOBJ_DTYPE_INT     , 1            , true  , 3);

        // Pour autoriser le html
//        $this->initVar('dohtml', XOBJ_DTYPE_INT, 1, false);
	}

    private function Xoosocialnetwork_sn()
    {
        $this->__construct();
    }

    public function setView()
    {
        $this->setVar('xoosocialnetwork_display', 1);
        return true;
    }

    public function setHide()
    {
        return true;
    }

    public function getValues($keys = null, $format = null, $maxDepth = null)
    {
        $sn_module = Xoosocialnetwork::getInstance();

        $ret = parent::getValues();
        if ( $ret['xoosocialnetwork_image'] != 'blank.gif' ) {
        }
        return $ret;
    }

    public function CleanVarsForDB()
    {
        $system = System::getInstance();
        foreach ( parent::getValues() as $k => $v ) {
            if ( $k != 'dohtml' ) {
                if ( $this->vars[$k]['data_type'] == XOBJ_DTYPE_STIME || $this->vars[$k]['data_type'] == XOBJ_DTYPE_MTIME || $this->vars[$k]['data_type'] == XOBJ_DTYPE_LTIME) {
                    $value = $system->CleanVars($_POST[$k], 'date', date('Y-m-d'), 'date') + $system->CleanVars($_POST[$k], 'time', date('u'), 'int');
                    $this->setVar( $k,  isset( $_POST[$k] ) ? $value : $v );
                } elseif ( $this->vars[$k]['data_type'] == XOBJ_DTYPE_INT ) {
                    $value = $system->CleanVars($_POST, $k, $v, 'int');
                    $this->setVar( $k,  $value );
                } elseif ( $this->vars[$k]['data_type'] == XOBJ_DTYPE_ARRAY ) {
                    $value = $system->CleanVars($_POST, $k, $v, 'array');
                    $this->setVar( $k,  $value );
                } else {
                    $value = $system->CleanVars($_POST, $k, $v, 'string');
                    $this->setVar( $k,  $value );
                }
            }
        }
    }
}

class XoosocialnetworkXoosocialnetwork_snHandler extends XoopsPersistableObjectHandler
{
    public function __construct($db)
    {
        $this->configPath = XOOPS_VAR_PATH . '/configs/xoosocialnetwork/';
        $this->configFile = 'xoosocialnetwork';
        $this->configFileExt = '.php';

        parent::__construct($db, 'xoosocialnetwork', 'Xoosocialnetwork_sn', 'xoosocialnetwork_id', 'xoosocialnetwork_title');
    }

    public function renderAdminList()
    {
        $criteria->setSort( 'xoosocialnetwork_order' );
        $criteria->setOrder( 'asc' );
        return $this->getObjects($criteria, true, false);
    }

    public function getDisplayed()
    {
        $criteria = new CriteriaCompo();
        $criteria->add( new Criteria('xoosocialnetwork_display', 1) ) ;
        $criteria->setSort( 'xoosocialnetwork_order' );
        $criteria->setOrder( 'asc' );
        return $this->getObjects($criteria, true, false);
    }

    public function loadConfig()
    {
        $cached_config = $this->readConfig();
        if (empty($cached_config)) {
            $cached_config = $this->createConfig();
        }
        return $cached_config;
    }

    public function readConfig()
    {
        $path_file = $this->configPath . $this->configFile . $this->configFileExt;
        XoopsLoad::load('XoopsFile');
        $file = XoopsFile::getHandler('file', $path_file);
        return eval(@$file->read());
    }

    public function createConfig()
    {
    }

    public function writeConfig($data)
    {
        XoopsLoad::load('XoopsFile');
        $file = XoopsFile::getHandler('file', $path_file);
        return $file->write( "return " . var_export($data, true) . ";");
    }
}
?>