<?php



class AgentController  extends IController{
  
  
    function __construct() {
      
        include_once("models/AgentModel.php");
        include_once("modelviews/AgentModelView.php");
    }
    
    
    function Index()
    {
         $this->ViewBag("Title", "Mgr Booking");
         return $this->View(null,"Agent","index");
    }
       
    function LoginForm()
    {
        $this->ViewBag("Title","Log in");
        return $this->View(null,"Agent","Login");  
    }
    
    function Login($email, $password, $option =null)
    {
        $email =($email=="null")?null:$email;
        $password =($password=="null")?null:$password;
        $agentModel = new AgentModel();
       
        if($agentModel->IsLogin($email,$password))
        { 
             $agent = new Agent();
            // The user has successfully login
            if($agentModel->IsActive($email))
            {
              Session::set("db_username", "$email");              
             
              $agent->email=$email;
              $agent->password=$email;              
              return $this->ReDirectTo("Account","Index");
            }else
            {
            
              return $this->ReDirectTo("Agent", "Confirmation");
            }
        } 
        else 
            {
            ContextManager::ValidationFor("warning","Invalid username or password\n");
        }
      
       
       return $this->View(null,"Agent","Login");  
    }
    function Confirmation($codes=null)
    {
        $this->ViewBag("Title","Confirmation");
        return $this->View($codes,"Agent", "Confirmation");
    }
    function Create($email,$firstname,$lastname,$phone,$password,$repassword,$sendButton=null)
    {
       $repassword =($repassword =="null")?null:$repassword;
       $agent = new Agent();
       $agent->set($firstname,$lastname,$email,$phone,$password);
       
       $agentModelView = new AgentModelView();
       $agentModelView->agent=$agent;
       
       if($agent->validated())
       {
          if($password != $repassword)
          {
                ContextManager::ValidationFor("warning"," Password mis-matched, re-enter passwords again!");
                 return $this->View($agentModelView,"Agent","Index");
          }
         else {
          
            $agentModel = new AgentModel($agent);
            $agentModelView->agentDbModel=$agentModel;

            if($agentModel->Exists())
            {
              
                ContextManager::ValidationFor("warning","The user with the given email address [$email] already exists!");
            }
            else
            {
                  
                try{
                    //else create the user
                    if($agentModel->Create())
                    {  
                        $sessionID=Session::getId();
                        $agentModel->SaveVerificationCode($email,$sessionID);
                       if($this->_sendVerificationEmail($agent,$sessionID))
                       {
                        //navigate to comfirmation page
                        return $this->View($agent,"Agent","Confirmation"); 
                       }  else {
                          ContextManager::ValidationFor("warning","could not send mail ");   
                          $agentModel->DeleteAgent($email);
                       }
                    }
                   
                }catch(Exception $err)
                {
                   ContextManager::ValidationFor("warning",$err->getMessage()); 
                }
            }
         }
          
          // create a database record here
       }  else {
           ContextManager::ValidationFor("warning", $agent->getError()); 
       }
        
         return $this->View($agentModelView,"Agent","Index"); 
      
        
       
    }
    
    
    
    function VerifyUser($email,$verifiedCode)
    {
        
        $agentModel = new AgentModel();
        
        if($agentModel->IsFound($email))
        {
             if(!$agentModel->IsActive($email))
             {
                 // check if the code provided is validated
                 if($agentModel->IsVerificationCodeExist($email, $verifiedCode))
                 {
                    
                     $agentModel->SetActive($email,1);
                 }
                else {
                      ContextManager::ValidationFor("warning","Verification code is invalid");
                       return $this->View($email, "Agent", "Confirmation");
                 }
                
             }
             
            return $this->ReDirectTo("Agent", "LoginForm");
             
        }  else {
            
        {
           ContextManager::ValidationFor("warning","The email [$email] address provided does not exists you can registered it if you wants");
        }
       return $this->View($email, "Agent", "Confirmation");
    }
    }
    
    
    //helper methods
    
    private function _sendVerificationEmail($agent,$code)
    {
        
           date_default_timezone_set('Etc/UTC');

            $mail = new PHPMailer();
            //Tell PHPMailer to use SMTP
            $mail->isSMTP();         
            $mail->SMTPDebug = 0;           
            $mail->Debugoutput = 'html';
            $mail->isHTML(true);
            $mail->Host = SMTP_HOST;
            $mail->Port =  SMTP_PORT;           
            $mail->SMTPSecure= 'tls';          
            $mail->SMTPAuth = true;          
            $mail->Username = SMTP_EMAIL_ACCOUNT;
            $mail->Password = SMTP_PASSORD;
            //Set who the message is to be sent from
            $mail->setFrom('jimobama2011@gmail.com', 'Obaro Isreal');
            $mail->addReplyTo('jimobama2011@gmail.com', 'Obaro Isreal');
          
            $mail->addAddress($agent->email, $agent->firstname." ".$agent->lastname);

            $mail->Subject = 'Welcome to flights.com[verification send]';
            
            //add the html contents
            $message=" <h2>Account Details</h2> <br>Dear ".$agent->lastname .",<br> "
                    . "<p style='text-indent: 30px;'> Welcome to flights below is your account informations : <br>"
                    . " Username : $agent->email <br> Password: $agent->password<br>"
                    . " Verification Code : $code"
                    . "<hr> Click on the below link to verify your account ".ContextManager::CreateLink("Verify my Account", "Agent", "Confirmation")
                    ."</p> <br> or copy the user and paste on the browser URL  ".HOST_NAME."?url=Agent&action=VerifyUser&code=$code <hr>  ";
            $mail->msgHTML($message);
            $status=  $mail->send();
           
            return $status;
            
    }
    
    
}
