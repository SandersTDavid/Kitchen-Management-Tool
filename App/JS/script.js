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
               type: "POST",
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
