<?php
if ($flight == null) {
    $flight = new Flight();
}
include_once("models/PlaneModel.php");
$planeModel = new PlaneModel();
$name = $planeModel->GetName($flight->planeID);
?>


<div class='container-fluid'>
    <div class='title'>Flight Informations</div>
    <div class='row-fluid'>
        <div class="col-sm-4"> 
            Flight Name
        </div>
        <div class="col-sm-8"> 
            <label> <?php echo $name; ?></label>             
        </div>        
    </div>


    <div class='row-fluid'>
        <div class="col-sm-2"> 
            From:
        </div>
        <div class="col-sm-4"> 
            <label> <?php echo $flight->from; ?></label>             
        </div>  

        <div class="col-sm-2"> 
            To:
        </div>
        <div class="col-sm-4"> 
            <label> <?php echo $flight->to; ?></label>             
        </div> 
    </div>



    <div class='row-fluid'>
        <div class="col-sm-3"> 
            Departing at:
        </div>
        <div class="col-sm-3"> 
            <label><?php echo $flight->deptureDate; ?></label>             
        </div>    


        <div class="col-sm-3"> 
            Arrival at:
        </div>
        <div class="col-sm-3"> 
            <label><?php echo $flight->landindDate; ?></label>             
        </div>   
    </div>



    <div class='row-fluid'>
        <div class="col-sm-3"> 
            Boarding Time:
        </div>
        <div class="col-sm-3"> 
            <label><?php echo $flight->boardingTime; ?></label>             
        </div>    


        <div class="col-sm-3"> 
            Est. Landing at:
        </div>
        <div class="col-sm-3"> 
            <label><?php echo $flight->Landingtime; ?></label>             
        </div>   
    </div>






    <div class='row-fluid'>
        <div class="col-sm-4"> 
            Number of stops:
        </div>
        <div class="col-sm-2"> 
            <label><?php echo $flight->stops; ?></label>             
        </div>      

        <div class="col-sm-3"> 
            Ticket Price
        </div>
        <div class="col-sm-3"> 
            <label><?php echo "£" . $flight->ticketPrice; ?></label>             
        </div>    
    </div>


</div>