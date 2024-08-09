
$(function() {
  $('a[data-auto-download]').each(function(){
    var $this = $(this);
    setTimeout(function() {
      window.location = $this.attr('href');
    }, 2000);
  });
});

$(document).ready(function(){     
        //$("#glossaire_download").delay(0).hide(0, "linear");
        $("#glossaire_download").delay(1000).show(1000, "linear");

        $("#glossaire_download").delay(5000).hide(1000, "linear", function(){
            //alert("Titre bien caché");
        });
});
