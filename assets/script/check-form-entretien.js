
var regex = /^[0-9]+$/;
var inputKmNewEntretien = document.getElementById('km-entretien');
var date = document.getElementById('date-entretien');
var inputDescr = document.getElementById('description-entretien');
var inputPrix = document.getElementById('prix-entretien');


window.addEventListener('click', checkform);


function checkform(){

    if(inputKmNewEntretien.value.match(regex) == true){
        console.log('ok');
    }else{
        console.log(inputKmNewEntretien.value.match(regex));
    }


    if(date.value !== "" && inputKmNewEntretien.value.match(regex) == true && inputDescr.value !== "" && inputPrix.value.match(regex) == true){

        console.log('ITS TRUE MOTHER FCJER');
    }else{
        console.log('ERRRRRRR');

    }


    // console.log(date.value);
    //
    // inputKm.value.match(regex);
    //
    // if(inputDescr.value == ""){
    //     console.log('vide');
    // }else{
    //     console.log('pas vide');
    // }
    //
    // inputPrix.value.match(regex);



}
