<{include file="admin:system/admin_navigation.tpl"}>
<{include file="admin:system/admin_tips.tpl"}>
<{include file="admin:system/admin_buttons.tpl"}>

<{if count($socialnetwork)}>
    <table class="outer">
        <thead>
        <tr>
            <th class="txtcenter"><{$smarty.const._AM_XOO_SN_TITLE}></th>
            <th class="txtcenter"><{$smarty.const._AM_XOO_SN_IMAGE}></th>
            <th class="txtcenter"><{$smarty.const._AM_XOO_SN_ORDER}></th>
            <th class="txtcenter"><{$smarty.const._AM_XOO_SN_DISPLAY}></th>
            <th class="txtcenter"><{$smarty.const._AM_XOO_SN_ACTION}></th>
        </tr>
        </thead>

        <{foreach from=$socialnetwork item=field}>
        <tr class="<{cycle values="even,odd"}>">
            <td class="txtleft bold"><{$field.xoosocialnetwork_title}></td>

            <td class="txtcenter">
                <img class="xo-moduleadmin-image" src="<{$field.xoosocialnetwork_image_link}>" alt="<{$field.xoosocialnetwork_title}>">
            </td>

            <td class="txtcenter"><{$field.xoosocialnetwork_order}></td>

            <td class="txtcenter">
                <{if ($field.xoosocialnetwork_display)}>
                    <a href="index.php?op=hide&amp;xoosocialnetwork_id=<{$field.xoosocialnetwork_id}>" title="<{$smarty.const._AM_XOO_SN_SHOW_HIDE}>"> <img src="<{xoImgUrl 'media/xoops/images/icons/16/on.png'}>" alt="<{$smarty.const._AM_XOO_SN_SHOW_HIDE}>"> </a>
                <{else}>
                    <a href="index.php?op=view&amp;xoosocialnetwork_id=<{$field.xoosocialnetwork_id}>" title="<{$smarty.const._AM_XOO_SN_SHOW_HIDE}>"><img src="<{xoImgUrl 'media/xoops/images/icons/16/off.png'}>" alt="<{$smarty.const._AM_XOO_SN_SHOW_HIDE}>"></a>
                <{/if}>
            </td>

            <td class="txtcenter">
                <a href="index.php?op=edit&amp;xoosocialnetwork_id=<{$field.xoosocialnetwork_id}>" title="<{$smarty.const._EDIT}>"><img src="<{xoImgUrl 'media/xoops/images/icons/16/edit.png'}>" alt="<{$smarty.const._EDIT}>"></a>

                    <{*<a href="index.php?op=del&amp;xoosocialnetwork_id=<{$field.xoosocialnetwork_id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoImgUrl media/xoops/images/icons/16/delete.png}>" alt="<{$smarty.const._DELETE}>"></a>*}>

            </td>
        </tr>
        <{/foreach}>
    </table>
<{/if}>
