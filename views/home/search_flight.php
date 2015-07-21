<?php
include_once("entities/Flight.php");
include_once("models/FlightModel.php");
$model = new FlightModel();
$flightList = $model->GetAllDistinctFlights();
?>


<?php
$object = new ArrayIterator();
$object->offsetSet("method", "post");
$object->offsetSet("class", "form form-horizontal ");
ContextManager::BeginForm("Flight", "Search", $object);
?>        

<?php if (Session::get("db_username") == null) { ?> 
    <div class="title border-sm-1">Search Flights</div>
    <?php
} else {
    ?>
    <div class="title borderless ">Agent Flights Search </div>
<?php }
?>


<div class="form-group inline-fields sm-2">                
    <label>One-Pass Ticket</label>                           
    <input type="radio" checked name="rbticketType" id="rdbonepass" value='one-pass'/>  
    <label>Return Ticket</label>    
    <input type="radio" name="rbticketType" id="chkOnePass" value='return' />   

</div>






<div class="form-group inline-fields sm-1">

    <label>From</label>

    <select name="txtForm" class="form-control"  >
        <option>   </option>                          
        <?php
        foreach ($flightList as $flight) {
            echo "<option value='$flight->from' >$flight->from</option>";
        }
        ?>
    </select>

    <span id="txtForm" class="error-reporter"> </span>
</div>

<div class="form-group inline-fields sm-1">

    <label>To</label>


    <select name="txtTo" class="form-control">
        <option>   </option> 
        <?php
        foreach ($flightList as $flight) {
            echo "<option value='$flight->to' >$flight->to</option>";
        }
        ?>
    </select>


</div>

<div class="form-group inline-fields sm-1">

    <label>Departure Date</label>                   
    <input type="date" class='form-control' name ="txtDepatureDate" id="txtDepatureDate" />

</div>


<div class="form-group inline-fields sm-1">

    <label>Return Date</label>

    <input type="date" class='form-control' name ="txtreturndate" id="txtTo" />                       

</div>


<div class="form-group inline-fields sm-1">

    <label>Flight Class</label> 
    <select id="flightclass" class="form-control" name='sltflight'>
        <option value="">...</option>
        <option value="1">Economics</option>
        <option value="2">Premier Economics</option>
        <option value="3">Business/Club</option>
        <option value="4">First</option>
    </select>                    
</div>

<div class="form-group inline-fields sm-1">

    <label>Ticket type</label> 


    <select name='sltTicketType' class="form-control">
        <option value="0">Lower Price</option>
        <option value="1">Flexible</option>
    </select>



</div>
<div class="form-group inline-fields sm-2">
    <label>Adults :</label>

    <input type="text" class="form-control " name ="txtadults" id="txtTo"  /> 
    <label>Children : </label>
    <input type="text" class="form-control " name ="txtchildren" id="txtchildren" /> 
</div>



<div class="control inline-fields button">
    <input type="submit" class="btn btn-primary " value="Search" class='btn'/>

</div>

<?php ContextManager::EndForm() ?>





