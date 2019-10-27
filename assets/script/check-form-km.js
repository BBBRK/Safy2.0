
var btnSubmit = document.getElementById('submit-km');
var inputKm = document.getElementById('km');
var regex = /^[0-9]+$/;

alert('');


window.addEventListener('click', checkFormKm);

function checkFormKm(){
    if(inputKm.value.match(regex)){
        btnSubmit.disabled = false;
        console.log('okkk');
    }else{
        btnSubmit.disabled = true;
        console.log('wrong');
    }
}
