<?php

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
                                <span class="field-validation-valid" data-valmsg-for="ErrorMessage" data-valmsg-replace="true"></span>
                            </div>
                      
                        <div class="control">
                            <div class="editor-label">
                                <label for="FirstName">First Name</label>
                            </div>
                            <div class="editor-field">
                                <input class="text-box single-line" data-val="true" data-val-required="The First Name field is required." id="FirstName" name="FirstName" type="text" value="" />
                                <span class="field-validation-valid" data-valmsg-for="FirstName" data-valmsg-replace="true"></span>
                            </div>

                        </div>
                        <div class="control">
                            <div class="editor-label">
                                <label for="LastName">Last Name</label>
                            </div>
                            <div class="editor-field">
                                <input class="text-box single-line" data-val="true" data-val-required="The Last Name field is required." id="LastName" name="LastName" type="text" value="" />
                                <span class="field-validation-valid" data-valmsg-for="LastName" data-valmsg-replace="true"></span>
                            </div>

                        </div>
                        <div class="control">
                            <div class="editor-label">
                                <label for="Email">Email Address</label>
                            </div>
                            <div class="editor-field">
                                <input class="text-box single-line" data-val="true" data-val-required="The Email Address field is required." id="Email" name="Email" type="text" value="" />
                                <span class="field-validation-valid" data-valmsg-for="Email" data-valmsg-replace="true"></span>
                            </div>

                        </div>
                        <div class="control">
                            <div class="editor-label">
                                <label for="PhoneNumber">Mobile Number</label>
                            </div>
                            <div class="editor-field">
                                <input class="text-box single-line" data-val="true" data-val-required="The Mobile Number field is required." id="PhoneNumber" name="PhoneNumber" type="tel" value="" />
                                <span class="field-validation-valid" data-valmsg-for="PhoneNumber" data-valmsg-replace="true"></span>
                            </div>

                        </div>
                        <div class="control">
                            <div class="editor-label">
                                <label for="Password">Password</label>
                            </div>
                            <div class="editor-field">
                                <input class="text-box single-line password" data-val="true" data-val-required="The Password field is required." id="Password" name="Password" type="password" value="" />
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
  


     