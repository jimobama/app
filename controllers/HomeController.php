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
           $this->ViewBag("Title","Home");
           return $this->View(null,"home","index");
        }
        
     public function ContactUs()
     {
         
         $this->ViewBag("Title","Contact Us");
         
         return $this->View(null,"home","contactus");
     }
     
    }//end class
    
