
var regex = /^[0-9]+$/;

//New entretien
var inputKmNewEntretien = document.getElementById('km-entretien');
var date = document.getElementById('date-entretien');
var inputDescr = document.getElementById('description-entretien');
var inputPrix = document.getElementById('prix-entretien');
var btnSubmit = document.getElementById('btn-submit-entretien');
var modalNew = document.querySelector('.modal-new-entretien');



//modif entretien
var modalModify = []; var inputKmNewEntretienModify = []; var dateModify = []; var inputDescrModify = []; var inputPrixModify = []; var btnSubmitModify = [];

for(var i = 0; i < document.querySelectorAll('.modal-modify').length; i++){
    modalModify.push(document.querySelectorAll('.modal-modify')[i]);

    inputKmNewEntretienModify.push(this.document.querySelectorAll('.km-entretien-modify')[i]);
    dateModify.push(this.document.querySelectorAll('.date-entretien-modify')[i]);
    inputDescrModify.push(this.document.querySelectorAll('.description-entretien-modify')[i]);
    inputPrixModify.push(this.document.querySelectorAll('.prix-entretien-modify')[i]);
    btnSubmitModify.push(this.document.querySelectorAll('.btn-submit-entretien-modify')[i]);

    document.querySelectorAll('.modal-modify')[i].addEventListener('click', checkformModify(inputKmNewEntretienModify[i], dateModify[i], inputDescrModify[i], inputPrixModify[i], btnSubmitModify[i], regex));
}

modalNew.addEventListener('click', checkform);
function checkform(){

        if(date.value !== "" && inputKmNewEntretien.value.match(regex) && inputDescr.value !== "" && inputPrix.value.match(regex)){
            btnSubmit.disabled = false;
        }else{
            btnSubmit.disabled = true;
        }
}

function checkformModify(km, date, description, prix, sub, regex){

    return function(event){
        if(date.value !== "" && km.value.match(regex) && description.value !== "" && prix.value.match(regex)){
            sub.disabled = false;
        }else{
            sub.disabled = true;
        }
    };
}
