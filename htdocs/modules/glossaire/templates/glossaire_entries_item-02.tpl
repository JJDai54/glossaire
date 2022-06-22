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
    <span class='limagei'><b><{$entry.term}></b>
    <a href='#haut_de_page'>
      <img src="<{xoModuleIcons16 ASC.png}>" style='float:right;' title="<{$smarty.const._MA_GLOSSAIRE_TOP}>"></a>

    <{if $entry.shortdef}> : <{$entry.shortdefMagnifed}><{/if}>
    </span>
</div>

<div class="item-round-no <{$colors_set}>-itemBody" style="padding:12px;margin-top:-5px;">
    <{$entry.definition_img}>
    <{if $entry.reference}><hr class='<{$colors_set}>-hr-style-two'><{$entry.reference}><{/if}>
</div>
<div class="item-round-no <{$colors_set}>-itemBody" style="padding:6px 12px 6px 12px;margin-top:-5px;">
<{*
    <{if $entry.url1}><a href='$entry.url1'><{$entry.url1}></a><{/if}>
    <{if $entry.url2}><a href='$entry.url1'><br><{$entry.url2}></a><{/if}>
*}>
    <{if $entry.urls}>
        <hr class='<{$colors_set}>-hr-style-two'><center><{$smarty.const._MA_GLOSSAIRE_SEEALSO}></center>
        <{$entry.urls}>
    <{/if}>
</div>

<{if $isCatAllowed}>
<{* Affichage de boutons image pour gérer l'entree *}>
<{if $showButtonsImg}>
  <div class="item-round-no <{$colors_set}>-itemBody" style="padding:6px;margin-top:-5px;text-align:right;">
    <a href='entries.php?op=edit&ent_id=<{$entry.ent_id}>&start=<{$start}>&limit=<{$limit}>''>
      <img src="<{xoModuleIcons16 edit.png}>" title="<{$smarty.const._EDIT}>"></a>
    <a href='entries.php?op=clone&ent_id_source=<{$entry.ent_id}>' title='<{$smarty.const._CLONE}>'>
       <img src="<{xoModuleIcons16 editcopy.png}>" title="<{$smarty.const._CLONE}>"></a>
    <a href='entries.php?op=new&catIdSelect=<{$catIdSelect}>' title='<{$smarty.const._ADD}>'>
       <img src="<{xoModuleIcons16 add.png}>" title="<{$smarty.const._ADD}>"></a>
    <a href='entries.php?op=delete&amp;ent_id=<{$entry.ent_id}>' title='<{$smarty.const._DELETE}>'>
       <img src="<{xoModuleIcons16 delete.png}>" title="<{$smarty.const._DELETE}>"></a>
  </div>


<{else}>
    <{* Affichage de boutons texte pour gérer l'entree *}>
  <div class='panel-foot'>
      <div class='col-sm-12 right'>
          <{if $showItem|default:''}>
              <a class='btn btn-success right' href='entries.php?op=list&amp;start=<{$start}>&amp;limit=<{$limit}>#entId_<{$entry.ent_id}>' title='<{$smarty.const._MA_GLOSSAIRE_ENTRIES_LIST}>'><{$smarty.const._MA_GLOSSAIRE_ENTRIES_LIST}></a>
          <{else}>
              <a class='btn btn-success right' href='entries.php?op=show&amp;ent_id=<{$entry.ent_id}>&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._MA_GLOSSAIRE_DETAILS}>'><{$smarty.const._MA_GLOSSAIRE_DETAILS}></a>
          <{/if}>
          <{if $isCatAllowed}>
                <a class='btn btn-primary right' href='entries.php?op=edit&amp;ent_id=<{$entry.ent_id}>&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._EDIT}>'><{$smarty.const._EDIT}></a>
                <a class='btn btn-primary right' href='entries.php?op=clone&amp;ent_id_source=<{$entry.ent_id}>' title='<{$smarty.const._CLONE}>'><{$smarty.const._CLONE}></a>
                <a class='btn btn-danger right' href='entries.php?op=delete&amp;ent_id=<{$entry.ent_id}>' title='<{$smarty.const._DELETE}>'><{$smarty.const._DELETE}></a>
              <{/if}>
  
      </div>
  </div>
<{/if}>
<{/if}> <{* //isCatAllowed *}>

<div class="item-round-no <{$colors_set}>-itemBody" style="padding:12px;margin-top:-5px;">
<hr class='<{$colors_set}>-hr-style-two'>
</div>
<{*  ------------------------------------------------------------------ *}>
<{if $smarty.const._GLS_SHOW_TPL_NAME==1}>
<{assign var=tplHierarchie value=$tplHierarchie-1}>
<div style="text-align: center; background-color: grey;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
