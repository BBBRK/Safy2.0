






// if(souris sur le bouton){
//
//     lancer fonction grandir
// }
// else{
//
//     lancer fonction rapetisser
// }





var test = anime({
    targets:'button.submit',
    duration: 300,
    width: '150px',
    easing: 'linear',
    autoplay: false,

});

var test2 = anime({
    targets:'button.submit',
    duration: 300,
    width: '100px',
    easing: 'linear',
    autoplay: false,

});


function over(){
    test.play();
}


function out(){
    test2.play();
}


if($('.submit').mouseover() === true){
    over();
}
else{
    out();
}


$(document).ready(function(){
    $('.submit').mouseover(function(){
        over();
    });
});


$(document).ready(function(){
    $('.submit').mouseout(function(){
        out();
    });
});






// $('.submit').hover();


// document.querySelector(".submit").addEventListener("mouseover", function(){
//     over();
// });
//
// document.querySelector(".submit").addEventListener("mouseout", function(){
//     out();
// });
