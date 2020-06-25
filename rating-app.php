<?php
/*
Plugin Name:  Rating Eklentisi
Plugin URI:   http://www.gokhancelebi.net/hakkimda/
Description:  Rating Eklentisi
Version:      1.0
Author:         Gökhan ÇELEBİ
Author URI:   http://www.gokhancelebi.net/hakkimda/
License:      GPL2
License URI:
Text Domain:
*/

static $rating_app_frontend_count = 1;

function show_rating_app_frontend()
{
    echo "
    
    <style>
    .rating-divv ul{
    margin:0;
    padding:0;
    }
    
    .rating-divv {
    background: #01579b ;
    float:left;
    color:#fff;
    font-size:15px;
    line-height: 15px;
    margin:0;
    -webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;
    padding:10px;
    width:100%
    
}

</style>
    ";
    global $rating_app_frontend_count;

    $star5 = get_post_meta(get_the_ID(), "star5", true);
    $star4 = get_post_meta(get_the_ID(), "star4", true);
    $star3 = get_post_meta(get_the_ID(), "star3", true);
    $star2 = get_post_meta(get_the_ID(), "star2", true);
    $star1 = get_post_meta(get_the_ID(), "star1", true);


    $adet = $star5 + $star4 + $star3 + $star2 + $star1;

    if ($adet == 0) {
        $adet = 1;
    }

    $ortalama = (($star1) + (2 * $star2) + (3 * $star3) + (4 * $star4) + (5 * $star5)) / $adet;


    $ortalama1 = number_format($ortalama, 1, ",", ".");

    $ortalama = round($ortalama);


    $html = "
    
        <ul post-id='" . get_the_ID() . "' class='rating-app' id='rating-app-" . $rating_app_frontend_count . "' rating-app-id='" . $rating_app_frontend_count . "' rating-data='$ortalama'>
            <li>
                <img src='" . plugin_dir_url(__FILE__) . "img/stars_crystal/rating_off.gif' class='star-app-star star-app-1' id='star-app-1' rating-data='1' rating-app-id='" . $rating_app_frontend_count . "'>
            </li>
            <li>
                <img src='" . plugin_dir_url(__FILE__) . "img/stars_crystal/rating_off.gif' class='star-app-star star-app-2' id='star-app-2' rating-data='2' rating-app-id='" . $rating_app_frontend_count . "'>
            </li>
            <li>
                <img src='" . plugin_dir_url(__FILE__) . "img/stars_crystal/rating_off.gif' class='star-app-star star-app-3' id='star-app-3' rating-data='3' rating-app-id='" . $rating_app_frontend_count . "'>
            </li>
            <li>
                <img src='" . plugin_dir_url(__FILE__) . "img/stars_crystal/rating_off.gif'  class='star-app-star star-app-4' id='star-app-4' rating-data='4' rating-app-id='" . $rating_app_frontend_count . "'>
            </li>
            <li>
                <img src='" . plugin_dir_url(__FILE__) . "img/stars_crystal/rating_off.gif' class='star-app-star star-app-5' id='star-app-5' rating-data='5' rating-app-id='" . $rating_app_frontend_count . "'>
            </li>
        </ul>
    
    ";

    $before_template = get_option("star-app-default");
    $after_template = get_option("star-app-after");

    $before_template = str_replace("YILDIZLAR", $html, $before_template);
    $after_template = str_replace("YILDIZLAR", $html, $after_template);

    $before_template = str_replace("ORTALAMA", $ortalama1, $before_template);
    $after_template = str_replace("ORTALAMA", $ortalama1, $after_template);

    $before_template = str_replace("OYADEDI", $adet, $before_template);
    $after_template = str_replace("OYADEDI", $adet, $after_template);

    echo "<center><div style='width: 100%;float:left;margin-bottom:10px;'><div  class='rating-divv' id='rating-div-" . get_the_ID() . "'>";

    if (isset($_COOKIE["oy_kullandin_mi_" . get_the_ID()])) {
        echo $after_template;
    } else {

        echo $before_template;
    }
    echo "</div></div></center>";

    $rating_app_frontend_count++;
}

