<?php
$flightList = ContextManager::$Model->flightList;
if($flightList !=null && is_a($flightList,"ArrayIterator"))
 {
    $flightList=ContextManager::$Model->flightList;
 }  else {
    $flightList= new ArrayIterator();}
  
include_once("models/PlaneModel.php");
$aplanes  = new PlaneModel();    
?>

<link href="styles/dash_board.css" rel="stylesheet" type="text/css" /> 



<div id='dash-board-wrapper' class="row">
    
     
    
    <div class="col-lg-12">
        
      <div id='container'>
                
           <div class='title'>
       
             Flight List :
              <?  ContextManager::ValidationFor("warning-l"); ?>
            </div>   
                
                
              <?php
                     $attr= new ArrayIterator();
                     $attr->offsetSet("method", "post");
                      ContextManager::BeginForm("Flight", "Modify", $attr);
                   ?>
                <table width="100%" class="table  table-heading borderless">
                    <tr class ="">
                    <th>S/N</th>
                    <th>Flight Name</th>
                    <th>Source</th>
                    <th>Destination</th>
                    <th>Boarding Date</th>
                    <th>Arrival Date</th> 
                     <th>Boarding Time</th> 
                      <th>Arrival Time</th> 
                       <th>Stops</th> 
                       <th>Price Rate</th> 
                       
                    <th>Status</th>
                                 
                    <th>#</th>
                </tr>
                <?php 
                 for($var=0; $var < $flightList->count(); $var++ )  
                 {
                      $flight= new Flight();
                     $flightList->seek($var);
                     $flight = $flightList->current();
                     $checkFlight = (ContextManager::$Model->flight !=null)?ContextManager::$Model->flight:(new Flight());
                     $checked="";
                     if($checkFlight->checked==true && $flight->Id==$checkFlight->Id )
                     {
                         //echo $flight->checked;
                         $checked="checked='checked'";
                     }
                      $status="";
                     if($flight->status==0 ||$flight->status=='0' )
                     {
                        $status="passive" ;
                     }else
                     {
                      $status="active" ;   
                     }
                     
                   $name=  $aplanes->GetName($flight->planeID);
                   echo "<tr>
                        <td>$var</td>
                        <td>$name</td>
                        <td>$flight->from</td>
                        <td>$flight->to</td>
                        <td>$flight->deptureDate</td>
                        <td>$flight->landindDate</td>
                        <td>$flight->boardingTime</td>
                        <td>$flight->Landingtime</td>
                       <td>$flight->stops</td>
                       <td>$flight->ticketPrice</td>
                        <td>$flight->seats</td>
                        <td>$status</td>
                        <td><input type='checkbox' value='$flight->Id' name='chkflights[]' $checked ></td>
                    </tr>
                    ";
                  }
                   ?>
                    
                </table>
                <div id="btn_panel_modifier">
                  <input type="submit" class="btn btn-primary" value="Edit/Modify" name="btnEdit"/>
                   <input type="submit" class="btn btn-primary" value="Delete" name="btnDelete"/>
                </div>
                
            <?php ContextManager::EndForm()?>
            </div>
            
      
        
       </div>   
        
        
        
        <!--Another record database-->
        
        
        
    </div>
    
    

