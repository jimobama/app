<?php
$paramsLink = new ArrayIterator();
$paramsLink->offsetSet("class", "nav-list btn-primary ");
//$paramsLink->offsetSet("data-toggle", "dropdown");
?>
<div class="panel panel-heading top-header">
    <div class="row">
        <div class="col-sm-4">                    
            <?php ContextManager::ActionLink("<img src='views/_share/logo.png' alt='Booking.com'/> ", "Home", "Index"); ?>
        </div>   
        <div class="col-sm-8" >
            <ul class="nav nav-tabs small-nav">
                <?php
                echo " <li> ";
                if (Session::get("db_username") == null) {
                    ContextManager::ActionLink("<span class='glyphicon glyphicon-user'></span> Sign In", "Agent", "login", $paramsLink);
                } else {
                    ContextManager::ActionLink("Top Up", "Account", "AddCreditView", $paramsLink);
                }
                echo "</li> ";
                ?>
                <li>  

                    <?php
                    if (Session::get("db_username") == null) {
                        ContextManager::ActionLink("<span class='glyphicon glyphicon-plus'></span> Register!", "Agent", "Create", $paramsLink);
                    } else {
                        
                    }
                    ?></li>     
                <li>  <?php
                    if (Session::get("db_username") == null) {
                        $paramsLink->offsetSet("class", "nav-list btn-info");

                        ContextManager::ActionLink("Forget Password!", "Agent", "ForgetPassword", $paramsLink);
                    } else {
                        ContextManager::ActionLink("<span class ='glyphicon glyphicon-user'></span> Profile", "Account", "Profile", $paramsLink);
                    }
                    ?>
                </li>  
                <li class='top-search-listitem'>
                    <form class="form-inline" role="form">
                        <div class="form-group">

                            <input type="text" class="form-control top-search" id="txtsearchbox">
                        </div>


                        <button type="submit" class="btn btn-info ">Find</button>
                    </form>

                </li>

            </ul>
            <?php require_once("menu.php") ?>

        </div>  

    </div>



</div>