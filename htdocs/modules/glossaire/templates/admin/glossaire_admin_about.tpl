<!-- Header -->
<{includeq file='db:glossaire_admin_header.tpl' }>

<!-- About Page -->

<table>
    <tr>
        <td width='50%'>
         <div class="top"><{$box.header.content}></div>
        
          <fieldset><legend class="label"><{$box.paypal.legend}></legend>
          <{$box.paypal.content}>
          </fieldset>
          
          <fieldset><legend class="label"><{$box.module.legend}></legend>
          <{$box.module.content}>
          </fieldset>
        </td>
        
        <td width='50%'>
          <fieldset><legend class="label"><{$box.changelog.legend}></legend>
          <{$box.changelog.content}>
          </fieldset>
        </td>
    </tr>
</table>

<!-- Footer -->
<{includeq file='db:glossaire_admin_footer.tpl' }>
