





<div class="form">

        <fieldset>
            <h2>Agent Registration Form</h2>
            <div cass="control-wrapper">

                
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
                        <input type="text" name ="txtForm" id="txtForm" required="true" />
                        <span id="txtForm" class="error-reporter"> </span>
                    </div>
                </div>
                <div class="control">
                    <div class="editor-label">
                         <label>To</label>
                    </div>
                    <div class="editor-field">
                         <input type="text" name ="txtForm" id="txtTo" required="true" />
                          <span id="txtTo" class="error-reporter"> </span>                      
                    </div>
                </div>

                <div class="control">
                    <div class="editor-label">
                        <label>Departure Date</label>
                    </div>
                    <div class="editor-field">
                        <input type="text" name ="txtDepatureDate" id="txtTo" required="true" />
                        <span id="txtDepatureDate" class="error-reporter"> </span>    
                       
                    </div>
                </div>


                <div class="control">
                    <div class="editor-label">
                       <label>Return Date</label>
                    </div>
                    <div class="editor-field">
                        <input type="text" name ="txtreturndate" id="txtTo" required="true" />                       
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
                    <div class="editor-label">
                        <label>Adults</label>
                    </div>
                    <div class="editor-field">
                                               
                         <input type="text" name ="txtadults" id="txtTo" required="true" /> 
                         <span id="txtadults" class="error-reporter"> </span> 
                    </div>
                </div>

                <div class="control">
                    <div class="editor-label">
                        <label>Children</label>
                    </div>
                    <div class="editor-field">
                        
                         <input type="text" name ="txtchildren" id="txtTo" required="true" /> 
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

            </div>

        </fieldset>


    </div>