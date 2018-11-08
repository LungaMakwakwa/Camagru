<?php
    require_once 'core/init.php';

    Redirect::to('gallery.php');
/*$db = DB::getInstance();
$db->get("comments",array('img_id', '=', $imgid));
$comments = $db->results();
$num_comments = $db->count() - 1;

for ($i=0; $i < 10 && $num_comments >= 0; $i++) { 
    $com = $comments[$num_comments]->img_name;
    $time = $comments[$num_comments]->time_stamp;
    $imgid = $comments[$num_comments]->img_id;
    //$total = commentcount($imgid);
    //$total_likes = likecount($imgid);
}*/



?>