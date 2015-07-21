





<?php
ContextManager::PartialView("AccountSummary", "Account");
ContextManager::PartialView("AccountSummary");
?>

<!-- Current Reservations  -->
<div class='container row grid-table'>
    <div class='title'>
        Current Active Reservations
    </div>

    <div class='col-lg-3'>
        <div class ="container">
            <h4>Bookings Settings</h4>
            <ul class="list-group">

                <li class ="list-group-item"><a href ="#hhhe">Start Booking</a><span class="badge">
                        <span class="glyphicon glyphicon-folder-open"></span>
                    </span>

                </li>

                <li class ="list-group-item"><a href ="#hhhe">Search..</a><span class="badge">
                        <span class="glyphicon glyphicon-folder-open"></span>
                    </span>

                </li>

                <li class ="list-group-item"><a href ="#hhhe">Edit/Update</a><span class="badge">
                        <span class="glyphicon glyphicon-folder-open"></span>
                    </span>

                </li>
                <li class ="list-group-item"><a href ="#hhhe">Delete</a><span class="badge">
                        <span class="glyphicon glyphicon-folder-open"></span>
                    </span>

                </li>




            </ul>


        </div>
    </div>

    <div class='col-lg-9'>
        <!--  search flight form -->
        <?php
        ContextManager::PartialView("search_flight", "Home");
        ContextManager::PartialView("search_flight");
        ?>

    </div>

</div>

<!-- Booking History -->

<div class="panel-body">    
    <?php ContextManager::PartialView(Session::get("SubView")); ?>
</div>