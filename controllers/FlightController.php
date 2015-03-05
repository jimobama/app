<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FlightController
 *
 * @author Obaro
 */
class FlightController extends IController {
    //put your code here
   private   $flightModelView=null;
    function __construct() {
        parent::__construct(new IModel(), new IView());
        include_once("entities/Flight.php");
         include_once("models/FlightModel.php");
        include_once("modelviews/FlightModelView.php");
        
        $this->flightModelView= new FlightModelView();
    }
    
    function Index()
    {
      
       $flightModel= new FlightModel();
       $listOfFlights = $flightModel->GetAllFlights();
       $this->flightModelView->flightList=$listOfFlights ;
       
        return $this->View($this->flightModelView,"Flight","Index");
    }
    
   public  function Create($planeId,$from,$to,$depatureDate,$landingDate,$boardingtime,$landingTime,$noOfStops,$ticketPrice,$option=null)
    {
        $id=null;
        $this->filter($id,$from,$to,$depatureDate,$landingDate,$boardingtime,$landingTime,$noOfStops,$ticketPrice,$option);
       
         
         $flight = new Flight();
         $flight->set($planeId,$from,$to,$depatureDate,$landingDate,$boardingtime,$landingTime,$ticketPrice,$noOfStops);
          $flightModel = new FlightModel($flight);
          $this->flightModelView->flight= $flight;
          
        
        
        if(isset($option) && $option !='null')
        {
            
           
            if($flight->validate())
            {
              
              $this->flightModelView->flightDbModel=$flightModel;
               
               if($flightModel->isExists($from,$to,$boardingtime))
               {
                ContextManager::ValidationFor("warning", "There is already a flight leaving at the same time to the same destination");
               }else
               {
                    //else if did not exists
                    $referenceNumber=  $flightModel->AddFlight();
                    if($referenceNumber != null)
                    {
                       $content=$flight->toString();
                       $path=  ContextManager::CreateQRBarcode($content,$referenceNumber);

                    }else
                    {
                     $flightModel->Rollback($flight->Id) ; 
                     ContextManager::ValidationFor("warning", "Transaction fails : ".$flightModel->GetError());
                    }
               }
               
            }
           else
               
           {
               ContextManager::ValidationFor("warning",$flight->error); 
           }
               
        }
       $listOfFlights = $flightModel->GetAllFlights();
       $this->flightModelView->flightList=$listOfFlights ;          
       return  $this->View($this->flightModelView,"Flight","Index");
    }
    
    
    function Modify()
    {
        $checkboxes = Request::RequestParams("chkflights");
        $btnEdit = Request::RequestParams("btnEdit");
        $btnDelete = Request::RequestParams("btnDelete");
        
        $flightModel= new FlightModel();
      
        
      if(isset( $checkboxes))
      {
            if(isset($btnDelete))
            {
              foreach($checkboxes as $key=>$flightID)
              {
                  $flightModel->DeleteFlight($flightID);
              }
            }
           else if(isset($btnEdit))
            {
               if(count($checkboxes)==1)
               {
                 $indexID = $checkboxes[0];                 
                 $flight= $flightModel->GetFlightById($indexID);
                 $flight->mode="edit";
                 $flight->checked=true;
                  Session::set("modifier_plane",$flight->planeID);
                 $this->flightModelView->flight=$flight;
                  
               }  
            }

           
      }
       $this->flightModelView->flightList=$flightModel->GetAllFlights();
       return $this->View($this->flightModelView,"Flight","Index");
    }
    
    
    function SaveChange($id,$planeId,$from,$to,$depatureDate,$landingDate,$boardingtime,$landingTime,$noOfStops,$ticketPrice,$option=null)
    {
         
        
       
         
        $flight = new Flight();
        $flight->set($planeId,$from,$to,$depatureDate,$landingDate,$boardingtime,$landingTime,$ticketPrice,$noOfStops);
        $flight->Id=$id;
      
       $this->flightModelView->flight=$flight;
       $flight->mode="edit";
        $flightModel= new FlightModel();
               
        
        if($flightModel->IsExistId($id))
        {
            
            $flightModel->Update($flight->Id,$flight);
        }
        $this->flightModelView->flightList=$flightModel->GetAllFlights();
        return $this->View($this->flightModelView,"Flight","Index");
    }
 
    
    private function filter(&$id,&$from,&$to,&$depatureDate,&$landingDate,&$boardingtime,&$landingTime,&$noOfStops,&$ticketPrice,&$option=null)
    {
         $id =($id=="null")?null:$id;
         $from =($from=="null")?null:$from;
         $to =($to=="null")?null:$to;
         $depatureDate =($depatureDate=="null")?null:$depatureDate;
         $landingDate=($landingDate=="null")?null:$landingDate;
         $noOfStops =($noOfStops=="null")?null:$noOfStops;
         $ticketPrice =($ticketPrice=="null")?null:$ticketPrice;
         $boardingtime =($boardingtime=="null")?null:$boardingtime;
         $landingTime =($ticketPrice=="null")?null:$landingTime;
         
    }
    
    
    function Search()
    {
        if($_SERVER["REQUEST_METHOD"]=="POST")
        {
         Session::set("seach_find",1);
        }
        return $this->View($this->flightModelView,"Home","Index");
    }
}

