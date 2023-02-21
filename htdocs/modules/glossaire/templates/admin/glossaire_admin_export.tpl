
<!-- Header -->
<{include file="db:glossaire_admin_header.tpl" }>

<{if $download==1}>
 <link rel="stylesheet" type="text/css" href="<{$smarty.const.XOOPS_URL}>/modules/glossaire/assets/css/import-export.css">
 
  <div id="glossaire_download" name ="glossaire_download" style="background:red;color:white;">
  <{$smarty.const._AM_GLOSSAIRE_DOWNLOAD_OK}>
  <a data-auto-download href="<{$href}>"><{$name}></a>
  
  </div>
  <script src="<{$smarty.const.XOOPS_URL}>/modules/glossaire/assets/js/import-export.js"></script>
<{/if}>

<{if $form}>
	<{$form}>
<{/if}>

<{* 
<{if $error}>
	<div class="errorMsg"><strong><{$error}></strong></div>
<{/if}>
*}> 

<!-- Footer -->
<{include file="db:glossaire_admin_footer.tpl" }>

