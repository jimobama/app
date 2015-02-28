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
?>

<script>
    $(function ()
    {
    $("#txtDepatureDate" ).datepicker({dateFormat: "dd/mm/yy"});
    $("#txtLandindDate").datepicker({dateFormat: "dd/mm/yy" });
    })
</script>
<div class="form">

        <fieldset>
            <h2>Add Flight's Details</h2>
            <div cass="control-wrapper">
              <?php
                $attr= new ArrayIterator();
                $attr->offsetSet("method", "post");   
                if($model->flight->mode=="edit")
                {
                ContextManager::BeginForm("Flight","SaveChange",$attr);
                $attr= new ArrayIterator();
                $attr->offsetSet("type", "hidden");
                $attr->offsetSet("name", "txtid");
                 $attr->offsetSet("value",$model->flight->Id );
                ContextManager::HtmlInputField("txtID", $attr);
                }  else {
                     ContextManager::BeginForm("Flight","Create",$attr);
                }
                ?>
                        <div class="editor-field">
                              
                            <?php  ContextManager::ValidationFor("warning");?>                               
                        </div>
                
                 <div class="control">
                    <div class="editor-label">
                        <label>Select Flight</label>
                    </div>
                    <div class="editor-field">
                        <select type="text" name ="txtplane" id="txtplane">
                            <option>...</option>
                        </select>
                        <span id="txtForm" class="error-reporter"> </span>
                    </div>
                </div>
                
                
                <div class="control">
                    <div class="editor-label">
                        <label>From</label>
                    </div>
                    <div class="editor-field">
                        <input type="text" name ="txtForm" id="txtForm" value="<?php echo $model->flight->from ?>" />
                        <span id="txtForm" class="error-reporter"> </span>
                    </div>
                </div>
                <div class="control">
                    <div class="editor-label">
                         <label>To</label>
                    </div>
                    <div class="editor-field">
                         <input type="text" name ="txtTo" id="txtTo"  value="<?php echo $model->flight->to ?>" />
                          <span id="txtTo" class="error-reporter"> </span>                      
                    </div>
                </div>

                  <div class="control">
                    <div class="editor-label">
                        <label>Boarding Date</label>
                    </div>
                    <div class="editor-field">
                        <input type="text" name ="txtDepatureDate" id="txtDepatureDate"  value="<?php echo $model->flight->deptureDate?>"/>
                        <span id="txtDepatureDate" class="error-reporter"> </span>    
                       
                    </div>
                  </div>
                
                <div class="control">
                    <div class="editor-label">
                        <label>Landing Date</label>
                    </div>
                    <div class="editor-field">
                        <input type="text" name ="txtLandindDate" id="txtLandindDate"  value="<?php echo $model->flight->landindDate?>"/>
                        <span id="txtDepatureDate" class="error-reporter"> </span>    
                       
                    </div>
                </div>

                <div class="control">
                    <div class="editor-label">
                        <label>Boarding time</label>
                    </div>
                    <div class="editor-field">
                        <input class ='small' type="text" name ="txtBoardinTime" id="txtBoardinTime" value="<?php echo $model->flight->boardingTime?>" />
                        <span id="txtBoardinTime" class="error-reporter"> </span>    
                       
                    </div>
                </div>
                
                <div class="control">
                    <div class="editor-label">
                        <label>Landing Time</label>
                    </div>
                    <div class="editor-field">
                        <input  class ='small' type="text" name ="txtlandingTime" id="txtlandingTime" value="<?php echo $model->flight->Landingtime?>" />
                        <span id="txtDepatureDate" class="error-reporter"> </span>    
                       
                    </div>
                </div>


                
                <div class="control">
                    <div class="editor-label">
                         <label>Number Of Stops</label>                       
                    </div>
                    <div class="editor-field">
                         <input class ="small" type='text' name='txtStops' id='txtStops' value="<?php echo $model->flight->stops?>"/>                       
                        <span class="flightclass" id="error-reporter"> </span>  
                      
                    </div>
                </div>

                <div class="control">
                    <div class="editor-label">
                         <label>Ticket price</label> 
                    </div>
                    <div class="editor-field">
                        <input type='text' name='txtprice' id='txtprice' value="<?php echo $model->flight->ticketPrice?>"/>
                         <span id="tickettype" class="error-reporter"> </span>  
                      
                    </div>
                </div>
             


                <div class="control">
                    <div class="editor-space">
                       
                    </div>
                    <div class="editor-button">
                        <?php 
                             $added= false;   
                                
                               if($model->flight !=null)
                               {
                                   if($model->flight->mode=="edit")
                                   {
                                    $paramInput= new ArrayIterator();
                                    $paramInput->offsetSet("class", "btn");
                                    $paramInput->offsetSet("type", "submit");
                                    $paramInput->offsetSet("value", "Save Changes");
                                    ContextManager::HtmlInputField("btnModify", $paramInput);
                                    $added=true;
                                    $param=new ArrayIterator();
                                    $param->offsetSet("class", "button");
                                    ContextManager::ActionLink("<< Back", "Flight","Index",$param);
                                    
                                   } 
                                  else {
                                       $paramInput= new ArrayIterator();
                                        $paramInput->offsetSet("class", "btn");
                                        $paramInput->offsetSet("type", "submit");
                                        $paramInput->offsetSet("value", "Add Details");
                                        ContextManager::HtmlInputField("btnSubmitAccount", $paramInput);
                                        $added=true;
                                   }
                               }
                               
                             if($added==false)
                             {
                                       $paramInput= new ArrayIterator();
                                        $paramInput->offsetSet("class", "btn");
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


    </div>