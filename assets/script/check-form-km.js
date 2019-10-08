
var btnSubmit = document.querySelector('.submit-km');
var inputKm = document.querySelector('.input-km');
var regex = /^[0-9]+$/;



window.addEventListener('blur', checkForm);

function checkForm(){
    if(inputKm.value.match(regex)){
        btnSubmit.disabled = false;
    }else{
        btnSubmit.disabled = true;
    }
}
