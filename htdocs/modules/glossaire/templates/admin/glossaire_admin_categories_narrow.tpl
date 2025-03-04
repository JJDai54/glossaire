<!-- Header -->
<{include file="db:glossaire_admin_header.tpl" }>
<{assign var="fldImg" value="blue"}>
<{assign var="styleParent" value=""}>

<{if $categories_list|default:""}>
    <table id="categories_list" name="categories_list"class="table table-bordered">
        <thead>
            <tr class="head">
                <th class="center"><{$smarty.const._AM_GLOSSAIRE_CATEGORY_ID}></th>
                <th class="center"><{$smarty.const._AM_GLOSSAIRE_CATEGORY_NAME}> / <{$smarty.const._AM_GLOSSAIRE_CATEGORY_FOLDER}></th>
                <th class="center"><{$smarty.const._AM_GLOSSAIRE_CATEGORY_ACTIVE}></th>
<{*                 <th class="center"><{$smarty.const._AM_GLOSSAIRE_CATEGORY_FOLDER}></th> *}>
                <th class="center"><{$smarty.const._AM_GLOSSAIRE_CATEGORY_DESCRIPTION}></th>
                <{* <th class="center"><{$smarty.const._AM_GLOSSAIRE_CATEGORY_TOTAL}></th> *}>
                <th class="center"><{$smarty.const._AM_GLOSSAIRE_CATEGORY_WEIGHT}></th>
                <th class="center"><{$smarty.const._AM_GLOSSAIRE_CATEGORY_LOGO}></th>
                <th class="center"><{$smarty.const._AM_GLOSSAIRE_CATEGORY_COLOR_SET}></th>
                <th class="center"><{$smarty.const._AM_GLOSSAIRE_CATEGORY_ENTRIES}></th>
                <th class="center"><{$smarty.const._AM_GLOSSAIRE_CATEGORY_DATE_CREATION}> / <{$smarty.const._AM_GLOSSAIRE_CATEGORY_DATE_UPDATE}></th>
                <{* <th class="center"><{$smarty.const._AM_GLOSSAIRE_CATEGORY_DATE_UPDATE}></th> *}>
                <th class="center width5"><{$smarty.const._AM_GLOSSAIRE_STYLES_GLS_STYLE_SHEET}></th>
                <th class="center width5"><{$smarty.const._AM_GLOSSAIRE_FORM_ACTIONS}></th>
            </tr>
        </thead>
        <{if $categories_count|default:""}>
        <tbody>
            <{foreach item=category from=$categories_list name=catItem}>
            <tr class="<{cycle values='odd, even'}>">
                <td class="center"><{$category.id}></td>
                <td class="left width20">
                    <a href="entries.php?op=list&catIdSelect=<{$category.id}>&tart=0&limit=<{$limit}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16}>/inserttable.png" alt="<{$smarty.const._AM_GLOSSAIRE_ENTRIES}>" ></a>                
                    <a href="categories.php?op=edit&amp;cat_id=<{$category.id}>&amp;start=<{$start}>&amp;limit=<{$limit}>" title="<{$smarty.const._EDIT}>">
                    <{$category.name}>
                    </a>
                    <br><{$category.upload_folder}>
                </td>
                
                <td class="center">
                
                    <{if $category.active == 1}>
                        <a href="categories.php?op=bascule_actif&catId=<{$category.id}>&value=0">
                        <img src="<{$sysPathIcon16}>/on.png" title="<{$smarty.const._AM_GLOSSAIRE_DESACTIVATE}>">
                        </a>
                    <{else}>
                        <a href="categories.php?op=bascule_actif&catId=<{$category.id}>&value=1">
                        <img src="<{$sysPathIcon16}>/off.png" title="<{$smarty.const._AM_GLOSSAIRE_ACTIVATE}>">
                        </a>
                    <{/if}>
                </td>

