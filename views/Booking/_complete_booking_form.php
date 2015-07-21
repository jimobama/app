
<?php
include_once("entities/BookInfo.php");
if ($flight == null) {
    $flight = new Flight();
}

$bookinfo = Session::get("BOOKINFO");
if ($bookinfo == NULL) {
    $bookinfo = new BookInfo();
}
?>

<div class='container' >
    <div class='title'>Ticket's informations...</div>



    <?php
    $form_args = new ArrayIterator();
    $form_args->offsetSet("method", "POST");
    $form_args->offsetSet("class", "form form-horizontal");
    ContextManager::BeginForm("Booking", "ProcceedToPayment", $form_args);

    ContextManager::ValidationFor("warning");
    ?>

    <div class='form-group'>

        <input class="form-control" name="flightid" type="hidden"  value="<?php echo $flight->Id; ?>" />

    </div> 

    <div class='form-group inline-fields sm-2'>
        <label>Ticket Amount Per/Each</label>
        <label><?php echo "£" . $flight->ticketPrice; ?> </label>

    </div>
    <div class="form-group inline-fields sm-2">
        <label>N<u>o</u> of adults</label>

        <input type="text"  value="<?php echo $bookinfo->adult_no ?>" class="form-control" name="adults" />

        <label class="control-label col-sm-2" for="pwd">Children:</label>
        <input type="text" style="width:30%" value="<?php echo $bookinfo->children_no; ?>" class="form-control"  name="children"  />

    </div>

    <div class="form-group  inline-fields sm-1">
        <label class="control-label col-sm-2" for="pwd">Ticket Category: </label>

        <select id="ticketcategory" class ='form-control' name='ticketcategory'>
            <option value="">select...</option>
            <option value="1" <?php
            if ($bookinfo->ticket_cat == "1") {
                echo"selected";
            }
            ?>>Economics</option>
            <option value="2" <?php
            if ($bookinfo->ticket_cat == "2") {
                echo"selected";
            }
            ?>>Premier Economics</option>
            <option value="3" <?php
            if ($bookinfo->ticket_cat == "3") {
                echo"selected";
            }
            ?>>Business/Club</option>
            <option value="4" <?php
            if ($bookinfo->ticket_cat == "4") {
                echo"selected";
            }
            ?>>First Class</option>
        </select>

    </div>
    <div class="form-group inline-fields sm-1 ">     
        <label>Ticket's type</label>
        <select class="form-control" type="checkbox"  name="typeticket"> 
            <option value="0" <?php
            if ($bookinfo->ticket_type == "0") {
                echo"selected";
            }
            ?>>With return  </option>
            <option value="1" <?php
            if ($bookinfo->ticket_type == "1") {
                echo"selected";
            }
            ?>>One-way pass  </option>          
        </select>

    </div>

    <div class="form-group inline-fields button">

        <button type="submit" class="btn btn-primary" name="btnProceed">Make Calculation</button>

    </div>

    <?php ContextManager::EndForm(); ?>

</div>
