<?php
    class DB {
        //store instance in DB if avail...
        private static $_instance = NULL;
        private $_pdo,
                //last query executed
                $_query,
                //error handle the query
                $_error = false,
                //result set 
                $results,
                //result count
                $_count = 0;

        //Database you are connecting too
        private function __construct() {
            try {
                $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname='. Config::get('mysql/db'), config::get('mysql/username'), config::get('mysql/password'));
            //  )))echo 'Connected';
            }
            catch(PDOException $e) {
                die($e->getMessage());
            }
        }

        //create new instance to connect to db
        public static function getInstance() {
            if (!isset(self::$_instance)) {
                self::$_instance = new DB();
            }
            return self::$_instance;
        }
        
        //prepare sql 
        public function query($sql, $params = array()) {
            $this->_error = false;
            if ($this->_query = $this->_pdo->prepare($sql)) {
                $x = 1;
                //check if param exist
                if (count($params)) {
                    foreach($params as $param) {
                        $this->_query->bindValue($x, $param);
                        $x++;
                    }
                }
                //if no params still execute query
                if ($this->_query->execute()) {
                    //echo 'success';
                    $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                    $this->_count = $this->_query->rowCount();
                } else {
                    $this->_error = true;
                }
            }
            return $this;
        }

        //prepare sql 
        public function query2($sql, $params = array()) {
            $this->_error = false;
            if ($this->_query = $this->_pdo->prepare($sql)) {
                $x = 1;
                //check if param exist
                if (count($params)) {
                    foreach($params as $param) {
                        $this->_query->bindValue($x, $param);
                        $x++;
                    }
                }
                //if no params still execute query
                if ($this->_query->execute()) {
                    //echo 'success';
                    $this->_results = $this->_query->fetchAll();
                    $this->_count = $this->_query->rowCount();
                } else {
                    $this->_error = true;
                }
            }
            return $this;
        }

        public function action($action, $table, $where = array()) {
            if (count($where) == 3) {
                $operators = array('=', '>', '<', '>=', '<=');
                
                $field = $where[0];
                $operator = $where[1];
                $value = $where[2];
                
                if (in_array($operator, $operators)) {
                    $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
                    if (!$this->query($sql, array($value))->error()) {
                        return $this;
                    }
                }
            }
            return false;
        }

        public function get($table, $where) {
            return $this->action('SELECT *', $table, $where);
        }

        public function delete($table, $where) {
            return $this->action('DELETE *', $table, $where);
        }

        public function insert($table, $fields) {
            if (count($fields)) {
                $keys = array_keys($fields);
                $values = NULL;
                $x = 1;

                foreach ($fields as $field) {
                    $values .= "?";
                    if ($x < count($fields)) {
                        $values .= ', ';
                    }
                    $x++;
                }
                $sql = "INSERT INTO {$table} (`" . implode('`,`', $keys) . "`) VALUES ({$values})";
                //echo $values;

                if (!$this->query($sql, $fields)->error()) {
                    return true;
                }

               echo $sql."\n";
                //print_r (escape($fields));
            }
            return false;
        }

        public function update($table, $id, $fields)
        {
            $set = '';
            $x = 1;
            foreach ($fields as $name => $values) {
                $set .= "{$name} = ?";
                if($x < count($fields))
                    {
                        $set .= ', ';
                    }
                    $x++;
            }
            $sql = "UPDATE {$table} SET {$set} WHERE `user_id` = {$id}";
            if (!$this->query($sql, $fields)->error())
            {
                return true;
            }
            return false;
        }

        public function results() {
            return $this->_results;
        }

        public function first()
		{
			return $this->results()[0];
		}

        public function error() {
            return $this->_error;
        }

        public function count() {
            return $this->_count; 
        }

    }
?>