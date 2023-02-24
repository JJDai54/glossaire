<{if $smarty.const.GLOSSAIRE_SHOW_TPL_NAME==1}>
<{if !$tplHierarchie}><{assign var=tplHierarchie value=1}><{else}><{assign var=tplHierarchie value=$tplHierarchie+1}><{/if}>
<div style="text-align: center; background-color: black;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
<{*  ------------------------------------------------------------------ *}>

<{if $catArr.show_terms_index > 0}>

<table width='100%'>
    <tr>
      <td width='<{$catArr.colWidth}>%'>
      
        <{foreach item=entry from=$entries  name=entriesList}>
          <{if $smarty.foreach.entriesList.index > 0}>
            <{if $smarty.foreach.entriesList.index % $catArr.nbEntriesByCol == 0}></td><td width='<{$catArr.colWidth}>%'><{/if}>
          <{/if}>
          <span style='margin:0px 12px 0px 0px;'>
          <a href="#entry-<{$entry.id}>" title="" alt="" >
          <{$entry.term}> 
          </a></span><br>
        <{/foreach}>
      </td>
    </tr>
</table>


<{else}>

<hr class='<{$colors_set}>-hr-style-two'>   
  <{foreach item=entry from=$entries name=entriesList}>
    <{if $smarty.foreach.entriesList.first}>|<{/if}>
    <span style='margin:0px 12px 0px 0px;'>
    <a href="#entry-<{$entry.id}>" title="" alt="" >
        <{$entry.term}> 
    </a></span>|
  <{/foreach}>
<hr class='<{$colors_set}>-hr-style-two'>

<{*  ------------------------------------------------------------------ *}>
<{if $smarty.const.GLOSSAIRE_SHOW_TPL_NAME==1}>
<{assign var=tplHierarchie value=$tplHierarchie-1}>
<div style="text-align: center; background-color: grey;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
<{/if}>
