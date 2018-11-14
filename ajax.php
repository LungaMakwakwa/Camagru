<?php
include "core/init.php";
$user = new user();
$db = DB::getInstance();


if(isset($_POST['offset2']))
{
    profilegallery();
}
else if(isset($_POST['picCounter']))
{
    imgCount();
}
else if(isset($_POST['picCounter2']))
{
    imgCount2();
}
else if(isset($_POST['offset']))
{
    homegallery();
}
else if(isset($_POST['username']))
{
    usernameupdate2();
}
else if(isset($_POST['email']))
{
    emailupdate2();
} 
else if(isset($_POST['passwd_new']) && isset($_POST['passwd_current']) && isset($_POST['passwd_new_again']))
{
    passwordupdate2();
}
else
{
    redirect::to('index.php');
}
function homegallery()
{
    global $db;
    $db->query("SELECT * FROM gallery ORDER BY time_stamp DESC LIMIT ".$_POST['limit']." OFFSET ".$_POST['offset']);
    $images = $db->results();
    $num_images = $db->count() - 1;
    echo json_encode($images);
}
function profilegallery()
{
    global $db, $user;
    $db->query("SELECT * FROM gallery WHERE `user_id` =".$user->data()->user_id." ORDER BY time_stamp DESC LIMIT ".$_POST['limit']." OFFSET ".$_POST['offset2']);
    $images = $db->results();
    $num_images = $db->count() - 1;
    echo json_encode($images);
}
//count images
function imgCount()
{
    global $db;
    $db->query("SELECT * FROM gallery");
    $images = $db->results();
    $num_images = $db->count() - 1;
    echo intval($num_images); 
}
function imgCount2()
{
    global $db, $user;
    $db->query("SELECT * FROM gallery WHERE `user_id` = ".$user->data()->user_id."");
    $images = $db->results();
    $num_images = $db->count() - 1;
    echo intval($num_images); 
}
function passwordupdate2()
{
 
    if (input::exists()) {
               global $user;
            
            $validate = new validate();
            $validation = $validate->check($_POST, array(
                'passwd_current' => array(
                    'required' => true,
                    'min' => 6
                ),
                'passwd_new' => array(
                    'required' => true,
                    'min' => 6
                ),
                'passwd_new_again' => array(
                    'required' => true,
                    'min' => 6,
                    'matches' => 'passwd_new'
                )
            ));
            if ($validation->passed()) {
                if (hash::make(input::get('passwd_current')) !== $user->data()->passwd)
                {
                    echo "Your current password was incorrect :(";
                }
                else
                {
                    $user->update(array(
                        'passwd' => hash::make(input::get('passwd_new'))
                    ));
                    echo "Password update successfully";
                }
            } else {
                foreach ($validation->errors() as $error) {
                    echo $error, "<br>";
                }
            }
            
        
    }
}
    function usernameupdate2()
	{
        global $user;
		if (input::exists()) {
				
				$validate = new validate();
				$validation = $validate->check($_POST, array(
					'username' => array(
						'min' => 2,
						'max' => 20,
						'unique' => 'users'
					),
				));
				if ($validation->passed())
				{
					try{
						$user->update(array(
							'username' => escape(input::get('username')),
						));
                        echo "Username update successfully";
					}
					catch(Exception $e)
					{
						die($e->getMessage()); 
					}
				}
				else{
					foreach ($validation->errors() as $error) {
						echo $error, '<br>';
					}
				}
			
		}
	}
	
	function emailupdate2()
	{
        global $user;
		if (input::exists()) {
		
				
				$validate = new validate();
				$validation = $validate->check($_POST, array(
					'email' => array(
						'required' => true,
						'unique' => 'users'
					),
					'email_again' => array(
						'required' => true,
						'matches' => 'email'
					)
				));
	
				if ($validation->passed()) {
					
						$user->update(array(
							'email' => escape(input::get('email'))
						));
                        echo "Email update successfully";
					
				} else {
					foreach ($validation->errors() as $error) {
						echo $error, "<br>";
					}
				}
				
			
		}
    }
?>