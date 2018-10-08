$(document).ready(function(){
    var hole_data;
    // Ajax call to generate random prize
    $('.play_button').click(function(){
        var ajaxurl = '../features/get_prize.php',
            data =  {'name' : $(this).val()};
        $.post(ajaxurl, data, function (response) {
            var parsed_data = JSON.parse(response);
            hole_data = parsed_data;
            showPrize(parsed_data);
        });
    });

    // Ajax call to cancel won prize
    $('#cancel_item_prize').click(function(){
        var ajaxurl = '../features/functions.php',
            data =  {'action': 'cancel_item',
                     'id': parseInt($("#item_id").html())};
        $.post(ajaxurl, data, function (response) {
            $(".prize_box").css("display", "none");
        });
    });

    // Auto generated form for item delivery
    $('#delivery_item').click(function () {
        $(".prize_box").html(" <form id='delivery_form'> " +
            "<label class='form_label' for='address'>Address</label><input class='form_input' id='address' type='text'><br>" +
            "<label class='form_label' for='city'>City</label><input class='form_input'  id='city' type='text'><br>" +
            "<label class='form_label' for='postal_code'>Postal code</label><input class='form_input'  id='postal_code' type='text'><br>" +
            "<button type='button' onclick='delivery()'>Process</button></form> ");
    })

    // Close tab with prize info
    $("#close_congrad").click(function () {
        $(".prize_box").css("display", "none");
    });

});

// Function which show prize info on home.php
function showPrize(response) {
    $("#item_foto").css("display", "none");
    $("#cancel_item_prize").css("display", "none");
    $("#delivery_item").css("display", "none");
    if (response.item_url == undefined){
        $(".prize_box").css("display", "block");
        $("#prize_type").html(response.prize_title + " " + response.value);
    } else {
        $("#cancel_item_prize").css("display", "inline-block");
        $("#delivery_item").css("display", "inline-block");
        $(".prize_box").css("display", "block");
        $("#item_foto").css("display", "block");
        $("#prize_type").html(response.name);
        $("#item_id").html(response.item_id);
        $("#item_foto").attr("src", response.item_url);
        $("#item_foto").attr("alt", response.name);
    }
}

// Delivery alert
function delivery() {
    alert("Your item will be delivered");
    $(".prize_box").css("display", "none");
}
