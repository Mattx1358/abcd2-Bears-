<?php
require_once __DIR__ . "/../../db_configuration.php";

class Dress{
    // properties
    public int $id;
    public $name;
    public $description;
    public $did_you_know;
    public $category;
    public $type;
    public $state_name;
    public $key_words;
    public $image_url;
    public $status;
    public $notes;
    private static $connection; 

    public static function setConnection($conn) {
        self::$connection = $conn;
    }

    // constructor
    public function __construct() {}

    /**
     * this function takes 1 parameters which is the integer id to be searched. the function
     * returns the dress object with that id, or null if none exists.
     */
    public static function getById($id){  
        $sql = "SELECT * FROM `dresses` WHERE id = " . $id;
        $result = run_sql($sql);

        // since id is the unique key, there is at most one result to return
        if ($result->num_rows > 0) {
            $obj = $result->fetch_object('Dress');
            return $obj;
        }
        else {
            return null;
        }
    }

    /**
     * this function takes an associative array of parameters. the keys should be the
     * database columns to query. the values should be the database row values to match.
     * multiple values can be provided if separated by a comma.
     */
    public static function getByParams($params){
        // build string
        $sql = "SELECT `id` FROM `dresses` WHERE ";
        foreach($params as $key => $values){
            $values = explode(",", $values);
            foreach($values as $value) {
                $sql .= "`" . $key . "` LIKE '%" . $value . "%' AND ";
            }
        }

        // remove the last " AND " from the string
        $sql = substr($sql, 0, -5);

        // store the results
        $result = run_sql($sql);
        $ids = array();
        while ($obj = $result->fetch_object('Dress')) {
            array_push($ids, $obj->id);
        }
        return $ids;
    }

    /*
    * This function can take 0 to all of the parameters.
    * All parameters are optional and are based off the sql table 'dresses'
    */
    public function addDress($name, $description, $did_you_know, $category, $type, $state_name, $key_words, $image_url, $status, $notes) {
        $name = $this->escapeString($name);
        $description = $this->escapeString($description);
        $did_you_know = $this->escapeString($did_you_know);
        $category = $this->escapeString($category);
        $type = $this->escapeString($type);
        $state_name = $this->escapeString($state_name);
        $key_words = $this->escapeString($key_words);
        $image_url = $this->escapeString($image_url);
        $status = $this->escapeString($status);
        $notes = $this->escapeString($notes);
    
        $sql = "INSERT INTO `dresses` (`name`, `description`, `did_you_know`, `category`, `type`, `state_name`, `key_words`, `image_url`, `status`, `notes`)
                VALUES ('$name', '$description', '$did_you_know', '$category', '$type', '$state_name', '$key_words', '$image_url', '$status', '$notes')";
    
        $result = run_sql($sql);
    
        if ($result) {
            $last_id = self::$connection->insert_id;
            return $this->getById($last_id);
        } else {
            return false; 
        }
    }

    private function escapeString($value) {
        // Prevent SQL injection
        return mysqli_real_escape_string(self::$connection, $value);
    }
}
?>