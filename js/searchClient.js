$("#clientView.php").ready(function(){
  
  $('#client').on('change', function(){
        selectClients();
  });

  

});

function selectClients(){
$.get('agence.php', {action:'client', client: $('#client').client() },
    function(data){
       alert(data);    
           
    });
}

