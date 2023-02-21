<{if $smarty.const.GLOSSAIRE_SHOW_TPL_NAME==1}>
<{if !$tplHierarchie}><{assign var=tplHierarchie value=1}><{else}><{assign var=tplHierarchie value=$tplHierarchie+1}><{/if}>
<div style="text-align: center; background-color: black;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
<{*  ------------------------------------------------------------------ *}>
<div class="pull-left"><{$copyright}></div>

    
<{if $xoops_isadmin|default:""}>
    <div class="text-center bold"><a href="<{$admin}>"><{$smarty.const._MA_GLOSSAIRE_ADMIN}></a></div>
<{/if}>

<{if $comment_mode|default:""}>
    <div class="pad2 marg2">
        <{if $comment_mode == "flat"}>
            <{include file="db:system_comments_flat.tpl" }>
        <{elseif $comment_mode == "thread"}>
            <{include file="db:system_comments_thread.tpl" }>
        <{elseif $comment_mode == "nest"}>
            <{include file="db:system_comments_nest.tpl" }>
        <{/if}>
    </div>
<{/if}>
<{include file="db:system_notification_select.tpl" }>

<{*  ------------------------------------------------------------------ *}>
<{if $smarty.const.GLOSSAIRE_SHOW_TPL_NAME==1}>
<{assign var=tplHierarchie value=$tplHierarchie-1}>
<div style="text-align: center; background-color: grey;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
