<?php
$booking = Session::get("BOOKINFO");
if ($booking == NULL) {
    $booking = new BookInfo();
}
?>


<div class='container-fluid'>            
    <div class ='title'>Passenger's Information :<span class='right'>Adult => <label> <?php echo $booking->adult_no; ?> </label>,  Children => <label><?php echo $booking->children_no; ?></label> </span></div>

    <?php
    $adult_count = intval($booking->adult_no);
    ContextManager::PartialView("AddPassenger", "Booking");

    for ($i = 1; $i <= $adult_count; $i++) {
        Session::set("FORM_NO", "adult=>" . $i);
        ?>


        <div class='container-fluid seperate-form'>
            <div class='title bg-primary'><span><label> Adult Passenger <?php echo $i ?> </label></span> </div>

            <?php
            ContextManager::PartialView("AddPassenger", null, true);
            ?>
        </div>

        <?php
    }

    //children details

    $children_count = intval($booking->children_no);

    for ($i = 1; $i <= $children_count; $i++) {
        Session::set("FORM_NO", "child=>" . $i);
        ?>
        <div class='container-fluid'>
            <div class='title bg-primary'> <span><label>Child Passenger <?php echo $i ?> </label></span> </div>
            <?php ContextManager::PartialView("AddPassenger", null, true); ?>
        </div>

        <?php
    }
    ?>

</div>