<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FlightController
 *
 * @author Obaro
 */
class FlightController extends IController {
    //put your code here
    
    function __construct() {
        parent::__construct(new IModel(), new IView());
    }
    
    function Index()
    {
        return $this->View(null,"Flight","Index");
    }
    
    function Create()
    {
        return "Creating flight details";
    }
}
