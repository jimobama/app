<?php
$userList= ContextManager::$Model;
if(is_a($userList,"ArrayIterator"))
 {
    $userList=ContextManager::$Model;
 }  else {
     $userList= new ArrayIterator();
}
?>

<link href="styles/dash_board.css" rel="stylesheet" type="text/css" /> 



<div id='dash-board-wrapper'>
    
    <div id='dash-board'>
        <fieldset>
            <legend>User Database:
            
            </legend>
            
            
            <div id='dash-context'>
            
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
                 for($var=0; $var < $userList->count(); $var++ )  
                 {
                     $userList->seek($var);
                     $agent = $userList->current();
                      $status="";
                     if($agent->status==0 ||$agent->status=='0' )
                     {
                        $status="not active" ;
                     }else
                     {
                      $status="active" ;   
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
                     
            
            </div>
            
        </fieldset>    
        
            
    </div>
    
    <div id='profile_wrapper'>
     <?php ContextManager::PartialView("newflight", "Account");
     
        ContextManager::PartialView("newflight");
     ?>
    </div>
    
</div>
