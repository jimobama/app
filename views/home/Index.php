<?php


?>

<link href="styles/home.css" rel="stylesheet" type="text/css" />


<div id="home-index">
<script>   
$(document).ready(function(){
    
var x = document.getElementById("demo");
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}
function showPosition(position) {
    x.innerHTML = "Latitude: " + position.coords.latitude +
    "<br>Longitude: " + position.coords.longitude;
}
});
</script> 
<div id="demo"></div>
 <div id="index-context" class="row">
    
<div id="index-left-context" class="col-lg-4">   
  <?php require_once("search_flight.php"); ?>   
</div>
     
     <div id="index-right-context" class="col-lg-8">   
<?php require_once("animation_index.php"); ?>
</div>
 </div>

</div>