
<div class='panel container-fluid'>
    <?php
    $model = new FlightModelView();
    ContextManager::PartialView("order_summary", "Booking");
    include_once("entities/Flight.php");
    $flight = new Flight();

    $model = ContextManager::$Model;

    if (is_a($model, "FlightModelView")) {
        $flight = new Flight();
        $flight = $model->flight;
    }

    if ($flight == null) {
        $flight = new Flight();
    }
    ?>




    <div class='col-sm-9'>

        <div class='panel panel-body'>
            <?php include_once("_flight.php"); ?>  
        </div>
        <?php include_once("_complete_booking_form.php") ?>
    </div>





    <div class='col-sm-3'>
        <?php ContextManager::PartialView("order_summary"); ?>        
    </div>


</div>


