<?php
        require_once 'core/init.php';
        /////////////////////////////
        //      comment validation 
        /////////////////////////////

        // $imgid  = Input::get('imgid');
        // $db = DB::get("likes", array('imgid', '=', $imgid));
        // $img_id = $db->results();
        // print_r ($img_id);
        // $inp_id = Input::get('imgid');




        $user = new User();
        if (Input::exists())
        {
            $db = DB::getInstance();
            $imgid = Input::get('imgid');
            // print_r ($user->data()->user_id);
            //$db->get('likes', array('img_id', '=', $imgid));
            // $img_id = $db->results();
            // print_r ($img_id);
            // if ($img_id->first() && $user_id)
            //     echo "cray cray";
            $users_id = $user->data()->user_id;

            $sql = "SELECT * FROM likes WHERE img_id = $imgid AND user_id = $users_id";
            $liker = $db->query($sql);
            //print_r($liker);
            $numlikes = $liker->count();
            //echo($numlikes);
            if ($numlikes === 0)
            {
                $db->insert('likes', array(
                    'img_id' =>  $imgid,
                    'user_id' => $user->data()->user_id
                ));
                echo "like added";
            }
            else
            {
                $sql_del = "DELETE FROM likes WHERE img_id = $imgid AND user_id = $users_id";
                $unlike = $db->query($sql_del);
                var_dump($unlike);
                echo "like removed";
            }
            
        }
        Redirect::to('gallery.php');
?>