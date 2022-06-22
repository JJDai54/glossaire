<!-- Header -->
<{include file='db:glossaire_admin_header.tpl' }>

<form name='select_filter' id='select_filter' action='entries.php' method='post' onsubmit='return xoopsFormValidate_form();' enctype=''>
<input type="hidden" name="op" value="list" />
<input type="hidden" name="sender" value="0" />
<{$smarty.const._CO_GLOSSAIRE_CATEGORY}> : <{$catIdSelect}>
<{$smarty.const._CO_GLOSSAIRE_STATUS}> : <{$statusSelect}>
</form>

<{if $entries_list|default:''}>
    <div class="clear">&nbsp;</div>
    <{if $pagenav|default:''}>
        <div class="xo-pagenav floatright"><{$pagenav|default:false}></div>
        <div class="clear spacer"></div>
    <{/if}>
    <table class='table table-bordered' name='entries_list' id = 'entries_list'>
        <thead>
            <tr class='head'>
                <th class="center"><{$smarty.const._AM_GLOSSAIRE_ENTRY_ID}></th>
                <{* <th class="center"><{$smarty.const._AM_GLOSSAIRE_ENTRY_CAT_ID}></th> *}>
                <th class="center"><{$smarty.const._AM_GLOSSAIRE_CREATOR}></th>
                <th class="center"><{$smarty.const._AM_GLOSSAIRE_ENTRY_INITIALE}></th>
                <th class="center"><{$smarty.const._AM_GLOSSAIRE_ENTRY_TERM}></th>
                <th class="center"><{$smarty.const._AM_GLOSSAIRE_ENTRY_IMAGE}></th>
                <th class="center"><{$smarty.const._AM_GLOSSAIRE_ENTRY_SHORTDEF}></th>
                <{* <th class="center"><{$smarty.const._AM_GLOSSAIRE_ENTRY_DEFINITION}></th> *}>
                <{* <th class="center"><{$smarty.const._AM_GLOSSAIRE_ENTRY_REFERENCES}></th> *}>
                <{* <th class="center"><{$smarty.const._AM_GLOSSAIRE_ENTRY_URL1}></th> *}>
                <{* ><th class="center"><{$smarty.const._AM_GLOSSAIRE_ENTRY_URL2}></th> *}>
                <th class="center"><{$smarty.const._AM_GLOSSAIRE_ENTRY_DATE_CREATION}></th>
                <th class="center"><{$smarty.const._AM_GLOSSAIRE_ENTRY_DATE_UPDATE}></th>
                <th class="center"><{$smarty.const._AM_GLOSSAIRE_ENTRY_COUNTER}></th>
                <th class="center"><{$smarty.const._AM_GLOSSAIRE_ENTRY_STATUS}></th>
                <{* <th class="center"><{$smarty.const._AM_GLOSSAIRE_ENTRY_FLAG}></th> *}>
                <th class="center width5"><{$smarty.const._AM_GLOSSAIRE_FORM_ACTION}></th>
            </tr>
        </thead>
        <{if $entries_count|default:''}>
        <tbody>
            <{foreach item=entry from=$entries_list}>
            <tr class='<{cycle values='odd, even'}>'>
                <td class='center'><{$entry.cat_id}>/<{$entry.id}></td>
                <{* <td class='center'><{$entry.cat_id}></td> *}>
                <td class='center'><{$entry.creator}></td>
                <td class='center width5'><{$entry.initiale}></td>
                <td class='left'>
                    <a href="entries.php?op=edit&amp;ent_id=<{$entry.id}>&amp;start=<{$start}>&amp;limit=<{$limit}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>">
                    <{$entry.term}>
                    </a>
                </td>
                <td class='left'><{$entry.image}></td>
                <td class='left'>
                    <{if $entry.shortdefMagnifed}>
                    <a href="entries.php?op=incrementField&field=ent_is_acronym&catIdSelect=<{$entry.ent_cat_id}>&ent_id=<{$entry.id}>&start=<{$start}>&limit=<{$limit}>" title="">
                        <img src='<{$modPathIcon16}>/bool-<{$entry.is_acronym}>.gif'>
                    </a>
                    <{/if}>
                <{$entry.shortdefMagnifed}>
                </td>
                <{* <td class='left'><{$entry.definition_short}></td> *}>
                <{* <td class='center'><{$entry.reference_short}></td> *}>
                <{* <td class='center'><{$entry.url1}></td> *}>
                <{* <td class='center'><{$entry.url2}></td> *}>
                <td class='center'><{$entry.date_creation}></td>
                <td class='center'><{$entry.date_update}></td>
                <td class='center'><{$entry.counter}></td>
                <td class='center'>
                    <a href="entries.php?op=changeStatus&catIdSelect=<{$entry.ent_cat_id}>&ent_id=<{$entry.id}>&start=<{$start}>&limit=<{$limit}>&statusIdSelect=<{$statusIdSelect}>" title="">
                        <img src='<{$modPathIcon16}>/status-<{$entry.status}>.png'>
                    </a>
                </td>
                
                <{* <td class='center'><{$entry.flag}></td> *}>
                <td class="center  width5">
                    <a href="entries.php?op=edit&amp;ent_id=<{$entry.id}>&amp;start=<{$start}>&amp;limit=<{$limit}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}> entries" ></a>
                    <a href="entries.php?op=clone&amp;ent_id_source=<{$entry.id}>" title="<{$smarty.const._CLONE}>"><img src="<{xoModuleIcons16 editcopy.png}>" alt="<{$smarty.const._CLONE}> entries" ></a>
                    <a href="entries.php?op=delete&ent_id=<{$entry.id}>&start=<{$start}>&statusIdSelect=<{$statusIdSelect}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}> entries" ></a>
                </td>
            </tr>
            <{/foreach}>
        </tbody>
        <{/if}>
    </table>
    <div class="clear">&nbsp;</div>
    <{if $pagenav|default:''}>
        <div class="xo-pagenav floatright"><{$pagenav|default:false}></div>
        <div class="clear spacer"></div>
    <{/if}>
<{/if}>
<{if $form|default:''}>
    <{$form|default:false}>
<{/if}>
<{if $error|default:''}>
    <div class="errorMsg"><strong><{$error|default:false}></strong></div>
<{/if}>

<script>
tth_set_value('last_asc', true);
tth_trierTableau('entries_list', 4, "1,2,3,4,5,6,7,8,9,10,11");  
</script>

<!-- Footer -->
<{include file='db:glossaire_admin_footer.tpl' }>
