<?php
class Database extends PDO{
    //put your code here
   private $response =array();
    public function __construct() { 
        //connect to the server and to the specific database  
        try
        {
        parent::__construct("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
        }
        catch(PDOException $err)
        {
            $response["Status"]="200";
            $response["ErrorMessage"]=$err->getMessage();            
            $json= json_encode($response);
            die("<pre>$json</pre>");
        }
            
    }//end functions
    
 
}//end