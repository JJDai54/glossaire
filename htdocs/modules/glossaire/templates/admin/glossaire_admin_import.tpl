<{*
<{include file='db:quizmaker_header.tpl' }>
*}>

<!-- Header -->
<{include file='db:glossaire_admin_header.tpl' }>


<{if $form_self}>
	<{$form_self}>
<{/if}>

<{if $form_ftp}>
	<{$form_ftp}>
<{/if}>

<{if $form_lexikon}>
	<{$form_lexikon}>
<{/if}>



<{if $error}>
	<div class="errorMsg"><strong><{$error}></strong></div>
<{/if}>






<!-- Footer -->
<{include file='db:glossaire_admin_footer.tpl' }>

