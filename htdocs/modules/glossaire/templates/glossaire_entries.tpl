<{if $smarty.const._GLS_SHOW_TPL_NAME==1}>
<{if !$tplHierarchie}><{assign var=tplHierarchie value=1}><{else}><{assign var=tplHierarchie value=$tplHierarchie+1}><{/if}>
<div style="text-align: center; background-color: black;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
<{*  ------------------------------------------------------------------ *}>
<{include file='db:glossaire_header.tpl' }>

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
<{/if}>

    <div class="item-round-topleft-no <{$colors_set}>-itemHead" style="padding:12px;margin-top:-5px;color:white;">
        <{if $catSelected.description}><{$catSelected.description}><{/if}>
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
 
<div style='float: left;'> 
  <form name='gls_search' id='gls_search' action='entries.php' method='post' enctype=''>
    <input type="hidden" name="op" value="list" />
    <input type="hidden" name="start" value="0" />
    <input type="hidden" name="letter" value="+" />
    <input type="hidden" name="exp2search" value="<{$exp2search}>" />
    
    <input type="text" id="exp2search" name="exp2search" required  minlength="4" maxlength="25" size="20" value='<{$exp2search}>'>  
    <button  type="submit" class="gls_btn_icon">
        <img src="<{xoModuleIcons16 search.png}>" title="<{$smarty.const._SEARCH}>" class='gls_btn_img'><{$smarty.const._MA_GLOSSAIRE_ENTRY_SEARCH}>
    </button>
  </form>
</div>

<div> 
<{if $isCatAllowed}>
  <form name='gls_addnew' id='gls_addnew' action='entries.php' method='post' enctype=''>
    <input type="hidden" name="op" value="new" />
    <input type="hidden" name="catIdSelect" value="<{$catIdSelect}>" />
    <button  type="submit" class="gls_btn_icon" style='width:300px;' onclick="">
        <img src="<{xoModuleIcons16 add.png}>" title="<{$smarty.const._ADD}>" class='gls_btn_img'><{$smarty.const._MA_GLOSSAIRE_ENTRY_NEW}>
    </button>
  </form>
<{else}><br>
<{/if}> <{* //isCatAllowed *}>
</div>
  
</div> 
 
    </div> 
      
    
    <center><{$alphaBarre}>
      <{if $pagenav|default:''}>
          <table style='width:100border:none;border-collapse:collapse;'><tr><td width='50%'></td><td><{$pagenav}></td><td width='50%'></td></tr></table>
      <{/if}>
    </center>
<{if $catSelected.show_terms_index}>    
    <{include file='db:glossaire_entries_terms_links.tpl' }>
<{/if}>
    
<{if $entriesCount|default:0 > 0}>
<div class="item-round-no <{$colors_set}>-itemHead" style="padding:12px;margin-top:-5px;">
</div>

    <{foreach item=entry from=$entries name=entry}>

        <div class='panel panel-<{$panel_type|default:false}>'>
            <{include file='db:glossaire_entries_item-02.tpl' }>
        </div>
    <{/foreach}>

<{/if}>
    <center><{$alphaBarre}>
      <{if $pagenav|default:''}>
          <table style='width:100border:none;border-collapse:collapse;'><tr><td width='50%'></td><td><{$pagenav}></td><td width='50%'></td></tr></table>
      <{/if}>
    </center>
<br>

</div>

<{if $form|default:''}>
    <{$form|default:false}>
<{/if}>
<{if $error|default:''}>
    <{$error|default:false}>
<{/if}>

<{include file='db:glossaire_footer.tpl' }>

<{*  ------------------------------------------------------------------ *}>
<{if $smarty.const._GLS_SHOW_TPL_NAME==1}>
<{assign var=tplHierarchie value=$tplHierarchie-1}>
<div style="text-align: center; background-color: grey;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
