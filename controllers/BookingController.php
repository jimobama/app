<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BookingController
 *
 * @author Obaro
 */
class BookingController extends IController{
    //put your code here
    
    function __construct() {
        parent::__construct(new IModel(), new IView());
    }
    
    function Index()
    {
         $this->ViewBag("Title", "Mgr Booking");
         return $this->View(null,"Booking","index");
    }
}
