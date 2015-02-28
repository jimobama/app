<?php

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
                      ContextManager::BeginForm("Flight", "Modify", $attr);
                   ?>
                <table width="100%">
                    <tr>
                    <th>S/N</th>
                    <th>Name</th>
                    <th>Total Seats</th>
                    <th>Description</th>
                    <th>Status</th>                    
                    <th>#</th>
                </tr>
                <?php
                   echo "<tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>$</td>                      
                        <td></td>
                        <td><input type='checkbox' value='' name='chkflights[]' ></td>
                    </tr>
                    ";
                  
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
