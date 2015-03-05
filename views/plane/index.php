<?php 
$model = ContextManager::$Model;
$list= new ArrayIterator();
$planeTem = new Plane();
 if($model ==null ||  !is_a($model,"PlaneModelView"))
 {
     include_once "modelviews/PlaneModelView.php";
     include_once "models/PlaneModel.php";     
     $model= new PlaneModelView();
 }  
 
 if($model->planeModel ==null)
 {  
 $model->planeModel= new PlaneModel();

 }
 $list=  $model->planeModel->GetAllPlanes();
 if($model->plane!=null)
 {
     $planeTem=$model->plane;
 }
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
                      ContextManager::BeginForm("Plane", "Modify", $attr);
                   ?>
                <table width="100%">
                    <tr>
                    <th>S/N</th>
                    <th>Name</th>
                    <th>Total Seats</th>
                    <th>Description</th>                                      
                    <th>#</th>
                </tr>
                <?php
              
                for ($i=0; $i < $list->count(); $i++)
                {
                     $list->seek($i); 
                      $plane= new Plane();
                      $plane = $list->current();
                    $sn = $i +1 ;
                    $checked="";
                    if($planeTem->Id == $plane->Id)
                    {
                        if($planeTem->mode=='edit')
                        {
                             $checked="checked='checked'";
                        }
                    }
                   echo "<tr>
                        <td>$sn</td>
                        <td>$plane->name</td>
                        <td>$plane->seats</td>
                        <td>$plane->desc</td>                                         
                        <td><input type='checkbox' value='$plane->Id' name='chkplanes[]'  $checked ></td>
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
     <?php ContextManager::PartialView("Create", "Plane");
     
        ContextManager::PartialView("Create");
     ?>
    </div>
    
    
    <div class="operation_panel" >
    
    
    
    </div>
    
  
    
</div>
