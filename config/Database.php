<?php
class Database extends PDO{
    //put your code here
 
    public function __construct() { 
        //connect to the server and to the specific database  
        try
        {
        parent::__construct("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
        }
        catch(PDOException $err)
        {
          die("Database connection error:".$err->getMessage()); 
        }
            
    }//end functions
    
 
}//end