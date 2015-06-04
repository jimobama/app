<?php

 $model =new FlightModelView();
  ContextManager::PartialView("shopping_progress_bar", "Booking");
include_once("entities/Flight.php");
$flight =new Flight();
 
 $model = ContextManager::$Model;
 
 if(is_a($model, "FlightModelView"))
 {
     $flight = new Flight();
    $flight = $model->flight;
     
 } 
 
 if($flight ==null)
 {
     $flight= new Flight();
 }
?>


<div class='row booking'>
    
    <div class='col-sm-3'>
       <?php include_once("_flight.php"); ?>
        
    </div>
    
     <div class='col-sm-6' style="border:1px solid #eee;">
      <?php include_once("_complete_booking_form.php") ?>
    </div>
    
     <div class='col-sm-2'>
    <?php ContextManager::PartialView("shopping_progress_bar"); ?>
        
    </div>
    
    
</div>

 
