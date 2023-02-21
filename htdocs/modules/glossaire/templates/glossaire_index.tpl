<{if $smarty.const.GLOSSAIRE_SHOW_TPL_NAME==1}>
<{if !$tplHierarchie}><{assign var=tplHierarchie value=1}><{else}><{assign var=tplHierarchie value=$tplHierarchie+1}><{/if}>
<div style="text-align: center; background-color: black;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
<{*  ------------------------------------------------------------------ *}>
<{include file="db:glossaire_header.tpl" }>

<!-- Start index list -->
<table>
    <thead>
        <tr class="center">
            <th><{$smarty.const._MA_GLOSSAIRE_TITLE}>  -  <{$smarty.const._MA_GLOSSAIRE_DESC}></th>
        </tr>
    </thead>
    <tbody>
        <tr class="center">
            <td class="bold pad5">
                <ul class="menu text-center">
                    <li><a href="<{$glossaire_url}>"><{$smarty.const._MA_GLOSSAIRE_INDEX}></a></li>
                    <li><a href="<{$glossaire_url}>/categories.php"><{$smarty.const._MA_GLOSSAIRE_CATEGORIES}></a></li>
                    <li><a href="<{$glossaire_url}>/entries.php"><{$smarty.const._MA_GLOSSAIRE_ENTRIES}></a></li>
                </ul>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr class="center">
            <td class="bold pad5">
                <{if $adv|default:""}><{$adv|default:false}><{/if}>
            </td>
        </tr>
    </tfoot>
</table>
<!-- End index list -->

<div class="glossaire-linetitle"><{$smarty.const._MA_GLOSSAIRE_INDEX_LATEST_LIST}></div>
<{if $categoriesCount|default:0 > 0}>
    <!-- Start show new categories in index -->
    <table class="table table-<{$table_type}>">
                    </tr><tr>
        <tr>
            <!-- Start new link loop -->
            <{foreach item=category from=$categories name=category}>
                <td class="col_width<{$numb_col}> top center">
                    <{include file="db:glossaire_categories_list.tpl" category=$category}>
                </td>
                <{if $smarty.foreach.category.iteration is div by $divideby}>
                    </tr><tr>
                <{/if}>
            <{/foreach}>
            <!-- End new link loop -->
        </tr>
    </table>
<{/if}>
<div class="glossaire-linetitle"><{$smarty.const._MA_GLOSSAIRE_INDEX_LATEST_LIST}></div>
<{if $entriesCount|default:0 > 0}>
    <!-- Start show new entries in index -->
    <table class="table table-<{$table_type}>">
                    </tr><tr>
        <tr>
            <!-- Start new link loop -->
            <{foreach item=entry from=$entries name=entry}>
                <td class="col_width<{$numb_col}> top center">
                    <{include file="db:glossaire_entries_list.tpl" entry=$entry}>
                </td>
                <{if $smarty.foreach.entry.iteration is div by $divideby}>
                    </tr><tr>
                <{/if}>
            <{/foreach}>
            <!-- End new link loop -->
        </tr>
    </table>
<{/if}>
<{include file="db:glossaire_footer.tpl" }>

<{*  ------------------------------------------------------------------ *}>
<{if $smarty.const.GLOSSAIRE_SHOW_TPL_NAME==1}>
<{assign var=tplHierarchie value=$tplHierarchie-1}>
<div style="text-align: center; background-color: grey;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
