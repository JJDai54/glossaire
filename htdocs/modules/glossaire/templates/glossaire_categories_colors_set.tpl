<div class='gls_title fwj-contenair-onglets' style='margin-bottom:-5px'>

    <{foreach item=category from=$categories name=lpCat}>&nbsp;&nbsp;
          <div class="fwj-onglets <{$category.colors_set}>-item-legend" >
            <h1><a href="<{$smarty.const.GLOSSAIRE_URL}>/<{$page2redirect}>?catIdSelect=<{$category.id}>" >
              <{if $showId}>[#<{$category.id}>]-<{/if}><{$category.name}>
            </a></h1>

          </div>
         <{if !$smarty.foreach.lpCat.last}><div class="fwj-onglets2" ></div><{/if}>

    <{/foreach}>
</div>
