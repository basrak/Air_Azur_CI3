$(document).ready(function () {

        populateVol();
        populateClient();

    $('#selClient').on('change', function (e) {
        populateClient();
        calculPrixT();
    });

    $('#placesC').on('change', function (e) {
        populateClient();
        calculPrixT();
    });

});

function populateVol() {
    $('#modalReserver').on('show.bs.modal', function (e) {
    var code = $(e.relatedTarget).data('code');
    var date = $(e.relatedTarget).data('date');
    var prix = $(e.relatedTarget).data('prix');
    //alert(id);
    $(".volCode").html(code + " ");
    $("#volCode").val(code);
    $(".volDate").html(date);
    $("#volDate").val(date);
    $("#prixU").val(prix);
    calculPrixT();
        });
}

function calculPrixT(){
    
    var fPrix = parseFloat($("#prixU").val(), 10);
    var fPlaces = parseFloat($("#placesC").val(), 10);
    $("#prixT").val(fPrix * fPlaces);    
}

function populateClient() {
    //console.log("load", $('#selClient').val() ); 
    $.getJSON('http://localhost/Air_Azur_CI3/controller/json.php', {selClient: $('#selClient').val()},
            function (data) {
                $('#nomC').val(data["1"]);
                $('#prenomC').val(data["2"]);
                $('#adresseC').val(data["3"]);
                $('#CPC').val(data["4"]);
                $('#villeC').val(data["5"]);
                $('#telC').val(data["6"]);
                $('#mailC').val(data["7"]);
            });

}



/*$(document).ready(function(){
 
 $('.reserver').click(function(){
 console.log("test before réserver");
 loadReserver();
 console.log("test after réserver");
 });
 
 });
 
 function loadReserver(){
 var modalReserver = $('#modalReserver');
 var hiddenIdVol = $(this).data('id');
 //console.log("loadReserver %s", sID);
 $(".modalReserver #hiddenIdVol").val(hiddenIdVol);
 modalReserver.modal('show'); 
 
 
 
 /*
 $.get('http://localhost/Air_Azur_CI3/controller/agence.php?action=vol&id='+sID,
 function(data){
 console.log("loadReserver %s returns", sID); 
 modalReserver.modal('show');    
 
 });
 /**/
// $.ajax( { url : "http://localhost/Air_Azur_CI3/controller/agence.php?actions=volz&id="+sID} );}


