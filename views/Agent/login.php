
<script>
    $(document).ready(function () {
      
    })

</script>
    
<link href="styles/LoginForm.css" rel="stylesheet" type="text/css" />
<div id="login-form">
    <div class="form">

        <fieldset>
            <div>
            <h2>Secure Login</h2>
           
            
            </div>
            <div cass="control-wrapper">

              
                   <?php 
                     $object= new ArrayIterator();
                     $object->offsetSet("method", "post");                     
                         ContextManager::BeginForm("Agent", "Login", $object);
                     ?>
                     <div class="editor-field">
                            <span>
                                <span class="field-validation-valid" data-valmsg-for="Error" data-valmsg-replace="true"></span>
                            </span>

                        </div>
                   
                    <div class="control">

                        <div class="editor-label">
                            <label for="Email_Address">Email Address</label>
                        </div>
                        <div class="editor-field">
                            <input data-val="true" data-val-required="The Email Address field is required." id="Email" name="Email" type="text" value="" />
                            <span class="field-validation-valid" data-valmsg-for="Email" data-valmsg-replace="true"></span>
                        </div>
                    </div>
                    <div class="control">
                        <div class="editor-label">
                            <label for="Password">Password</label>
                        </div>
                        <div class="editor-field">
                            <input data-val="true" data-val-required="The Password field is required." id="Password" name="Password" type="password" />
                            <span class="field-validation-valid" data-valmsg-for="Password" data-valmsg-replace="true"></span>
                        </div>
                    </div>
                    <div class="control">
                        <div class="editor-space">

                        </div>
                        <div class="editor-button">
                            <input type="submit" value="Log In" class="btn" />
                        </div>
                    </div>
             <?php ContextManager::EndForm(); ?>         
            </div>

        </fieldset>

        <div class="note-wrapper">
            Agent only are allow to use this form to login.
            
        </div>
    </div>
</div>