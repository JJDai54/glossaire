<{if $smarty.const.GLOSSAIRE_SHOW_TPL_NAME==1}>
<{if !$tplHierarchie}><{assign var=tplHierarchie value=1}><{else}><{assign var=tplHierarchie value=$tplHierarchie+1}><{/if}>
<div style="text-align: center; background-color: black;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
<{*  ------------------------------------------------------------------ *}>

<div name="entry-<{$entry.id}>" id="entry-<{$entry.id}>" class="gls_title gls_ent_term item-round-no <{$colors_set}>-item-body" style="padding:6px;margin-top:0px; c">
    <{if $cat_br_after_term}>
        <h2 style="<{$catArr.css.gls_ent_term}>"><{if $showId}>[#<{$entry.id}>]-<{/if}><{$entry.term}></h2>
        <{if $entry.shortdef AND $catArr.show_bin[$smarty.const.GLOSSAIRE_ENT_SHORTDEF]}>             
            <h3  style="<{$catArr.css.gls_ent_shortdef}>"><{$entry.shortdefMagnifed}></h3>
        <{/if}>
    <{else}> 
        <h2   style="<{$catArr.css.gls_ent_term}>float:left;<{$catArr.term_css}>"><{if $showId}>[#<{$entry.id}>]-<{/if}><{$entry.term}></h2>
        <{if $entry.shortdef AND $catArr.show_bin[$smarty.const.GLOSSAIRE_ENT_SHORTDEF]}>          
            <h3  style="<{$catArr.css.gls_ent_shortdef}>">&nbsp;:&nbsp;<{$entry.shortdefMagnifed}></h3>
        <{/if}>                  
    <{/if}>
    

<{* ---------- Affichage de boutons image pour gerer l entree -----------*}>
<{if ($posButtonsActions & 1) > 0}>
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
<{/if}>
</div>

<{* ---------- data de l entree -----------*}>
<div class="item-round-no <{$colors_set}>-item-body" style="padding:6px;margin-top:-5px;float:none;"><br></div>
<div class="item-round-no <{$colors_set}>-item-body" style="padding:6px;margin-top:-5px;float:none;">
    <{if $entry.definition_img AND $catArr.show_bin[$smarty.const.GLOSSAIRE_ENT_DEFINITION]}>
        <div  style="<{$catArr.css.gls_ent_definition}>">
            <{$entry.definition_img}>
        </div>
    <{/if}>
    <{if $entry.reference AND $catArr.show_bin[$smarty.const.GLOSSAIRE_ENT_REFERENCE]}>
        <span class="gls_subtitle"><{$smarty.const._MA_GLOSSAIRE_REFERENCES}> : </span><br>
        <span style="<{$catArr.css.gls_ent_reference}>"><{$entry.reference}></span><br>
    <{/if}>
    <{if $entry.urls AND $catArr.show_bin[$smarty.const.GLOSSAIRE_ENT_URLS]}>
        <span  class="gls_subtitle"><{$smarty.const._MA_GLOSSAIRE_SEEALSO}> : </span>
        <span style="<{$catArr.css.gls_ent_urls}>"><{$entry.urls}></span>
    <{/if}>
    <{if $entry.email AND $catArr.show_bin[$smarty.const.GLOSSAIRE_ENT_EMAIL]}>
        <br><br><span class="gls_subtitle"><{$smarty.const._MA_GLOSSAIRE_CONTACT}> : </span>
        <span style="<{$catArr.css.gls_ent_email}>"><{$entry.email}></span><br>
    <{/if}>
    <{if $entry.file_name AND $catArr.show_bin[$smarty.const.GLOSSAIRE_ENT_FILE_NAME]}>
        <br><br><span class="gls_subtitle"><{$smarty.const._MA_GLOSSAIRE_FILE_LINKED}> : </span><br>
        <span style="<{$catArr.css.gls_ent_files_joins}>"><{$entry.file_link}></span><br>
    <{/if}>
    

    <{if $entry.creator AND $catArr.show_bin[$smarty.const.GLOSSAIRE_ENT_CREATOR]}>
        <br><span class="gls_subtitle"><{$smarty.const._AM_GLOSSAIRE_CREATOR}> : </span>
        <span style="<{$catArr.css.gls_ent_creator}>"><{$entry.creator}></span>
    <{/if}>
    <{if $catArr.show_bin[$smarty.const.GLOSSAIRE_ENT_COUNTER]}>
        <br><span class="gls_subtitle"><{$smarty.const._AM_GLOSSAIRE_ENT_COUNTER}> : </span>
        <span style="<{$catArr.css.gls_ent_counter}>"><{$entry.counter}></span>
    <{/if}>
    
    <{if $catArr.show_bin[$smarty.const.GLOSSAIRE_ENT_DATE_CREATION]}>
        <br><span class="gls_subtitle"><{$smarty.const._AM_GLOSSAIRE_ENT_DATE_CREATION}> : </span>
        <span style="<{$catArr.css.gls_ent_dates}>"><{$entry.date_creation}></span>
    <{/if}>
    
    <{if $catArr.show_bin[$smarty.const.GLOSSAIRE_ENT_DATE_UPDATE]}>
        <br><span class="gls_subtitle"><{$smarty.const._AM_GLOSSAIRE_ENT_DATE_UPDATE}> : </span>
        <span style="<{$catArr.css.gls_ent_dates}>"><{$entry.date_update}></span>
    <{/if}>
    
</div>
 
<{* ---------- Affichage des boutons image pour gerer l entree -----------*}>
<{if ($posButtonsActions & 2)>0}>
    <a href="#haut_de_page">
      <img src="<{xoModuleIcons16 ASC.png}>" class="gls_button gls_buttonTop" title="<{$smarty.const._MA_GLOSSAIRE_TOP}>"></a>


    <{if $catPerms.approve}>
        <a href="entries.php?op=delete&amp;ent_id=<{$entry.ent_id}>" title="<{$smarty.const._DELETE}>">
           <img src="<{xoModuleIcons16 delete.png}>" class="gls_button" title="<{$smarty.const._DELETE}>"></a>
        <a href="entries.php?op=new&catIdSelect=<{$catIdSelect}>" title="<{$smarty.const._ADD}>">
           <img src="<{xoModuleIcons16 add.png}>" class="gls_button" title="<{$smarty.const._ADD}>"></a>
        <a href="entries.php?op=clone&ent_id_source=<{$entry.ent_id}>" title="<{$smarty.const._CLONE}>">
           <img src="<{xoModuleIcons16 editcopy.png}>" class="gls_button" title="<{$smarty.const._CLONE}>"></a>
        <a href="entries.php?op=edit&ent_id=<{$entry.ent_id}>&start=<{$start}>&limit=<{$limit}>">
          <img src="<{xoModuleIcons16 edit.png}>" class="gls_button" title="<{$smarty.const._EDIT}>"></a>
    <{/if}>
<{/if}>


<div class="item-round-no <{$colors_set}>-item-body" style="padding:1px;margin-top:0px;">
    <{if !$smarty.foreach.entry.last}><hr class="<{$colors_set}>-hr-style-two"><{else}><br><{/if}>
</div>
<{*  ------------------------------------------------------------------ *}>
<{if $smarty.const.GLOSSAIRE_SHOW_TPL_NAME==1}>
<{assign var=tplHierarchie value=$tplHierarchie-1}>
<div style="text-align: center; background-color: grey;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
