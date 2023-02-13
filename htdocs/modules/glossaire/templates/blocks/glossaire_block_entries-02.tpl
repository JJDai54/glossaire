<table class='table table-<{$table_type|default:false}>'>
    <thead>
        <tr class='head'>
            <th>&nbsp;</th>
            <{* <th class='center'><{$smarty.const._MB_GLOSSAIRE_ENT_CAT_ID}></th> *}>
            <{* <th class='center'><{$smarty.const._MB_GLOSSAIRE_ENT_UID}></th> *}>
            <th class='center'><{$smarty.const._MB_GLOSSAIRE_ENT_TERM}></th>
            <th class='center'><{$smarty.const._MB_GLOSSAIRE_ENT_SHORTDEF}></th>
            <{* <th class='center'><{$smarty.const._MB_GLOSSAIRE_ENT_DEFINITION}></th> *}>
            <{* <th class='center'><{$smarty.const._MB_GLOSSAIRE_ENT_REFERENCE}></th> *}>
            <th class='center'><{$smarty.const._MB_GLOSSAIRE_ENT_COUNTER}></th>
        </tr>
    </thead>
    <{if count($block)}>
    <tbody>
        <{foreach item=entry from=$block}>
        <tr class='<{cycle values="odd, even"}>'>
            <{* <td class='center'><{$entry.id}></td> *}>
            <td class='center'><{$entry.cat_id}></td>
            <{* <td class='center'><{$entry.uid}></td> *}>
            <td class='left'>
                <a href='<{$glossaire_url}>/entries.php?op=list&catIdSelect=<{$entry.cat_id}>&exp2search=<{$entry.term}>&letter=+' title='<{$smarty.const._MB_GLOSSAIRE_ENTRY_GOTO}>'>
                    <{$entry.term}>
                </a>
            </td>
            <td class='left'><{$entry.shortdef}></td>
            <{* <td class='center'><{$entry.definition}></td> *}>
            <{* <td class='center'><{$entry.reference}></td> *}>
            <td class='center'><{$entry.counter}></td>
            <{* <td class='center'> 
                <a href='entries.php?op=show&ent_id=<{$entry.id}>' title='<{$smarty.const._MB_GLOSSAIRE_ENTRY_GOTO}>'>
                    <{$smarty.const._MB_GLOSSAIRE_ENTRY_GOTO}>
                </a>
            </td>
            *}>
        </tr>
        <{/foreach}>
    </tbody>
    <{/if}>
    <tfoot><tr><td>&nbsp;</td></tr></tfoot>
</table>
