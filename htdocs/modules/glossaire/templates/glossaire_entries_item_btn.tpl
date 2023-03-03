
 
<{* ---------- Affichage de boutons image pour gerer l entree -----------*}>
<a href="#haut_de_page">
  <img src="<{xoModuleIcons16 ASC.png}>" class="gls_button gls_buttonTop" title="<{$smarty.const._MA_GLOSSAIRE_TOP}>"></a>


<{if $catPerms.approve}>
    <a href="entries.php?op=delete&amp;ent_id=<{$entry.ent_id}>" title="<{$smarty.const._DELETE}>">
       <img src="<{xoModuleIcons16 delete.png}>" class="gls_button" title="<{$smarty.const._DELETE}>"></a>
    <a href="entries.php?op=new&catIdSelect=<{$catIdSelect}>" title="<{$smarty.const._ADD}>">
       <img src="<{xoModuleIcons16 add.png}>" class="gls_button" title="<{$smarty.const._ADD}>"></a>
    <a href="entries.php?op=clone&ent_id_source=<{$entry.ent_id}>" title="<{$smarty.const._CLONE}>">
       <img src="<{xoModuleIcons16 editcopy.png}>" class="gls_button" title="<{$smarty.const._CLONE}>"></a>
    <a href="entries.php?op=edit&ent_id=<{$entry.ent_id}>&start=<{$start}>&limit=<{$limit}>&letter=<{$letter}>">
      <img src="<{xoModuleIcons16 edit.png}>" class="gls_button" title="<{$smarty.const._EDIT}>"></a>
<{/if}>

