<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TProduct
 *
 * @author jimobama
 */
class Agent extends IModel {

   
    //put your code here
    public $agentId;
    public $firstname;
    public $lastname;
    public $email;
    public $phonenumber;
    public $date_reqistered;
    public $password;
   
    public function __construct()
    {
      // parent::__construct();    
    }
   
    
    final public function set($firstname,$lastname,$email,$phone,$password) {
        
      $firstname = $firstname=="null"?null:$firstname;
      $lastname =$lastname=="null"?null:$lastname;
      $email =$email=="null"?null:$email;
      $password =$password=="null"?null:$password;
      $phone =$phone=="null"?null:$phone;
     
     $this->agentId=  Validator::UniqueKey();
     $this->firstname=$firstname;
     $this->lastname=$lastname;
     $this->email=$email;
     $this->phonenumber=$phone;
     $this->password= $password;
     $this->date_reqistered=Date("d/m/Y",time()) ;        
    }
   
 final public  function validated()
    {
       $okay=true;
       if(trim($this->agentId)=="" )
       {
           $this->setError("Agent id not set or there is an error during the submission of the form contact administrator");
           $okay=false;
       }  
      else if(!Validator::isEmail($this->email))
       {
         $this->setError("Enter a valid email address");
         $okay=false;   
       }
      else if(!Validator::isWord($this->firstname) || strlen(trim($this->firstname))<=2 )
      {
          $this->setError("Enter a valid firstname!");
          $okay=false; 
      }
      else if(!Validator::isWord($this->lastname)|| strlen(trim($this->lastname))<=2)
      {
          $this->setError("Enter a valid lastname!");
          $okay=false; 
      } 
      else if(!Validator::isNumber($this->phonenumber))
      {
          $this->setError("Enter a valid  phone number e.g +44(0)7765441232!");
          $okay=false; 
      } 
     else if(strlen(trim($this->password))< 6)
      {
          $this->setError("Enter a valid password that is more than 5 character!");
          $okay=false; 
      } 
  
     return $okay;
    }

    
    
    
    
}//end class

//end class Tproduct
?>
