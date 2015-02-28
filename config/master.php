<?php
//The master file will enable you to include a paths
require_once("config/Session.php");
require_once ('api/PHPMailer/PHPMailerAutoload.php');
require_once("app_data/DbConstants.php");
include_once("config/constants.php");
 require_once("api/qrbarcode/Image/QRCode.php");
include_once("Image/Barcode.php");


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
    
    
    public static function CreateLink($title,$controller,$actionmethod,  ArrayIterator $object=null)
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
         $_website = \filter_input(INPUT_SERVER,"HTTP_HOST");
         
        $strLink= "<a href='$_website/".URL."=$controller&action=$actionmethod'  $attributes >$title</a>";
       return $strLink;
        
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
        
        $strLink= "<a href='".HOST_NAME.URL."=$controller&action=$actionmethod'  $attributes >$title</a>";
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
    
     public static function LabelFor($name,$label, ArrayIterator $object=null)
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
        
        $strLink= "<labe name='$name' id='$name'  $attributes >$label</label>";
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
     
     public static function ValidationFor($labelname,$message=null,$object=null)
     {
         if($message===null)
        {
          // try to get the view
            
            $bool = self::$include_global->offsetExists($labelname);
            if($bool)
            {
                $message =self::$include_global->offsetGet($labelname);
                if($object==null)
                {
                    $object= new ArrayIterator();
                }
                $object->offsetSet("class", "error");
                self::LabelFor($labelname,  $message, $object);
            }
        }else
        {
            $bool =self::$include_global->offsetExists($labelname);
            if($bool)
            {
                self::$include_global->offsetUnset($labelname);
            }
            
            //set it again
            self::$include_global->offsetSet($labelname,$message);
        }
     }
     static function CreateURL($controller,$action,  ArrayIterator $param=null)
     {
          $parameters="";
         if($param !=null)
         {
            $parameters="&"; 
             for($var=0; $var < $param->count();$var++)
             {
                 $param->seek($var);
                 $field= $param->key();
                 $value= $param->current();
                 $parameters= $parameters."$field = $value";
                 if(($var + 1) < $param->count())
                 {
                    $parameters = $parameters."&" ;
                 }
                
             }
            
         }
         
         $url = HOST_NAME.URL."=$controller&action=$action $parameters";
         return $url;
     }
    static function CreateQRBarcode($encodetext,$id=null,$imageType="png") 
    {
        
                $qrbacode = new Image_QRCode();
                $option =array 
                        (
                           "image_type" => $imageType,
                           "output_type" => "return"
                        );
            $image=  $qrbacode->makeCode($encodetext,$option); 
            $filename=$id;
            if($id ==null)
            {
               $filename= sha1(addslashes($encodetext));  
            }           
            $filename=BARCODE_PATH.$filename.".png";
            $bool= imagepng($image,$filename);
        if($bool)
        {
          return $filename;  
        }
        return null;
    }
     
    
}
include_once("entities/object.php");
require_once("config/Database.php");

include_once("config/Response.php");
include_once "config/request.php";
include_once "config/IContextView.php";
include_once "helpers/iview.php";
include_once "helpers/icontroller.php";
include_once "models/imodel.php";
include_once "helpers/Validator.php";

include_once("entities/agent.php");


