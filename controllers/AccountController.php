<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AccountController
 *
 * @author Obaro
 */
class AccountController extends IController {

    //put your code here
    private $agentViewModel = null;

    function __construct() {
        parent::__construct(new IModel(), new IView());
        include_once("models/AgentModel.php");
        include_once("modelviews/AgentModelView.php");

        $this->agentViewModel = new AgentModelView();
    }

    //The action method that will be automatically called when user login. 
    //The method verify if the user login before re-directing him/her to account page
    public function Index() {
        if (Session::get("db_username") != null) {
            $this->ViewBag("Title", "Account");
            $agentModel = new AgentModel();
            $UserList = $agentModel->GetUsers();
            $this->agentViewModel->agentList = $UserList;
            $this->ViewBag("Controller", "Booking");
            $this->ViewBag("Page", "History");
            return $this->View($this->agentViewModel, "Account", "Index", "Profile");
        }
        return $this->ReDirectTo("Home", "Index");
    }

    public function AddCreditView() {
        $this->ViewBag("Title", "Become Agent");
        $this->ViewBag("Controller", "Credit");
        $this->ViewBag("Page", "MakeDeposit");
        return $this->View(null, "Account", "Index", "Agent");
    }

    public function UserSettings() {
        $this->ViewBag("Title", "User settings");
        $this->ViewBag("Controller", "Agent");
        $this->ViewBag("Page", "Index");
        return $this->View(null, "Account", "Index", "My Bookings");
    }

    public function Booking() {
        if (Session::get("db_username") == null) {
            return $this->View(null, "Booking", "SearchByRef", "no-user");
        } else {
            $this->ViewBag("Title", "My Bookings");
            $this->ViewBag("Controller", "Booking");
            $this->ViewBag("Page", "History");
            return $this->View(null, "Account", "Index", "My Bookings");
        }
    }

    public function CreateAgent() {
        if (Session::get("db_username") == null) {
            return $this->View(null, "Home", "Index", "no-user");
        } else {

            return $this->View(null, "Agent", "CreateAgent");
        }
    }

    public function Profile() {

        $this->ViewBag("Title", "Profile");
        $this->ViewBag("Controller", "Agent");
        $this->ViewBag("Page", "Profile");
        return $this->View(null, "Account", "Index", "");
    }

    public function Logout() {
        Session::delete("db_username");
        Session::destroy();
        return $this->ReDirectTo("Home", "Index");
    }

    public function NewFlight() {

        $this->ViewBag("Title", "Flight");
        $this->ViewBag("Controller", "Flight");
        $this->ViewBag("Page", "Create");
        return $this->View(null, "Account", "Index", "");
    }

    public function Flights() {

        $this->ViewBag("Title", "Flight List");

        return $this->ReDirectTo("Flight", "Index");
    }

}
