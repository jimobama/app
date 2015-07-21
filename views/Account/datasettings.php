<?php
$adminModel = new AdminModel();
$agentModel = new AgentModel();
$agent = $agentModel->GetAccountEmail(Session::get("db_username"));

if ($adminModel->isAdmin($agent->agentId)) {
    ?>
    <div class ="container">
        <h4>Data Settings</h4>
        <ul class="list-group">

            <li class ="list-group-item">
                <?php ContextManager::ActionLink("Plane Settings", "Plane", "Create"); ?>



                <span class="badge">
                    <span class="glyphicon glyphicon-folder-open">                         
                    </span>
                </span>

            </li>  

            <li class ="list-group-item">

                <?php ContextManager::ActionLink("Add New Flight ", "Account", "NewFlight"); ?>
                <span class="badge">
                    <span class="glyphicon glyphicon-folder-open"></span>
                </span>

            </li>

            <li class ="list-group-item">
                <?php
                ContextManager::ActionLink("Flight List", "Account", "Flights");
                ?>

                <span class="badge">
                    <span class="glyphicon glyphicon-folder-open"></span>
                </span>

            </li>


            <li class ="list-group-item">

                <?php ContextManager::ActionLink("Planes' Seats Settings", "Seat", "Index", null); ?>
                <span class="badge">
                    <span class="glyphicon glyphicon-folder-open"></span>
                </span>

            </li>


        </ul>


    </div>

    <?php
}?>