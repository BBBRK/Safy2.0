
var btnSubmit = document.querySelector('.submit-km');
var inputKm = document.querySelector('.input-km');
var regex = RegExp('/^\d+$/');




window.addEventListener('click', checkForm);

function checkForm(){
    var km = inputKm.value;
    console.log(regex.test(km));

}
