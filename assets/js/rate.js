require('../css/rate.css');
var $ = require('jquery');
$(document).ready(function(){

    /* 1. Visualizing things on Hover - See next part for action on click */


    /* 2. Action to perform on click */
    $('input').on('click', function(){
        var onStar = parseInt($(this).attr('value'), 10); // The star currently selected
        var stars = $(this).parent().children('.rating');
        console.log(onStar);
        $('.hidden').attr('value',onStar);
    });


});