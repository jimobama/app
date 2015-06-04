<?php 
 $model = ContextManager::$Model;
 if($model ==null ||  !is_a($model,"FlightModelView"))
 {
     include_once "modelviews/FlightModelView.php";
     include_once "entities/Flight.php";     
     $model= new FlightModelView();
 }  
 
 if($model->flight ==null)
 {
     $model->flight=new Flight();
 }
  include "entities/Plane.php";



?>

<script>
    $(function ()
    {
    $("#txtDepatureDate" ).datepicker({dateFormat: "dd/mm/yy"});
    $("#txtLandindDate").datepicker({dateFormat: "dd/mm/yy" });
    })
</script>
  <?php
        $attr= new ArrayIterator();
        $attr->offsetSet("method", "post");
        $attr->offsetSet("class", "form form-horizontal form-5-sm form-wrapper");
        if($model->flight->mode=="edit")
                {
                ContextManager::BeginForm("Flight","SaveChange",$attr);
                $attr1= new ArrayIterator();
                $attr1->offsetSet("type", "hidden");
                $attr1->offsetSet("name", "txtid");           
                
                 $attr1->offsetSet("value",$model->flight->Id );
                ContextManager::HtmlInputField("txtID", $attr);
                }  else {
                     ContextManager::BeginForm("Flight","Create",$attr);
                }
 ?>

     <div class='title'>Add Flight's Details</div>
     
     <div class="form-group">                              
         <?php  ContextManager::ValidationFor("warning");?>                               
    </div>
                
    <div class="form-group inline-fields sm-1">
                    
       <label >Select Flight</label>
         <select  class='form-control' type="text" name ="txtplane" id="txtplane">
                            <?php  
                              echo "<option value=''></option>";
                              foreach( $planeList as $plane)
                              {
                                  $selected="";
                                  if($plane->Id== Session::get("modifier_plane"))                              
                                  {
                                      $selected ="selected";
                                      Session::delete("modifier_plane");
                                  }
                                echo "<option value='$plane->Id'  $selected >$plane->name</option>";
                              }
                           ?>
       </select>
       
   </div>
    <div class="form-group inline-fields sm-2">
       <label>From</label>
       <input type="text" class='form-control' name ="txtForm" id="txtForm" value="<?php echo $model->flight->from ?>" />
      <label>To</label>
        <input type="text"  class='form-control' name ="txtTo" id="txtTo"  value="<?php echo $model->flight->to ?>" />
    </div>
    
    <div class="form-group inline-fields sm-1 ">
      <label>Boarding Date</label>
      <input type="text" class='form-control' name ="txtDepatureDate" id="txtDepatureDate"  value="<?php echo $model->flight->deptureDate?>"/>
          
   </div>
     <div class='form-group inline-fields sm-1'>
           <label>Landing Date</label>
         <input type="text"  class='form-control' name ="txtLandindDate" id="txtLandindDate"  value="<?php echo $model->flight->landindDate?>"/>         
          
     </div>
                
    <div class="form-group inline-fields sm-2">
             <label>Boarding time</label>
         <input  class='form-control'  type="text" name ="txtBoardinTime" id="txtBoardinTime" value="<?php echo $model->flight->boardingTime?>" />
                 
   </div>
     
     
      <div class="form-group inline-fields sm-2">
              <label>Landing Time</label>
         <input  class='form-control' type="text" name ="txtlandingTime" id="txtlandingTime" value="<?php echo $model->flight->Landingtime?>" />
                              
   </div>
     
        <div class="form-group inline-fields sm-2">
              <label>Number Of Stops</label>
        <input class ="form-control" type='number' name='txtStops' id='txtStops' value="<?php echo $model->flight->stops?>"/>                         
   </div>
     
 <div class="form-group inline-fields sm-2">
                   
     <label>Ticket price</label> 
     <input type='number' class='form-control' name='txtprice' id='txtprice' value="<?php echo $model->flight->ticketPrice?>"/>
   
                      
</div>
             
<div class="form-group inline-fields button">
<?php 
                             $added= false;   
                              $paramInput= new ArrayIterator();  
                              $paramInput->offsetSet("class", "btn btn-primary");
                               if($model->flight !=null)
                               {
                                   if($model->flight->mode=="edit")
                                   {
                                   
                                    $paramInput->offsetSet("type", "submit");
                                    $paramInput->offsetSet("value", "Save Changes");
                                    ContextManager::HtmlInputField("btnModify", $paramInput);
                                    $added=true;
                                  
                                   
                                    ContextManager::ActionLink("<< Back", "Flight","Index",$param);
                                    
                                   } 
                                  else {
                                     
                                        $paramInput->offsetSet("type", "submit");
                                        $paramInput->offsetSet("value", "Add Details");
                                        ContextManager::HtmlInputField("btnSubmitAccount", $paramInput);
                                        $added=true;
                                   }
                               }
                               
                             if($added==false)
                             {
                                  
                                        $paramInput->offsetSet("type", "submit");
                                        $paramInput->offsetSet("value", "Add Details");
                                        ContextManager::HtmlInputField("btnSubmitAccount", $paramInput);  
                             }
                       ?>
                    </div>
                </div>
                
                <?php ContextManager::EndForm() ?>

            </div>

        </fieldset>


    </form>