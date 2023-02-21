<{if $smarty.const.GLOSSAIRE_SHOW_TPL_NAME==1}>
<{if !$tplHierarchie}><{assign var=tplHierarchie value=1}><{else}><{assign var=tplHierarchie value=$tplHierarchie+1}><{/if}>
<div style="text-align: center; background-color: black;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
<{*  ------------------------------------------------------------------ *}>
<div class="panel-heading">
    <h3 class="panel-title"><{$entry.cat_id}></h3>
    <h3 class="panel-title"><{$entry.uid}></h3>
</div>
<div class="panel-body">
    <span class="col-sm-9 justify"><{$entry.uid}></span>
    <span class="col-sm-9 justify"><{$entry.term}></span>
    <span class="col-sm-9 justify"><{$entry.shortdef}></span>
    <span class="col-sm-9 justify"><{$entry.definition}></span>
    <span class="col-sm-9 justify"><{$entry.reference}></span>
    <span class="col-sm-9 justify"><{$entry.url1}></span>
    <span class="col-sm-9 justify"><{$entry.url2}></span>
    <span class="col-sm-9 justify"><{$entry.date_creation}></span>
</div>
<div class="panel-foot">
    <span class="col-sm-12"><a class="btn btn-primary" href="entries.php?op=show&amp;ent_id=<{$entry.ent_id}>" title="<{$smarty.const._MA_GLOSSAIRE_DETAILS}>"><{$smarty.const._MA_GLOSSAIRE_DETAILS}></a></span>
</div>

<{*  ------------------------------------------------------------------ *}>
<{if $smarty.const.GLOSSAIRE_SHOW_TPL_NAME==1}>
<{assign var=tplHierarchie value=$tplHierarchie-1}>
<div style="text-align: center; background-color: grey;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
