<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
define("CHILD_DISCOUNT_PECT", 75);

class Passenger extends IModel {

    public $id;
    public $title;
    public $firstname;
    public $lastname;
    public $formid;
    public $form_type;
    public $valid = false;

    function __construct() {
        parent::__construct();
        $this->id = Validator::UniqueKey();
    }

    function validated() {
        $okay = true;



        if ($this->title == "" || $this->title == NULL) {
            $okay = false;
        } else if (!Validator::isWord($this->firstname) || trim($this->firstname) == NULL) {
            $okay = false;
            $this->setError("Enter first name for passenger $this->formid");
        } else if (!Validator::isWord($this->lastname) || trim($this->lastname) == NULL) {
            $okay = false;
            $this->setError("Enter lastname for passenger $this->formid");
        } else {
            $this->valid = true;
        }
        return $okay;
    }

    function analyser() {
        if (trim($this->formid) != "") {
            $formarray = explode("=>", $this->formid);
            $this->formid = $formarray[1];

            $this->form_type = $formarray[0];
        }
    }

}

class BookInfo extends IModel {

    public $id;
    public $flight_id;
    public $children_no;
    public $adult_no;
    public $ticket_cat;
    public $ticket_type;
    public $ticket_adult_price;

    //whats
    const TICKET_CATEGORY = 1;
    const TICKET_TYPE = 2;

    public function __construct($flight_id = NULL, $ticket_cat = NULL, $ticket_type = NULL, $adult = 0, $child = 0, $price = 0.0) {
        parent::__construct();
        $this->flight_id = $flight_id;
        $this->children_no = $child;
        $this->adult_no = $adult;
        $this->ticket_cat = $ticket_cat;
        $this->ticket_type = $ticket_type;
        $this->ticket_adult_price = $price;
        $this->id = Validator::UniqueKey();
    }

    public function validated() {
        include_once("models/FlightModel.php");
        $flightModel = new FlightModel();
        $okay = true;
        if (!$flightModel->IsExistId($this->flight_id)) {
            $okay = false;
            $this->setError("Session expired contact admin or stage over again");
        } else if (intval($this->adult_no) == 0 || $this->adult_no == NULL) {
            $okay = false;
            $this->setError("Specify the number of adults please!");
        } else if ($this->ticket_cat == NULL || trim($this->ticket_cat) == "") {
            $okay = false;
            $this->setError("Select ticket category!");
        } else if ($this->ticket_type == NULL || trim($this->ticket_type) == "") {
            $okay = false;
            $this->setError("Select ticket ticket!");
        } else {
            return $okay;
        }
    }

    function ticket_category_tostring() {
        $intval = intval($this->ticket_cat);
        switch ($intval) {
            case 1:
                return "Economics";
            case 2:
                return "Premier Economics";
            case 3:
                return "Business/Club";
            case 4:
                return "First Class";
            default:
                return "Nil";
        }
    }

    function ticket_type_tostring() {
        $intval = intval($this->ticket_type);
        switch ($intval) {
            case 0:
                return "Return";
            case 1:
                return "One-way pass";
            default:
                return "Nil";
        }
    }

}
