<?php

?>

<link href="styles/dash_board.css" rel="stylesheet" type="text/css" /> 



<div id='dash-board-wrapper'>
    
    <div id='dash-board'>
        <fieldset>
            <legend>Dash Board :
            <span id='search_bar'>  
               <?php ContextManager::BeginForm("Search", "search")?>
               
                <input type='text' class='text' name='txtcriteria' placeholder='search items here ' id='txtSearchProduct'/>
                <input type='submit' class='button' name='btnSubmitSearch' id='btnSubmitSearch' value='Find' />
                
                <?php ContextManager::EndForm()?>
             </span>
            </legend>
            
            
            <div id='dash-context'>
            
                <div class='row'>
                    
                     <div class='col-sm-4'> 
                       1
                     </div>
                     <div class='col-sm-4'> 
                         2
                      </div>
                     <div class='col-sm-4'> 
                     3
                     </div>
                     <div class='col-sm-4'> 
                     4
                     </div>
                     <div class='col-sm-4'> 
                     5
                     </div>
                    <div class='col-sm-4'>
                        6
                    </div>
                </div>
            
            </div>
            
        </fieldset>    
        
            
    </div>
    
    <div id='profile_wrapper'>
     <?php ContextManager::PartialView("newflight", "Account");
     
        ContextManager::PartialView("newflight");
     ?>
    </div>
    
</div>
