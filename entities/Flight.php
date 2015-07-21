<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Flight
 *
 * @author Obaro
 */
class Flight {

    //put your code here
    public $from;
    public $to;
    public $deptureDate;
    public $landindDate;
    public $boardingTime;
    public $Landingtime;
    public $ticketPrice;
    public $stops;
    public $error;
    public $Id;
    public $seats = 0;
    public $status = 1;
    public $mode = null;
    public $checked = false;
    public $planeID;

    function __construct() {
        $this->set(null, null, null, null, null, null, null, null, null);
        $mode = "create";
    }

    public function set($planeId, $from, $to, $deptdate, $landingDate, $boardingTime, $LandingTime, $ticketPrice, $stops) {
        $this->from = $from;
        $this->to = $to;
        $this->deptureDate = $deptdate;
        $this->landindDate = $landingDate;
        $this->boardingTime = $boardingTime;
        $this->Landingtime = $LandingTime;
        $this->ticketPrice = $ticketPrice;
        $this->stops = $stops;
        $this->Id = Validator::UniqueKey();
        $this->planeID = $planeId;
    }

    public function validate() {
        $okay = false;
        if (trim($this->planeID) == "" || trim($this->planeID) == null) {
            $this->error = "Select flight name";
        } else if ($this->from == null && !Validator::isWord($this->from)) {
            $this->error = "Enter a valid name of the current location where the flight will board from";
        } else if ($this->to == null && !Validator::isWord($this->to)) {
            $this->error = "Enter a valid destination place";
        } else if (!Validator::IsDate($this->deptureDate)) {
            $this->error = "Enter a valid boarding date in the format  dd/mm/yyyy";
        } else if (!Validator::IsDate($this->landindDate)) {
            $this->error = "Enter a valid date of landing in the format  dd/mm/yyyy";
        } else if (!Validator::IsTime($this->boardingTime)) {
            $this->error = "Enter a valid time when the flight will board in this format hh:mm";
        } else if (!Validator::IsTime($this->Landingtime)) {
            $this->error = "Enter a valid landing time  in format hh:mm";
        } else if (!Validator::IsDateInFuture($this->deptureDate)) {
            $this->error = "Enter a valid date for boarding it must be in the future!";
        } else if (Validator::DateDifferent($this->landindDate, $this->deptureDate) < 0) {
            $this->error = "Invalid landing date it must be in the future please!";
        } else if (doubleval($this->ticketPrice) <= 0) {
            $this->error = "Enter ticket flight price";
        } else if (intval($this->stops) < 0) {
            $this->error = "Invalid character entry on the number of stops field";
        } else {
            $okay = true;
        }

        return $okay;
    }

//end validation

    function toString() {
        return "<flight></flight>";
    }

}
