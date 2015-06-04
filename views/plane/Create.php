

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

  <?php
                $attr= new ArrayIterator();
                $attr->offsetSet("method", "post");  
                $attr->offsetSet("class", "form form-horizontal");  
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
<div class='title'>Add new plane...</div>
                        <div class="form-group">
                              
                            <?php  ContextManager::ValidationFor("warning");?>                               
                        </div>
                
                 <div class="form-group inline-fields sm-1">
                  <label>Name/Title</label>                   
                  <input type="text"  class='form-control' name ="txtplane" id="txtplane" value="<?php echo $model->plane->name ?>"/>
                    
                </div>
                
                
                <div class="form-group inline-fields sm-2">
                    
                   <label>Total Seats</label>
                    <input type="number" class="form-control" name ="txtseats" id="txtseats" value="<?php echo $model->plane->seats ?>" />
                     
                </div>
                <div class="form-group inline-fields sm-1">
                 <label>Description</label>
                  <textarea name='txtaDesc' class='form-control' ><?php echo $model->plane->desc ?></textarea>
                </div>
                    

               
               <div class="form-group inline-fields button">
                        <?php 
                         $paramInput= new ArrayIterator();
                          $paramInput->offsetSet("class", "btn btn-primary");
                          if( $model->plane->mode !='edit')
                          {
                            
                             $paramInput->offsetSet("type", "submit");
                             $paramInput->offsetSet("value", "Add");
                             ContextManager::HtmlInputField("btnSubmitAccount", $paramInput);
                          }  else {
                            
                            
                             $paramInput->offsetSet("type", "submit");
                             $paramInput->offsetSet("value", "Save Changes");
                             ContextManager::HtmlInputField("btnSaveChanages", $paramInput); 
                          }
                       ?>
                    </div>
                </div>
                
<?php ContextManager::EndForm() ?>
            

     

 <?php
  include_once("index.php");
 ?>               

