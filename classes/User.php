<?php
    class User
    {
        private $_db;
        private $_data;
        private $_sessionName;
        private $_isLoggedIn;
        

        public function __construct($user = null)
        {
            $this->_db = DB::getInstance();
            $this->_sessionName = Config::get('session/session_name');

            if (!$user)
            {
                if (Session::exists($this->_sessionName))
                {
                    $user = Session::get($this->_sessionName);
                    //echo $user;
                    if ($this->find($user))
                    {
                        $this->_isLoggedIn = true;
                    }
                    else
                    {
                        //process Logout
                    }
                }
                else
                {
                    $this->find($user);
                }
            }
        }

        public function update($field = array())
        {
            if (!$id && $this->isLoggedIn())
            {
                $id = $this->data()->id;
            }
            if (!$this->_db->update('users', $id, $fields))
            {
                throw new Exception('There was a problem updating.');       
            }
        }

        public function create($fields = array())
        {
            //print_r ($fields);
            if (!$this->_db->insert('users', $fields))
            {
                //print_r($fields);
                throw new Exception('There was a problem creating an account.');
            }
        }

        public function find($user = null)
		{
			if ($user) {
				$field = (is_numeric($user)) ? 'user_id' : 'username';
				$data = $this->_db->get('users', array($field, '=', $user));
				if($data->count())
				{
					$this->_data = $data->first();
					return true;
				}
			}
			return false;
		}
		public function login($username = null, $password = null)
		{
			$user = $this->find($username);
			//if (!$username && !$passwd && $this->exists()) {
			//	session::put($this->_sessionName, $this->data()->user_id);
			//} else {
            if($user)
            {
                if (!strcmp($this->_data->username, $username)) 
                {
                    //echo $this->data()->passwd;
                    if($this->data()->password === hash::make($password))
                    {
                        Session::put($this->_sessionName, $this->data()->user_id);
                    }
                    return true;
                }
            }
            return false;
		}

        public function data()
        {
            return $this->_data;
        }

        public function logout()
        {
            Session::delete($this->_sessionName);
        }

        public function isLoggedIn()
        {
            return $this->_isLoggedIn;   
        }
    }
?>