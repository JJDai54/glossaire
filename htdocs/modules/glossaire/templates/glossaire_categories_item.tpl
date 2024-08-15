<{if $smarty.const.GLOSSAIRE_SHOW_TPL_NAME==1}>
<{if !$tplHierarchie}><{assign var=tplHierarchie value=1}><{else}><{assign var=tplHierarchie value=$tplHierarchie+1}><{/if}>
<div style="text-align: center; background-color: black;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
<{*  ------------------------------------------------------------------ *}>
<div class="item-round-top <{$category.colors_set}>-item-head"  catlist>
    <a href="<{$smarty.const.XOOPS_URL}>/modules/glossaire/entries.php?catIdSelect=<{$category.id}>">
        <b><{$category.name}></b>
    </a>

    <{* ---------- Affichage de boutons image pour gerer la categorie -----------  *}>
    <{include file="db:glossaire_categories_item_btn.tpl" }>
</div>

    
<div  class="item-round-none <{$category.theme}>-item-body" catlist>
    <{$category.description}><br>
</div>

<div  class="item-round-bottom <{$category.theme}>-item-info" catlist>
    <center>...</center>
</div>
<{*  ------------------------------------------------------------------ *}>
<{if $smarty.const.GLOSSAIRE_SHOW_TPL_NAME==1}>
<{assign var=tplHierarchie value=$tplHierarchie-1}>
<div style="text-align: center; background-color: grey;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>


