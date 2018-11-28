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
	<style>
		.body{
			background-image:url('img_smallflower.jpg');		
		}
	</style>
	<!--script src="js/pagination.js"></script-->
       
</head>
<body>
    <?php
	require_once 'core/init.php';

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

        if (Session::exists('home'))
        {
            echo '<p>' .Session::flash('home').'</p>';
        }
        $user = new User();

		//echo ($user->data()->user_id);
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
						<a href= "gallery.php">Gallery</a>
						<a href = "update_details.php">Update Details</a> 
						<a href= "logout.php">Log out</a>
                    </div>
                </div>
            </div>
            <!-- END TOP BAR -->

            <h1 class="site-logo" align = "center"><a href="index.html">Camagru</a></h1>
            <hr>

		<!-- TOP CONTAINER DIV START -->
        <div class="main-container">  
			<h2 align = "center"> Welcome <?php echo escape($user->data()->name); ?></h2>
			
			<!-- MAIN CONTAINER DIV START -->
			<div class = "top-container">
					<!-- OVERLAY DIV
					<div id="overlay" class="overlay">
						<img class="text" height='100px' width='100px' id="emoji1" name="emoji1" onclick="off()">
						<img onclick="off2()" class="text" height='100px' width='100px' id="emoji2" name="emoji2">
					</div>
					END OVERLAY DIV -->
			
				<!-- KEEP OVERLAY IN PLACE DIV -->
				
            	<!-- VIDEO DIV -->
				<div class = "video" width = "500" height = "375" border = "2px" bordercolor = "red">
						<div id="overlay" class="overlay">
							<img class="text" height='100px' width='100px' id="emoji1" name="emoji1" onclick="off()">
							<img onclick="off2()" class="text" height='100px' width='100px' id="emoji2" name="emoji2">
						</div>
					<video id="video">
						Stream not available				
					</video>
					<img id="uploaded_image" height='375px' width='500px' style= "display:none">
				</div>
				</div>
				<!-- END VIDEO DIV-->
				
				<!-- BUTTONS AND CANVAS STARTS -->
				<div>
					<button class= "w3-button w3-section w3-teal w3-ripple" id="photo_button">Take Photo</button>
					<canvas id="canvas2"></canvas>
					<button class= "w3-button w3-section w3-teal w3-ripple" id="save_photo">Save</button>
					<button class= "w3-button w3-section w3-teal w3-ripple" id="uploadbtn">Upload</button>
					<input class= "w3-button w3-section w3-teal w3-ripple" type="file" id= "fileupload" style= "display:none">
					<canvas id="canvas"></canvas>
				</div>
				<!-- BUTTONS AND CANVAS ENDS -->

			</div>
			<!-- MAIN CONTAINER DIV END -->

			<!-- EMOJI CONTAINER DIV START -->
        	<div class="w3-responsive">
				<table class="w3-table-all top-bar w3-animate-right" width = "500px">
					<tr>
						<td><img id="e1" src="img/emojis/emoj_1.png" height='50px' width='50px' style="margin: 17px"></td>
						<td><img id="e2" src="img/emojis/emoj_2.png" height='50px' width='50px' style="margin: 17px"></td>
						<td><img id="e3" src="img/emojis/emoj_3.png" height='50px' width='50px' style="margin: 17px"></td>
						<td><img id="e4" src="img/emojis/emoj_4.png" height='50px' width='50px' style="margin: 17px"></td>
						<td><img id="e5" src="img/emojis/emoj_5.png" height='50px' width='50px' style="margin: 17px"></td>
						<td><img id="e6" src="img/emojis/emoj_6.png" height='50px' width='50px' style="margin: 17px"></td>
						<td><img id="e7" src="img/emojis/emoj_7.png" height='50px' width='50px' style="margin: 17px"></td>
						<td><img id="e8" src="img/emojis/emoj_8.png" height='50px' width='50px' style="margin: 17px"></td>
						<td><img id="e9" src="img/emojis/emoj_9.png" height='50px' width='50px' style="margin: 17px"></td>
						<td><img id="e10" src="img/emojis/emoj_10.png" height='50px' width='50px' style="margin: 17px"></td>
						<br>
					</tr>
				</table>
			</div>
			<!-- EMOJI CONTAINER DIV END -->
			
			<!-- BOTTOM CONTAINER DIV START -->
			<div class="bottom-container">
				<div id="photos"></div>
			</div>
			<!-- BOTTOM CONTAINER DIV END -->

			<!-- POST DIV/ THUMBNAIL START -->
			<div class="w3-row-padding w3-margin-top w3-animate-left">
				<?php
					$db = DB::getInstance();
					$db->get("gallery",array('user_id', '=', $user->data()->user_id));
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

					$this_page_first_result = ($page - 1) * $items_per_page;
					$user_id = $user->data()->user_id;
					$sql = "SELECT * FROM gallery WHERE user_id = $user_id ORDER BY time_stamp DESC LIMIT " . $items_per_page . " OFFSET " . $this_page_first_result ;
					$db->query($sql);
					$result = $db->results();
					$num_res = $db->count();	

					$i = 0;
					$y = 0;
					while ($i < $num_res)
					{
                    	$time = $result[$i]->time_stamp;
						$imgid = $result[$i]->img_id;
						$total = commentcount($imgid);
						$total_likes = likecount($imgid);
						$db->get("comments",array('img_id', '=', $imgid));
    					$comments = $db->results();
    					$num_comments = $db->count() - 1;
						
						echo "
							<div class ='w3-third'>
								<div class ='w3-card'>
									<img src='".$result[$i]->img_name."' style='width:100%'>"."<br>
									<div class='w3-container'>
                                    	<p>$total_likes  <input type='submit' class = 'like2' value = 'LIKE'/></p>
										<p><input type='hidden' name='imgid' id = 'imgid' value = '$imgid'/></p>
										<form action = 'delete_img.php' method = 'post'>
                                    		<p><input type='submit' class = 'like2' value = 'DELETE PICTURE'/></p>
                                    		<input type='hidden' name='imgid' id = 'imgid' value = '$imgid'/></p>
                                    		<input type='hidden' name='page_no' id = 'page_no' value = '$page'/></p>
                                		</form>
										<p><span class='mr-2'>$time</span> &bullet;
										<span class= 'ml-1'><span class= 'fa fa-comments'></span>$total</span></p>
										<p><Button class = 'viewComments' onclick='hidetest(".$y.")'>View Comments</button></p>
										<div id = 'hidden".$y."' class ='w3-animate-bottom' style = 'display:none' >";
											$x = 0;
											while ($num_comments >= $x) { 
												$com = $comments[$x]->comment;
												echo $com."<br><hr>";
												$x++;
											}
						echo "					
                                		</div>
									</div>
								</div>
							</div>";
						$i++;
						$y++;
					}
					echo "</div>";
					echo "<div align='center' class='pagination2'>";
					for ($page=1;$page<=$total_pages;$page++) {
						echo '

									<a href="index.php?page=' . $page . '">' . $page . '</a> 	
							';
					}
					echo "</div>";
				?>
			<!-- POST DIV/ THUMBNAIL ENDS -->

			<!-- START PAGINATION 
			<div id="images" class="photo" >
			</div>
			<div id="controls">
				<button id="prev" onclick="prevset();">Previous</button>
				<button id="next" onclick="nextset();">Next</button>
			</div>
			 END PAGINATION -->

		</div>
		<!-- TOP CONTAINER DIV ENDS -->


