<?php
$model = ContextManager::$Model;
$email = "";
if (!is_object($model)) {
    $email = $model;
}
?>
<link href="styles/Confirmation.css" rel="stylesheet" type="text/css" />
<div id='confirmation-wrapper' class="row">
    <div class="editor-field">
        <?php
        ;
        $msg = Session::get("Warning");
        if ($msg != null) {
            ContextManager::ValidationFor("warning", $msg);
            Session::delete("Warning");
        }
        ContextManager::ValidationFor("warning")
        ?>
    </div>
    <div class='form' >
        <?php
        $object = new ArrayIterator();
        $object->offsetSet("method", "post");
        ContextManager::BeginForm("Agent", "VerifyUser", $object);
        ?>
        <div cass="control-wrapper">
            <fieldset>
                <h2> Email Address 
                </h2>



                <div class="control">

                    <div class="editor-field">
                        <input  id="Email" name="Email" type="text" value="<?php echo $email; ?>" />
                        <span class="field-validation-valid" data-valmsg-for="Email" data-valmsg-replace="true"></span>
                    </div>
                </div>

            </fieldset>

            <fieldset>
                <h2>Verification code</h2>
                <div class="control">

                    <div class="editor-field">
                        <input type="text" value="" name="txtverification"/>
                        <span class="field-validation-valid" data-valmsg-for="Email" data-valmsg-replace="true"></span>
                    </div>
                </div>
            </fieldset>

            <div class="control">
                <div class="editor-space">

                </div>
                <div class="editor-button">
                    <input type="submit" value="Log In" class="btn" />
                </div>
            </div>
        </div>
        <?php ContextManager::EndForm(); ?> 
    </div>
</div>

