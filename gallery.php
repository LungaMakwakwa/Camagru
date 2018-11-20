<?php
function commentcount($picid)
{
    $db = DB::getInstance();
    $db->get("comments",array('img_id', '=', $picid));
    $imid = $db->results();
    $total = $db->count();
    return $total;
}

function likecount($picid)
{
    $db = DB::getInstance();
    $db->get("likes",array('img_id', '=', $picid));
    $imid = $db->results();
    $total = $db->count();
    return $total;
}
/////////////////////////////////////////////////////////////////
//      FIX!!! ONLY ECHOS ONE COMMENT
/////////////////////////////////////////////////////////////////
function showcomments($theid)
{
    $db = DB::getInstance();
    $db->get("comments",array('img_id', '=', $theid));
    $comments = $db->results();
   // print_r($comments);
    $num_comments = $db->count() - 1;

    $x = 0;
    while ($num_comments >= $i) { 
        $com = $comments[$i]->comment;
        //return ($com);
         //com ="<br>";
        echo $com."<br>";
        $x++;

    }
    //return ($com);
    //echo ($com);
    //return ($com);
    

}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>index</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/w3.css">
    <script src="js/main.js"></script>
       
</head>
<body background="bg.jpg">
    <?php
	require_once 'core/init.php';
	

        if (Session::exists('home'))
        {
            echo '<p>' .Session::flash('home').'</p>';
        }
        $user = new User();

