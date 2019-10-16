
var regex = /^[0-9]+$/;

//New entretien
var inputKmNewEntretien = document.getElementById('km-entretien');
var date = document.getElementById('date-entretien');
var inputDescr = document.getElementById('description-entretien');
var inputPrix = document.getElementById('prix-entretien');
var btnSubmit = document.getElementById('btn-submit-entretien');

//modif entretien
var inputKmNewEntretienModify = document.getElementById('km-entretien-modify');
var dateModify = document.getElementById('date-entretien-modify');
var inputDescrModify = document.getElementById('description-entretien-modify');
var inputPrixModify = document.getElementById('prix-entretien-modify');
var btnSubmitModify = document.getElementById('btn-submit-entretien-modify');




window.addEventListener('click', checkform);
window.addEventListener('click', checkformModify);


function checkformModify(){

    if(dateModify.value !== "" && inputKmNewEntretienModify.value.match(regex) && inputDescrModify.value !== "" && inputPrixModify.value.match(regex)){

        btnSubmitModify.disabled = false;
    }else{

        btnSubmitModify.disabled = true;
    }



}



function checkform(){


    if(date.value !== "" && inputKmNewEntretien.value.match(regex) && inputDescr.value !== "" && inputPrix.value.match(regex)){

        btnSubmit.disabled = false;
    }else{

        btnSubmit.disabled = true;
    }



}
