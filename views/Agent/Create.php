<?php
 $agent= new Agent();

 if(ContextManager::$Model ==null)
      {
       if(is_a(ContextManager::$Model, "AgentModelView"))
       {
         ContextManager::$Model = new AgentModelView(); 
         $agent = ContextManager::$Model->agent;
       }
      }  
      else {
         if(is_a(ContextManager::$Model, "AgentModelView"))
         {
            $agent = ContextManager::$Model->agent; 
         }
       }
    

?>

<script>
    $(document).ready(function () {
      
    })

</script>
    
<link href="styles/agent.css" rel="stylesheet" type="text/css" />

 <div id="agent-reg-from">
  
<div class="form">

            <fieldset>
                <h2>Agent Registration Form</h2>
                <div cass="control-wrapper">
                    <?php 
                       $attr= new ArrayIterator();
                       $attr->offsetSet("method", "post");                       
                       ContextManager::BeginForm($controller,$action,$attr);
                    ?>
                   
    
                           <div class="editor-field">
                              
                                      <?php ContextManager::ValidationFor("warning");?>
                               
                            </div>
                       <div class="control">
                            <div class="editor-label">
                                <label for="Email">Email Address</label>
                            </div>
                            <div class="editor-field">
                                <input class="text-box single-line" data-val="true"  id="Email" name="Email" type="text" value="<?php  echo $agent->email;  ?>" />
                                <span class="field-validation-valid" data-valmsg-for="Email" data-valmsg-replace="true"></span>
                            </div>

                        </div>
                        <div class="control">
                            <div class="editor-label">
                                <label for="FirstName">First Name</label>
                            </div>
                            <div class="editor-field">
                                <input  id="FirstName" name="FirstName" type="text" value="<?php  echo $agent->firstname;  ?>" />
                                <span  data-valmsg-for="FirstName" data-valmsg-replace="true"></span>
                            </div>

                        </div>
                        <div class="control">
                            <div class="editor-label">
                                <label for="LastName">Last Name</label>
                            </div>
                            <div class="editor-field">
                                <input  data-val="true" id="LastName" name="LastName" type="text" value="<?php  echo $agent->lastname;  ?>" />
                                <span   data-valmsg-for="LastName" data-valmsg-replace="true"></span>
                            </div>

                        </div>
                       
                        <div class="control">
                            <div class="editor-label">
                                <label for="PhoneNumber">Mobile Number</label>
                            </div>
                            <div class="editor-field">
                                <input class="text-box single-line" data-val="true"  id="PhoneNumber" name="PhoneNumber" type="tel" value="<?php  echo $agent->phonenumber;  ?>" />
                                <span class="field-validation-valid" data-valmsg-for="PhoneNumber" data-valmsg-replace="true"></span>
                            </div>

                        </div>
                        <div class="control">
                            <div class="editor-label">
                                <label for="Password">Password</label>
                            </div>
                            <div class="editor-field">
                                <input class="text-box single-line password" data-val="true"  id="Password" name="Password" type="password" value="" />
                                <span class="field-validation-valid" data-valmsg-for="Password" data-valmsg-replace="true"></span>
                            </div>

                        </div>
                        <div class="control">
                            <div class="editor-label">
                                <label for="RePassword">Re-Type Password</label>
                            </div>
                            <div class="editor-field">
                                <input class="text-box single-line password" id="RePassword" name="RePassword" type="password" value="" />
                                <span class="field-validation-valid" data-valmsg-for="RePassword" data-valmsg-replace="true"></span>
                            </div>

                        </div>
                        <div class="control">
                            <div class="editor-space">

                            </div>
                            <div class="editor-button">
                                
                                <?php 
                                $paramInput= new ArrayIterator();
                                $paramInput->offsetSet("class", "btn");
                                $paramInput->offsetSet("type", "submit");
                                $paramInput->offsetSet("value", "Create Account");
                                ContextManager::HtmlInputField("btnSubmitAccount", $paramInput);
                                ?>
                               
                            </div>

                        </div>
                        <?php ContextManager::EndForm(); ?>
                </div>

            </fieldset>
  <div class="note-wrapper">
      We have over 0  agencies world wide. Please read the rules and condition  before you registered with us .
  </div>
</div>

</div>
  


     