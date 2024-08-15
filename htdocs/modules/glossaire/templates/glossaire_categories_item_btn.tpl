<{*  ------------------- direction la liste des entrees ----------------- *}>

<a href="entries.php?op=list&catIdSelect=<{$category.id}>" title="<{$smarty.const._MA_GLOSSAIRE_TITLE}>">
    <img src="<{xoModuleIcons16}>/forward.png" class="gls_button" title="<{$smarty.const._MA_GLOSSAIRE_TITLE}>">
</a>

<{if $category.show_bin[$smarty.const.GLOSSAIRE_ENT_BTN_ACTIONS_TOP] ||  $category.show_bin[$smarty.const.GLOSSAIRE_ENT_BTN_ACTIONS_BOTTOM]}>

    <{* ---------- Affichage de boutons image pour gerer la categorie -----------*}>
    <{if $category.perms.global_ac}>    
        <a href="categories.php?op=delete&amp;cat_id=<{$category.id}>" title="<{$smarty.const._DELETE}>">
           <img src="<{xoModuleIcons16}>/delete.png" class="gls_button" title="<{$smarty.const._DELETE}>">
        </a>
    <{*
        <a href="categories.php?op=new&catIdSelect=<{$category.id}>" title="<{$smarty.const._ADD}>">
            <img src="<{xoModuleIcons16}>/add.png" class="gls_button" title="<{$smarty.const._ADD}>">
        </a> 
    *}>
        <a href="categories.php?op=clone&cat_id_source=<{$category.id}>" title="<{$smarty.const._CLONE}>">
           <img src="<{xoModuleIcons16}>/editcopy.png" class="gls_button" title="<{$smarty.const._CLONE}>">
        </a>
    <{/if}>
    <{if $category.perms.global_ac}>    
        <a href="categories.php?op=edit&cat_id=<{$category.id}>&start=<{$start}>&limit=<{$limit}>">
          <img src="<{xoModuleIcons16}>/edit.png" class="gls_button" title="<{$smarty.const._EDIT}>">
        </a>
    <{/if}>
<{/if}>

    
