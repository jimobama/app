<?php


class  ContextManager extends GlobalMaster 
{
   private static $request = null;
   private static $controller=null;
   private static $action= null; 
   private static  $context=null;
   
   private static  $_viewBag=null;
   
   public static $Model = null;
   
   
   

   protected  function __construct()
    {
       
    }
   
    public static function StartApplication()
    {
        Session::init();
        self::Initialised();
        self::$_viewBag= new ArrayObject(); 
        self::$request = new Request();
        self::$context =new IContextView() ;
        self::$context->View();     
     
    }

     
   final static function ViewBag($key,$value=null)
    {
        if($value ==null)
        {
           $bool=  self::$_viewBag->offsetExists($key);
           if($bool)
           {
               return self::$_viewBag->offsetGet($key);
           }
           return "";
        }
        else
        {
            //set the value of the array with the key
            $bool=  self::$_viewBag->offsetExists($key);
            if($bool)
            {
                self::$_viewBag->offsetUnset($key);
            }
             self::$_viewBag->offsetSet($key, $value);
        }
    }
    public static function RenderContext()
    {  
        if(self::$request->IsValid())
        {    
        
         self::$controller =self::$request->Controller();      
         self::$action =      self::$request->Action();
       
         return  self::_run();
         
        }
       
        self::$request->_Default();
    }
    
    // this will run the context to display base of the control action called
    private static function _run()
    {
            
        if(class_exists(self::$controller))
        {
            $clsObject = new  self::$controller();
            $methodCall=self::$action;
          if(is_object($clsObject))
          {
              self::_exec($clsObject,$methodCall);
          }
        }
  
    }
    
  static private function _exec($clsObject,$methodCall)
  {
     $method = new  ReflectionMethod(self::$controller,self::$action);
     
      self::$context= $method ->invokeArgs($clsObject, self::$request->Parameters());                    
      self::__displayContext(self::$context);
  }
    
    private static function __displayContext($context)
    {
         if(is_a($context, "IContextView"))
            {          
            
                $context->Content(); 
            } 
        else 
            {
            
            if(is_array($context))
            {
                print_r($context);
            }else{
                echo $context;
            }
        }
         
    }
    
    
}