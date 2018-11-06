<?php

//allow us to grip shii from init.php
    class config
    {
        public static function get($path = null)
        {   
            if ($path)
            {
                $config = $GLOBALS['config'];
                $path = explode('/', $path);
                //print_r($path);
                foreach($path as $bit)
                {
                    //echo $bit;
                    if (isset($config[$bit]))
                    {
                        $config = $config[$bit];
                    }
                }
                return ($config);
            }
            return false;
        }
        
    }

?>