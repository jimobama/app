<?php


?>

<link href="styles/home.css" rel="stylesheet" type="text/css" />



<script>   

</script> 

<div  class="row">
    
<div  class="col-lg-4 search-panel">   
  <?php require_once("search_flight.php"); ?>   
</div>
     
<div  class="col-lg-6" >   
<?php 
 ContextManager::Display($this->ViewBag("Controller"), $this->ViewBag("Page"));
?>
</div>
 </div>
