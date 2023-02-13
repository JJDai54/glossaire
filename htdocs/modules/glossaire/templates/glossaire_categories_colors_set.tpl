<{if $smarty.const.GLOSSAIRE_SHOW_TPL_NAME==1}>
<{if !$tplHierarchie}><{assign var=tplHierarchie value=1}><{else}><{assign var=tplHierarchie value=$tplHierarchie+1}><{/if}>
<div style="text-align: center; background-color: black;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
<{*  ------------------------------------------------------------------ *}>

<div class='fwj-contenair-onglets' style='margin-bottom:-5px'>
    <{if $showBtnAllCategorys}>
      <div class="fwj-onglets">
        <a href="<{$smarty.const.GLOSSAIRE_URL}><{$page2redirect}>" >
          <{$smarty.const._ALL}>
        </a>
      </div>
    <{/if}>

    <{foreach item=category from=$categories name=lpCat}>&nbsp;&nbsp;
          <div class="fwj-onglets <{$category.colors_set}>-item-legend" >
            <a href="<{$smarty.const.GLOSSAIRE_URL}>/<{$page2redirect}>?catIdSelect=<{$category.id}>" >
              <{if $showId}>[#<{$category.id}>]-<{/if}><{$category.name}>
            </a>

          </div>
         <{if !$smarty.foreach.lpCat.last}><div class="fwj-onglets2" ></div><{/if}>

    <{/foreach}>
</div>

<{*  ------------------------------------------------------------------ *}>
<{if $smarty.const.GLOSSAIRE_SHOW_TPL_NAME==1}>
<{assign var=tplHierarchie value=$tplHierarchie-1}>
<div style="text-align: center; background-color: grey;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
