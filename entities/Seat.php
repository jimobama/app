<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Seat
 *
 * @author Obaro
 */
class Seat extends IModel{
    //put your code here
    
    public $seatNo;
    public $id;
    public $planeID;
    public $desc;
    public $mode;
    public $type;
    public $rate;
    
    function __construct() {
      $this->mode=null;
    }
    
    public function set($seatNo,$planeId,$desc,$type,$rate)
    {
        $this->seatNo=$seatNo;
        $this->planeID=$planeId;
        $this->type=$type;      
        $this->desc=$desc;
        $this->rate=$rate;
        $this->id= Validator::UniqueKey();
          
    }
    
    function validated()
    {
        $okay=false;
        if($this->planeID == "" || $this->planeID ==null)
        {
             $this->setError("Select the plane !!!");
        }
        else if(!Validator::isNumber($this->seatNo))
        {
            $this->setError("Enter a valid seat number!!!");
        }
        else if(!Validator::isNumber($this->rate))
        {
          $this->setError("Enter a valid price for the current ticket seat number!!!");  
        }
        else if(trim($this->type) ==null or trim($this->type)=="")
        {
             $this->setError("Enter a valid ticket type for the seat number!!!");
        }
    else {
            $okay=true;
        }
        
        return $okay;
    }
}
