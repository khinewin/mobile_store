$(function () {

    $("#MyProduct").dataTable();



    $("#sale_item").on('keyup', function () {
        setTimeout(function () {
            $("#sale_form").submit();
        }, 2000)
    });
})