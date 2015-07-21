
<?php
ContextManager::PartialView("newUserForm", "Agent");
if (Session::get("db_username") == null) {
    ?>
    <div class="container-fluid row">

        <div class="col-sm-7">
            <?php ContextManager::PartialView("newUserForm"); ?>
        </div>
        <div class="col-sm-5">
            <div class="title">User Instructions</div>
        </div>
    </div>

    <?php
} else {
    ContextManager::PartialView("newUserForm");
}
?>