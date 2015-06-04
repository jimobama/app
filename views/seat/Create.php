

<?php 
include_once("entities/plane.php");
include_once("models/PlaneModel.php");

$model = ContextManager::$Model;

 if($model ==null ||  !is_a($model,"SeatModelView"))
 {
     include_once "modelviews/SeatModelView.php";
     include_once "entities/Seat.php"; 
     $model= new SeatModelView();
    
    
 }  
 
 if($model->seat==null)
 {
     $model->seat=new Seat();
 }
$model->planes= new PlaneModel();
$pList= $model->planes->GetAllPlanes();
?>


<?php
                $attr= new ArrayIterator();
                $attr->offsetSet("method", "post");  
                $attr->offsetSet("class", "form form-horizontal");  
                if($model->seat->mode=="edit")
                {
                    ContextManager::BeginForm("Seat","Update",$attr); 
                    $fieldsArray= new ArrayIterator();
                    $fieldsArray->offsetSet("type", "hidden");
                    $fieldsArray->offsetSet("value", $model->seat->id);
                    
                    ContextManager::HtmlInputField("txtid", $fieldsArray);
                }else{
                ContextManager::BeginForm("Seat","Create",$attr);
                }
               
 ?>

<div class='title'>Set Flight Seats</div>
                        <div class="form-group">
                              
                            <?php  ContextManager::ValidationFor("warning");?>                               
                        </div>
                
<div class="form-group inline-fields sm-1 ">
    <label>Select Plane</label>
                   <select type="text" class="form-control" name ="txtplaneid" id="txtplaneid" placeholder="">
                            <option value="">Select plane... </option>
                            <?php
                             for($i=0;$i < $pList->count();$i++)
                             {
                                 $plane= new Plane();
                                 $pList->seek($i);
                                 $plane = $pList->current();
                                  $selected="";
                                 if(Session::get("selected_plane_id")!=$plane->Id)
                                 {
                                     $selected ="selected = 'selected'";
                                     Session::delete("selected_plane_id");
                                 }
                                 
                                 echo " <option value='$plane->Id'  $selected> $plane->name</option>";
                             }
                            ?>
                        </select>
                        
                      
                    </div>
             
                
                 <div class="form-group inline-fields sm-2">
                   <label>Seat N<u>o</u></label>
                   <input type="number" class='form-control' name ="txtplane"  id="txtplane" value="<?php echo $model->seat->seatNo?>"/>
                   
                </div>
                 <div class="form-group inline-fields sm-1 ">
                    <label>Ticket Rate</label>
                    <input type="number" class='form-control' name ="txtrate"  id="txtrate" value="<?php echo $model->seat->rate?>"/>
                    
                </div>
                
                <div class="form-group inline-fields sm-1">
                    
                        <label>Type</label>
                 
                       <select class='form-control' id="flightclass" name="flightclass">
                            <option value="">...</option>
                             <option value="1" <?php if(Session::get("type_plane")=='1') echo "selected" ?> >Economic</option>
                             <option value="2" <?php if(Session::get("type_plane")=='2') echo "selected" ?> >Premier Economic</option>
                             <option value="3" <?php if(Session::get("type_plane")=='3') echo "selected" ?>  >Business/Club</option>
                             <option value="4" <?php if(Session::get("type_plane")=='4') echo "selected" ?> >First</option>
                        </select>
                        <?php Session::delete("type_plane"); ?>
                    
                    </div>
                <div class="form-group inline-fields sm-1">
                    <label>Description</label>
                   <textarea class="form-control" name="desc_note"><?php echo $model->seat->desc ?></textarea>
                                         
                  
                </div>

     <div class="form-group">
         <?php 
         $paramInput= new ArrayIterator();
        $paramInput->offsetSet("class", "btn btn-primary");
        if($model->seat->mode=="edit")
                        {
                            
                             $paramInput->offsetSet("type", "submit");
                             $paramInput->offsetSet("value", "Update");
                             ContextManager::HtmlInputField("btnUpdateSeat", $paramInput);
                            
                        }else{
                         
                             $paramInput->offsetSet("type", "submit");
                             $paramInput->offsetSet("value", "Add");
                             ContextManager::HtmlInputField("btnCreateSeat", $paramInput);
                        }
                       ?>
            </div>
             
                
      <?php ContextManager::EndForm() ?>
          

  


  