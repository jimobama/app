<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Plane
 *
 * @author Obaro
 */
class Plane extends IModel {

    //put your code here

    public $Id;
    public $name;
    public $seats;
    public $desc;
    public $mode;

    public function __construct() {
        $this->set(null, null, null, null);
    }

    public function set($name, $seat, $desc) {
        $this->Id = Validator::UniqueKey();
        $this->desc = $desc;
        $this->seats = $seat;
        $this->name = $name;
        $this->mode = null;
    }

    public function validated() {
        $okay = false;
        if ($this->name == null || !Validator::isWord(trim($this->name))) {
            $this->setError("Enter a valid name for the plane");
        } else if ($this->seats == null || !Validator::isNumber($this->seats) || (intval($this->seats) <= 0)) {
            $this->setError("Enter the total count of the plan seats ");
        } else {
            $okay = true;
        }
        return $okay;
    }

}
