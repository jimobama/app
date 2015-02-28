

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
    
    })
</script>
<div class="form">

        <fieldset>
            <h2>Add Aeroplane Informations</h2>
            <div cass="control-wrapper">
              <?php
                $attr= new ArrayIterator();
                $attr->offsetSet("method", "post");  
                
                ContextManager::BeginForm("Plane","Create",$attr);
               
                ?>
                        <div class="editor-field">
                              
                            <?php  ContextManager::ValidationFor("warning");?>                               
                        </div>
                
                 <div class="control">
                    <div class="editor-label">
                        <label>Name/Title</label>
                    </div>
                    <div class="editor-field">
                        <input type="text" name ="txtplane" id="txtplane"/>
                        
                        <span id="txtForm" class="error-reporter"> </span>
                    </div>
                </div>
                
                
                <div class="control">
                    <div class="editor-label">
                        <label>Total Seats</label>
                    </div>
                    <div class="editor-field">
                        <input type="text" class="small" name ="txtseats" id="txtseats" value="<?php echo $model->flight->from ?>" />
                        <span id="txtForm" class="error-reporter"> </span>
                    </div>
                </div>
                <div class="control">
                    <div class="editor-label">
                         <label>Description</label>
                    </div>
                    <div class="editor-field">
                        <textarea></textarea>
                          <span id="txtTo" class="error-reporter"> </span>                      
                    </div>
                </div>

            
                
               

               
                
                


                
             
                </div>
             


                <div class="control">
                    <div class="editor-space">
                       
                    </div>
                    <div class="editor-button">
                        <?php 
                            $paramInput= new ArrayIterator();
                            $paramInput->offsetSet("class", "btn");
                             $paramInput->offsetSet("type", "submit");
                             $paramInput->offsetSet("value", "Add");
                             ContextManager::HtmlInputField("btnSubmitAccount", $paramInput);
                       ?>
                    </div>
                </div>
                
                <?php ContextManager::EndForm() ?>
             </fieldset>
            </div>

     


