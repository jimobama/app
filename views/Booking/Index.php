

<?php
if (Session::get("db_username") != null) {
    ContextManager::PartialView("account_bar", "Account");
    ContextManager::PartialView("account_bar");
}
$booking = Session::get("BOOKINFO");
if ($booking == NULL) {
    $booking = new BookInfo();
}
?>

<div class='row container-fluid'>

    <div class='col-lg-3'>
        <?php
        ContextManager::PartialView("Index_Left", "Booking");
        ContextManager::PartialView("Index_Left");

//if the count is same size of the request tcket then show proceed button
        $total_tickets = intval($booking->adult_no) + intval($booking->children_no);

        if (Session::get("Passager-Valid") == $total_tickets) {
            $payment_link = new ArrayIterator();
            $payment_link->offsetSet("class", "btn btn-primary single-link-button");
            ContextManager::ActionLink("Make Payment", "Booking", "makepayment_form", $payment_link);
        }
        ?>

    </div>

    <div class='col-lg-9'>

        <?php
        ContextManager::Display($this->ViewBag("Controller"), $this->ViewBag("Page"));
        ?>

    </div>

</div>