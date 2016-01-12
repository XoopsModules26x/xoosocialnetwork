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
 */

use Xoops\Core\Request;

include __DIR__ . '/header.php';

switch ($op) {
    case 'save':
        if (!$xoops->security()->check()) {
            $xoops->redirect('index.php', 5, implode(',', $xoops->security()->getErrors()));
        }

        $xoosocialnetwork_id = Request::getInt('xoosocialnetwork_id', 0, 'POST'); //$system->cleanVars($_POST, 'xoosocialnetwork_id', 0, 'int');
        if (null !== $xoosocialnetwork_id && $xoosocialnetwork_id > 0) {
            $data = $snHandler->get($xoosocialnetwork_id);
        } else {
            $data = $snHandler->create();
        }
        $data->cleanVarsForDB();

        if ($snHandler->insert($data)) {
            $snHandler->createConfig();
            $xoops->redirect('index.php', 5, _AM_XOO_SN_SAVED);
        }
        break;

    case 'add':
        $data = $snHandler->create();
        $form = $snModule->getForm($data, 'socialnetwork');

        $admin_page->addInfoBox(_AM_XOO_SN_ADD);
        $admin_page->addInfoBoxLine($form->render());
        break;

    case 'edit':
        $data = $snHandler->get($xoosocialnetwork_id);
        $form = $snModule->getForm($data, 'socialnetwork');

        $admin_page->addInfoBox(_AM_XOO_SN_EDIT . ' : ' . $data->getVar('xoosocialnetwork_title'));
        $admin_page->addInfoBoxLine($form->render());
        break;

    case 'view':
        $data = $snHandler->get($xoosocialnetwork_id);
        $data->setView();
        $snHandler->insert($data);
        $snHandler->createConfig();
        $xoops->redirect('index.php', 5, _AM_XOO_SN_SAVED);
        break;

    case 'hide':
        $data = $snHandler->get($xoosocialnetwork_id);
        $data->setHide();
        $snHandler->insert($data);
        $snHandler->createConfig();
        $xoops->redirect('index.php', 5, _AM_XOO_SN_SAVED);
        break;

    case 'createconfig':
        $snHandler->createConfig();
        $xoops->redirect('index.php', 5, _AM_XOO_SN_CREATED);
        break;

    default:
        $socialnetwork = $snHandler->renderAdminList();
        $xoops->tpl()->assign('socialnetwork', $socialnetwork);

        $admin_page->addItemButton(_AM_XOO_SN_ADD, 'index.php?op=add', 'add');
        ob_start();
        $admin_page->displayButton();
        $admin_button = ob_get_contents();
        ob_end_clean();

        $admin_page->addInfoBox(_AM_XOO_SN_MANAGER);
        $admin_page->addInfoBoxLine($xoops->tpl()->fetch('admin:xoosocialnetwork/xoosocialnetwork_index.tpl'));
        break;
}
$admin_page->displayIndex();
include __DIR__ . '/footer.php';
