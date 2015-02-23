<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of request
 *
 * @author Obaro
 */
class Request  {
   
  private $_website=null;
  private  $_reflection=null;
  private $_request_array=null;
  private $_controller=null;
  private $_action=null;
  private $_valid;
  private $params=null;
  private  $__methodRef=null;
  private $__parameters=null;

  public  function __construct() 
    {
      //get the current url and parse it to the controlelrs and the method action and parameters
    
        $this->_website = \filter_input(INPUT_SERVER,"HTTP_HOST");
        $this->_request_array = new ArrayIterator($_REQUEST);
        
       
        $this->params= new ArrayIterator(array());       
        $this->_parser();       
       // $this->_reflection= new ReflectionClass($this->_controller);        
        $this->__parameters= array();
        
    }
    

 private function _parser()
    {
     if(($this->_request_array != null) && ($this->_request_array->count()>0))
     {
         $this->_request_array->seek(0);
         //controller 0;
         //action 1;
         //the rest are parameters
         
         $controller = $this->_request_array->current();
         $this->_request_array->next();  
         
         if( $this->_request_array->valid())
         {
          $action = $this->_request_array->current(); 
          $this->loadParams();         
         }else
         {
            $action= "Index"; 
         }
         //we get the controller and the action methods
         $this->_controller =  $controller;
         $this->_action = $action;
         //load the paramters        
        $this->loadController();    
     }
     
     
    }
    
 private function loadController()
 {

  $controller_full = $this->_controller.CONTROLLER_SUFIX;
  $controller_path= CONTROLLER_PATH.$controller_full.".php";
  
  if(file_exists(strtolower($controller_path)))
    {
      include_once($controller_path);   
     if(class_exists($controller_full))
     {
         $this->_controller= $controller_full;
        $this->_validation();
     }
    }
   
 
 }
 
private function _validation()
{
    try
    {
        $this->_reflection= new ReflectionClass($this->_controller) ;   
        $this->_refMethodParser($this->_reflection);
    } 
    catch (ReflectionException $ex) {
        $this->_valid=false;
        $this->_errorReporter($ex->getMessage());
    }
}
 
private function _refMethodParser(ReflectionClass $ref)
{
    try
    {
              
      if(!$ref->hasMethod($this->_action))
       {
             throw new Exception("The class $this->_controller did not have any action method call [$this->_action]");
       } 
     else
     {
        $this->__methodRef =  $ref->getMethod($this->_action);
        if($this->__methodRef->isPublic())
        {
          $this->_valid=true;  
          $this->_action= $this->__methodRef->getName();
         
        }
        else
        {
             throw new Exception("The class $this->_controller  [$this->_action] method cannot not be called unless its convert to be public ");
        }
         
     }
    }catch(Exception $errr)
    {
            die($errr->getMessage());
            
    }
}
public  function Parameters()
{
   if($this->__methodRef !=null){
        return $this->_methodBinding($this->__methodRef);
   }
   return ;
}
private function _methodBinding(ReflectionMethod $ref)
{
   
           $counter =$ref->getNumberOfParameters();  
          
           $counter2 = $ref->getNumberOfRequiredParameters();
            
           $paramCounter = $this->params->count();
           
           
           if( $paramCounter >= $counter2  && $paramCounter <= $counter)
           {
              $paramter= array();             
              for($iter=0 ; $iter < $this->params->count(); $iter++ )
              {
                 $this->params->seek($iter);
                 $value =trim($this->params->current());
                 $key = trim($this->params->key());
                 if($value ===null  || $value ==="")
                 {
                     $value="null"; 
                     
                 }
                 $paramter[$key]= $value;              
                             
              }
              $this->__parameters = $paramter;  
             
           
           }
         else
         {
            $this->__parameters=  $this->initialiseParameters($counter2);
         }
     return  $this->__parameters;
}


 public function initialiseParameters($counter2)
{
    $arry= array();
    for($var=0; $var <$counter2; $var++)
    {
        $arry[$var]="";
    }
    return $arry;
}
final  public function HasParameters()
{
    if($this->params->count()>0)
    {
        return true;
    }
    return false;
}
private function loadParams()
     {     
       for($counter=2; $counter <$this->_request_array->count(); $counter++ )
       {
         $this->_request_array->seek($counter);  
         $this->params->offsetSet($this->_request_array->key(), $this->_request_array->current());        
       }       
     }
   /*Is valid methods*/ 
  public function IsValid()
  {
     
      return $this->_valid;
  }
  private function _errorReporter($error)
  {
      // redirection 
    echo $error;
      
  }
  public function Controller()
  {
     
     return $this->_controller;
  }
  
  public function Action()
  {
      if($this->_controller ==null)
            return null;  
      return $this->_action;      
  }
  
  final public function RequestParams($param)
  {
       if(isset($_REQUEST[$param]))
       {
           return $_REQUEST[$param];
       }
       return ;
  }
  final public  function _Default()
  {
      
      ContextManager::PartialView(DEFAULT_ACTION);
  }
  
   /*/* _tokenised
  private function _tokenised()
  {
   $url_start=null;
    if($this->_request_string !=null)  
    {
        $this->_request_string= html_entity_decode($this->_request_string);   
         $this->_request_string= trim($this->_request_string);
         $this->_request_string= trim($this->_request_string,'/');
         $urls = explode("/", $this->_request_string);
         for($i=0; $i <  array_count_values($urls); $i++)
         {
             $url = isset($urls[$i])?$urls[$i]:null;
             if( $url==null)
             {
                 break;
             }            
           if($url[0]==='?')
             {
                $url_start=  $urls[$i];
               
                break;
             }
         }//end for
        
    }//end if
    
  if($url_start !=null)
  {
     //remove the first ? only if its starts the url
      $url_start= ltrim($url_start,"?");
      //remove any forward splace from the end of the strings
      $url_start= rtrim($url_start,"/");      
      $this->_groupTokenised($url_start);   
  }
  
 
  }
    
   
  private final function _groupTokenised($url_start)
  {
     print_r ($_REQUEST);
      $objects_str = new ArrayObject();
      $TypeValue=0;
      $Value="";
      $Key="";
      
      for($var=0; $var < strlen($url_start) ; $var++ )
      {
         $char = $url_start[$var];
              
         switch($char)
         {
             case '=':
             {
                 $TypeValue=1;//get value;                 
                 
             }break;
             case '&':
             {
               $TypeValue =0; //get variable  
               //add objects 
             $bool=  $objects_str->offsetExists($Key);
              if($bool) 
              {
                  $objects_str->offsetUnset($Key);
              }
              $objects_str->offsetSet($Key, $Value) ;
              echo $Key." = ".$Value."<br>";
              $Key="";
              $Value="";
              
             }break;
             default:
             {
              if($TypeValue==0)
              {
                  //appending variables
                  $Key = $Key.$char;
              }
              else
              {
                  //appending values
               $Value = $Value.$char;
              
              }
            
             }break;
         };
      }
   
    
  }*/
    
}
