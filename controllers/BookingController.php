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
    private $db=null;
    private $viewModel=null;
    function __construct() {
        parent::__construct(new IModel(), new IView());
        $this->db= new Database();
        $this->db->createFields("flightID", "varchar(40)", " not null");
        $this->db->createFields("booking_date", "varchar(40)", " not null");
        $this->db->createFields("seatID", "varchar(40)", " not null");
        $this->db->createFields("planeID", "varchar(40)", " not null");
        $this->db->createFields("booking_id", "varchar(40)", " primary key");       
        $this->db->createFields("who_book", "varchar(40)", " ");
        $this->db->createFields("type", "varchar(40)", " not null");
        $this->db->createFields("payment_id", "varchar(40)", "");
        $this->db->createFields("children", "int", "");
        $this->db->createFields("adults", "int", "");
        $this->db->createFields("status", "int", "");
        $this->db->createTable("tbl_booking");
        
        include_once("modelviews/FlightModelView.php");
        $this->viewModel=new FlightModelView();
    }
    
    function Index()
    {
        if(Session::get("db_username") ==null || Session::get("db_username") =="")
        {
            $this->ViewBag("Title","Ticket"); 
            return $this->View(null,"Booking", "SearchByRef");
        }
        
         $this->ViewBag("Title","Mgr Booking"); 
         return $this->View(null,"Booking","index");
    }
    
    function SearchByRef()
    {
        $this->ViewBag("Title","Find Booking"); 
        return $this->View(null,"Booking","SearchByRef");
    }
    
    
    function Flight()
    {
        $id =Request::RequestParams("id");
        
        include_once("entities/Flight.php");
        include_once("models/FlightModel.php");
        
        $flightModel= new FlightModel();
        
        $this->viewModel->flightDbModel=$flightModel;
        $this->viewModel->flight =$flightModel->GetFlightById($id);        
        return $this->View($this->viewModel, "Booking", "Flight");
    }
}
