   
<?php
  $paramsLink=  new ArrayIterator();
  $paramsLink->offsetSet("class", "dropdown-toggle");
  $paramsLink->offsetSet("data-toggle", "dropdown");
?>
<div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><?php
                      
                      
                      ContextManager::ActionLink("Home", "Home", "Index"); 
                   ?></li>
                  <li class='dropdown'>
                      <?php 
                       
                         ContextManager::ActionLink("Manage My Booking  <span class='caret'></span>", "Home", "ManageMyBooking",$paramsLink); 
                        
                      ?>
                      
                      <ul class='dropdown-menu'>
                      <li><?php include_once("searchBooking.php");?></li>
                           
                      </ul>
                  </li>
                  
                  
                   <li class='dropdown'>
                       
                       <?php ContextManager::ActionLink("Times Table<span class='caret'></span>","TimesTable", "Index",$paramsLink); ?>
                       
                      
                    <ul class='dropdown-menu'>
                              <li><a href="#">Page 1-1</a></li>
                            <li><a href="#">Page 1-2</a></li>
                            <li><a href="#">Page 1-3</a></li> 
                      </ul>
                   </li>
                    
                   
                    <li class='dropdown'>
                        
                        <?php ContextManager::ActionLink("Destinations<span class='caret'></span>","Destination", "Index",$paramsLink); ?>
                        
                      
                    <ul class='dropdown-menu'>
                              <li><a href="#">Page 1-1</a></li>
                            <li><a href="#">Page 1-2</a></li>
                            <li><a href="#">Page 1-3</a></li> 
                      </ul>
                   </li>
                   
                   
                    <li class='dropdown'>
                       <?php ContextManager::ActionLink("Contact Us", "Home", "ContactUs")?>                
                   </li>

            </ul>
     
     
      <ul class="nav navbar-nav navbar-right">
          
        <li><?php ContextManager::ActionLink("<span class=\"glyphicon glyphicon-user\"></span> Travel Agent", "Agent", "Index")?> </li>        
        
        <li> <?php ContextManager::ActionLink("Log In <span class=\"glyphicon glyphicon-log-in\"></span>", "Agent", "Login")?></li>
      </ul>
 </div>