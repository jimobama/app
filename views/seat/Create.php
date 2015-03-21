

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

<script>
    $(function ()
    {
       
       
    })
</script>
<div class="form">

        <fieldset>
            <h2>Set Flight Seats</h2>
            <div cass="control-wrapper">
              <?php
                $attr= new ArrayIterator();
                $attr->offsetSet("method", "post");  
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
                        <div class="editor-field">
                              
                            <?php  ContextManager::ValidationFor("warning");?>                               
                        </div>
                
                 <div class="control">
                    <div class="editor-label">
                        <label>Select Plane</label>
                    </div>
                    <div class="editor-field">
                        <select type="text" name ="txtplaneid" id="txtplaneid">
                            <option value=""> </option>
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
                        
                        <span id="txtForm" class="error-reporter"> </span>
                    </div>
                </div>
                
                 <div class="control">
                    <div class="editor-label">
                        <label>Seat N<u>o</u></label>
                    </div>
                    <div class="editor-field">
                        <input type="text" name ="txtplane" class="small" id="txtplane" value="<?php echo $model->seat->seatNo?>"/>
                        
                        <span id="txtForm" class="error-reporter"> </span>
                    </div>
                </div>
                 <div class="control">
                    <div class="editor-label">
                        <label>Ticket Rate</label>
                    </div>
                    <div class="editor-field">
                        <input type="text" name ="txtrate" class="small" id="txtrate" value="<?php echo $model->seat->rate?>"/>
                        
                        <span id="txtForm" class="error-reporter"> </span>
                    </div>
                </div>
                
                <div class="control">
                    <div class="editor-label">
                        <label>Type</label>
                    </div>
                    <div class="editor-field">
                       <select id="flightclass" name="flightclass">
                            <option value="">...</option>
                             <option value="1" <?php if(Session::get("type_plane")=='1') echo "selected" ?> >Economic</option>
                             <option value="2" <?php if(Session::get("type_plane")=='2') echo "selected" ?> >Premier Economic</option>
                             <option value="3" <?php if(Session::get("type_plane")=='3') echo "selected" ?>  >Business/Club</option>
                             <option value="4" <?php if(Session::get("type_plane")=='4') echo "selected" ?> >First</option>
                        </select>
                        <?php Session::delete("type_plane"); ?>
                        <span id="txtForm" class="error-reporter"> </span>
                    </div>
                </div>
                <div class="control">
                    <div class="editor-label">
                         <label>Description</label>
                    </div>
                    <div class="editor-field">
                        <textarea  name="desc_note"><?php echo $model->seat->desc ?></textarea>
                          <span id="txtTo" class="error-reporter"> </span>                      
                    </div>
                </div>

            
                
               

               
                
                


                
             
                </div>
             


                <div class="control">
                    <div class="editor-space">
                       
                    </div>
                    <div class="editor-button">
                        
                        
                        <?php 
                        if($model->seat->mode=="edit")
                        {
                            $paramInput= new ArrayIterator();
                            $paramInput->offsetSet("class", "btn");
                             $paramInput->offsetSet("type", "submit");
                             $paramInput->offsetSet("value", "Update");
                             ContextManager::HtmlInputField("btnUpdateSeat", $paramInput);
                            
                        }else{
                            $paramInput= new ArrayIterator();
                            $paramInput->offsetSet("class", "btn");
                             $paramInput->offsetSet("type", "submit");
                             $paramInput->offsetSet("value", "Add");
                             ContextManager::HtmlInputField("btnCreateSeat", $paramInput);
                        }
                       ?>
                    </div>
                </div>
                
                <?php ContextManager::EndForm() ?>
            </fieldset>
            </div>

  


  