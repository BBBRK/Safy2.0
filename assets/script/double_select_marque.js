
$(document).ready(function(){

    $('#marque').on('change', function(){

        console.log("coucou");
        var marqueId = $(this).val();
        if(marqueId == ''){
            $('#modele').prop('disabled', true);
        }
        else{
            $('#modele').prop('disabled', false);
            $.post({
                url: "http://localhost/Safy2.0/index.php/moto/get_modele_json/" + marqueId,
                //type: "POST",
                //data: {marqueId: marqueId},
                //dataType: 'json',
                success: function(data){

                    var result = "<option>Selectionez modèle</option>";
                    for (var model of data) {
                        result += "<option value='" + model.id_Modele + "'>" + model.nom_Modele + "</option>";
                    }
                    $("#modele").html(result);

                },
                error : function(){
                    alert('ERREUR');
                }
            });
        }
    });
});
