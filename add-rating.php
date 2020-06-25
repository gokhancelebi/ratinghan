<?php




include "../../../wp-load.php";

$id = $_GET["post_id"];


$star5 = get_post_meta($id,"star5",true);
$star4 = get_post_meta($id,"star4",true);
$star3 = get_post_meta($id,"star3",true);
$star2 = get_post_meta($id,"star2",true);
$star1 = get_post_meta($id,"star1",true);



$vote = $_GET["rating_data"];

if(!isset($_COOKIE["oy_kullandin_mi_" . $_GET["post_id"]])) {

    if($vote == 1){
        if($star1 == false)
        {
            $star1 = 0;
        }
        $star1++;

        update_post_meta($id,"star1",$star1);
    }

    if($vote == 2){
        if($star2 == false)
        {
            $star2 = 0;
        }
        $star2++;
        update_post_meta($id,"star2",$star2);
    }

    if($vote == 3){
        if($star3 == false)
        {
            $star3 = 0;
        }
        $star3++;
        update_post_meta($id,"star3",$star3);
    }

    if($vote == 4){
        if($star4 == false)
        {
            $star4 = 0;
        }
        $star4++;
        update_post_meta($id,"star4",$star4);
    }

    if($vote == 5){
        if($star5 == false)
        {
            $star5 = 0;
        }
        $star5++;
        update_post_meta($id,"star5",$star5);

    }

    setcookie("oy_kullandin_mi_" . $_GET["post_id"], $vote, time() + (86400 * 60), "/");
}





$star5 = get_post_meta($id,"star5",true);
$star4 = get_post_meta($id,"star4",true);
$star3 = get_post_meta($id,"star3",true);
$star2 = get_post_meta($id,"star2",true);
$star1 = get_post_meta($id,"star1",true);


$adet = $star5 + $star4 + $star3 + $star2 + $star1;


$ortalama = (( $star1 ) + (2 * $star2 ) + (3 * $star3 )+ (4 * $star4 ) + (5 * $star5) ) / $adet ;

$ortalama1 = number_format($ortalama,1,",",".");


$ortalama = round($ortalama);





$html = "
    
        <ul post-id='" . get_the_ID() . "' class='rating-app' id='rating-app-" . $rating_app_frontend_count . "' rating-app-id='" . get_the_ID()  . "' rating-data='$ortalama'>
            <li>
                <img src='" . plugin_dir_url(__FILE__) . "img/stars_crystal/rating_off.gif' class='star-app-star star-app-1' id='star-app-1' rating-data='1' rating-app-id='" . get_the_ID() . "'>
            </li>
            <li>
                <img src='" . plugin_dir_url(__FILE__) . "img/stars_crystal/rating_off.gif' class='star-app-star star-app-2' id='star-app-2' rating-data='2' rating-app-id='" . get_the_ID()  . "'>
            </li>
            <li>
                <img src='" . plugin_dir_url(__FILE__) . "img/stars_crystal/rating_off.gif' class='star-app-star star-app-3' id='star-app-3' rating-data='3' rating-app-id='" . get_the_ID()  . "'>
            </li>
            <li>
                <img src='" . plugin_dir_url(__FILE__) . "img/stars_crystal/rating_off.gif'  class='star-app-star star-app-4' id='star-app-4' rating-data='4' rating-app-id='" . get_the_ID()  . "'>
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


echo json_encode([
    "ortalama" => round($ortalama),
    "adet" => $adet,
    "template" => $after_template
]);






