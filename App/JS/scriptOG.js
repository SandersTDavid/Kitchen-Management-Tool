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

$(document).ready(function() {
  $.ajax({
    type: "POST",
    url: "ajax.php",
    data: {
        add: food_name, food_category, food_time
    }
  })
})

function addNewItem(food_name, food_category, food_time) {
  var newItem = document.querySelector('.input').value;
  var food_category;
  var food_time;
  if (newItem != '') {
    if(food_name == newItem ){
    document.querySelector('.input').value = '';

    var table = document.createElement('table');
    var attr = document.createAttribute('draggable');
    var tr = document.querySelector('tr');
    tr.className = 'draggable';
    attr.value = 'true';
    tr.setAttributeNode(attr);
    td.appendChild(document.createTextNode(food_name));
    td.appendChild(document.createTextNode(food_category));
    td.appendChild(document.createTextNode(food_time));
    table.appendChild(tr);
    addEventsDragAndDrop(tr);
  }
  }
}