<script>
	function off() {
		document.getElementById("emoji1").style.visibility = "hidden";
		document.getElementById("emoji1").removeAttribute('src');

	}
	function off2() {
		document.getElementById("emoji2").style.visibility = "hidden";
		document.getElementById("emoji2").removeAttribute('src');

	}

	emo1 = document.getElementById("e1");
	emo2 = document.getElementById("e2");
	emo3 = document.getElementById("e3");
	emo4 = document.getElementById("e4");
	emo5 = document.getElementById("e5");
	emo6 = document.getElementById("e6");
	emo7 = document.getElementById("e7");
	emo8 = document.getElementById("e8");
	emo9 = document.getElementById("e9");
	emo10 = document.getElementById("e10");
	
//	emo1.addEventListener("click", alert('hello'), false);
	emo1.addEventListener("click", function(){switchsrc(emo1);}, false);
	emo2.addEventListener("click", function(){switchsrc(emo2);}, false);
	emo3.addEventListener("click", function(){switchsrc(emo3);}, false);
	emo4.addEventListener("click", function(){switchsrc(emo4);}, false);
	emo5.addEventListener("click", function(){switchsrc(emo5);}, false);
	emo6.addEventListener("click", function(){switchsrc(emo6);}, false);
	emo7.addEventListener("click", function(){switchsrc(emo7);}, false);
	emo8.addEventListener("click", function(){switchsrc(emo8);}, false);
	emo9.addEventListener("click", function(){switchsrc(emo9);}, false);
	emo10.addEventListener("click", function(){switchsrc(emo10);}, false);

	function switchsrc(emonew)
	{
		document.getElementById("emoji1").style.visibility = "visible";
		if (document.getElementById("emoji1").hasAttribute("src"))
		{
			document.getElementById("emoji2").style.visibility = "visible";
			var emoswitch = document.getElementById("emoji2");
		}
		else
		{
			var emoswitch = document.getElementById("emoji1");
		}
		var ovl = document.getElementById("overlay");
		switch (emonew.id)
		{
			case "e1" :
				emoswitch.setAttribute('src', emonew.src);
				emoswitch.style.top = "10px";
				emoswitch.style.left = "10px";
				break;
			case "e2" :
				emoswitch.setAttribute('src', emonew.src);
				emoswitch.style.top = "10px";
				emoswitch.style.left = "200px";
				break;
			case "e3" :
				emoswitch.setAttribute('src', emonew.src);
				emoswitch.style.top = "10px";
				emoswitch.style.left = "400px";
				break;
			case "e4" :
				emoswitch.setAttribute('src', emonew.src);
				emoswitch.style.top = "100px";
				emoswitch.style.left = "10px";
				break;
			case "e5" :
				emoswitch.setAttribute('src', emonew.src);
				emoswitch.style.top = "100px";
				emoswitch.style.left = "200px";
				break;
			case "e6" :
				emoswitch.setAttribute('src', emonew.src);
				emoswitch.style.top = "100px";
				emoswitch.style.left = "400px";
				break;
			case "e7" :
				emoswitch.setAttribute('src', emonew.src);
				emoswitch.style.top = "250px";
				emoswitch.style.left = "10px";
				break;
			case "e8" :
				emoswitch.setAttribute('src', emonew.src);
				emoswitch.style.top = "250px";
				emoswitch.style.left = "200px";
				break;
			case "e9" :
				emoswitch.setAttribute('src', emonew.src);
				emoswitch.style.top = "250px";
				emoswitch.style.left = "400px";
				break;
			case "e10" :
				emoswitch.setAttribute('src', emonew.src);
				emoswitch.style.top = "100px";
				emoswitch.style.left = "200px";
				break;
		}
	} 
	
	
	///////////////////////////////////////////////////
	//			comments hidden div
	//////////////////////////////////////////////////

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
    <?php
///////////////////////////////////////////////////////////////////////////////
//          USER NOT!!!! LOGGED IN!!!
//////////////////////////////////////////////////////////////////////////////
    }
    else
    {
        ?>
            <?php 
				REDIRECT::to("not_loggedin_index.php");
            ?>
        <?php
    }
    ?>
	<footer class = "site-footer2">
        <p>@lmakwakw2018</p>
    <footer>


    </body>
</html>