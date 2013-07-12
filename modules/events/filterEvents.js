var values = new Array();
var category = new Array();
$(document).ready(function() {
    function selectCity()
    {
        var category = $('input:checkbox:checked.filterEventChbx').map(function() {
            return this.value;
        }).get();
        var values = $('input:checkbox:checked.filterNgoChbx').map(function() {
            return this.value;
        }).get();
        var v = $("#filterCity").val();
        $.ajax({
            type: "GET",
            url: 'eventList.php',
            data: {
                selectedCategory: category,
                selectedNgo: values,
                filterCity: v
            }, // appears as $_GET['id'] @ ur backend side
            success: function(data) {
                // data is ur summary
                $('#filterList').html(data);
            }

        });
    }
    $(".filterEventChbx").click(function() {
        var category = $('input:checkbox:checked.filterEventChbx').map(function() {
            return this.value;
        }).get();

        var values = $('input:checkbox:checked.filterNgoChbx').map(function() {
            return this.value;
        }).get();
        var v = $("#filterCity").val();
        $.ajax({
            type: "GET",
            url: 'eventList.php',
            data: {
                selectedCategory: category,
                selectedNgo: values,
                filterCity: v
            }, // appears as $_GET['id'] @ ur backend side
            success: function(data) {
                // data is ur summary
                $('#filterList').html(data);
            }

        });
    });


    $(".filterNgoChbx").click(function() {
        var category = $('input:checkbox:checked.filterEventChbx').map(function() {
            return this.value;
        }).get();
        var values = $('input:checkbox:checked.filterNgoChbx').map(function() {
            return this.value;
        }).get();
        var v = $("#filterCity").val();
        $.ajax({
            type: "GET",
            url: 'eventList.php',
            data: {
                selectedCategory: category,
                selectedNgo: values,
                filterCity: v
            }, // appears as $_GET['id'] @ ur backend side
            success: function(data) {
                // data is ur summary
                $('#filterList').html(data);
            }

        });
    });
    $("#previousEvents").click(function() {
        $("#regEmail").slideDown("slow");
    });

    $("#prevEventsBtn").click(function() {
        var regEmail = $("#prevEmailTxt").val();
        $.ajax({
            type: "GET",
            url: 'eventList.php',
            data: {
                regEmailID: regEmail
            }, // appears as $_GET['id'] @ ur backend side
            success: function(data) {
                // data is ur summary
                
                $('#filterList').html(data);
            }

        });
    });
});