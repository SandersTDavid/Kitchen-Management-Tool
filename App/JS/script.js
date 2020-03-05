//Getting value from "ajax.php".
function fill(Value) {
   $('#search').val(Value);
   $('#display').hide();

}

$(document).ready(function() {
   $("#search").keyup(function() {
       var food_name = $('#search').val();
       if (food_name == "") {
           $("#display").html("");
       }
       else {
           $.ajax({
               type: "GET",
               url: "ajax.php",
               data: {
                   search: food_name
               },
               success: function(html) {
                   $("#display").html(html).show();
               }
           });
       }
   });
});

function fill2(Value2) {
   $('#search2').val(Value2);
   $('#display2').hide();
}

$(document).ready(function() {
   $("#search2").keyup(function() {
       var food_category = $('#search2').val();
       if (food_category == "") {
           $("#display2").html("");
       }
       else {
           $.ajax({
               type: "GET",
               url: "ajax.php",
               data: {
                   search: food_category
               },
               success: function(html) {
                   $("#display2").html(html).show();
               }
           });
       }
   });
});


function fill3(Value3) {
   $('#search3').val(Value3);
   $('#display3').hide();
}

$(document).ready(function() {
   $("#search3").keyup(function() {
       var food_time = $('#search3').val();
       if (food_time == "") {
           $("#display3").html("");
       }
       else {
           $.ajax({
               type: "GET",
               url: "ajax.php",
               data: {
                   search: food_time
               },
               success: function(html) {
                   $("#display3").html(html).show();
               }
           });
       }
   });
});
