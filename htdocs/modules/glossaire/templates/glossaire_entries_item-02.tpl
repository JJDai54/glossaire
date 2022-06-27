<{if $smarty.const._GLS_SHOW_TPL_NAME==1}>
<{if !$tplHierarchie}><{assign var=tplHierarchie value=1}><{else}><{assign var=tplHierarchie value=$tplHierarchie+1}><{/if}>
<div style="text-align: center; background-color: black;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
<{*  ------------------------------------------------------------------ *}>
<{*  
<i id='entId_<{$entry.ent_id}>'></i>
<div class='panel-heading'>
</div>
<div class='panel-body'>
    <span class='col-sm-9 justify'><{$entry.uid}></span>
    <span class='col-sm-9 justify'><{$entry.term}></span>
    <span class='col-sm-9 justify'><{$entry.shortdef}></span>
    <span class='col-sm-9 justify'><{$entry.definition}></span>
    <span class='col-sm-9 justify'><{$entry.reference}></span>
    <span class='col-sm-9 justify'><{$entry.url1}></span>
    <span class='col-sm-9 justify'><{$entry.url2}></span>
    <span class='col-sm-9 justify'><{$entry.date_creation}></span>
</div>
*}>

<div name='entry-<{$entry.id}>' id='entry-<{$entry.id}>' class="item-round-no <{$colors_set}>-itemBody" style="padding:12px;margin-top:-5px;">
    <span class='limagei'><{if $showId}>[#<{$entry.id}>]-<{/if}><b><{$entry.term}></b>

<{* Affichage de boutons image pour gérer l'entree *}>
    <a href='#haut_de_page'>
      <img src="<{xoModuleIcons16 ASC.png}>" class='gls_button gls_buttonTop' title="<{$smarty.const._MA_GLOSSAIRE_TOP}>"></a>

    <{if $entry.shortdef}> : <{$entry.shortdefMagnifed}><br><{/if}>


<{if $showButtonsImg}>
    <a href='entries.php?op=delete&amp;ent_id=<{$entry.ent_id}>' title='<{$smarty.const._DELETE}>'>
       <img src="<{xoModuleIcons16 delete.png}>" class='gls_button' title="<{$smarty.const._DELETE}>"></a>
    <a href='entries.php?op=new&catIdSelect=<{$catIdSelect}>' title='<{$smarty.const._ADD}>'>
       <img src="<{xoModuleIcons16 add.png}>" class='gls_button' title="<{$smarty.const._ADD}>"></a>
    <a href='entries.php?op=clone&ent_id_source=<{$entry.ent_id}>' title='<{$smarty.const._CLONE}>'>
       <img src="<{xoModuleIcons16 editcopy.png}>" class='gls_button' title="<{$smarty.const._CLONE}>"></a>
    <a href='entries.php?op=edit&ent_id=<{$entry.ent_id}>&start=<{$start}>&limit=<{$limit}>''>
      <img src="<{xoModuleIcons16 edit.png}>" class='gls_button' title="<{$smarty.const._EDIT}>"></a>
<{/if}>
    </span>
</div>

<div class="item-round-no <{$colors_set}>-itemBody" style="padding:12px;margin-top:-5px;">
    <{$entry.definition_img}>
    <{if $entry.reference}>
        <span class='gls_seealso'><{$smarty.const._MA_GLOSSAIRE_REFERENCES}> : </span><br>
        <{$entry.reference}>
    <{/if}>

    <{if $entry.urls}>
        <span class='gls_seealso'><{$smarty.const._MA_GLOSSAIRE_SEEALSO}> : </span><br>
        <{$entry.urls}>
    <{/if}>
</div>


<div class="item-round-no <{$colors_set}>-itemBody" style="padding:12px;margin-top:-5px;">
<hr class='<{$colors_set}>-hr-style-two'>
</div>
<{*  ------------------------------------------------------------------ *}>
<{if $smarty.const._GLS_SHOW_TPL_NAME==1}>
<{assign var=tplHierarchie value=$tplHierarchie-1}>
<div style="text-align: center; background-color: grey;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
