


<?php
$parem = new ArrayIterator();
$parem->offsetSet("class", "form form-horizontal form-wrapper form-4-sm");
ContextManager::BeginForm("Booking", "SearchByRef", $parem);
?>
<div class="panel title">Search my booking</div>

<div class='form-group'>
    <label id='lblreferenceNo'>Reference Number:</label>
    <input class ='form-control' type='text' name='txtref'>
</div>
<div class ='form-group'>

    <label id='lblreferenceNo'>Full name</label>
    <input class ='form-control' type='text' name='fullname'>
</div>

<div class ='form-group'>                    
    <input class ='btn btn-primary' type='submit' value="Search" name='btnSubmit'>
</div>



<?ph 
ContextManager::EndForm();
?>
</div>