////////////////////////////////////////////////////////////
//          IF USER LOGGED IN!
////////////////////////////////////////////////////////////
        if ($user->isLoggedIn())
        {
    ?>  
            <!-- Top BAR -->  
            <div class="top-bar top-bar w3-animate-top">
                <div class="container w3-container w3-animate-zoom">
                    <div class="col-9 social">
                        <a href= "index.php">Profile</a>
						<a href= "update_details.php">Update details</a>
						<a href= "logout.php">Log out</a>
                    </div>
                </div>
            </div>
            <!-- END TOP BAR -->

            <h1 class="site-logo" align = "center"><a href="index.html">Camagru</a></h1>
            <hr>

        <div align = "center">
                <h2> Welcome <?php echo escape($user->data()->name); ?></h2>
        </div>
        <!-- START post -->
        <div class="w3-row-padding w3-margin-top w3-animate-left">
            <?php
					$db = DB::getInstance();
					$db->get("gallery",array('user_id', '>', 1));
					$images = $db->results();
					$num_images = $db->count() - 1;
					$items_per_page = 3;
					$total_pages = ceil($num_images/$items_per_page);
					$page = 1;

					if (!isset($_GET['page']))
					{
						$page = 1;
					}
					else
					{
						$page = $_GET['page'];
					}

					$this_page_first_result = (intval($page) - 1) * $items_per_page;
					$sql = "SELECT * FROM gallery LIMIT " . $items_per_page . " OFFSET " . $this_page_first_result ;
					$db->query($sql);
					$result = $db->results();
					$num_res = $db->count();	

                    $i = 0;
                    $y = 0;
				for ($i=0; $i < $num_res; $i++) { 
                    $img = $result[$i]->img_name;
                    $time = $result[$i]->time_stamp;
                    $imgid = $result[$i]->img_id;
                    //$img = $images[$num_images]->img_name;
                    //$time = $images[$num_images]->time_stamp;
                    //$imgid = $images[$num_images]->img_id;
                    $total = commentcount($imgid);
                    $total_likes = likecount($imgid);

                    $db->get("comments",array('img_id', '=', $imgid));
                    $comments = $db->results();
                    $num_comments = $db->count() - 1;
                    echo 
                    "
                    <div class='w3-third'>
                        <div class = 'w3-card'>
                            <img src='".$result[$i]->img_name."' style='width:100%'>"."<br>
                            <div class='w3-container'>
                                <form action = 'likes.php' method = 'post'>
                                    <p>$total_likes  <input type='submit' class = 'like' value = 'LIKE'/></p>
                                    <input type='hidden' name='imgid' id = 'imgid' value = '$imgid'/></p>
                                    <input type='hidden' name='page_no' id = 'page_no' value = '$page'/></p>
                                </form>
                                <p><span class='mr-2'>$time</span> &bullet;
                                <span class= 'ml-1'><span class= 'fa fa-comments'></span>$total</span></p>
                                <p><Button class = 'viewComments' onclick='hidetest(".$y.")'>View Comments</button></p>
                                <div id = 'hidden".$y."' style = 'display:none' class = 'w3-margin-top w3-animate-top' >";
                                    $x = 0;
                                    while ($num_comments >= $x) { 
                                        $com = $comments[$x]->comment;
                                        echo $com."<br><hr>";
                                        $x++;
                                    }
                    echo
                    "
                               </div>
                                <form action = 'comments.php' method='post'>
                                    <input style = 'width: 100%' type='text' class= 'w3-input' name='comment' id = 'comment' autocomplete='off' placeholder='Comment on Picture' align = 'left'/>
                                    <input type='hidden' name='imgid' id = 'imgid' value = '$imgid'/>
                                    <input type='submit' class = 'like2' value = 'Comment'/>
                                    <input type='hidden' name='page_num' id = 'page_num' value = '$page'/></p>
                                </form>
                                <p> </p>
                            </div>
                        </div>
                    </div>

                    ";
                    $num_images--;
                    $y++;
                }
               // echo ($page);

                for ($page=1;$page<=$total_pages;$page++) {
                    echo '<a href="gallery.php?page=' . $page . '">' . $page . '</a> ';
                }
            ?>
            </div>
        </div>
        <!-- END post -->
        </div>
        </div>
    <?php
///////////////////////////////////////////////////////////////////////////////
//          USER NOT!!!! LOGGED IN!!!
//////////////////////////////////////////////////////////////////////////////
    }
    else
    {
        ?>
        <!-- START header -->
        <div class="top-bar top-bar w3-animate-top">
        <div class="container w3-container w3-animate-zoom">
            <div class="col-9 social">
              <p align = "center">WELCOME TO CAMAGRU</p>
              <!--<img src = "img/camera_icon.jpg" alt = "camera icon" height = "75px" width = "75px">-->
            </div>
        </div>
        </div>
        <section class="site-section">
            <?php 
                echo '<p> You need to <a href="login.php">log in</a> or <a href="register.php">register</a>!</p>';
            ?>
            <!-- Start Post-->
            <div class="thumb_nail">
            <div class='post-entry-horzontal'>
			<?php
				$db = DB::getInstance();
                $db->get("gallery",array('user_id', '>', 0));
                $images = $db->results();
				$num_images = $db->count() - 1;

				for ($i=0; $i < 10 && $num_images >= 0; $i++) { 
                    $img = $images[$num_images]->img_name;
                    $time = $images[$num_images]->time_stamp;
                    $imgid = $images[$num_images]->img_id;
                    $total = commentcount($imgid);
                    echo 
                    "
                        
                        <div class = 'image'>
                            <img src='$img' width='200px' heigh='167px' >
                        </div>
                        <span class = 'text'>
                            <div class='post-meta'>
                                <span class='mr-2'>$time</span> &bullet;
                                <span class= 'ml-1'><span class= 'fa fa-comments'></span>$total</span>
                                <input type='hidden' name='imgid' id = 'imgid' value = '$imgid'/>
                            </div>
                        </span>

                    ";
					$num_images--;
                } 
            ?>
            </div>
        </div>
        </section>
        <?php
    }
    ?>
    <script>

        function hidden_div(y) {
            var x = document.getElementById("hidden"+y);
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
        function hidetest(y) {
            var x = document.getElementById("hidden"+y);
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>
    </body>
</html>