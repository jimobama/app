<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AgentModel
 *
 * @author Obaro
 */




class AgentModel extends IModel{
    //put your code here
    public  $agent=null;
    private $db =null;
    function __construct(Agent $model=null) {
        parent::__construct();
        $this->agent=$model;
        $this->db= new Database();
        
       
    }
   public final function IsLogin($email,$password)
    {
        if($email ==null || trim($email)=="" )
        {
            return false;
        }
       
        
        if($this->db!=null)
        {
           
            $query = "select *from tbl_agent where email=:email and password = :password";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(":email", addslashes(trim(strtolower($email))));
            $stmt->bindValue(":password", sha1($password));   
           
           try
           {
              $stmt->execute();            
            if($stmt->rowCount()>0)
             {
                return true;
             }
           }
           catch(Exception $ex)
           {
               throw $ex;
           }
            
        }
        
        return false;
    }
    
    public final function  Exists()
    {
        if($this->agent==null || $this->db ==null){
            return false;
        }
    
        $okay=false;
        
        if($this->db !=null)
        {
             $statement="select *from tbl_agent where email =:email";
             $stmtbj = $this->db->prepare($statement);
             $stmtbj->bindValue(":email", strtolower($this->agent->email));
             
             $stmtbj->execute();
             if( $stmtbj->rowCount()>0)
             {
              $okay= true;   
             }
              
        }
       
     return    $okay;
    }
 
    public final function Create()
    {
        $okay= false;
        
        if($this->db !=null)
        {
             $query = "insert into tbl_agent(email,phone,firstname,lastname,password,active,id)"
                     . "Values(:email,:phone,:firstname,:lastname,:password,:active,:id)";
             $stmtbj =  $this->db->prepare($query);
             $stmtbj->bindValue(":email", addslashes(strtolower(trim($this->agent->email))));
             $stmtbj->bindValue(":phone", addslashes(strtolower(trim($this->agent->phonenumber))));
             $stmtbj->bindValue(":lastname", addslashes(strtolower(trim($this->agent->lastname))));
             $stmtbj->bindValue(":firstname", addslashes(strtolower(trim($this->agent->firstname))));
             $stmtbj->bindValue(":password", sha1($this->agent->password));
             $stmtbj->bindValue(":active","0");
             $stmtbj->bindValue(":id", addslashes(strtolower(trim($this->agent->agentId))));
             
             //execute the query
             try
             {
                $okay=  $stmtbj->execute();             
                 
             } catch (Exception $ex) {
                 throw $ex;   
             }
        }
        
        return $okay;
    }
}
