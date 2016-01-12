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


/**
 * Class XooSocialNetworkSocialnetworkForm
 */
class XooSocialNetworkSocialnetworkForm extends Xoops\Form\ThemeForm
{
    /**
     * @param XooSocialNetworkSocialnetwork|XoopsObject $obj
     */
    public function __construct($obj = null)
    {
        $this->xoopsObject = $obj;

        $snModule  = XooSocialNetwork::getInstance();
        $snHandler = $snModule->snHandler();

        if ($this->xoopsObject->isNew()) {
            parent::__construct('', 'form_socialnetwork', 'index.php', 'post', true);
        } else {
            parent::__construct('', 'form_socialnetwork', 'index.php', 'post', true);
        }
        $this->setExtra('enctype="multipart/form-data"');

        // Title
        $this->addElement(new Xoops\Form\Text(_AM_XOO_SN_TITLE, 'xoosocialnetwork_title', 5, 255, $this->xoopsObject->getVar('xoosocialnetwork_title')), true);

        // Url
        $this->addElement(new Xoops\Form\Text(_AM_XOO_SN_URL, 'xoosocialnetwork_url', 7, 255, $this->xoopsObject->getVar('xoosocialnetwork_url')), true);

        // Query string URL
        $queryUrl = new Xoops\Form\Text(_AM_XOO_SN_QUERY_URL, 'xoosocialnetwork_query_url', 5, 20, $this->xoopsObject->getVar('xoosocialnetwork_query_url'));
        $queryUrl->setDatalist(array(
                                   'u',
                                   'url'));
        $this->addElement($queryUrl, true);

        // Query string title
        $queryString = new Xoops\Form\Text(_AM_XOO_SN_QUERY_TITLE, 'xoosocialnetwork_query_title', 5, 20, $this->xoopsObject->getVar('xoosocialnetwork_query_title'));
        $queryString->setDatalist(array(
                                      't',
                                      'title'));
        $this->addElement($queryString);

        // image
        $xoops       = Xoops::getInstance();
        $imageTray   = new Xoops\Form\ElementTray(_AM_XOO_SN_IMAGE, '');
        $imageArray  = XoopsLists::getImgListAsArray($xoops->path('modules/xoosocialnetwork/assets/icons/Default'));
        $imageSelect = new Xoops\Form\Select('', 'xoosocialnetwork_image', $this->xoopsObject->getVar('xoosocialnetwork_image'));
        $imageSelect->addOptionArray($imageArray);
        $imageSelect->setExtra("onchange='showImgSelected(\"select_image\", \"xoosocialnetwork_image\", \"" . '/' . "\", \"\", \"" . $xoops->url('modules/xoosocialnetwork/assets/icons/Default') . "\")'");
        $imageTray->addElement($imageSelect);
        $imageTray->addElement(new Xoops\Form\Label('', "<br /><img src='" . $xoops->url('modules/xoosocialnetwork/assets/icons/Default/') . $this->xoopsObject->getVar('xoosocialnetwork_image') . "' name='select_image' id='select_image' alt='' />"));
        $this->addElement($imageTray);

        // order
        $this->addElement(new Xoops\Form\Text(_AM_XOO_SN_ORDER, 'xoosocialnetwork_order', 1, 3, $this->xoopsObject->getVar('xoosocialnetwork_order')));

        // display
        $this->addElement(new Xoops\Form\RadioYesNo(_AM_XOO_SN_DISPLAY, 'xoosocialnetwork_display', $this->xoopsObject->getVar('xoosocialnetwork_display')));

        // hidden
        $this->addElement(new Xoops\Form\Hidden('xoosocialnetwork_id', $this->xoopsObject->getVar('xoosocialnetwork_id')));

        // button
        $buttonTray = new Xoops\Form\ElementTray('', '');
        $buttonTray->addElement(new Xoops\Form\Hidden('op', 'save'));
        $buttonTray->addElement(new Xoops\Form\Button('', 'submit', XoopsLocale::A_SUBMIT, 'submit'));
        $buttonTray->addElement(new Xoops\Form\Button('', 'reset', XoopsLocale::A_RESET, 'reset'));
        $buttonCancelSend = new Xoops\Form\Button('', 'cancel', XoopsLocale::A_CANCEL, 'button');
        $buttonCancelSend->setExtra("onclick='javascript:history.go(-1);'");
        $buttonTray->addElement($buttonCancelSend);
        $this->addElement($buttonTray);
    }

    /**
     * @param        $msg
     * @param string $title
     * @param string $class
     * @return string
     */
    public function message($msg, $title = '', $class = 'errorMsg')
    {
        $ret = "<div class='" . $class . "'>";
        if ('' != $title) {
            $ret .= '<strong>' . $title . '</strong>';
        }
        if (is_array($msg) || is_object($msg)) {
            $ret .= implode('<br />', $msg);
        } else {
            $ret .= $msg;
        }
        $ret .= '</div>';

        return $ret;
    }
}
