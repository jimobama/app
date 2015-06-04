<?php 
    include_once("entities/Agent.php");
    include_once("models/AgentModel.php");   
   
    $model = new AgentModel();
    $email= Session::get("db_username");
    $agent=  $model->GetAccountEmail($email);
   
    if($agent==null)
    {
      $agent= new Agent();
    }
 ?>

<div class='container'>
    
    <div class='title'>
        
      <?php  
      $reg_date= date("jS M , Y",$agent->date_reqistered);
      
      echo "<label style='text-weight:bold;color='#AAA;'>Account Number : </label> ".strtoupper($agent->agentId);
      
       echo "<span style='float:right'><label style='text-weight:bold;color='#AAA;'>Registration Date</label> :".$reg_date."</span>"; 
       ?>
    </div>
    
    <div class='row-fluid'>
        <div class='col-lg-3'>
           
            
       <div class ="container">
      <h4>Account Settings</h4>
        <ul class="list-group">
            
              <li class ="list-group-item"><a href ="#hhhe">Explorer</a><span class="badge">
                  <span class="glyphicon glyphicon-folder-open"></span>
                </span>
             
              </li>
              
               <li class ="list-group-item"><a href ="#hhhe">Edit/Update</a><span class="badge">
                  <span class="glyphicon glyphicon-folder-open"></span>
                </span>
             
              </li>
              <li class ="list-group-item"><a href ="#hhhe">Page Settings</a><span class="badge">
                  <span class="glyphicon glyphicon-folder-open"></span>
                </span>
             
              </li>
             
              
              
              
              <li class ="list-group-item"><a href ="#hhhe">Settings</a><span class="badge">
                  <span class="glyphicon glyphicon-folder-open"></span>
                </span>
             
              </li>
              
              
        </ul>
    </div>
            
            
        </div>
         <div class='col-lg-9 '>
             <div class='row grid-layout '>
                 <div class='col-sm-2 '>
                     Email: 
                 </div>
                 <div class='col-sm-4 '>
                    <?php echo $agent->email; ?>
                 </div>
                 <div class='col-sm-2 '>
                     Status: 
                 </div>
                 <div class='col-sm-4 '>
                     <?php 
                      $status="Not Active";
                     if($agent->status=='1' || $agent->status==1)
                     {
                         $status="Active";
                     }
                         
                     echo $status;
                     
                     ?>
                 </div>
             </div>
             <!--row 2-->
             <div class='row grid-layout '>
                 <div class='col-sm-2 '>
                    Mobile N<u>o</u>: 
                 </div>
                 <div class='col-sm-4 '>
                    <?php echo $agent->phonenumber; ?>
                 </div>
                 <div class='col-sm-2 '>
                    Password: 
                 </div>
                 <div class='col-sm-4 '>
                     <?php                      
                         $object= new ArrayIterator();
                         $object->offsetSet("class", "btn btn-default");
                         $object->offsetSet("style", "margin:0px 10px 0px 0px");
                       ContextManager::ActionLink("Password settings", "Account", "ChangePassword", $object);
                     
                     ?>
                 </div>
             </div>
             
             <!-- row 3 -->
             
              <div class='row grid-layout '>
                 <div class='col-sm-2 '>
                     First Name: 
                 </div>
                 <div class='col-sm-4 '>
                    <?php echo ucfirst($agent->firstname);?>
                 </div>
                 <div class='col-sm-2 '>
                     Last Name :
                 </div>
                 <div class='col-sm-4 '>
                     <?php 
                     
                     echo $agent->lastname;
                     
                     ?>
                 </div>
             </div>
             
             
        </div>
        
        <!--Another section-->
        
       
        
    </div>
    
    
</div>

<div class='container'>
     <div class='title'>
            Card Details
        </div>
    </div>