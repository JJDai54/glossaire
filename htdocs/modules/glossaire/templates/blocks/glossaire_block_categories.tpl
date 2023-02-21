<style>
.entrieTbl td{
    padding: 8px 0px 8px 8px;
    border:none;
}
</style>

	<{if count($block) OR true}>
        <div class="item-round-top <{$block.options.theme}>-item-head"><center><b>
        <a href="modules/glossaire/index.php"><{$block.options.title}></a>
        </b></center></div>
<{*         <div class="item-round-none <{$block.options.theme}>-item-body"><center><{$block.options.desc}></center></div> *}>
        
  
          <table class="entrieTbl" width="100%" style="border:none;">
        	<tbody>
		<{foreach item=Cat from=$block.data key=cat_Id}>    

           <{* ========================================================== *}>  
    			<tr>
            <td style="border:none;padding:0px;">
                    <div class="item-round-none <{$Cat.theme}>-item-body" style="padding:12px;">
                        <a href="modules/glossaire/entries.php?catIdSelect=<{$Cat.id}>" title=""><{$Cat.name}></a>
                    </div>
                </td>
    		</tr>
        
            <{* <div class="item-round-bottom <{$Cat.theme}>-item-legend"><center>...</center></div> *}>

    		<{/foreach}>
        	</tbody>
          </table>
    
            <div class="item-round-bottom <{$block.options.theme}>-item-legend"><center>...</center></div>
	<{/if}>

