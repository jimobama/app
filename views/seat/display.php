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

<!-- Begin form-->
 <?php
    $attr= new ArrayIterator();
    $attr->offsetSet("method", "post");
     $attr->offsetSet("class", "form form-horizontal");
    ContextManager::BeginForm("Seat", "Modify", $attr);
 ?>

<div class='title'>List of Plane Seats</div>
<?  ContextManager::ValidationFor("warning-l"); ?>

  <table width="100%" class="table table-striped table-hover table-responsive">
                    <tr>
                    <th>S/N</th>
                    <th>Type</th>
                    <th>Seat N<u>o</u></th>
                    <th>Description</th>                              
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
 
<!--  end form -->
<?php ContextManager::EndForm()?>