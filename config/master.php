<?php
//The master file will enable you to include a paths
require_once("helpers/Session.php");

class GlobalMaster
{
    private static $include_global=null;
  private  function __construct() 
    {
      
    }
    
  static protected  function Initialised()
    {
         self::$include_global= new ArrayObject();
    }
    static function  PartialView($view_name,$controller_name=null)
    {
        if($controller_name===null)
        {
          // try to get the view
            
            $bool = self::$include_global->offsetExists($view_name);
            if($bool)
            {
                $controller =self::$include_global->offsetGet($view_name);
                self::displayAtLocation($controller,$view_name);
            }
        }else
        {
            $bool =self::$include_global->offsetExists($view_name);
            if($bool)
            {
                self::$include_global->offsetUnset($view_name);
            }
            
            //set it again
            self::$include_global->offsetSet($view_name,$controller_name);
        }
    }
    
    
    private static function displayAtLocation($controller,$action)
    {
        
        $file= VIEW.$controller."/$action".".php";
        if(file_exists($file))
        {
          include_once($file);
        }
    }
    
    
    
    public static function ActionLink($title,$controller,$actionmethod,  ArrayIterator $object=null)
    {
        $attributes="";
        if($object !=null)
        {
           for($var=0; $var < $object->count(); $var++) 
           {
               $object->seek($var);
               $attr = $object->key();
               $value = $object->current();
               $attributes = $attributes." $attr='$value'";
           }
        }
        
        $strLink= "<a href='".URL."=$controller&action=$actionmethod'  $attributes >$title</a>";
        echo html_entity_decode($strLink);
    }
    
   public static function HtmlInputField($name, ArrayIterator $object=null)
    {
        $attributes="";
        if($object !=null)
        {
           for($var=0; $var < $object->count(); $var++) 
           {
               $object->seek($var);
               $attr = $object->key();
               $value = $object->current();
               $attributes = $attributes." $attr='$value'";
           }
        }
        
        $strLink= "<input name='$name' id='$name'  $attributes />";
        echo html_entity_decode($strLink);
    }
    
    public static function BeginForm($controller,$action, ArrayIterator $object=null)
    {
         $attributes="";
        if($object !=null)
        {
           for($var=0; $var < $object->count(); $var++) 
           {
               $object->seek($var);
               $attr = $object->key();
               $value = $object->current();
               $attributes = $attributes." $attr='$value'";
           }
        }
        
       $form =" <form action='".URL."=$controller&action=$action' $attributes >";
       echo $form;
    }
    
     public static function EndForm()
     {
           $form =" </form>";
           echo $form;
     }
    
}


include_once("config/constants.php");
include_once("helpers/Response.php");
include_once "helpers/request.php";
include_once "config/IContextView.php";
include_once "helpers/iview.php";
include_once "helpers/icontroller.php";
include_once "models/imodel.php";



