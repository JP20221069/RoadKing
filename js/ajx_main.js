$(document).ready(function () {
    $(document).on('click', '#logrefresher', function () {
    $.get('gettbl.php/?v=1',function(response) {
        console.log(response);
       $('#TBL_LOG').html(response);
    });
    });
});

$(document).ready(function () {
    $(document).on('click', '#requestrefresher', function () {
    $.get('gettbl.php/?v=2', function(response) {
        console.log(response);
       $('#TBL_RVW').html(response);
    });
    });
});

$(document).ready(function () {
    $(document).on('click', '#myrequestrefresher', function () {
    $.get('gettbl.php/?v=3', function(response) {
        console.log(response);
       $('#TBL_MRVW').html(response);
    });
    });
});