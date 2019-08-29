
var reg = /^[0-9]*$/g;

$(function(){

$('#form_km').submit(function(event){
event.preventDefault();
var km = $('#km').val();

console.log(reg.test(km));

$.post({
        url: "http://localhost/safymotor/index.php/moto/maj_km",
        //data: {'km': km},
        dataType: 'json',
        success: function(results){
            console.log(results);
             if(reg.test(km) == false){
              $('#error_msg').html('test');
              return false;
             }
        }
  });


});

});
