<{if $smarty.const.GLOSSAIRE_SHOW_TPL_NAME==1}>
<{if !$tplHierarchie}><{assign var=tplHierarchie value=1}><{else}><{assign var=tplHierarchie value=$tplHierarchie+1}><{/if}>
<div style="text-align: center; background-color: black;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
<{*  ------------------------------------------------------------------ *}>
<div>
    <a href="<{$smarty.const.XOOPS_URL}>/modules/glossaire/entries.php?catIdSelect=<{$category.id}>">
        <b><{$category.name}></b>
    </a>

    <{* ---------- Affichage de boutons image pour gerer l entree -----------*}>
    <{include file="db:glossaire_categories_item_btn.tpl" }>

</div>
    
<div style='padding-left:50px;'>
    <{$category.description}>
</div>

<{*  ------------------------------------------------------------------ *}>
<{if $smarty.const.GLOSSAIRE_SHOW_TPL_NAME==1}>
<{assign var=tplHierarchie value=$tplHierarchie-1}>
<div style="text-align: center; background-color: grey;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
