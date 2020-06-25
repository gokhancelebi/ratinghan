
$(".star-app-star").hover(function () {

    var rating_app_id = $(this).attr("rating-app-id");
    var rating_now = $(this).attr("rating-data");


    if(rating_now >= 1)
        $("#rating-app-" + rating_app_id).find("#star-app-1:first").attr("src",rating_plugin_dir +"img/stars_crystal/rating_on.gif");
    else
        $("#rating-app-" + rating_app_id).find("#star-app-1:first").attr("src",rating_plugin_dir +"img/stars_crystal/rating_off.gif");



    if(rating_now >= 2)
        $("#rating-app-" + rating_app_id).find("#star-app-2:first").attr("src",rating_plugin_dir +"img/stars_crystal/rating_on.gif");
    else
        $("#rating-app-" + rating_app_id).find("#star-app-2:first").attr("src",rating_plugin_dir +"img/stars_crystal/rating_off.gif");



    if(rating_now >= 3)
        $("#rating-app-" + rating_app_id).find("#star-app-3:first").attr("src",rating_plugin_dir +"img/stars_crystal/rating_on.gif");
    else
        $("#rating-app-" + rating_app_id).find("#star-app-3:first").attr("src",rating_plugin_dir +"img/stars_crystal/rating_off.gif");



    if(rating_now >= 4)
        $("#rating-app-" + rating_app_id).find("#star-app-4:first").attr("src",rating_plugin_dir +"img/stars_crystal/rating_on.gif");
    else
        $("#rating-app-" + rating_app_id).find("#star-app-4:first").attr("src",rating_plugin_dir +"img/stars_crystal/rating_off.gif");



    if(rating_now >= 5)
        $("#rating-app-" + rating_app_id).find("#star-app-5:first").attr("src",rating_plugin_dir +"img/stars_crystal/rating_on.gif");
    else
        $("#rating-app-" + rating_app_id).find("#star-app-5:first").attr("src",rating_plugin_dir +"img/stars_crystal/rating_off.gif");

},function () {
    refresh_rating();
});


$(".star-app-star").click(function () {
    var rating_datam = $(this).attr("rating-data");
    var  rating_app_id = $(this).attr("rating-app-id");

    var  post_idm  = $("#rating-app-" + rating_app_id).attr("post-id");


    var c_start = document.cookie;

    var s = rating_plugin_dir + "add-rating.php";


    if(c_start.indexOf("oy_kullandin_mi_" + post_idm) == -1)
    {

     $.get(s,{post_id:post_idm,rating_data:rating_datam},function (data) {
            var dat = JSON.parse(data);

            $("#rating-app-" + rating_app_id).attr("rating-data",dat.ortalama);

            $("#rating-div-" + post_idm).html(dat.template);
         refresh_rating();
        });

    }else {
        //alert("zaten kullandın");
    }




});

function refresh_rating(){
    $(".rating-app").each(function (index) {

        var rating_now = $(this).attr("rating-data");

        if(rating_now >= 1)
            $(this).find("#star-app-1:first").attr("src",rating_plugin_dir +"img/stars_crystal/rating_on.gif");
        else
            $(this).find("#star-app-1:first").attr("src",rating_plugin_dir +"img/stars_crystal/rating_off.gif");



        if(rating_now >= 2)
            $(this).find("#star-app-2:first").attr("src",rating_plugin_dir +"img/stars_crystal/rating_on.gif");
        else
            $(this).find("#star-app-2:first").attr("src",rating_plugin_dir +"img/stars_crystal/rating_off.gif");



        if(rating_now >= 3)
            $(this).find("#star-app-3:first").attr("src",rating_plugin_dir +"img/stars_crystal/rating_on.gif");
        else
            $(this).find("#star-app-3:first").attr("src",rating_plugin_dir +"img/stars_crystal/rating_off.gif");



        if(rating_now >= 4)
            $(this).find("#star-app-4:first").attr("src",rating_plugin_dir +"img/stars_crystal/rating_on.gif");
        else
            $(this).find("#star-app-4:first").attr("src",rating_plugin_dir +"img/stars_crystal/rating_off.gif");



        if(rating_now >= 5)
            $(this).find("#star-app-5:first").attr("src",rating_plugin_dir +"img/stars_crystal/rating_on.gif");
        else
            $(this).find("#star-app-5:first").attr("src",rating_plugin_dir +"img/stars_crystal/rating_off.gif");
    });
}
refresh_rating();
