<?php
$object = new ArrayIterator();
$object->offsetSet("class", "form form-horizontal");
$object->offsetSet("method", "post");

ContextManager::BeginForm("Booking", "AddPassenger", $object);
$formno = Session::get("FORM_NO");

$arrform = Session::get("FORM_NO");


if (Session::get("passage-form") == $arrform) {
    ContextManager::ValidationFor("warning");
}

$passengers = Session::get("Passengers");
if ($passengers == null) {
    $passengers[$arrform] = null;
}
$p = isset($passengers[$arrform]) ? $passengers[$arrform] : new Passenger();
?>



<div>
    <input name="form_no" type="hidden" value="<?php
    echo $formno;
    Session::delete("FORM_NO");
    ?>"</input>
</div>
<div class='form-group inline-fields sm-2'>
    <label> Title</label>
    <select name='title' class='form-control'>
        <option value='mr' <?php
        if ($p->title == 'mr') {
            echo "selected";
        }
        ?> >Mr.</option>
        <option value='mrs' <?php
        if ($p->title == 'mrs') {
            echo "selected";
        }
        ?>>Mrs.</option>
        <option value='miss' <?php
        if ($p->title == 'miss') {
            echo "selected";
        }
        ?>>Miss.</option>
        <option value='ms' <?php
        if ($p->title == 'ms') {
            echo "selected";
        }
        ?>>Ms.</option>
        <option value='maid' <?php
        if ($p->title == 'maid') {
            echo "selected";
        }
        ?>>Maid.</option>                                
        <option value='chief' <?php
        if ($p->title == 'chief') {
            echo "selected";
        }
        ?>>Chief.</option>
        <option value='excellency' <?php
        if ($p->title == 'excellency') {
            echo "selected";
        }
        ?>>Your Excellency.</option>
    </select>
</div>

<div class='form-group inline-fields sm-1''>
    <label> First Name</label>
    <input class='form-control' type='text' name='firstname' value='<?php echo $p->firstname ?>'/>                            
</div>

<div class='form-group inline-fields sm-1''>
    <label>Last Name</label>
    <input class='form-control' type='text' name='lastname' value='<?php echo $p->lastname ?>'/>                            
</div>

<div class='form-group inline-fields  button '>                            
    <input class='btn btn-primary' type='submit' value='Save/Update'/>                            
</div>

<?php
ContextManager::EndForm();
?>