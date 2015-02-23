
<div class="form">

        <fieldset>
            <h2>Add Flight's Details</h2>
            <div cass="control-wrapper">
              <?php
               $object= new ArrayIterator();
                $object->offsetSet("method", "post");
                  ContextManager::BeginForm("Flight", "Create", $object)?>
                
            


                <div class="control">
                    <div class="editor-label">
                        <label>From</label>
                    </div>
                    <div class="editor-field">
                        <input type="text" name ="txtForm" id="txtForm" />
                        <span id="txtForm" class="error-reporter"> </span>
                    </div>
                </div>
                <div class="control">
                    <div class="editor-label">
                         <label>To</label>
                    </div>
                    <div class="editor-field">
                         <input type="text" name ="txtForm" id="txtTo"  />
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
                            <option value="">Select flight class...</option>
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

                        </select>
                         <span id="tickettype" class="error-reporter"> </span>  
                      
                    </div>
                </div>
             


                <div class="control">
                    <div class="editor-space">
                       
                    </div>
                    <div class="editor-button">
                       <input type="submit" value="Submit" class='btn'/>
                    </div>
                </div>
                
                <?php ContextManager::EndForm() ?>

            </div>

        </fieldset>


    </div>