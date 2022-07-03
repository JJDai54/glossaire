<{if $smarty.const.GLOSSAIRE_SHOW_TPL_NAME==1}>
<{if !$tplHierarchie}><{assign var=tplHierarchie value=1}><{else}><{assign var=tplHierarchie value=$tplHierarchie+1}><{/if}>
<div style="text-align: center; background-color: black;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
<{*  ------------------------------------------------------------------ *}>

<div name='entry-<{$entry.id}>' id='entry-<{$entry.id}>' class="item-round-no <{$colors_set}>-itemBody" style="padding:6px;margin-top:0px;">
    <span class='limagei'><{if $showId}>[#<{$entry.id}>]-<{/if}><b><{$entry.term}></b></span>
        <{if $entry.shortdef}>
            <{if $cat_br_after_term}><br><{else}> : <{/if}>
            <{$entry.shortdefMagnifed}>
        <{/if}>


<{* ---------- Affichage de boutons image pour gérer l'entree -----------*}>
<{if ($posButtonsActions & 1)>0}>
    <a href='#haut_de_page'>
      <img src="<{xoModuleIcons16 ASC.png}>" class='gls_button gls_buttonTop' title="<{$smarty.const._MA_GLOSSAIRE_TOP}>"></a>


    <{if $catPerms.approve}>
        <a href='entries.php?op=delete&amp;ent_id=<{$entry.ent_id}>' title='<{$smarty.const._DELETE}>'>
           <img src="<{xoModuleIcons16 delete.png}>" class='gls_button' title="<{$smarty.const._DELETE}>"></a>
        <a href='entries.php?op=new&catIdSelect=<{$catIdSelect}>' title='<{$smarty.const._ADD}>'>
           <img src="<{xoModuleIcons16 add.png}>" class='gls_button' title="<{$smarty.const._ADD}>"></a>
        <a href='entries.php?op=clone&ent_id_source=<{$entry.ent_id}>' title='<{$smarty.const._CLONE}>'>
           <img src="<{xoModuleIcons16 editcopy.png}>" class='gls_button' title="<{$smarty.const._CLONE}>"></a>
        <a href='entries.php?op=edit&ent_id=<{$entry.ent_id}>&start=<{$start}>&limit=<{$limit}>''>
          <img src="<{xoModuleIcons16 edit.png}>" class='gls_button' title="<{$smarty.const._EDIT}>"></a>
    <{/if}>
<{/if}>
</div>

<{* ---------- data de l'entrée -----------*}>
<div class="item-round-no <{$colors_set}>-itemBody" style="padding:6px;margin-top:-5px;">
    <{if $entry.definition_img}>
        <{$entry.definition_img}>
    <{/if}>
    <{if $entry.reference}>
        <span class='gls_seealso'><{$smarty.const._MA_GLOSSAIRE_REFERENCES}> : </span><br>
        <{$entry.reference}>
    <{/if}>

    <{if $entry.urls}>
        <span class='gls_seealso'><{$smarty.const._MA_GLOSSAIRE_SEEALSO}> : </span><br>
        <{$entry.urls}>
    <{/if}>
    <{if $entry.email}>
        <span class='gls_seealso'><{$smarty.const._MA_GLOSSAIRE_CONTACT}> : </span> : <{$entry.email}>
    <{/if}>
    <{if $entry.file_name}>
        <br><br><span class='gls_seealso'><{$smarty.const._MA_GLOSSAIRE_FILE_LINKED}> : </span><br>
        <{$entry.file_link}>
    <{/if}>
</div>

<{* ---------- Affichage des boutons image pour gérer l'entree -----------*}>
<{if ($posButtonsActions & 2)>0}>
    <a href='#haut_de_page'>
      <img src="<{xoModuleIcons16 ASC.png}>" class='gls_button gls_buttonTop' title="<{$smarty.const._MA_GLOSSAIRE_TOP}>"></a>


    <{if $catPerms.approve}>
        <a href='entries.php?op=delete&amp;ent_id=<{$entry.ent_id}>' title='<{$smarty.const._DELETE}>'>
           <img src="<{xoModuleIcons16 delete.png}>" class='gls_button' title="<{$smarty.const._DELETE}>"></a>
        <a href='entries.php?op=new&catIdSelect=<{$catIdSelect}>' title='<{$smarty.const._ADD}>'>
           <img src="<{xoModuleIcons16 add.png}>" class='gls_button' title="<{$smarty.const._ADD}>"></a>
        <a href='entries.php?op=clone&ent_id_source=<{$entry.ent_id}>' title='<{$smarty.const._CLONE}>'>
           <img src="<{xoModuleIcons16 editcopy.png}>" class='gls_button' title="<{$smarty.const._CLONE}>"></a>
        <a href='entries.php?op=edit&ent_id=<{$entry.ent_id}>&start=<{$start}>&limit=<{$limit}>''>
          <img src="<{xoModuleIcons16 edit.png}>" class='gls_button' title="<{$smarty.const._EDIT}>"></a>
    <{/if}>
<{/if}>


<div class="item-round-no <{$colors_set}>-itemBody" style="padding:1px;margin-top:0px;">
    <{if !$smarty.foreach.entry.last}><hr class='<{$colors_set}>-hr-style-two'><{else}><br><{/if}>
</div>
<{*  ------------------------------------------------------------------ *}>
<{if $smarty.const.GLOSSAIRE_SHOW_TPL_NAME==1}>
<{assign var=tplHierarchie value=$tplHierarchie-1}>
<div style="text-align: center; background-color: grey;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
