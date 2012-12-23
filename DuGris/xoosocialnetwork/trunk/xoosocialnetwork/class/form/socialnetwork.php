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

class XoosocialnetworkSocialnetworkForm extends XoopsThemeForm
{
    /**
     * @param null $obj
     */
    public function __construct($obj = null)
    {        $this->xoopsObject = $obj;

        $sn_module = Xoosocialnetwork::getInstance();
        $sn_handler = $sn_module->SNHandler();

        if ($this->xoopsObject->isNew() ) {
            parent::__construct('', 'form_socialnetwork', 'index.php', 'post', true);
        } else {            parent::__construct('', 'form_socialnetwork', 'index.php', 'post', true);
        }
        $this->setExtra('enctype="multipart/form-data"');

        // Title
        $this->addElement( new XoopsFormText(_AM_XOO_SN_TITLE, 'xoosocialnetwork_title', 5, 255, $this->xoopsObject->getVar('xoosocialnetwork_title')) , true );

        // Url
        $this->addElement( new XoopsFormText(_AM_XOO_SN_URL, 'xoosocialnetwork_url', 7, 255, $this->xoopsObject->getVar('xoosocialnetwork_url')) , true );

        // Query string URL
        $query_url = new XoopsFormText(_AM_XOO_SN_QUERY_URL, 'xoosocialnetwork_query_url', 5, 20, $this->xoopsObject->getVar('xoosocialnetwork_query_url'));
        $query_url->setDatalist(array('u','url'));
        $this->addElement( $query_url , true );

        // Query string title
        $query_string = new XoopsFormText(_AM_XOO_SN_QUERY_TITLE, 'xoosocialnetwork_query_title', 5, 20, $this->xoopsObject->getVar('xoosocialnetwork_query_title'));
        $query_string->setDatalist(array('t','title'));
        $this->addElement( $query_string );

        // order
        $this->addElement( new XoopsFormText(_AM_XOO_SN_ORDER, 'xoosocialnetwork_order', 1, 3, $this->xoopsObject->getVar('xoosocialnetwork_order')) );

        // display
        $this->addElement( new XoopsFormRadioYN(_AM_XOO_SN_DISPLAY, 'xoosocialnetwork_display',  $this->xoopsObject->getVar('xoosocialnetwork_display')) );

        // hidden
        $this->addElement( new XoopsFormHidden('xoosocialnetwork_id', $this->xoopsObject->getVar('xoosocialnetwork_id')) );

        // button
        $button_tray = new XoopsFormElementTray('', '');
        $button_tray->addElement(new XoopsFormHidden('op', 'save'));
        $button_tray->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
        $button_tray->addElement(new XoopsFormButton('', 'reset', _RESET, 'reset'));
        $cancel_send = new XoopsFormButton('', 'cancel', _CANCEL, 'button');
        $cancel_send->setExtra("onclick='javascript:history.go(-1);'");
        $button_tray->addElement($cancel_send);
        $this->addElement($button_tray);
    }

    public function message($msg, $title = '', $class='errorMsg' )
    {
        $ret = "<div class='" . $class . "'>";
        if ( $title != '' ) {
            $ret .= "<strong>" . $title . "</strong>";
        }
        if ( is_array( $msg ) || is_object( $msg ) ) {
            $ret .= implode('<br />', $msg);
        } else {
            $ret .= $msg;
        }
        $ret .= "</div>";
        return $ret;
    }
}
?>