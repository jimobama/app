<?php
include_once("entities/Flight.php");
include_once("models/FlightModel.php");
   $model= new FlightModel();
   $flightList= $model->GetAllDistinctFlights();
   
?>





<div class="form">

        <fieldset>
            <h2>Search Flights</h2>
            <div cass="control-wrapper">
              <?php
               $object= new ArrayIterator();
                $object->offsetSet("method", "post");
                  ContextManager::BeginForm("Flight", "Search", $object)?>
                
                <div class="control-collection-horizontal">
                    
                    <div class ="group-control">
                    <div class="control">
                        <div class="editor-label">
                            <label>One-Pass Ticket</label>                            
                        </div>
                        <div class="editor-field">
                            <input type="radio" name="rbticketType" id="rdbonepass" />                           
                        </div>
                    </div>


                    <div class="control">
                        <div class="editor-label">
                            <label>Return Ticket</label>                            
                        </div>
                        <div class="editor-field">
                              <input type="radio" name="rbticketType" id="chkOnePass" />   
                         
                        </div>
                    </div>
                </div>

                </div>


                <div class="control">
                    <div class="editor-label">
                        <label>From</label>
                    </div>
                    <div class="editor-field">
                        <select name="txtForm" class="combo">
                            <option>   </option>                          
                           <?php
                            foreach($flightList as $flight)
                            {
                                echo "<option value='$flight->from' >$flight->from</option>";
                            }
                           ?>
                        </select>
                        
                        <span id="txtForm" class="error-reporter"> </span>
                    </div>
                </div>
                <div class="control">
                    <div class="editor-label">
                         <label>To</label>
                    </div>
                    <div class="editor-field">
                         <select name="txtTo" class="combo">
                            <option>   </option> 
                             <?php
                            foreach($flightList as $flight)
                            {
                                echo "<option value='$flight->to' >$flight->to</option>";
                            }
                           ?>
                        </select>
                          <span id="txtTo" class="error-reporter"> </span>                      
                    </div>
                </div>

                <div class="control">
                    <div class="editor-label">
                        <label>Departure Date</label>
                    </div>
                    <div class="editor-field">
                        <input type="text" name ="txtDepatureDate" id="txtTo" />
                        <span id="txtDepatureDate" class="error-reporter"> </span>    
                       
                    </div>
                </div>


                <div class="control">
                    <div class="editor-label">
                       <label>Return Date</label>
                    </div>
                    <div class="editor-field">
                        <input type="text" name ="txtreturndate" id="txtTo" />                       
                        <span class="txtreturndate" id="error-reporter"> </span>    
                    </div>
                </div>

                
                <div class="control">
                    <div class="editor-label">
                         <label>Flight Class</label>                       
                    </div>
                    <div class="editor-field">
                        <select id="flightclass">
                            <option value="">...</option>
                             <option value="1">Economics</option>
                             <option value="2">Premier Economics</option>
                             <option value="3">Business/Club</option>
                             <option value="4">First</option>
                        </select>
                        <span class="flightclass" id="error-reporter"> </span>  
                      
                    </div>
                </div>

                <div class="control">
                    <div class="editor-label">
                         <label>Ticket type</label> 
                    </div>
                    <div class="editor-field">
                        <select>
                            <option value="0">Lower Price</option>
                            <option value="1">Flexible</option>
                        </select>
                         <span id="tickettype" class="error-reporter"> </span>  
                      
                    </div>
                </div>
                <div class="control">
                    <div class="editor-label">
                        <label>Adults</label>
                    </div>
                    <div class="editor-field">
                                               
                         <input type="text" name ="txtadults" id="txtTo"  /> 
                         <span id="txtadults" class="error-reporter"> </span> 
                    </div>
                </div>

                <div class="control">
                    <div class="editor-label">
                        <label>Children</label>
                    </div>
                    <div class="editor-field">
                        
                         <input type="text" name ="txtchildren" id="txtTo" /> 
                         <span id="txtchildren" class="error-reporter"> </span> 
                       
                    </div>
                </div>

                <div class="control">
                    <div class="editor-space">
                       
                    </div>
                    <div class="editor-button">
                       <input type="submit" value="Search" class='btn'/>
                    </div>
                </div>
                
                <?php ContextManager::EndForm() ?>

            </div>

        </fieldset>


    </div>