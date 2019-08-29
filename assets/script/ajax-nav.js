


    var divSante = document.querySelector(".moto-sante");
    var divHistorique = document.querySelector(".historique");
    var idMoto = $("#idMoto").val();



    function sante(){

        divHistorique.style.display = "none";
        divSante.style.display = "block";
    }

    function historique(){

        divSante.style.display = "none";

        $.ajax({
            url: "http://localhost/safymotor/index.php/moto/historique/" + idMoto,
            dataType: "json",
            success: function(data){

                var result = "";
                for(var historique of data){

                    result += "<tr><td class='height-row'>" + historique.type + "</td>";
                    result += "<td class='height-row'>" + historique.description + "</td>";
                    result += "<td class='height-row'>" + historique.km + " km" + "</td>";
                    result += "<td class='height-row'>" + historique.date + "</td>";
                    result += "<td class='height-row'>" + historique.prix + "€" + "</td>";
                    result += "<td class='height-row'><button data-toggle='modal' data-target=#modal-update-entretien-" + historique.id + "><i class='far fa-edit icon'></i></button>   |   <a href='http://localhost/safymotor/index.php/moto/delete_historique/" + historique.id + "'><i class='fas fa-trash-alt icon'></i></a>   |   <button data-toggle='modal' data-target=#modal-facture-><i class='fas fa-cloud-upload-alt'></i></a></td><tr>";

                }
                $("#tr").html(result);

            },
            error: function(){
                alert("ERREUR");
            }
        });

        divHistorique.style.display = "block";
    }
