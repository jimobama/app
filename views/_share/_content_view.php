<!DOCTYPE html>
<?php
  
?>


<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Flights-> <?php  echo $this->ViewBag("Title"); ?></title>  
     <link href="styles/bootstrap.css" rel="stylesheet" type="text/css" /> 
     <link href="styles/bootstrap.min.css" rel="stylesheet" type="text/css" /> 
      <link href="styles/site.css" rel="stylesheet" type="text/css" /> 
     <link href="styles/index.css" rel="stylesheet" type="text/css" /> 
     <link href="styles/menu.css" rel="stylesheet" type="text/css" /> 
     <link href="styles/form.css" rel="stylesheet" type="text/css" /> 
     <script src="scripts/lib/jquery.js"></script>
     
</head>
<body>
 
 <div id='main-body-wrapper'>
     
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        
        <div class="page-header">            
            <?php require_once("_header.php"); ?>
        </div>
    </div>
</nav>

    
    <div class='content-wrapper'>
        <?php
         ContextManager::RenderContext();
        ?>
    </div>
        
         <div id="footer-wrapper" >
            <span class="copyright">
                &copy;   Copyright 2015 - Alright reserved.
            </span>
        </div>
 </div>
    <script src="scripts/lib/jquery-1.10.2.min.js"></script>
    <script src="scripts/lib/bootstrap.min.js"></script>
    
   
</body>
</html>