<{*                 <td class="left"><{$category.upload_folder}></td> *}>
                <td class="left"><{$category.description_short}></td>
                <{* <td class="center"><{$category.total}></td> *}>

                <{* ---------------- Arrows Weight -------------------- *}>
                <td class="center width10" <{$styleParent}> >
                    <{if $smarty.foreach.catItem.first}>
                      <img src="<{$modPathIcon16}>/arrows/<{$fldImg}>/first-0.png" title="<{$smarty.const._AM_GLOSSAIRE_FIRST}>">
                      <img src="<{$modPathIcon16}>/arrows/<{$fldImg}>/up-0.png" title="<{$smarty.const._AM_GLOSSAIRE_UP}>">
                    <{else}>
                      <a href="categories.php?op=updateWeight&cat_id=<{$category.id}>&action=first&weight=<{$category.weight}>">
                      <img src="<{$modPathIcon16}>/arrows/<{$fldImg}>/first-1.png" title="<{$smarty.const._AM_GLOSSAIRE_FIRST}>">
                      </a>
                    
                      <a href="categories.php?op=updateWeight&cat_id=<{$category.id}>&action=up&weight=<{$category.weight}>">
                      <img src="<{$modPathIcon16}>/arrows/<{$fldImg}>/up-1.png" title="<{$smarty.const._AM_GLOSSAIRE_UP}>">
                      </a>
                    <{/if}>
                 
                    <{* ----------------------------------- *}>
                    <img src="<{$modPathIcon16}>/blank-08.png" title="">
                    <{$category.weight}>
                    <img src="<{$modPathIcon16}>/blank-08.png" title="">
                    <{* ----------------------------------- *}>
                 
                    <{if $smarty.foreach.catItem.last}>
                      <img src="<{$modPathIcon16}>/arrows/<{$fldImg}>/down-0.png" title="<{$smarty.const._AM_GLOSSAIRE_DOWN}>">
                      <img src="<{$modPathIcon16}>/arrows/<{$fldImg}>/last-0.png" title="<{$smarty.const._AM_GLOSSAIRE_LAST}>">
                    <{else}>
                    
                    <a href="categories.php?op=updateWeight&cat_id=<{$category.id}>&action=down&weight=<{$category.weight}>">
                      <img src="<{$modPathIcon16}>/arrows/<{$fldImg}>/down-1.png" title="<{$smarty.const._AM_GLOSSAIRE_DOWN}>">
                      </a>
                 
                    <a href="categories.php?op=updateWeight&cat_id=<{$category.id}>&action=last&weight=<{$category.weight}>">
                      <img src="<{$modPathIcon16}>/arrows/<{$fldImg}>/last-1.png" title="<{$smarty.const._AM_GLOSSAIRE_LAST}>">
                      </a>
                    <{/if}>
                </td>
                <{* ---------------- /Arrows -------------------- *}>

                <td class="center"><img src="<{$category.logo_url}>" alt="<{$category.logo}>" style="max-width:80px;JJD   CdS91700cd40b
                "></td>
                <td class="center"><{$category.colors_set}></td>
                
                <td class="center"><{$category.count_entries}></td>
                <td class="center width10"><{$category.date_creation}>
                    <br><{$category.date_update}>
                </td>
                <td class="center">
                    <div class="glossaire-btn-actions">
                    <a href="categories.php?op=edit_css&cat_id=<{$category.id}>" title="<{$smarty.const._AM_GLOSSAIRE_EDIT_CSS}>"><img src="<{xoModuleIcons16}>/attach.png" alt="<{$smarty.const._AM_GLOSSAIRE_EDIT_CSS}> categories" ></a>               
                    <a href="categories.php?op=init_css&cat_id=<{$category.id}>" title="<{$smarty.const._AM_GLOSSAIRE_STYLES_INIT_STYLE_SHEET}>"><img src="<{xoModuleIcons16}>/editpaste.png" alt="<{$smarty.const._AM_GLOSSAIRE_STYLES_INIT_STYLE_SHEET}> categories" ></a>
                    </div>
                </td>
           
                <td class="center  width10 ">
                    <div class="glossaire-btn-actions">
                    <a href="entries.php?op=list&catIdSelect=<{$category.id}>&tart=0&limit=<{$limit}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16}>/inserttable.png" alt="<{$smarty.const._AM_GLOSSAIRE_ENTRIES}>" ></a>                
                    <a href="categories.php?op=edit&cat_id=<{$category.id}>&amp;start=<{$start}>&amp;limit=<{$limit}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16}>/edit.png" alt="<{$smarty.const._EDIT}> categories" ></a>
                    <a href="categories.php?op=clone&cat_id_source=<{$category.id}>" title="<{$smarty.const._CLONE}>"><img src="<{xoModuleIcons16}>/editcopy.png" alt="<{$smarty.const._CLONE}> categories" ></a>
                    <a href="categories.php?op=delete&amp;cat_id=<{$category.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16}>/delete.png" alt="<{$smarty.const._DELETE}> categories" ></a>
                    </div>
                </td>
                
            </tr>
            <{/foreach}>
        </tbody>
        <{/if}>
    </table>
    <div class="clear">&nbsp;</div>
    <{if $pagenav|default:""}>
        <div class="xo-pagenav floatright"><{$pagenav|default:false}></div>
        <div class="clear spacer"></div>
    <{/if}>
<{/if}>
<{if $form|default:""}>
    <{$form|default:false}>
<{/if}>
<{if $error|default:""}>
    <div class="errorMsg"><strong><{$error|default:false}></strong></div>
<{/if}>

<script>
tth_set_value("last_asc", true);
tth_trierTableau("categories_list", 6);  
</script>

<!-- Footer -->
<{include file="db:glossaire_admin_footer.tpl" }>
