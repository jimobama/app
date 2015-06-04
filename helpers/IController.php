<?php



    
    class IController 
    {
        protected  $model=null;
        protected  $view=null;
        private    $method=null;
       private     $context=null;
        public  function  __construct(IModel $amodel,IView $aview) 
        {
            $this->model = $amodel;
            $this->view =  $aview;   
            $this->context = new IContextView($amodel,null,null); 
           
        }

        //We have to render the view

      final public function render()
        {
             echo "Hello World\n"  ; 
        }
     final public function Call($amethod)
     {
        if($amethod !=null)
        {
            $this->method=$amethod;
            return $this->$this->method;  
        }
        return "nil";
     }
     
     
//display the view 
     public final function View($model=null, $controller=null, $actions=null,$subpage=null)
       {
         if($model ==null)
         {
             $model= $this->model;
         }
         if($this->context==null)
         {
             $this->context= new IContextView($model,$controller,$actions,$subpage);
         }  else
         {
            $this->context->attach($model,$controller,$actions,$subpage);  
         }
         
         return $this->context;
       }
       
    public final function ViewBag($key=null,$value=null) 
    { 
        if($this->context !=null){
        return  $this->context->ViewBag($key, $value);
        }
        return null;
    }
    
    public final function ReDirectTo($controller,$action,$subpage=null)
    {
        if($subpage==null){
         header("Location:" . URL . "=$controller&action=$action");
        }else
        {
         header("Location:" . URL . "=$controller&action=$action&subpage=$subpage");
        }
    }
    
 }
