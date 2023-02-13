<{if $smarty.const.GLOSSAIRE_SHOW_TPL_NAME==1}>
<{if !$tplHierarchie}><{assign var=tplHierarchie value=1}><{else}><{assign var=tplHierarchie value=$tplHierarchie+1}><{/if}>
<div style="text-align: center; background-color: black;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
<{*  ------------------------------------------------------------------ *}>
<script>
function qm_scrollWin(offsetV = -100){
var intervalID = setTimeout(qm_scrollWin2, 80, offsetV);
}
function qm_scrollWin2(offsetV){
document.scrollTop = -100;
window.scroll(0, window.scrollY + offsetV);
//alert('scrollWin');
}

$(function() {
    /**
    * Smooth scrolling to page anchor on click
    **/
    $("a[href*='#']:not([href='#'])").click(function() {
        if (
            location.hostname == this.hostname
            && this.pathname.replace(/^\//,"") == location.pathname.replace(/^\//,"")
        ) {
            var anchor = $(this.hash);
            anchor = anchor.length ? anchor : $("[name=" + this.hash.slice(1) +"]");
            if ( anchor.length ) {
                //ajout d'un decalage de -100 pour compenser la barre de titre qui sinon masque la cible
                $("html, body").animate( { scrollTop: anchor.offset().top -100}, 1500);
            }
        }
    });
});

$(function() {
    /**
    * Smooth scrolling to a specific element 
    **/
    function scrollTo( target ) {
        if( target.length ) {
            $("html, body").stop().animate( { scrollTop: target.offset().top }, 1500);
        }
    }

    // exemple
    //scrollTo( $("#mon-id") );
});

// $(function() {
// 	 /**
// 	 * Smooth scrolling to the top of page !
// 	 **/
// 	 $("html, body").animate({scrollTop : 0}, 1500);
// });

</script>

<hr class='<{$colors_set}>-hr-style-two'>
  <{foreach item=entry from=$entries name=entriesList}>
    <{if $smarty.foreach.entriesList.first}>|<{/if}>
    <span style='margin:0px 12px 0px 0px;'>
    <a href="#entry-<{$entry.id}>" title="" alt=""  >
        <{$entry.term}> 
    </a></span>|
  <{/foreach}>
<hr class='<{$colors_set}>-hr-style-two'>

<{*  ------------------------------------------------------------------ *}>
<{if $smarty.const.GLOSSAIRE_SHOW_TPL_NAME==1}>
<{assign var=tplHierarchie value=$tplHierarchie-1}>
<div style="text-align: center; background-color: grey;"><span style="color: yellow;">Template [<{$tplHierarchie}>]: <{$smarty.template}></span></div>
<{/if}>
