<?php
ContextManager::PartialView("Create", "Agent");
ContextManager::PartialView("AdvanceSettings", "Agent");
?>

<div class="row container-fluid">

    <div class='col-sm-6'>

        <?php ContextManager::PartialView("Create") ?>
    </div>
    <div class='col-sm-6'>
        <?php ContextManager::PartialView("AdvanceSettings"); ?>

    </div>

</div>