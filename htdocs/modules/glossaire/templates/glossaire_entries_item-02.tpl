<{if $smarty.const.GLOSSAIRE_SHOW_TPL_NAME==1}>
<{if !$tplHierarchie}><{assign var=tplHierarchie value=1}><{else}><{assign var=tplHierarchie value=$tplHierarchie+1}><{/if}>
<div style="text-align: center; background-color: black;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
<{*  ------------------------------------------------------------------ *}>

<div name="entry-<{$entry.id}>" id="entry-<{$entry.id}>" class="gls_title gls_ent_term item-round-no <{$colors_set}>-item-body" style="vertical-align: baseline;padding:6px;margin-top:0px;">
    <{if $cat_br_after_term}>
        <h2 style="<{$catArr.css.gls_ent_term}>"><{if $showId}>[#<{$entry.id}>]-<{/if}><{$entry.term}></h2>
        <{if $entry.shortdef AND $catArr.show_bin[$smarty.const.GLOSSAIRE_ENT_SHORTDEF]}>             
            <h3  style="<{$catArr.css.gls_ent_shortdef}>"><{$entry.shortdefMagnifed}></h3>
        <{/if}>
    <{else}> 
        <h2   style="<{$catArr.css.gls_ent_term}>float:left;"><{if $showId}>[#<{$entry.id}>]-<{/if}><{$entry.term}></h2>
        <{if $entry.shortdef AND $catArr.show_bin[$smarty.const.GLOSSAIRE_ENT_SHORTDEF]}>          
            <h3  style="<{$catArr.css.gls_ent_shortdef}>">&nbsp;:&nbsp;<{$entry.shortdefMagnifed}></h3>
        <{/if}>                  
    <{/if}>
    

<{* ---------- Affichage de boutons image pour gerer l entree -----------*}>
<{if $catArr.show_bin[$smarty.const.GLOSSAIRE_ENT_BTN_ACTIONS_TOP]}> 
    <{include file="db:glossaire_entries_item_btn.tpl" }>
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
        <br><br><span class="gls_subtitle"><{$smarty.const._MA_GLOSSAIRE_REFERENCES}> : </span>
        <span style="<{$catArr.css.gls_ent_reference}>"><{$entry.reference}></span>
    <{/if}>
    <{if $entry.urls AND $catArr.show_bin[$smarty.const.GLOSSAIRE_ENT_URLS]}>
        <br><br><span  class="gls_subtitle"><{$smarty.const._MA_GLOSSAIRE_SEEALSO}> : </span>
        <span style="<{$catArr.css.gls_ent_urls}>"><{$entry.urls}></span>
    <{/if}>
    <{if $entry.email AND $catArr.show_bin[$smarty.const.GLOSSAIRE_ENT_EMAIL]}>
        <br><span class="gls_subtitle"><{$smarty.const._MA_GLOSSAIRE_CONTACT}> : </span>
        <span style="<{$catArr.css.gls_ent_email}>"><{$entry.email}></span>
    <{/if}>
    <{if $entry.file_name AND $catArr.show_bin[$smarty.const.GLOSSAIRE_ENT_FILE_NAME]}>
        <br><span class="gls_subtitle"><{$smarty.const._MA_GLOSSAIRE_FILE_LINKED}> : </span>
        <span style="<{$catArr.css.gls_ent_files_joins}>"><{$entry.file_link}></span>
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
<{if $catArr.show_bin[$smarty.const.GLOSSAIRE_ENT_BTN_ACTIONS_BOTTOM]}>
    <{include file="db:glossaire_entries_item_btn.tpl" }>
<{/if}>


<div class="item-round-no <{$colors_set}>-item-body" style="padding:1px;margin-top:0px;">
    <{if !$smarty.foreach.entry.last}><hr class="<{$colors_set}>-hr-style-two"><{else}><br><{/if}>
</div>
<{*  ------------------------------------------------------------------ *}>
<{if $smarty.const.GLOSSAIRE_SHOW_TPL_NAME==1}>
<{assign var=tplHierarchie value=$tplHierarchie-1}>
<div style="text-align: center; background-color: grey;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
