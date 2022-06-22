<{if $smarty.const._GLS_SHOW_TPL_NAME==1}>
<{if !$tplHierarchie}><{assign var=tplHierarchie value=1}><{else}><{assign var=tplHierarchie value=$tplHierarchie+1}><{/if}>
<div style="text-align: center; background-color: black;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
<{*  ------------------------------------------------------------------ *}>
<div class='panel-body'>
<span class='col-sm-2'><{$category.name}></span>

<span class='col-sm-3 justify'><{$category.description}></span>

<span class='col-sm-2'><{$category.total}></span>

<span class='col-sm-2'><{$category.weight}></span>

<span class='col-sm-3'><img src='<{$xoops_icons32_url|default:false}>/<{$category.logourl}>' alt='categories' ></span>

<span class='col-sm-2'><{$category.date_creation}></span>

<span class='col-sm-2'><{$category.date_update}></span>

</div>

<div class='panel-body'>
<span class='col-sm-2'><{$entry.uid}></span>

<span class='col-sm-2'><{$entry.term}></span>

<span class='col-sm-2'><{$entry.shortdef}></span>

<span class='col-sm-3 justify'><{$entry.definition}></span>

<span class='col-sm-3 justify'><{$entry.reference}></span>

<span class='col-sm-2'><{$entry.url1}></span>

<span class='col-sm-2'><{$entry.url2}></span>

<span class='col-sm-2'><{$entry.date_creation}></span>

</div>


<{*  ------------------------------------------------------------------ *}>
<{if $smarty.const._GLS_SHOW_TPL_NAME==1}>
<{assign var=tplHierarchie value=$tplHierarchie-1}>
<div style="text-align: center; background-color: grey;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
