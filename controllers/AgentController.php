<?php


class AgentController  extends IController{
  
    function __construct() {
       
    }
    
    
    function Index()
    {
        
        return $this->View(null,"Agent","Index");
    }
    
    function Login()
    {
        
        
       return $this->View(null,"Agent","Login");  
    }
    
    function Create()
    {
        $model= "new IModel();";
        
       return $this->View($model,"Agent","Index");  
    }
}
