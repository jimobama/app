<div class="col-lg-8">
    <div class='dash-board'>
        <fieldset>
            <legend>Users: 
                <?  ContextManager::ValidationFor("warning-l"); ?>
            </legend>            

            <div id='dash-context'>
                <?php
                $attr = new ArrayIterator();
                $attr->offsetSet("method", "post");
                ContextManager::BeginForm("Agent", "Modify", $attr);
                ?>
                <table width="100%">
                    <tr>
                        <th>S/N</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>                   
                        <th>Status</th>

                        <th>#</th>
                    </tr>
                    <?php
                    for ($var = 0; $var < $userList->count(); $var++) {
                        $userList->seek($var);
                        $agent = $userList->current();
                        $status = "";
                        if ($agent->status == 0 || $agent->status == '0') {
                            $status = "not active";
                        } else {
                            $status = "active";
                        }
                        echo "<tr>
                        <td>$var</td>
                        <td>$agent->firstname</td>
                        <td>$agent->lastname</td>
                        <td>$agent->email</td>
                        <td>$agent->phonenumber</td>
                        
                        <td>$status</td>
                        <td><input type='checkbox' value='$agent->agentId' name='chkboxes[]'></td>
                    </tr>
                    ";
                    }
                    ?>

                </table>
                <div id="btn_panel_modifier">
                    <input type="submit" value="Cancel" name="btnCancel"/>
                    <input type="submit" value="Suspend" name="btnModifer"/>
                </div>

                <?php ContextManager::EndForm() ?>
            </div>

        </fieldset>    

    </div>   



    <!--Another record database-->



</div>