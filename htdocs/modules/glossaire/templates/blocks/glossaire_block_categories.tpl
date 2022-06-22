<table class='table table-<{$table_type|default:false}>'>
    <thead>
        <tr class='head'>
            <th>&nbsp;</th>
            <th class='center'><{$smarty.const._MB_GLOSSAIRE_CAT_NAME}></th>
            <th class='center'><{$smarty.const._MB_GLOSSAIRE_CAT_DESCRIPTION}></th>
            <th class='center'><{$smarty.const._MB_GLOSSAIRE_CAT_TOTAL}></th>
            <th class='center'><{$smarty.const._MB_GLOSSAIRE_CAT_WEIGHT}></th>
            <th class='center'><{$smarty.const._MB_GLOSSAIRE_CAT_LOGOURL}></th>
            <th class='center'><{$smarty.const._MB_GLOSSAIRE_CAT_DATE_CREATION}></th>
            <th class='center'><{$smarty.const._MB_GLOSSAIRE_CAT_DATE_UPDATE}></th>
        </tr>
    </thead>
    <{if count($block)}>
    <tbody>
        <{foreach item=category from=$block}>
        <tr class='<{cycle values="odd, even"}>'>
            <td class='center'><{$category.id}></td>
            <td class='center'><{$category.name}></td>
            <td class='center'><{$category.description}></td>
            <td class='center'><{$category.total}></td>
            <td class='center'><{$category.weight}></td>
            <td class='center'><img src="<{xoModuleIcons32}><{$category.logourl}>" alt="categories" ></td>
            <td class='center'><{$category.date_creation}></td>
            <td class='center'><{$category.date_update}></td>
            <td class='center'><a href='categories.php?op=show&amp;cat_id=<{$category.id}>' title='<{$smarty.const._MB_GLOSSAIRE_CATEGORY_GOTO}>'><{$smarty.const._MB_GLOSSAIRE_CATEGORY_GOTO}></a></td>
        </tr>
        <{/foreach}>
    </tbody>
    <{/if}>
    <tfoot><tr><td>&nbsp;</td></tr></tfoot>
</table>
