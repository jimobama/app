

<div id="">
    
 <form class="form-horizontal" role="form">
  <div class="form-group">
      <label class="control-label" for="adults">N<u>o</u> of adults</label>
 
       <input type="text" style="width:30%" value="<?php echo (Session::get("adults")=="")?0:Session::get("adults"); ?>" class="form-control" id="adults" >
   
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Children:</label>
   
    <input type="text" style="width:30%" value="<?php echo (Session::get("children")=="")?0:Session::get("children"); ?>" class="form-control" id="adults"  >
  
  
  </div>
     <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Ticket Category: </label>
    
         <select id="flightclass" class ='form-control' name='sltflight'>
            <option value="">...</option>
            <option value="1">Economics</option>
            <option value="2">Premier Economics</option>
            <option value="3">Business/Club</option>
            <option value="4">First</option>
         </select>
   
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label><input type="checkbox"> Remember me</label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Process</button>
    </div>
  </div>
</form>
    
</div>