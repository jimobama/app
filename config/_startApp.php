<?php


class  ContextManager extends GlobalMaster 
{
   private static $request = null;
   private static $controller=null;
   private static $action= null; 
   private static  $context=null;

   protected  function __construct()
    {
       
    }
   
    public static function StartApplication()
    {
        Session::init();
        self::Initialised();
        self::$request = new Request();
        self::$context =new IContextView() ;
        self::$context->View();     
     
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
    
      if(self::$request->HasParameters())
             {
                
               self::$context= $clsObject->$methodCall(self::$request->Parameters());                  
              }else
              {
                 self::$context= $clsObject->$methodCall();
              }
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