<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>index</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/main.js"></script>
	<!--script src="js/pagination.js"></script-->
       
</head>
<body>
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
            <div class="top-bar">
                <div class="container">
                    <div class="col-9 social">
                        <a href= "logout.php">Log out</a>
                        <a href= "update.php">Update details</a>
						<a href= "changepassword.php">Change Password</a>
						<a href= "gallery.php">Gallery</a>
                    </div>
                </div>
            </div>
            <!-- END TOP BAR -->

            <h1 class="site-logo" align = "center"><a href="index.html">Camagru</a></h1>
            <hr>

		<!-- TOP CONTAINER DIV START -->
        <div class="top_container">  
			<h2> Welcome <?php echo escape($user->data()->name); ?></h2>

			<!-- MAIN CONTAINER DIV START -->
			<div class = "main-container">
			
				<!-- KEEP OVERLAY IN PLACE DIV -->
				<div class="overlay2">
					<!-- OVERLAY DIV -->
					<div id="overlay" class="overlay">
						<img class="text" height='100px' width='100px' id="emoji1" name="emoji1" onclick="off()">
						<img onclick="off2()" class="text" height='100px' width='100px' id="emoji2" name="emoji2">
					</div>
					<!-- END OVERLAY DIV -->
				</div>
				<!-- KEEP OVERLAY IN PLACE DIV -->
				
            	<!-- VIDEO DIV -->
            	<div class = "video" width = "500" height = "375" border = "2px" bordercolor = "red">
					<video id="video">
						<div id="overlay" class="overlay">
							<img class="text" height='100px' width='100px' id="emoji1" name="emoji1" onclick="off()">
							<img onclick="off2()" class="text" height='100px' width='100px' id="emoji2" name="emoji2">
						</div>
						Stream not available				
					</video>
					<img id="uploaded_image" height='375px' width='500px' style= "display:none">
            	</div>
				<!-- END VIDEO DIV-->
				
				<!-- BUTTONS AND CANVAS STARTS -->
				<button id="photo_button">Take Photo</button>
				<canvas id="canvas2"></canvas>
				<button id="save_photo">Save</button>
				<button id="uploadbtn">Upload</button>
				<input type="file" id= "fileupload" style= "display:none">
				<canvas id="canvas"></canvas>
				<!-- BUTTONS AND CANVAS ENDS -->

			</div>
			<!-- MAIN CONTAINER DIV END -->

			<!-- EMOJI CONTAINER DIV START -->
        	<div>
				<img id="e1" src="img/emojis/emoj_1.png" height='50px' width='50px' style="margin: 17px">
				<img id="e2" src="img/emojis/emoj_2.png" height='50px' width='50px' style="margin: 17px">
				<img id="e3" src="img/emojis/emoj_3.png" height='50px' width='50px' style="margin: 17px">
				<img id="e4" src="img/emojis/emoj_4.png" height='50px' width='50px' style="margin: 17px">
				<img id="e5" src="img/emojis/emoj_5.png" height='50px' width='50px' style="margin: 17px">
				<img id="e6" src="img/emojis/emoj_6.png" height='50px' width='50px' style="margin: 17px">
				<img id="e7" src="img/emojis/emoj_7.png" height='50px' width='50px' style="margin: 17px">
				<img id="e8" src="img/emojis/emoj_8.png" height='50px' width='50px' style="margin: 17px">
				<img id="e9" src="img/emojis/emoj_9.png" height='50px' width='50px' style="margin: 17px">
				<img id="e10" src="img/emojis/emoj_10.png" height='50px' width='50px' style="margin: 17px">
				<br>
			</div>
			<!-- EMOJI CONTAINER DIV END -->
			
			<!-- BOTTOM CONTAINER DIV START -->
			<div class="bottom-container">
				<div id="photos"></div>
			</div>
			<!-- BOTTOM CONTAINER DIV END -->

			<!-- POST DIV/ THUMBNAIL START -->
			<div class="thumb_nail">
				<?php
					$db = DB::getInstance();
					$db->get("gallery",array('user_id', '=', $user->data()->user_id));
					$images = $db->results();
					$num_images = $db->count() - 1;
					$items_per_page = 5;
					$total_pages = ceil($num_images/$items_per_page);
					// echo $total_pages;
					// echo "he";
					$page = 1;
					$offset = ($page - 1) * $items_per_page;


					for ($i=0; $i < $items_per_page && $num_images >= 0; $i++) { 
						$img = $images[$num_images]->img_name;
						echo "<img src='$img' height='250px' width='375px'>";
						$num_images--;
					} 
				?>
			</div>
			<!-- POST DIV/ THUMBNAIL ENDS -->

			<!-- START PAGINATION
			<div id="images" class="photo" >
			</div>
			<div id="controls">
				<button id="prev" onclick="prevset();">Previous</button>
				<button id="next" onclick="nextset();">Next</button>
			</div>
			<!-- END PAGINATION -->

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
        </script>
    <?php
///////////////////////////////////////////////////////////////////////////////
//          USER NOT!!!! LOGGED IN!!!
//////////////////////////////////////////////////////////////////////////////
    }
    else
    {
        ?>
        <!-- START header -->
        <div class="top-bar">
        <div class="container">
            <div class="col-9 social">
              <p align = "center">WELCOME TO CAMAGRU</p>
              <!--<img src = "img/camera_icon.jpg" alt = "camera icon" height = "75px" width = "75px">-->
            </div>
        </div>
        </div>
        <section class="site-section">
            <?php 
                echo '<p> You need to <a href="login.php">log in</a> or <a href="register.php">register</a>  or view <a href="gallery.php">Gallery</a>!</p>';
            ?>
        </section>
        <?php
    }
    ?>



    </body>
</html>