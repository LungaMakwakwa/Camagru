<?php
    require_once "core/init.php";

    $db = DB::getInstance();

    $imgid = Input::get('imgid');
    echo $imgid."<br>";
    $image = $db->query( "DELETE FROM `gallery` WHERE `img_id` = ?", array("img_id"=>$imgid));
    echo $db->count()."<br>";
    $comments = $db->query( "DELETE FROM `comments` WHERE `img_id` = ?", array("img_id"=>$imgid));
    echo $db->count()."<br>";
    $likes = $db->query( "DELETE FROM `likes` WHERE `img_id` = ?", array("img_id"=>$imgid));
    echo $db->count()."<br>";

    Session::flash('Delete', 'Image successfully deleted');
    $page = $_POST['page_no'];
    Redirect::to("index.php?page=".$page);
?>