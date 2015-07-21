
<?php
include_once("views/Booking/summary_ticket.php");
?>

<div class='container-fluid '>

    <?php
    $object = new ArrayIterator();
    $object->offsetSet("class", "btn btn-info single-link-button");
    ContextManager::ActionLink("Make Reservation", "Booking", "pessengers_forms", $object);
    ?>

</div>
