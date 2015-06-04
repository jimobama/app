

<div class="row">
    
    <div class=" col-sm-3">   
        
        <?php include_once("explorer.php"); ?>
       
        </div>
    
     <div class="col-sm-9">
        <?php
        
           ContextManager::Display($this->ViewBag("Controller"), $this->ViewBag("Page"));
        ?>
         
    </div>
</div>