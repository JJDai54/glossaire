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
<{if ($posButtonsActions & 1 || 1) > 0}>
    <{if $category.perms.submit}>    
        <a href="categories.php?op=delete&amp;cat_id=<{$category.id}>" title="<{$smarty.const._DELETE}>">
           <img src="<{xoModuleIcons16 delete.png}>" class="gls_button" title="<{$smarty.const._DELETE}>"></a>
<{*
        <a href="categories.php?op=new&catIdSelect=<{$category.id}>" title="<{$smarty.const._ADD}>">
            <img src="<{xoModuleIcons16 add.png}>" class="gls_button" title="<{$smarty.const._ADD}>"></a> 
*}>
        <a href="categories.php?op=clone&cat_id_source=<{$category.id}>" title="<{$smarty.const._CLONE}>">
           <img src="<{xoModuleIcons16 editcopy.png}>" class="gls_button" title="<{$smarty.const._CLONE}>"></a>
    <{/if}>
    <{if $category.perms.approve}>    
        <a href="categories.php?op=edit&cat_id=<{$category.id}>&start=<{$start}>&limit=<{$limit}>">
          <img src="<{xoModuleIcons16 edit.png}>" class="gls_button" title="<{$smarty.const._EDIT}>"></a>
    <{/if}>
<{/if}>
</div>
    
<div style='padding-left:50px;'>
    <{$category.description}>
</div>

<{*  ------------------------------------------------------------------ *}>
<{if $smarty.const.GLOSSAIRE_SHOW_TPL_NAME==1}>
<{assign var=tplHierarchie value=$tplHierarchie-1}>
<div style="text-align: center; background-color: grey;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
