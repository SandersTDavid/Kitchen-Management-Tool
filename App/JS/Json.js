$(document).ready(function(){

    $("#txt_search").keyup(function(){
        var search = $(this).val();

        if(search != ""){

            $.ajax({
                url: 'getSearch.php',
                type: 'post',
                data: {search:search, type:1},
                dataType: 'json',
                success:function(response){

                    var len = response.length;
                    $("#searchResult").empty();
                    for( var i = 0; i<len; i++){
                        var food_id = response[i]['food_id'];
                        var food_name = response[i]['food_name'];

                        $("#searchResult").append("<li value='"+food_id+"'>"+food_name+"</li>");

                    }

                    // binding click event to li
                    $("#searchResult li").bind("click",function(){
                        setText(this);
                    });

                }
            });
        }

    });

});

// Set Text to search box and get details
function setText(element){

    var value = $(element).text();
    var userid = $(element).val();

    $("#txt_search").val(value);
    $("#searchResult").empty();

    // Request User Details
    $.ajax({
        url: 'getSearch.php',
        type: 'post',
        data: {userid:userid, type:2},
        dataType: 'json',
        success: function(response){

            var len = response.length;
            if(len > 0){
                var food_id = response[0]['food_id'];
                var food_name = response[0]['food_name'];
                var food_category = response[0]['food_category'];
                var food_time = response[0]['food_time'];

                $('#mytable').append('<tr><td>' + food_name + '</td><td>' + food_category + '</td><td>' + food_time + '</td></tr>');
            }
        }

    });
}
