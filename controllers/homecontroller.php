<?php

    
    class HomeController extends IController
    {
       
        public  function  __construct() 
        {
            $amodel= new IModel();
            $aview= new IView();
            parent::__construct($amodel, $aview);
            
            $this->model = $amodel;
            $this->view =  $aview;       
        }
        
      public  function Index()
        { 
            
           return $this->View(null,"home","index");
        }
        
     public function ContactUs()
     {
         $this->ViewBag("Title","Contact Page");
         
         return $this->View(null,"home","contactus");
     }
     
    }//end class
    
