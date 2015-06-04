<?php
if($flight==null)
{
    $flight= new Flight();
    
}
include_once("models/PlaneModel.php");
$planeModel= new PlaneModel();
$name=$planeModel->GetName($flight->planeID);
?>
<div style="border:1px solid #eee; padding:4px; margin:2px;">
    <form role="form">
       <div class="form-group"> 
            <label>Flight Name </label>
            <input type ='text' class="form-control" id="name" disabled="disabled" value="<?php echo $name;?>"/>
        </div>
         <div class="form-group"> 
            <label>From </label>
            <input type ='text' value="<?php echo $flight->from; ?>" class="form-control" id="from" disabled="disabled" />
        </div>
         <div class="form-group"> 
            <label>To </label>
            <input type ='text' value="<?php echo $flight->to; ?>"  class="form-control" id="to" disabled="disabled" />
        </div>
         <div class="form-group"> 
            <label>Departing at</label>
            <input type ='text' value="<?php echo $flight->deptureDate; ?>" class="form-control" id="departure" disabled="disabled" />
        </div>
        
         <div class="form-group"> 
            <label>Arrival at</label>
            <input type ='text' value="<?php echo $flight->landindDate; ?>" class="form-control" id="arrival" disabled="disabled" />
        </div>
        
         <div class="form-group"> 
            <label>Number of stops</label>
            <input type ='text' style="width:40%;" value="<?php echo $flight->stops ?>" class="form-control" id="stops" disabled="disabled" />
        </div>
        
    </form> 
        
</div>