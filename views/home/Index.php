<?php
Session::delete("Passengers");
?>

<link href="styles/home.css" rel="stylesheet" type="text/css" />



<script>

</script> 

<div  class="container-fluid" >

    <div class="row-fluid">

        <div  class="col-sm-4 bg_panel ">   
            <?php require_once("search_flight.php"); ?>   
        </div>


        <div  class="col-sm-7 panel panel-body cell-right-2" >   
            <?php
            @ContextManager::Display($this->ViewBag("Controller"), $this->ViewBag("Page"));
            ?>
        </div>
    </div>


</div>
