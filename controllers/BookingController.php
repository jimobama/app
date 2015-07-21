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
class BookingController extends IController {

    //put your code here
    private $db = null;
    private $viewModel = null;

    function __construct() {
        parent::__construct(new IModel(), new IView());
        $this->db = new Database();
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
        $this->viewModel = new FlightModelView();
    }

    function Index() {
        if (Session::get("db_username") == null || Session::get("db_username") == "") {
            $this->ViewBag("Title", "Ticket");
            return $this->View(null, "Booking", "SearchByRef");
        }

        $this->ViewBag("Title", "Mgr Booking");
        return $this->View(null, "Booking", "index");
    }

    function SearchByRef() {
        $this->ViewBag("Title", "Find Booking");
        return $this->View(null, "Booking", "SearchByRef");
    }

    public function ProcceedToPayment() {



        include_once("models/FlightModel.php");

        $flightId = Request::RequestParams("flightid");
        $category = Request::RequestParams("ticketcategory");
        $children = Request::RequestParams("children");
        $adults = Request::RequestParams("adults");
        $typeticket = Request::RequestParams("typeticket");

        //set the booking details
        $booking = new BookInfo();
        $booking->adult_no = (isset($adults)) ? $adults : 0;
        $booking->children_no = (isset($children)) ? $children : 0;
        $booking->flight_id = $flightId;
        $booking->ticket_cat = $category;
        $booking->ticket_type = $typeticket;
        $flightModel = new FlightModel();
        $this->viewModel->flightDbModel = $flightModel;
        $this->viewModel->flight = $flightModel->GetFlightById($flightId);

        if ($booking->validated()) {



            if ($this->viewModel->flight != NULL) {
                $booking->ticket_adult_price = $this->viewModel->flight->ticketPrice;
            }
        } else {
            //else still required more informations
            $attr = new ArrayIterator();
            $attr->offsetSet("class", "warning");
            $attr->offsetSet("style", "border:1px solid #000;");
            ContextManager::ValidationFor("warning", $booking->getError());
        }

        $this->ViewBag("Title", "Booking");
        $this->ViewBag("Controller", "Booking");
        $this->ViewBag("Page", "Flight");


        Session::set("BOOKINFO", $booking);

        return $this->View($this->viewModel, "Home", "Index");
    }

    function Flight() {
        $id = Request::RequestParams("id");

        include_once("models/FlightModel.php");

        $flightModel = new FlightModel();

        $this->viewModel->flightDbModel = $flightModel;
        $this->viewModel->flight = $flightModel->GetFlightById($id);

        $this->ViewBag("Title", "Booking");
        $this->ViewBag("Controller", "Booking");
        $this->ViewBag("Page", "Flight");

        return $this->View($this->viewModel, "Home", "Index");
    }

    public function pessengers_forms() {

        include_once("models/FlightModel.php");

        $bookInfo = Session::get("BOOKINFO");
        if ($bookInfo == NULL) {
            $bookInfo = new BookInfo();
        }

        $this->ViewBag("Controller", "Booking");
        $this->ViewBag("Page", "PassenderForms");
        return $this->View($this->viewModel->flightDbModel, "Booking", "Index");
    }

    public function AddPassenger($formno, $title, $firstname, $lastname, $btnpress = null) {

        $passenger = new Passenger();
        $passenger->formid = $formno;
        $passenger->title = $title;
        $passenger->firstname = $firstname;
        $passenger->lastname = $lastname;
        $passenger->analyser();

        $passenger_list = Session::get("Passengers");
        if ($passenger_list == NULL) {
            $passenger_list = [];
        }

        if ($passenger->validated()) {
            
        } else {

            Session::set("passage-form", $formno);
            ContextManager::ValidationFor("warning", $passenger->getError());
        }

        $passenger_list[$formno] = $passenger;

        Session::set("Passengers", $passenger_list);
        Session::set("Passager-Valid", $this->countValidPessenger());


        $this->ViewBag("Controller", "Booking");
        $this->ViewBag("Page", "PassenderForms");

        return $this->View($this->viewModel->flightDbModel, "Booking", "Index");
    }

    private function countValidPessenger() {
        $passenger_list = Session::get("Passengers");
        if ($passenger_list == null) {
            $passenger_list = [];
        }
        $counter = 0;
        foreach ($passenger_list as $p) {
            if ($p == null) {
                $p = new Passenger();
                continue;
            }
            if ($p->valid) {
                $counter++;
            }
        }
        return $counter;
    }

    public function makepayment_form() {
        $this->ViewBag("Controller", "Booking");
        $this->ViewBag("Page", "paymentform");
        return $this->View($this->viewModel->flightDbModel, "Booking", "Index");
    }

    public function MakePayment(){
        
         $firstname =  Request::RequestParams("txtfirstname");
         $txtlastname =  Request::RequestParams("txtlastname");
         $email =  Request::RequestParams("email");
         $phone =  Request::RequestParams("phone");
         $streetname=  Request::RequestParams("streetname");
         $city =  Request::RequestParams("city");
         $state =  Request::RequestParams("state");
         $txtpostcode =  Request::RequestParams("txtpostcode");
         $country =  Request::RequestParams("txtcountry");
         $cardtype =  Request::RequestParams("txtcardtype");
         $cardnumber =  Request::RequestParams("txtcardnumber");
         $expireddate =  Request::RequestParams("expirydate");
         $svc =  Request::RequestParams("svcnumber");
         $this->makeReservation($firstname,  $txtlastname,  $phone,$email, $streetname, $streetname, $city, $state,
                 $txtpostcode, $country, $cardtype, $cardnumber, $expireddate, $svc,null);
    
         
    }
    



    public function makeReservation($firstname,  $txtlastname,  $phone,$email, $streetname, $streetname, $city, $state,
                 $txtpostcode, $country, $cardtype, $cardnumber, $expireddate, $svc,  $btnPress = null) {
       
        echo "This site is still under construction....";
        
    }

}
