<?php
  $paramsLink=  new ArrayIterator();
  $paramsLink->offsetSet("class", "dropdown-toggle");
  $paramsLink->offsetSet("data-toggle", "dropdown");
?>
<div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><?php
                      
                      
                      ContextManager::ActionLink("Flight Manager", "Flight", "Index"); 
                   ?></li>
                  <li class='dropdown'>
                      <?php 
                       
                         ContextManager::ActionLink("Agent Manager", "Account", "Index"); 
                        
                      ?>
                      
                  </li>
              
                    <li class='dropdown'>
                      <?php 
                       
                         ContextManager::ActionLink("Ticket Manager", "Booking", "Index"); 
                        
                      ?>
                      
                  </li>
                  
                  
                    <li class='dropdown'>
                      <?php 
                       
                         ContextManager::ActionLink("Plane Manager", "Plane", "Index"); 
                        
                      ?>
                      
                  </li>
                  
                  
                    <li class='dropdown'>
                      <?php 
                       
                         ContextManager::ActionLink("Seats Manager", "Seat", "Index"); 
                        
                      ?>
                      
                  </li>
            </ul>
     
     
     
 </div>