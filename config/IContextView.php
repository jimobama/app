<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IContextView
 *
 * @author Obaro
 */
class IContextView {
   //put your code here
   private  $model=null;
   private  $controller=null; 
   private $action=null;
  private  $viewFile=null;
   private $_valid=false;
   private $_response=null;
   
   
    function __construct($amodel=null,$acontroller=null,$aaction=null) 
      {
      $this->attach($amodel,$acontroller,$aaction);     
      
     }
    
     
     private final function _validate()
     {
         if($this->controller === null)
         {
            if($this->action==null)
            {
             $this->viewFile= DEFAULT_ERROR_VIEW;
            }
            
         }
        else {
            $this->viewFile=VIEW.$this->controller."/".$this->action.".php";
            $this->_valid= true;
        }
     }
    
    final  function View()
    {  
        include_once(DEFAULT_TEMPLATE);        
      
    }
  final public function attach($model,$controller,$action)
   {
       $this->model=$model;
       $this->controller =$controller;
       $this->action =$action;      
       
       $this->_response= new Response();
   }
    final function Content()
    {
        $this->_validate();        
        $this->_response->LoadContext($this->viewFile);       
                
        $this->_response->Show($this->model);
    }
    final function ViewBag($key=null,$value=null)
    {
       return  $this->_response->ViewBag($key,$value);
    }
}
