<{if $smarty.const.GLOSSAIRE_SHOW_TPL_NAME==1}>
<{if !$tplHierarchie}><{assign var=tplHierarchie value=1}><{else}><{assign var=tplHierarchie value=$tplHierarchie+1}><{/if}>
<div style="text-align: center; background-color: black;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
<{*  ------------------------------------------------------------------ *}>
<{include file="db:glossaire_header.tpl" }>

<{if $categoriesCount|default:0 > 0}>
<div class="table-responsive">
    <table class="table table-<{$table_type|default:false}>">
        <thead>
            <tr class="head">
                <th ><{$smarty.const._MA_GLOSSAIRE_CATEGORIES_TITLE}></th>
            </tr>
        </thead>
        <tbody>
                <{foreach item=category from=$categories name=category}>
            <tr>
                <td>
                    <div class="panel panel-<{$panel_type|default:false}>">
                        <{include file="db:glossaire_categories_item.tpl" }>
                    </div>
                </td>
            </tr>
                <{/foreach}>
        </tbody>
        <tfoot><tr><td>&nbsp;</td></tr></tfoot>
    </table>
</div>
<{/if}>
<{if $form|default:""}>
    <{$form|default:false}>
<{/if}>
<{if $error|default:""}>
    <{$error|default:false}>
<{/if}>

<{include file="db:glossaire_footer.tpl" }>

<{*  ------------------------------------------------------------------ *}>
<{if $smarty.const.GLOSSAIRE_SHOW_TPL_NAME==1}>
<{assign var=tplHierarchie value=$tplHierarchie-1}>
<div style="text-align: center; background-color: grey;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
