<?php
$model = ContextManager::$Model;

 if($model ==null ||  !is_a($model,"SeatModelView"))
 {
     include_once "modelviews/SeatModelView.php";
     include_once "entities/Seat.php"; 
     $model= new SeatModelView();
    
    
 }  
 
 if($model->seatModel==null)
 {
     $model->seatModel=new SeatModel();
 }

$aSeats= $model->seatModel->All();
?>

<link href="styles/dash_board.css" rel="stylesheet" type="text/css" /> 


<?php ContextManager::PartialView("menu_list","Account");ContextManager::PartialView("menu_list"); ?>
<div id='dash-board-wrapper' class="row">
    
     
    
    <div class="col-lg-8">
        <div class='dash-board'>
        <fieldset>
            <legend>Planes Information: 
           <?  ContextManager::ValidationFor("warning-l"); ?>
            </legend>            
            
            <div id='dash-context'>
              <?php
                     $attr= new ArrayIterator();
                     $attr->offsetSet("method", "post");
                      ContextManager::BeginForm("Seat", "Modify", $attr);
                   ?>
                <table width="100%">
                    <tr>
                    <th>S/N</th>
                    <th>Type</th>
                    <th>Seat N<u>o</u></th>
                    <th>Description</th>                              
                    <th>#</th>
                </tr>
                <?php
                
                for($v=0;$v < $aSeats->count(); $v++)
                {
                    $sn= $v +1;
                    $temSeat= new Seat();
                    $aSeats->seek($v);
                    $temSeat= $aSeats->current();
                    $type= GetSeatType($temSeat->type);
                     $selected="";
                    if(Session::get("id_seatSelected")==$temSeat->id)
                    {
                        $selected ="checked='checked'";
                        Session::delete("id_seatSelected");
                    }
                   
                   echo "<tr>
                        <td> $sn</td>
                        <td>$type</td>
                        <td>$temSeat->seatNo</td>
                        <td>$temSeat->desc</td>                        
                        <td><input type='checkbox' value='$temSeat->id' name='chkseats[]' $selected ></td>
                    </tr>
                    ";
                }
                  ?>
                    
                </table>
                <div id="btn_panel_modifier">
                  <input type="submit" value="Edit/Modify" name="btnEdit"/>
                   <input type="submit" value="Delete" name="btnDelete"/>
                </div>
                
            <?php ContextManager::EndForm()?>
            </div>
            
        </fieldset>    
        
       </div>   
        
        
        
        <!--Another record database-->
        
        
        
    </div>
    
    <div id='profile_wrapper' class="col-lg-4">
     <?php ContextManager::PartialView("Create", "Seat");
     
        ContextManager::PartialView("Create");
     ?>
    </div>
    
    
    <div class="operation_panel" >
    
    
    
    </div>
    
  
    
</div>
