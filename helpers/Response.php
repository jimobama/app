<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Response
 *
 * @author Obaro
 */
class Response {
    //put your code here  
    
    private  $__model=null;
    private $content=null;
    public $Model =null;
    
    function __construct($model=null) {
        $this-> content="";
        $this->__model = $model;
        $this->_viewBag= new ArrayObject();         
    }
}
