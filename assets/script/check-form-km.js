
var btnSubmitKm = document.getElementById('submit-km');
var inputKm = document.getElementById('km');
var regex = /^[0-9]+$/;
var modal = document.querySelector('.modal-km');

modal.addEventListener('click', checkFormKm);

function checkFormKm(){

    if(inputKm.value.match(regex)){
        btnSubmitKm.disabled = false;
    }else{
        btnSubmitKm.disabled = true;
    }
}
