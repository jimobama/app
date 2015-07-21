<?php
include_once("entities/BookInfo.php");
$bookinfo = new BookInfo();
$bookinfo = Session::get("BOOKINFO");
?>
<div class="container-fluid grid-layout ">

    <div class="title">Order Summary</div>

    <div class="panel row bg_panel font-sm1">
        <div class="col-sm-7">Item: </div>
        <div class="col-sm-5"> Description </div>     

    </div>


    <div class="row font-sm1">
        <div class="col-sm-7">Adult(s):</div>
        <div class="col-sm-5"><?php echo $bookinfo->adult_no; ?></div>     

    </div>


    <div class="row font-sm1">
        <div class="col-sm-7">Children(s): </div>
        <div class="col-sm-5"><?php echo $bookinfo->children_no; ?></div>     

    </div>


    <div class="row font-sm1">
        <div class="col-sm-7">Adult's price: </div>
        <div class="col-sm-5"> <?php echo "£" . round($bookinfo->ticket_adult_price, 2); ?>  </div>     

    </div>

    <div class="row  font-sm1">
        <div class="col-sm-7">Child price: </div>
        <div class="col-sm-5"> <?php
            $percentage_of = floatval(CHILD_DISCOUNT_PECT);
            $child_price = ((double) $percentage_of * floatval($bookinfo->ticket_adult_price)) / 100;
            echo "£" . round($child_price, 2);
            ?></div>           
    </div>




    <div class='container-fluid grid-layout'>

        <div class='title'>Ticket Summary</div>


        <div class="row font-sm1">
            <div class="col-sm-7">Category</div>
            <div class="col-sm-5"> <?php echo $bookinfo->ticket_category_tostring(); ?> </div>         
        </div>

        <div class="row font-sm1">
            <div class="col-sm-7">Type</div>
            <div class="col-sm-5"> <?php echo $bookinfo->ticket_type_tostring(); ?>  </div>         
        </div>

    </div>



    <div class='container-fluid grid-layout'>

        <div class='title'>Payment Details</div>


        <div class="row font-sm1">
            <div class="col-sm-7">Discount in(%)</div>
            <div class="col-sm-5">0.0%</div>         
        </div>

        <div class="row font-sm1">
            <div class="col-sm-7">Adult's total:</div>
            <div class="col-sm-5"> <?php
                $total_adult = floatval($bookinfo->ticket_adult_price) * intval($bookinfo->adult_no);
                echo "£" . round($total_adult, 2);
                ?> </div>         
        </div>


        <div class="row font-sm1">
            <div class="col-sm-7">Children's total:</div>
            <div class="col-sm-5">  <?php
                $percentage_of = floatval(CHILD_DISCOUNT_PECT);
                $child_price = ((double) $percentage_of * floatval($bookinfo->ticket_adult_price)) / 100;

                $total_children = (floatval($child_price) ) * intval($bookinfo->children_no);
                echo "£" . round($total_children, 2);
                ?> </div>         
        </div>


        <div class="row font-sm1">
            <div class="col-sm-7">Discounts(£):</div>
            <div class="col-sm-5"> 
                <?php
                $discount = 0.0;
                if (Session::get("db_username") != null) {
                    //retrieve current agent account discounts
                    $discount = 2.0;
                }

                $total_amount = $total_children + $total_adult;
                $amount = (float) ($discount * ( $total_amount )) / 100;
                echo "£$amount"
                ?>
            </div>         
        </div>     


        <div class="row font-sm1  bg_panel">
            <div class="col-sm-7">Total(£)</div>
            <div class="col-sm-5"><?php echo "£" . $total_amount; ?> </div>         
        </div>   


    </div>





</div>