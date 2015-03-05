

<?php 
$model = ContextManager::$Model;

 if($model ==null ||  !is_a($model,"PlaneModelView"))
 {
     include_once "modelviews/PlaneModelView.php";
     include_once "entities/Plane.php";     
     $model= new PlaneModelView();
 }  
 
 if($model->plane ==null)
 {
     $model->plane=new Plane();
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
                if( $model->plane->mode !='edit')
                {
                ContextManager::BeginForm("Plane","Create",$attr);
                }  else {
                     ContextManager::BeginForm("Plane","SaveChanges",$attr);
                     
                     $attrFlied= new ArrayIterator();                     
                      $attrFlied->offsetSet("value",$model->plane->Id );
                     $attrFlied->offsetSet("type","hidden" );
                     ContextManager::HtmlInputField("id", $attrFlied);
                }
               
                ?>
                        <div class="editor-field">
                              
                            <?php  ContextManager::ValidationFor("warning");?>                               
                        </div>
                
                 <div class="control">
                    <div class="editor-label">
                        <label>Name/Title</label>
                    </div>
                    <div class="editor-field">
                        <input type="text" name ="txtplane" id="txtplane" value="<?php echo $model->plane->name ?>"/>
                        
                        <span id="txtForm" class="error-reporter"> </span>
                    </div>
                </div>
                
                
                <div class="control">
                    <div class="editor-label">
                        <label>Total Seats</label>
                    </div>
                    <div class="editor-field">
                        <input type="text" class="small" name ="txtseats" id="txtseats" value="<?php echo $model->plane->seats ?>" />
                        <span id="txtForm" class="error-reporter"> </span>
                    </div>
                </div>
                <div class="control">
                    <div class="editor-label">
                         <label>Description</label>
                    </div>
                    <div class="editor-field">
                        <textarea name='txtaDesc' ><?php echo $model->plane->desc ?></textarea>
                          <span id="txtTo" class="error-reporter"> </span>                      
                    </div>
                </div>

            
             
                </div>
             


                <div class="control">
                    <div class="editor-space">
                       
                    </div>
                    <div class="editor-button">
                        <?php 
                          if( $model->plane->mode !='edit')
                          {
                             $paramInput= new ArrayIterator();
                             $paramInput->offsetSet("class", "btn");
                             $paramInput->offsetSet("type", "submit");
                             $paramInput->offsetSet("value", "Add");
                             ContextManager::HtmlInputField("btnSubmitAccount", $paramInput);
                          }  else {
                             $paramInput= new ArrayIterator();
                             $paramInput->offsetSet("class", "btn");
                             $paramInput->offsetSet("type", "submit");
                             $paramInput->offsetSet("value", "Save Changes");
                             ContextManager::HtmlInputField("btnSaveChanages", $paramInput); 
                          }
                       ?>
                    </div>
                </div>
                
                <?php ContextManager::EndForm() ?>
             </fieldset>
            </div>

     


