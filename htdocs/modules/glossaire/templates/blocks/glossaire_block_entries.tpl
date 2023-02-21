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
  
		<{foreach item=cat from=$block.data key=cat_Id}>    
          <div class="item-round-none <{$cat.cat.theme}>-item-head">
    	       <center><b>
               <a href="modules/glossaire/entries.php?catIdSelect=<{$cat.cat.id}>" title=""><{$cat.cat.name}></a>
               </b></center>
          </div>

           <{* ========================================================== *}>  
          <div class="item-round-none <{$cat.cat.theme}>-item-body">
          <table class="entrieTbl" width="100%" style="border:none;">
    		<thead>
    			<tr class="head">
    				<{* <th class="center">#</th> *}>
    				<{* <th class="center" colspan="2"><{$smarty.const._MB_GLOSSAIRE_NAME}></th> *}>
    			</tr>
    		</thead>
	<tbody>
    		<{foreach item=Entrie from=$cat.entries}>
    		<tr class="<{cycle values="odd, even"}>">
    			<{* <td class="center" width="80px"><{$Entrie.cat_id}>/<{$Entrie.id}></td> *}>
                
                
                <td class="left">
                    <a href="modules/glossaire/entries.php?catIdSelect=<{$Entrie.cat_id}>&exp2search=<{$Entrie.term}>&letter=+">
                    <{$Entrie.term}> : <{$Entrie.shortdef}>
                    </a>
                  </td>
    		</tr>
    		<{/foreach}>
	</tbody>
          </table>
        
            </div>
            <{* <div class="item-round-bottom <{$cat.cat.theme}>-item-legend"><center>...</center></div> *}>

    		<{/foreach}>
    
            <div class="item-round-bottom <{$cat.cat.theme}>-item-legend"><center>...</center></div>
	<{/if}>

