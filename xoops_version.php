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
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         Xoosocialnetwork
 * @since           2.6.0
 * @author          Laurent JEN (Aka DuGris)

 */
$modversion                  = [];
$modversion['version']       = 1.01;
$modversion['module_status'] = 'Alpha 1';
$modversion['release_date']  = '2019/02/15';
$modversion['dirname']       = basename(__DIR__);
$modversion['name']          = _MI_XOO_SN_NAME;
$modversion['description']   = _MI_XOO_SN_DESC;
$modversion['author']        = 'XooFoo - Laurent JEN';
$modversion['nickname']      = 'aka DuGris';
$modversion['credits']       = 'DuGris.XooFoo Project';
$modversion['license']       = 'GNU GPL 2.0';
$modversion['license_url']   = 'www.gnu.org/licenses/gpl-2.0.html/';
$modversion['official']      = 1;
$modversion['help']          = 'page=help';
$modversion['image']         = 'assets/images/logo.png';

// about
$modversion['module_website_url']  = 'xoops.org';
$modversion['module_website_name'] = 'XOOPS Project';
$modversion['min_php']             = '7.1.0';
$modversion['min_xoops']           = '2.6.0';
$modversion['min_db']              = ['mysql' => '5.5'];

// paypal
$modversion['paypal']                  = [];
$modversion['paypal']['business']      = 'dugris93@gmail.com';
$modversion['paypal']['item_name']     = _MI_XOO_SN_DESC;
$modversion['paypal']['amount']        = 0;
$modversion['paypal']['currency_code'] = 'EUR';

// Admin menu
$modversion['system_menu'] = 1;

// Admin things
$modversion['hasAdmin']   = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu']  = 'admin/menu.php';

// Manage extension
$modversion['extension']         = 1;
$modversion['extensionModule'][] = 'system';

// Scripts to run upon installation or update
$modversion['onInstall']   = 'include/oninstall.php';
$modversion['onUpdate']    = 'include/onupdate.php';
$modversion['onUninstall'] = '';

// JQuery
$modversion['jquery'] = 1;

// Mysql file
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';

// Tables created by sql file (without prefix!)
//$modversion['tables'][1] = 'xoosocialnetwork';
$modversion['schema'] = 'sql/schema.yml';

// Menu
$modversion['hasMain'] = 0;
