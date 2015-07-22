<?php

class ContextManager extends GlobalMaster {

    private static $request = null;
    private static $controller = null;
    private static $action = null;
    private static $context = null;
    // private static  $_viewBag=null;

    public static $Model = null;

    protected function __construct() {
        
    }

    public static function StartApplication() {

        self::Initialised();
        //self::$_viewBag= new ArrayObject(); 
        self::$request = new Request();
        self::$context = new IContextView();
        self::_process();
        ContextManager::PartialView(DEFAULT_ACTION, DEFAULT_LOAD_CONTROLLER);
        self::displayView();
    }

    /*
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

     */

    public static function RenderContext() {
        self::__displayContext(self::$context);
    }

    // this will run the context to display base of the control action called
    private static function _run() {

        if (class_exists(self::$controller)) {
            $clsObject = new self::$controller();
            $methodCall = self::$action;
            if (is_object($clsObject)) {
                self::_exec($clsObject, $methodCall);
            }
        }
    }

    private static function _process() {
        if (self::$request->IsValid()) {

            self::$controller = self::$request->Controller();
            self::$action = self::$request->Action();

            return self::_run();
        }
    }

    static private function _exec($clsObject, $methodCall) {
        $method = new ReflectionMethod(self::$controller, self::$action);
        self::$context = $method->invokeArgs($clsObject, self::$request->Parameters());
    }

    private static function displayView() {
        if (is_a(self::$context, "IContextView")) {
            self::$context->View();
        } else {
            self::__displayContext(self::$context);
        }
    }

    private static function __displayContext($context) {
        
       
        if (self::$request->IsValid()) {
            if (is_a($context, "IContextView")) {

                $context->Content();
            } else {

                if (is_object($context)) {
                    $context = json_encode($context);
                   
                }

                echo $context;
            }
        } else {
            self::$request->_Default();
           
        }
    }

    static function Display($controller, $page) {
        $_view = new IContextView();
        if ($_view->isExist($controller, $page)) {
            $_view->display($controller, $page);
        } else {
            $_view->display($controller, DEFAULT_ERROR_VIEW);
        }
    }

}
