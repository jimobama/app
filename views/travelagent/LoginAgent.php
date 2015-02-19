
<script>
    $(document).ready(function () {
      
    })

</script>
    
<link href="styles/LoginForm.css" rel="stylesheet" type="text/css" />
<div id="login-form">
    <div class="form">

        <fieldset>
            <h2>Login Form</h2>
            <div cass="control-wrapper">

                <form action="/TravelAgents/LoginAgent" method="post"><input name="__RequestVerificationToken" type="hidden" value="thLwnHl2K6v7aOtfqxkOdW7c_3T-fI6j0tS3gcNEgOn_cQgHr-YIPY8E-lQ6HyN27mZ3LF5V2F-ASJRDimWyKiBvCht3-enypnVaYS_vZ_Y1" />                    <div class="control">
                        <div class="editor-field">
                            <span>
                                <span class="field-validation-valid" data-valmsg-for="Error" data-valmsg-replace="true"></span>
                            </span>

                        </div>
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
                </form>           
            </div>

        </fieldset>


    </div>
</div>