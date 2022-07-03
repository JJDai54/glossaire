<{if $smarty.const.GLOSSAIRE_SHOW_TPL_NAME==1}>
<{if !$tplHierarchie}><{assign var=tplHierarchie value=1}><{else}><{assign var=tplHierarchie value=$tplHierarchie+1}><{/if}>
<div style="text-align: center; background-color: black;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>


<{*  ------------------------------------------------------------------ *}>
<{include file='db:glossaire_header.tpl' }>

<{if !$form}>

<div class='table-responsive'>
<{if $catIdSelect}>
<form name='select_filter' id='select_filter' action='entries.php' method='post' onsubmit='return xoopsFormValidate_form();' enctype=''>
<input type="hidden" name="op" value="list" />
<input type="hidden" name="sender" value="0" />
<{* <{$smarty.const._CO_GLOSSAIRE_CATEGORY}> : <{$catIdSelect}> *}>
</form>
<{/if}>
<{*  ------------------------------------------------------------------ *}>
<a name="haut_de_page" id="haut_de_page"></a>
<{assign var="colors_set" value=$catSelected.colors_set}>
<{if $nbCategories > 1}>
    <{include file="db:glossaire_categories_colors_set.tpl"}>
    <div class="item-round-topleft-no <{$colors_set}>-itemHead" style="padding:12px;margin-top:-5px;color:white;">
<{else}>    
    <div class="item-round-top <{$colors_set}>-itemHead" style="padding:12px;margin-top:-5px;color:white;">
<{/if}>

        <{if $catSelected.description_img}><{$catSelected.description_img}><{/if}>
</div>
<{*  ------------------------------------------------------------------ *}>

<div class="item-round-no <{$colors_set}>-itemHead" style="padding:6px;margin-top:-5px;text-align:right;">
 
<style>
.gls_btn_icon{
  width:150px;height:30px;
  -moz-border-radius: 8px 8px 8px 8px;
  -webkit-border-radius: 8px 8px 8px 8px;
  -khtml-border-radius: 8px 8px 8px 8px;
  border-radius: 8px 8px 8px 8px;
}
.gls_btn_img{
    margin-left:8px;
    margin-right:8px;
}
</style>
 
<div style='float: left;color:black;'> 
  <form name='gls_search' id='gls_search' action='entries.php' method='post' enctype=''>
    <input type="hidden" name="op" value="<{$searchMode}>" />
    <input type="hidden" name="start" value="0" />
    <input type="hidden" name="letter" value="+" />
    <input type="hidden" name="exp2search" value="<{$exp2search}>" />
    <input type="hidden" name="catIdSelect" value="<{$catIdSelect}>" />
    
    <input type="text" id="exp2search" name="exp2search" required  minlength="4" maxlength="30" size="30" value='<{$exp2search}>'>  
    <button  type="submit" class="gls_btn_icon">
        <img src="<{xoModuleIcons16 search.png}>" title="<{$smarty.const._SEARCH}>" class='gls_btn_img'><{$smarty.const._MA_GLOSSAIRE_ENTRY_SEARCH}>
    </button>
  </form>
</div>

<{if $catPerms.approve OR $catPerms.submit}>
  <div style='color:black;'> 
    <form name='gls_addnew' id='gls_addnew' action='entries.php' method='post' enctype=''>
      <input type="hidden" name="op" value="<{if $catPerms.approve}>new<{else}>new_light<{/if}>" />         
      <input type="hidden" name="catIdSelect" value="<{$catIdSelect}>" />
      <input type="hidden" name="statusAccess" value="<{$statusAccess}>" />
      <button  type="submit" class="gls_btn_icon" style='width:250px;' onclick="">
          <img src="<{xoModuleIcons16 add.png}>" title="<{$smarty.const._ADD}>" class='gls_btn_img'>
          <{if $catPerms.approve}><{$smarty.const._MA_GLOSSAIRE_ENTRY_NEW}><{elseif $catPerms.submit}><{$smarty.const._MA_GLOSSAIRE_ENTRY_SOUMETTRE}><{/if}>
      </button>
    </form>
  </div>
<{else}>&nbsp;<{/if}>
  
</div> 
 
 
<div class="item-round-no <{$colors_set}>-itemBody" style="padding:12px;margin-top:-5px;color:white;">      
    <center><{$alphaBarre}>
      <{if $pagenav|default:''}>
          <div class="pagenav pagenav-container"><{$pagenav}></div>
      <{/if}>
    </center>

<{if $catSelected.show_terms_index}>    
    <{include file='db:glossaire_entries_terms_links.tpl' }>
<{/if}>
</div> 
    
<{if $entriesCount|default:0 > 0}>
<div class="item-round-no <{$colors_set}>-itemHead" style="padding:12px;margin-top:-5px;">
</div>

    <{foreach item=entry from=$entries name=entry}>
            <{include file='db:glossaire_entries_item-02.tpl' }>
    <{/foreach}>

    <{* ------------- Barre de navigation  --------------------*}>
<{/if}>
    <div class="item-round-no <{$colors_set}>-itemHead" style="padding:12px;margin-top:-5px;"></div>
    <div class="item-round-bottom <{$colors_set}>-itemBody" style="padding:12px;margin-top:-5px;">
    <center><{$alphaBarre}>
      <{if $pagenav|default:''}>
          <div class="pagenav pagenav-container"><{$pagenav}></div>
      <{/if}>
    </center>
</div>
<br>

</div>

<{else}>
    <{* ------------- Formulaire d'édition --------------------*}>
    <div class="item-round-top <{$colors_set}>-itemHead" style="padding:12px;margin-top:-5px;">
        <{$cat_name}>
    </div>
    <div class="item-round-no <{$colors_set}>-itemBody" style="padding:12px;margin-top:-5px;">
        <{$form|default:false}>
    </div>
    <div class="item-round-bottom <{$colors_set}>-itemFoot" style="padding:12px;margin-top:-5px;"><center>...</center></div>
<{/if}>
    
<{if $error|default:''}>
      <{$error|default:false}>
<{/if}>

<{include file='db:glossaire_footer.tpl' }>

<{*  ------------------------------------------------------------------ *}>
<{if $smarty.const.GLOSSAIRE_SHOW_TPL_NAME==1}>
<{assign var=tplHierarchie value=$tplHierarchie-1}>
<div style="text-align: center; background-color: grey;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
