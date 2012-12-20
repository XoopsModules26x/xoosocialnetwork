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

include dirname(__FILE__) . '/header.php';

switch ($op) {    case 'save':
    if ( !$xoops->security()->check() ) {
        $xoops->redirect('index.php', 5, implode(',', $xoops->security()->getErrors()));
    }

    $xoosocialnetwork_id = $system->CleanVars($_POST, 'xoosocialnetwork_id', 0, 'int');
    if( isset($xoosocialnetwork_id) && $xoosocialnetwork_id > 0 ){
        $data = $sn_handler->get($xoosocialnetwork_id);
    } else {
        $data = $sn_handler->create();
    }
    $data->CleanVarsForDB();

    if ($sn_handler->insert($data)) {
        $sn_handler->createConfig();
        $xoops->redirect('index.php', 5, _AM_XOO_SN_SAVED);
    }
    break;

    case 'add':
    $data = $sn_handler->create();
    $form = $sn_module->getForm($data, 'socialnetwork');

    $admin_page->addInfoBox(_AM_XOO_SN_ADD);
    $admin_page->addInfoBoxLine( $form->render() );
    break;

    case 'edit':
    $data = $sn_handler->get($xoosocialnetwork_id);
    $form = $sn_module->getForm($data, 'socialnetwork');

    $admin_page->addInfoBox(_AM_XOO_SN_EDIT . ' : ' . $data->getVar('xoosocialnetwork_title'));
    $admin_page->addInfoBoxLine( $form->render() );
    break;

    case 'view':
    $data = $sn_handler->get($xoosocialnetwork_id);
    $data->setView();
    $sn_handler->insert($data);
    $sn_handler->createConfig();
    $xoops->redirect('index.php', 5, _AM_XOO_SN_SAVED);
    break;

    case 'hide':
    $data = $sn_handler->get($xoosocialnetwork_id);
    $data->setHide();
    $sn_handler->insert($data);
    $sn_handler->createConfig();
    $xoops->redirect('index.php', 5, _AM_XOO_SN_SAVED);
    break;

    case 'createconfig':
    $sn_handler->createConfig();
    $xoops->redirect('index.php', 5, _AM_XOO_SN_CREATED);
    break;

    default:
    $socialnetwork = $sn_handler->renderAdminList();
    $xoops->tpl()->assign('socialnetwork', $socialnetwork );

    $admin_page->addItemButton(_AM_XOO_SN_ADD, 'index.php?op=add', 'add');
    ob_start();
    $admin_page->displayButton();
    $admin_button = ob_get_contents();
    ob_end_clean();

    $admin_page->addInfoBox(_AM_XOO_SN_MANAGER);
    $admin_page->addInfoBoxLine( $xoops->tpl()->fetch('admin:xoosocialnetwork|xoosocialnetwork_index.html') );
    break;
}
$admin_page->displayIndex();
include dirname(__FILE__) . '/footer.php';
?>