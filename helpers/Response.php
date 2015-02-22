<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Response
 *
 * @author Obaro
 */
class Response {
    //put your code here  
    private $_viewBag=null;
    private  $model=null;
    private $content=null;
    
    function __construct() {
       $this-> content="";
        $this->_viewBag= new ArrayObject();  
    }
 final function LoadContext($filename)
    {
     try
     {
       if(file_exists($filename))
       {
          $this->content= $filename;
          return ;
       }    
      throw new Exception("There is no view with the given controller action view:  $filename");
     }
     catch(Exception $err)
     {
         echo $err->getMessage();
     }
    }
final function Show($Model)
{
  
    if($this->content !=null)
    {
        include_once($this->content);
    }
    
    /*
$this->model=$Model; 
$this->content = htmlentities($this->content);
echo $this->content;
$this->content = html_entity_decode(eval($this->content));
echo $this->content;
     */
 
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
