<?php

class Database extends PDO {

    //put your code here
    private $response = array();
    private $queryString = null;

    public function __construct() {
        //connect to the server and to the specific database  
        $this->queryString = "";
        try {
            parent::__construct("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
        } catch (PDOException $err) {
            $response["Status"] = "200";
            $response["ErrorMessage"] = $err->getMessage();
            $json = json_encode($response);
            die("<pre>$json</pre>");
        }
    }

//end functions

    public function createFields($name, $type, $constraints) {
        if (Validator::IsWord(trim($name))) {
            $fields = "$name  $type  $constraints";
            $this->buildQuery($fields);
        }
    }

    public function createTable($tablename) {
        $query = "Create Table If Not Exists $tablename (" . $this->queryFields() . ")";

        $stmt = $this->prepare($query);
        $abool = $stmt->execute();
        if (!$abool) {
            print_r($stmt->errorInfo());
        }
    }

    function buildQuery($field) {
        if (is_string($field)) {
            $this->queryString = $this->queryString . "$field ,";
        }
    }

    function queryFields() {
        $this->queryString = trim($this->queryString, ",");
        return $this->queryString;
    }

}

//end