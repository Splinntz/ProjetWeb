require('../css/rate.css');
var $ = require('jquery');
$(document).ready(function(){

    /* 1. Visualizing things on Hover - See next part for action on click */


    /* 2. Action to perform on click */
    $('input').on('click', function(){
        var onStar = parseInt($(this).attr('value'), 10); // The star currently selected
        var stars = $(this).parent().children('.rating');
        console.log(onStar);
        /*for (i = 0; i < stars.length; i++) {
            $(stars[i]).removeClass('selected');
        }

        for (i = 0; i < onStar; i++) {
            $(stars[i]).addClass('selected');
        }

        // JUST RESPONSE (Not needed)
        var ratingValue = parseInt($('.rating input.selected').data('value'), 10);
        var msg = "";
        if (ratingValue > 1) {
            msg = "Thanks! You rated this " + ratingValue + " stars.";
        }
        else {
            msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
        }
        responseMessage(msg);*/

    });


});


function responseMessage(msg) {
   console.log(msg);
}