<{if count($xoosocialnetwork) != 0}>
    <link rel="stylesheet" type="text/css" media="screen" href="<{xoAppUrl modules/xoosocialnetwork/assets/css/module.css}>"/>
    <div class="xooSocialNetwork">
        <{foreach from=$xoosocialnetwork item=sn}>
            <a rel="external" href="<{$sn.xoosocialnetwork_url}>" title="<{$sn.xoosocialnetwork_title}>"><img src="<{$sn.xoosocialnetwork_image_link}>" alt="<{$sn.xoosocialnetwork_title}>"></a>
        <{/foreach}>
    </div>
    <div class="clear"></div>
<{/if}>
