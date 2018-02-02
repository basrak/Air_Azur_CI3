$(document).ready(function(){
  
  $('.modal-link').click(function(){
        var link = $(this).attr("href");
        alert(link);
  });
  
  $('#sVilleDepart').on('change', function(){
        selectVols();
  });

  $('#sVilleArrivee').on('change', function(){
        selectVols();
  });

});

function selectVols(){
$.get('agence.php', {action:'vol', sVilleDepart: $('#sVilleDepart').val() },
    function(data){
       alert(data);    
           
    });
}

