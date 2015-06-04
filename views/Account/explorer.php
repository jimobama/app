
        
        
        
     <div class ="container menu">
      <h4>Explorer</h4>
        <ul class="list-group">
            
              <li class ="list-group-item">
                  <?php ContextManager::ActionLink("Account Summary", "Account", "Index"); ?>
                 <span class="badge">
                  <span class="glyphicon glyphicon-folder-open"></span>
                </span>
             
              </li>
              
               <li class ="list-group-item">
                  <?php ContextManager::ActionLink("My Profile", "Account", "Profile"); ?> <span class="badge">
                  <span class="glyphicon glyphicon-folder-open"></span>
                </span>
             
              </li>
              <li class ="list-group-item"><a href ="#hhhe">Reservations</a><span class="badge">
                  <span class="glyphicon glyphicon-folder-open"></span>
                </span>
             
              </li>
              <li class ="list-group-item"><a href ="#hhhe">Bookings</a><span class="badge">
                  <span class="glyphicon glyphicon-folder-open"></span>
                </span>
             
              </li>  
            
              <li class ="list-group-item"><a href ="#hhhe">Settings</a><span class="badge">
                  <span class="glyphicon glyphicon-folder-open"></span>
                </span>
             
              </li>
              
              
        </ul>
      
      
        </div>
    
    <div class ="container">
      <h4>Control Panel</h4>
        <ul class="list-group">
            
             <li class ="list-group-item">
                 <?php ContextManager::ActionLink("Plane Settings", "Plane", "Create"); ?>
               
                 
                 
                 <span class="badge">
                     <span class="glyphicon glyphicon-folder-open">                         
                     </span>
                </span>
             
              </li>  
              
              <li class ="list-group-item">
                 
                  <?php   ContextManager::ActionLink("Add New Flight ", "Account", "NewFlight");  ?>
                  <span class="badge">
                  <span class="glyphicon glyphicon-folder-open"></span>
                </span>
             
              </li>
              
               <li class ="list-group-item">
                 <?php   
                   ContextManager::ActionLink("Flight List", "Account", "Flights"); 
                  ?>
                   
                   <span class="badge">
                  <span class="glyphicon glyphicon-folder-open"></span>
                </span>
             
              </li>
                       
            
              <li class ="list-group-item">
                  
                  <?php ContextManager::ActionLink("Planes' Seats Settings", "Seat", "Index", null); ?>
                  <span class="badge">
                  <span class="glyphicon glyphicon-folder-open"></span>
                </span>
             
              </li>
            
              
        </ul>
      
      
        </div>
    