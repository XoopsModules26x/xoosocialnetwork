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
 * @version         $Id: install.php 1088 2012-11-09 23:45:14Z DuGris $
 */

defined('XOOPS_ROOT_PATH') or die('Restricted access');

function xoops_module_install_xoosocialnetwork()
{    $xoops = Xoops::getInstance();
    $folders    = array();
    $folders[]  = $xoops->path('uploads') . '/xoosocialnetwork/images';
    $images     = array('index.html', 'blank.gif');

    foreach ( $folders as $folder ) {        if ( !xoosocialnetwork_mkdirs($folder) ) {
            return false;
        } else {
            foreach ( $images as $image ) {                if ( !xoosocialnetwork_copyfile($xoops->path('uploads'), $image, $folder) ) {
                    return false;
                }
            }
        }
    }
    xoosocialnetwork_mkdirs($xoops->path(XOOPS_VAR_PATH) . '/configs/xoosocialnetwork');
    return true;
}

function xoosocialnetwork_mkdirs( $pathname, $pathout = XOOPS_ROOT_PATH )
{
    $xoops = Xoops::getInstance();
    $pathname = substr( $pathname, strlen(XOOPS_ROOT_PATH) );
    $pathname = str_replace( DIRECTORY_SEPARATOR, '/', $pathname );

    $dest = $pathout;
    $paths = explode( '/', $pathname );

    foreach ( $paths as $path ) {
        if ( !empty( $path ) ) {
            $dest = $dest . '/' . $path;
            if ( !is_dir( $dest ) ) {
                if ( !mkdir( $dest , 0755 ) ) {
                    return false;
                } else {
                    xoosocialnetwork_copyfile($xoops->path('uploads'), 'index.html', $dest);
                }
            }
        }
    }
    return true;
}

function xoosocialnetwork_copyfile( $folder_in, $source_file, $folder_out )
{
    if ( !is_dir($folder_out) ) {
        if ( !xoosocialnetwork_mkdirs($folder_out) ) {
            return false;
        }
    }

    // Simple copy for a file
    if ( is_file($folder_in . '/' . $source_file) ) {
        return copy($folder_in . '/' . $source_file, $folder_out . '/' . basename($source_file) );
    }
    return false;
}
?>