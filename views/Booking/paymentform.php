
<div class='container'>

    <div class='title'>Billing Information</div>

    <?php
    $arr = new ArrayIterator();
    $arr->offsetSet("class", "form form-horizontal");
    $arr->offsetSet("method", "post");
    
    ContextManager::BeginForm("Booking", "MakePayment",$arr);
    ?>
    <div class='form-group inline-fields sm-1'>
        <label>First Name</label>
        <input type='text' class='form-control' name='txtfirstname'/>
    </div>  


    <div class='form-group inline-fields sm-1'>
        <label>Last Name</label>
        <input type='text' class='form-control' name='txtlastname'/>
    </div> 
    <div class='form-group inline-fields sm-1'>
        <label>Email Address</label>
        <input type='text' class='form-control' name='email'/>
    </div> 


    <div class='form-group inline-fields sm-2'>
        <label>House number</label>
        <input type='text' class='form-control' name='phone'/>

        <label style="width:100px">Street Name</label>
        <input type='text' class='form-control' name='streetname'/>
    </div> 


    <div class='form-group inline-fields sm-2'>
        <label>City</label>
        <input type='text' class='form-control' name='city'/>

        <label  style="width:100px">State</label>
        <input type='text' class='form-control' name='state'/>
    </div> 

    <div class='form-group inline-fields sm-2'>
        <label>Postcode</label>
        <input type='text' class='form-control' name='txtpostcode'/>
    </div> 

    <div class='form-group inline-fields sm-1'>
        <label>Country</label>
        <input type='text' class='form-control' name='txtcountry'/>
    </div> 

    <div class='title'>Credit/Debits Card Informations</div>

    <div class='form-group inline-fields sm-1'>
        <label>Card Type</label>
        <select class="form-control" name='txtcardtype'>
            <option value=""></option>
        </select>
    </div> 

    <div class='form-group inline-fields sm-1'>
        <label>Card Number</label>
        <input type='number' class='form-control' name='txtcardnumber'/>
    </div> 


    <div class='form-group inline-fields sm-2'>
        <label>Expiry Date</label>
        <input type='date' class='form-control' name='expirydate'/>
    </div> 


    <div class='form-group inline-fields sm-2'>
        <label>SVC Number</label>
        <input type='number' class='form-control' name='svcnumber'/>
    </div> 


    <div class='form-group inline-fields  button'>

        <input type='submit' class='btn btn-primary' name='btnSumbit' value="Submit"/>
    </div> 


<?php ContextManager::EndForm(); ?>
</div>

