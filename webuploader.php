<?php
        require_once "core/init.php";

        $x;
        $y;
        $pos1;
        $pos2;
        $height;
        $width;
    
        $db = DB::getInstance();
        $user = new User();
    
        $imgnum = $db->get("gallery",array('user_id', '=', $user->data()->user_id));
        $img_id = $imgnum->count() + 1;
        $user_id = $user->data()->user_id;
        //echo ($user_id);
        
        $data = explode( ',', $_POST["img64"] );
        //print_r ($data);
        $test = base64_decode($data[1]);
        
        file_put_contents("img/gallery/user_".$user_id."_image_".$img_id.".png", $test);
        $dest= imagecreatefrompng("img/gallery/user_".$user_id."_image_".$img_id.".png");
    
        if(!empty($_POST["emoji64"]))
        {
            $emo = explode ('camagru/',$_POST["emoji64"]);
            
            $src = imagecreatefrompng($emo[1]);
            $width = ImageSx($src);
    
            $height = ImageSy($src);
            pic_position($emo);
            ImageCopyResampled($dest,$src,$pos2,$pos1,0,0,$x,$y,$width,$height);
        }
        
        if(!empty($_POST["emoji64_2"]))
        {
            $emo2 = explode ('camagru/',$_POST["emoji64_2"]);
    
            $src = imagecreatefrompng($emo2[1]);
            $width = ImageSx($src);
    
            $height = ImageSy($src);
            pic_position($emo2);
            ImageCopyResampled($dest,$src,$pos2,$pos1,0,0,$x,$y,$width,$height);
        }
        imagepng($dest, "img/gallery/user_".$user_id."_image_".$img_id.".png");
    
        $db->insert('gallery', array(
            'img_name' => 'img/gallery/'."user_".$user_id."_image_".$img_id.'.png',
            'user_id' => $user_id
        ));
        Redirect::to("index.php"); 

        function pic_position($emo)
        {
            global $x, $y, $width, $height, $pos1, $pos2;
    
            switch ($emo[1])
            {
                case "img/emojis/emoj_1.png" :
                    $pos1 = 10;
                    $pos2 = 10;
                    $x = $width/5; $y = $height/5;
                    break;
                case "img/emojis/emoj_2.png" :
                    $pos1 = 10;
                    $pos2 = 200;
                    $x = $width/5; $y = $height/5;
                    break;
                case "img/emojis/emoj_3.png" :
                    $pos1 = 10;
                    $pos2 = 400;
                    $x = $width/5; $y = $height/5;
                    break;
                case "img/emojis/emoj_4.png" :
                    $pos1 = 100;
                    $pos2 = 10;
                    $x = $width/5; $y = $height/5;
                    break;
                case "img/emojis/emoj_5.png" :
                    $pos1 = 100;
                    $pos2 = 200;
                    $x = $width/5; $y = $height/5;
                    break;
                case "img/emojis/emoj_6.png" :
                    $pos1 = 100;
                    $pos2 = 400;
                    $x = $width/4; $y = $height/4;
                    break;
                case "img/emojis/emoj_7.png" :
                    $pos1 = 250;
                    $pos2 = 10;
                    $x = $width/4; $y = $height/4;
                    break;
                case "img/emojis/emoj_8.png" :
                    $pos1 = 250;
                    $pos2 = 200;
                    $x = $width/5; $y = $height/5;
                    break;
                case "img/emojis/emoj_9.png" :
                    $pos1 = 250;
                    $pos2 = 390;
                    $x = $width/6; $y = $height/6;
                    break;
                case "img/emojis/emoj_10.png" :
                    $pos1 = 100;
                    $pos2 = 200;
                    $x = $width/5; $y = $height/5;
                    break;
            }
        } 


?>