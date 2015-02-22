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
   private $_viewBag=null;
   
    function __construct($amodel=null,$acontroller=null,$aaction=null) 
      {
      $this->_viewBag= new ArrayObject(); 
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
       
   }
    final function Content()
    {
       
        $this->_validate();  
        if($this->_valid){       
        ContextManager::$Model= $this->model;        
        include_once($this->viewFile);
        }
         
     
   }
    
    
   final function ViewBag($key,$value=null)
    {
        if($value ==null)
        {
           $bool= $this->_viewBag->offsetExists($key);
           if($bool)
           {
               return $this->_viewBag->offsetGet($key);
           }
           return "";
        }
        else
        {
            //set the value of the array with the key
            $bool= $this->_viewBag->offsetExists($key);
            if($bool)
            {
                $this->_viewBag->offsetUnset($key);
            }
            $this->_viewBag->offsetSet($key, $value);
        }
    }
}