function add_header_rating_app()
{
    echo "<link rel='stylesheet' href='" . plugin_dir_url(__FILE__) . "css/rating_style.css'>";

}


add_action('wp_head', 'add_header_rating_app');


function add_footer_rating_app()
{

    echo "<script>

var rating_plugin_dir = \"" . plugin_dir_url(__FILE__) . "\";

</script>";

    echo "<script src='" . plugin_dir_url(__FILE__) . "js/script.js'></script>
    ";
}


add_action('wp_footer', 'add_footer_rating_app');


add_action('admin_menu', 'add_rating_app_settings_page');

function add_rating_app_settings_page()
{
    add_menu_page('Rating App Settings', 'Rating Settings', 'manage_options', 'rating-app-settings', 'rating_app_settings_page', 'dashicons-tickets', 100);

}


function rating_app_settings_page()
{

    if (isset($_POST["star-app-default"])) {

        update_option("star-app-default", $_POST["star-app-default"]);
        update_option("star-app-after", $_POST["star-app-after"]);

    }

    if (get_option("star-app-default") === false) {
        update_option("star-app-default", "<span>Oy bırak :</span> YILDIZLAR");
        update_option("star-app-after", "<span>Oyunu Bıraktın :</span> YILDIZLAR");
    }

    echo "<div class='wrap'>";

    echo "<strong>YILDIZLAR </strong>: yıldızların konumlanacağı yer<br>";
    echo "<strong>ORTALAMA </strong>: ortalama değerin konumlanacağı yer<br>";
    echo "<strong>OYADEDI </strong>: toplam oy adedinin konumlanacağı yer<br>";


    echo "<form action='admin.php?page=rating-app-settings' method='post'>";

    echo "<br>Default Template :<br> <textarea style='width: 300px; height: 200px;' name='star-app-default'>" . get_option("star-app-default") . "</textarea>";

    echo "<br><br>Oylama Sonrası Template :<br> <textarea style='width: 300px; height: 200px;' name='star-app-after'>" . get_option("star-app-after") . "</textarea>";

    echo "<br><br><input class='button button-primary' type='submit' value='Gönder'/>";

    echo "</form><br><a class='button button-primary' href='admin.php?page=rating-app-settings&temizle=1' type='submit' value='Gönder'/>Temizle</a>";

    echo "</div>";

    global $wpdb,$table_prefix;

    if (isset($_GET["temizle"])) {

        $varmi1 = $wpdb->get_results("SELECT * FROM " . $table_prefix . "postmeta where meta_key = 'star1'");
        $varmi2 = $wpdb->get_results("SELECT * FROM " . $table_prefix . "postmeta where meta_key = 'star2'");
        $varmi3 = $wpdb->get_results("SELECT * FROM " . $table_prefix . "postmeta where meta_key = 'star3'");

        foreach ($varmi1 as $varmi) {
            echo $varmi->meta_value . " Silindi<br>";
            delete_post_meta($varmi->post_id,"star1");
            update_post_meta($varmi->post_id,"star4",get_post_meta($varmi->post_id,"star4",true) + $varmi->meta_value);
        }


        foreach ($varmi2 as $varmi) {
            echo $varmi->meta_value . " Silindi<br>";

            update_post_meta($varmi->post_id,"star4",get_post_meta($varmi->post_id,"star4",true) + $varmi->meta_value);
            delete_post_meta($varmi->post_id,"star2");

        }


        foreach ($varmi3 as $varmi) {

            echo $varmi->meta_value . " Silindi<br>";

            delete_post_meta($varmi->post_id,"star3");
            update_post_meta($varmi->post_id,"star5",get_post_meta($varmi->post_id,"star5",true) +  $varmi->meta_value);
        }


    }
}
