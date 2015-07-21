<?php include_once("views/Booking/summary_ticket.php"); ?>

<div class="container-fluid grid-layout ">

    <div class='title'>  List of Passengers </div>

    <div class='row bg_panel font-sm1'>
        <div class='col-sm-3 mark-right'>
            <label class='center'>S/N</label>
        </div>                
        <div class='col-sm-9'>
            <label class='center'> Full Name </label>
        </div>
    </div>
    <?php
    $passengers = Session::get("Passengers");
    if ($passengers == null) {
        $passengers = [];
    }
    $counter = 0;
    foreach ($passengers as $key => $person) {
        if ($person == NULL) {
            $person = new Passenger();
        }
        if ($person->valid) {
            $counter++;
            echo ("  <div class='row  font-sm1'>
                          <div class='col-sm-2'>
                              <label class='center'>$counter</label>
                          </div>                
                          <div class='col-sm-9'>
                              <label class='center'>$person->firstname $person->lastname </label>
                          </div>
                      </div>");
        }
    }
    ?>

</div>