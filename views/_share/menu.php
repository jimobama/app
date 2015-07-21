   
<?php
$paramsLink = new ArrayIterator();
$paramsLink->offsetSet("class", "dropdown-toggle");
//$paramsLink->offsetSet("data-toggle", "dropdown");
?>
<div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">

        <li>
            <?php
            if (Session::get("db_username") == null) {
                ContextManager::ActionLink("<span class='glyphicon glyphicon-home'></span> Home", "Home", "Index");
            } else {
                ContextManager::ActionLink("<span class=\"glyphicon glyphicon-home\"></span> Account", "Account", "Index");
            }
            ?>

        </li>

        <li>
            <?php
            ContextManager::ActionLink("<span class=\"glyphicon glyphicon-book\"></span> Bookings", "Account", "Booking");
            ?>

        </li>


        <li >
            <?php ContextManager::ActionLink("<span class='glyphicon glyphicon-calendar'></span> Times Table", "Flight", "TimesTable", $paramsLink); ?>

        </li>


        <li >

            <?php ContextManager::ActionLink("<span class='glyphicon glyphicon-plane'></span> Destinations", "Flight", "Destinations", $paramsLink); ?>

        </li>

        <li>

            <?php
            if (Session::get("db_username") == null) {
                ContextManager::ActionLink("<span class=\"glyphicon glyphicon-user\"></span> Travel Agent", "Agent", "LoginForm");
            } else {
                ContextManager::ActionLink("<span class=\"glyphicon glyphicon-log-out\"></span> Log out", "Account", "Logout");
            }
            ?> </li>  

    </ul>


</div>