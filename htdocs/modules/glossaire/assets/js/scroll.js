
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



