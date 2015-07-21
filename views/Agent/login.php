<?php
Session::destroy();
$agent = new Agent();
if (ContextManager::$Model == null) {
    ContextManager::$Model = new AgentModelView();
    $agent = ContextManager::$Model->agent;
} else {
    $agent = ContextManager::$Model->agent;
}
?>

<script>
    $(document).ready(function () {

    })

</script>





<div cass="panel panel-default">


    <?php
    $msg = Session::get("Warning");
    if ($msg != null) {
        ContextManager::ValidationFor("warning", $msg);
        Session::delete("Warning");
    }
    ?>

</div>
<!--Create new form -->             
<?php
$object = new ArrayIterator();
$object->offsetSet("method", "post");
$object->offsetSet("class", "form form-horizontal form-wrapper form-3-sm");
ContextManager::BeginForm("Agent", "Login", $object);
?>

<div class="form-group">
    <?php ContextManager::ValidationFor("warning"); ?>
</div>

<div class="form-group">
    <input data-val="true" class="form-control" placeholder="Enter email address or username here" id="Email" name="Email" type="text" value="" />

</div>
<div class="form-group">
    <input class="form-control" placeholder="Enter password here" id="Password" name="Password" type="password" />                                         
</div>     
<div class="form-group">
    <label><input class="" type="checkbox"> Remember me</label>
</div>
<div class="from-group">
    <input type="submit" value="Log In" class="btn btn-primary" />
</div>

<?php ContextManager::EndForm(); ?>         



