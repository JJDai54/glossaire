<{if $smarty.const.GLOSSAIRE_SHOW_TPL_NAME==1}>
<{if !$tplHierarchie}><{assign var=tplHierarchie value=1}><{else}><{assign var=tplHierarchie value=$tplHierarchie+1}><{/if}>
<div style="text-align: center; background-color: black;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
<{*  ------------------------------------------------------------------ *}>

<{if $catArr.show_terms_index > 0}>
                             
  <hr class='<{$colors_set}>-hr-style-two'>   
  <table width='100%' style="<{$catArr.css.gls_ent_index_table}>">
      <tr>
        <td width='<{$catArr.colWidth}>%'  style="<{$catArr.css.gls_ent_index_table}>">
        
          <{foreach item=entry from=$entries  name=entriesList}>
            <{if $smarty.foreach.entriesList.index > 0}>
              <{if $smarty.foreach.entriesList.index % $catArr.nbEntriesByCol == 0}>
                  </td>
                  <td width='<{$catArr.colWidth}>%'  style="<{$catArr.css.gls_ent_index_table}>">
              <{/if}>
            <{/if}>
            <span style='margin:0px 12px 0px 0px;'>
            <a href="#entry-<{$entry.id}>" title="" alt="" >
            <{$entry.term}> 
            </a></span><br>
          <{/foreach}>
        </td>
      </tr>
  </table>
  <hr class='<{$colors_set}>-hr-style-two'>   

  
<{else}>
    <hr class='<{$colors_set}>-hr-style-two'>   
    <div style="<{$catArr.css.gls_ent_index_div}>">
      <{foreach item=entry from=$entries name=entriesList}>
        <{if $smarty.foreach.entriesList.first}>|<{/if}>
        <span style='margin:0px 12px 0px 0px;'>
        <a href="#entry-<{$entry.id}>" title="" alt="" >
            <{$entry.term}> 
        </a></span>|
      <{/foreach}>
    </div>
    <hr class='<{$colors_set}>-hr-style-two'>
<{/if}>

<{*  ------------------------------------------------------------------ *}>
<{if $smarty.const.GLOSSAIRE_SHOW_TPL_NAME==1}>
<{assign var=tplHierarchie value=$tplHierarchie-1}>
<div style="text-align: center; background-color: grey;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
