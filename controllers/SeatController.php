<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SeatController
 *
 * @author Obaro
 */
class SeatController extends IController {

    //put your code here
    private $modelview = null;
    private $db=null;

    function __construct() {
        parent::__construct(new IModel(), new IView());
        include_once("entities/seat.php");
        include_once("models/SeatModel.php");
        include_once("modelviews/SeatModelView.php");
       $this->db= new Database();
       $this->db->createFields("planeID", "varchar(40)", "not null");
       $this->db->createFields("seatNo", "int", "");
       $this->db->createFields("type", "varchar(40)", "");
       $this->db->createFields("price", "double", "default 0.0");
       $this->db->createFields("desc_note", "text", "");
       $this->db->createFields("seatID", "varchar(40)", "primary key");
       $this->db->createFields("status", "int", "default 0"); 
       $this->db->createTable("tbl_seat");
       
        $this->modelview = new SeatModelView();
    }

    function Index() {
        $this->ViewBag("Title", "Seats");
        $this->ViewBag("Controller","Seat");
        $this->ViewBag("Page","Index");
        return $this->View(null, "Account", "Index");
    }

    function Create($planeID, $seatNo, $rate, $type, $Desc, $buttonPressed = null) {

        $seat = new Seat();
        $seat->set($seatNo, $planeID, $Desc, $type, $rate);
        $this->modelview->seat = $seat;
        Session::set("selected_plane_id", $planeID);
        Session::set("type_plane", $type);
        $model = new SeatModel($seat,$this->db);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {


            if ($seat->validated()) {

                if (!$model->IsExists()) {
                    $model->Add();
                    ContextManager::ValidationFor("warning", "Seat successfully created");
                } else {
                    ContextManager::ValidationFor("warning", "The current seat number for the given plane as already be created");
                }
            } else {
                ContextManager::ValidationFor("warning", $seat->getError());
            }
        }
        
        $this->ViewBag("Title", "Seats");
        $this->ViewBag("Controller","Seat");
        $this->ViewBag("Page","Index");  
        return $this->View($this->modelview, "Account", "Index");
    }

    function Modify() {
        $check = Request::RequestParams("chkseats");
        $btnDelete = Request::RequestParams("btnDelete");

        $this->modelview->seatModel = new SeatModel();
        if ($_SERVER["REQUEST_METHOD"] == "POST" && sizeof($check) > 0) {
            if (isset($btnDelete)) {

                foreach ($check as $key => $value) {

                    $this->modelview->seatModel->Delete($value);
                }
            } else {
                if (sizeof($check) == 1) {
                     $id= $check[0];
                     $this->modelview->seat= new Seat();
                    $this->modelview->seat= $this->modelview->seatModel->Get($id);
                     $this->modelview->seat->mode="edit";
                     Session::set("selected_plane_id", $this->modelview->seat->planeID);
                    Session::set("type_plane", $this->modelview->seat->type);
                    Session::set("id_seatSelected",$this->modelview->seat->id);
                } else {
                    ContextManager::ValidationFor("warning", "Only one item can not be modifier at same time , select an item again");
                }
            }
        }

        $this->ViewBag("Title", "Seats");
        $this->ViewBag("Controller","Seat");
        $this->ViewBag("Page","Index");       
        return $this->View($this->modelview, "Account", "Index");
    }
    
    
    
    public function Update($seatId, $planeID, $seatNo, $rate, $type, $Desc,$press=null)
    {
       
        $seat = new Seat();
        $seat->set($seatNo, $planeID, $Desc, $type, $rate);
        $seat->id=$seatId;
        $seat->mode="edit";
        $this->modelview->seat = $seat;
        
        Session::set("selected_plane_id", $planeID);
        Session::set("type_plane", $type);
        $model = new SeatModel($seat,$this->db);
        
        if(!$model->IsIdExists($seatId))
        {
          ContextManager::ValidationFor("warning", "Oops! there is no flight seats selected to modify");
          return $this->View($this->modelview, "Seat","Index");  
        }
        
        $model->Update();        
        $this->modelview->seatModel=$model;
        
       $this->ViewBag("Title", "Seats");
        $this->ViewBag("Controller","Seat");
        $this->ViewBag("Page","Index");       
        return $this->View($this->modelview, "Account", "Index");
        
    }

}
