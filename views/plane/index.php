

<div class='container'>
    <div  class="row ">   


        <div class="col-lg-7">
            <?php include_once("Create.php"); ?>
        </div>



    </div>

    <?php
    ContextManager::PartialView("display", "plane");
    ContextManager::PartialView("display");
    ?>

</div>
