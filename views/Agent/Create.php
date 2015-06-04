<?php
 $agent= new Agent();
 $userList = new ArrayIterator();
 

  if(ContextManager::$Model !=null && is_a(ContextManager::$Model, "AgentModelView"))
    {   
       $agent = ContextManager::$Model->agent; 
       
    }  


?>





    
 <?php 
    $attr= new ArrayIterator();
     $attr->offsetSet("method", "post");  
     $attr->offsetSet("class", "form  form-horizontal form-wrapper form-4-sm");  
      ContextManager::BeginForm("Agent","Create",$attr);
  ?>
    
    
<div class= 'title'> Create New Account </div>
<div class="form-group">    
        
 <?php
 ContextManager::ValidationFor("warning",Session::get("warning"));
 ContextManager::ValidationFor("warning");
 Session::delete("warning");
 ?>
    
</div>
 
 
  
 <div class ='form-group'>
 
   <input type ='text' class ='form-control ' value='<?php  echo $agent->email;  ?>'  placeholder="Enter e-mail address..." name='txtemail' id='txtemail' />

 </div>
 
 <div class ='form-group'>
   <input type ='text' class ='form-control'  value="<?php  echo $agent->firstname;  ?>"    placeholder="Enter first name here..." name='txtfirstname' id='txtfirstname' />
 </div>
 
  <div class ='form-group'>
   <input type ='text' class ='form-control' placeholder="Enter last name here..." value="<?php  echo $agent->lastname;  ?>" name='txtlastname' id='txtlastname' />
 </div>
 

 
  <div class ='form-group'>

  <input type ='text'  maxlength='15' value="<?php  echo $agent->phonenumber;  ?>"  class= 'form-control' placeholder="+44 706 765 6521" name='txtnumber' id='txtcode' />
  
 </div>
  <div class = 'form-group'>
	<input type ='button' class='btn btn-warning text-info' value="Generate Password" name='btnGeneratePassword' id='btnGeneratePassword' />
 </div>
  <div class ='form-group'>
   <input type ='password' class='form-control' value="<?php  echo $agent->password;  ?>"  placeholder ="Choose enter password " name='txtpassword' id='txtpassword' />
 </div>
 
  <div class ='form-group'>
   <input type ='password' class='form-control' placeholder="Re-enter password" name='txtrpassword' id='txtrpassword' />
 </div>
 
 <div class = 'form-group'> 
 <input class='btn btn-primary'   type ='submit' value="Create Account" name='btnCreateAgentAccount' id='btnCreateAgentAccount' />
 </div>
 
 
 <div class ='note' >
 </div>
 
 
<?php ContextManager::EndForm(); ?>

