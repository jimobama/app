<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TProduct
 *
 * @author jimobama
 */
class Item extends Object {
//const values
   const BYNAME="name";
   const BYNUMBER="number";
    //put your code here
    private $agentId;
    private $firstname;
    private $lastname;
    private $email;
    private $phonenumber;
    private $date_reqistered;
   
     
    function setDateRegistered($date)
    {
       if ($date == "" || $date == null ) {
            throw new  WebException("Date registered must be setup please", 0, null);
        }
        $this->description = addslashes($date);  
    }

    function getDescription()
    {
        return  stripslashes($this->description) ;
    }
    function __construct() {
        $this->product_id = null;
        $this->name = null;
        $this->current_price = 0.0;
        $this->previous_price = 0.0;
        $this->photo = null;
        $this->stock_number = 0;
        $this->stock_left = 0;
        $this->category = null;
     
    }
    

    
final  public  function getCategoryNumber()
    {         
       return $this->category; 
    }
  final  public  function setCategoryNumber($category)
    {
      if(!is_string($category) || is_null($category))
      {
           throw new  WebException("item_category: category identity number must be set for this item",0,null);
      }     
       $this->category=$category; 
    }
    static function with($id, $name, $current_price, $previous_price, $photo, $stock_no, $stock_left) {
        $item = new Item();
        $item->set($id, $name, $current_price, $previous_price, $photo, $stock_no, $stock_left);
        return $item;
    }

    public function __destruct() {
        parent::__destruct();
    }

    public function toString() {
        
    }

    final public function set($id, $name, $current_price, $previous_price, $photo, $stock_no, $stock_left) {

        $this->setCategoryNumber($this->getCategoryNumber());
        $this->setNumber($id);
        $this->setName($name);
        $this->setCurrentPrice($current_price);
        $this->setPhoto($photo);
        $this->setPreviousPrice($previous_price);
        $this->setStockLeft($stock_left);
        $this->setStockNumber($stock_no);
    }

    //the setter and getter
    //return the product Id if is not empty or null
    final public function getNumber() {
        if ($this->product_id != null) {
            return $this->product_id;
        }
        return null; //return NULL;
    }

    //end function getID

    final function setNumber($id) {
        //check if the product $id setting is the right format
        if ($id == "" || $id == null || is_array($id)) {
            throw new  WebException("Enter new item number or identity please!", 0, null);
        }
        $this->product_id = $id;
    }

    final public function setName($name) {
        if ($name == "" || $name == null || !Validator::isWord($name)) {
            throw new  WebException("item_name:Enter item name please!", 0, null);
        }
        $this->name = $name;
    }

    final public function getName() {

        return ucwords(strtolower($this->name));
    }

    final public function setCurrentPrice($price) {
        if (!is_double($price) ) {
            throw new  WebException("item_current_price:Enter double or numeric value for item price please!", 0, null);
        }
        
        //calculated the item tax
      //  $this->vat=(double)$price *  ((double)VAT) /100;
        $this->current_price = $price;
    }

    final public function getCurrentPrice() {

        return $this->current_price;
    }

    final public function setPhoto($name) {
        if (!is_string($name)) {
            throw new  WebException("item_photo:Enter a string name for photo path or name!", 0, null);
        }
        $this->photo = $name;
    }

    final public function getPhoto() {
        return $this->photo;
    }

    final public function setPreviousPrice($previous_price) {
        if (!is_double($previous_price)) {
            throw new  WebException("item_previous:Enter a numberic value for previous item price please!", 0, null);
        }
        $this->previous_price = $previous_price;
    }

    final public function getPreviousPrice() {
        return $this->previous_price;
    }

    final public function setStockLeft($stock_left) {
        if (!is_integer($stock_left)) {
            throw new  WebException("item_stock_left: stock left field accept only integer number", 0, null);
        }
        $this->stock_left = $stock_left;
    }

    final public function getStockLeft() {
        return $this->stock_left;
    }

    final public function getStockNumber() {
        return $this->stock_number;
    }

    final public function setStockNumber($stocknumber) {

        if (!is_integer($stocknumber)) {
            throw new  WebException("item_stock_number:stock number fields accept only integer value", 0, null);
        }
        $this->stock_number = $stocknumber;
    }
    
 final public  function validated()
    {
     try{
       
       $this->setNumber($this->getNumber());        
       $this->setName($this->getName());
       $this->setCurrentPrice($this->getCurrentPrice());
       $this->setPhoto($this->getPhoto());
       $this->setPreviousPrice($this->getPreviousPrice());
       $this->setStockLeft($this->getStockLeft());
       $this->setStockNumber($this->getStockNumber()); 
       $this->setCategoryNumber($this->getCategoryNumber());
       $this->setDescription($this->getDescription());
          
        return true;
       }
       catch(  WebException $err)
       {
       throw $err;
          
       }
        
    }

}

//end class Tproduct
?>
