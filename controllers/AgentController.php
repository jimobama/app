<?php



class AgentController  extends IController{
  
 private  $agentModelView = null;
 private $db= null;
 
    function __construct() {
      
        include_once("models/AgentModel.php");
        include_once("modelviews/AgentModelView.php");
       $this->agentModelView= new AgentModelView();
       
       $this->db= new Database();
       //create the table      
       $this->db->createFields("email", "varchar(40)", "not null");
        $this->db->createFields("phone", "varchar(17)", "not null");
         $this->db->createFields("firstname", "varchar(20)", "not null");
       $this->db->createFields("lastname", "varchar(20)", "not null");
       $this->db->createFields("password", "varchar(50)", "not null");
        $this->db->createFields("active", "int", "");
       $this->db->createFields("id", "varchar(40)", "primary key");
       $this->db->createFields("status", "int", "default 1");
        $this->db->createFields("vcode", "varchar(50)", "not null");
       $this->db->createTable("tbl_agent");
       
    }
    
    
    function Index()
    {
         $this->ViewBag("Title", "Mgr Booking");
         return $this->View(null,"Agent","Create");
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
               if(!$agentModel->IsSuspended($email))
                {
                Session::set("db_username", "$email");              

                $agent->email=$email;
                $agent->password=$email;              
                return $this->ReDirectTo("Account","Index");
               }  else {
                     Session::set("Warning","This account as be fully suspected please contact administrator");
                     return $this->ReDirectTo("Agent", "LoginForm");
               }
            }else
            {
              Session::set("Warning", 
                      "Your email account [$email] is not yet verified.");                    
               
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
        if(Session::get("db_username")==null || Session::get("db_username")=="")
            return $this->ReDirectTo("Index","Index");
       
       $repassword =($repassword =="null")?null:$repassword;
       $agent = new Agent();
       $agent->set($firstname,$lastname,$email,$phone,$password);
       $agentModel = new AgentModel($agent);
       $list= $agentModel->GetUsers();
       
       $this->agentModelView->agent=$agent;
        $this->agentModelView->agentList=$list;
       if($agent->validated())
       {
          if($password != $repassword)
          {
                 Session::set("warning"," Password mis-matched, re-enter passwords again!");
                 return $this->View($this->agentModelView,"Agent","Index");
          }
         else {
          
           
            $this->agentModelView->agentDbModel=$agentModel;

            if($agentModel->Exists())
            {
              
                Session::set("warning","The user with the given email address [$email] already exists!");
            }
            else
            {
                  
                try{
                    //else create the user
                    
                    
                    
                    if($agentModel->Create())
                    {  
                        $sessionID=Validator::UniqueKey(20);
                        $agentModel->SaveVerificationCode($email,$sessionID);
                        
                        //create a barcode
                        $param= new ArrayIterator();
                        $param->offsetSet("username", $agent->email);
                        $param->offsetSet("verificationCode", $sessionID);                    
                        $url=  ContextManager::CreateURL("Agent","Login",$param); 
                        $imgPath= ContextManager::CreateQRBarcode($url,$agent->agentId); 
                        
                       if($this->_sendVerificationEmail($agent,$sessionID,$imgPath))
                       {
                        //navigate to comfirmation page
                         return $this->View($agent,"Agent","Confirmation"); 
                       }  else {
                           Session::set("warning","could not send mail ");   
                          $agentModel->DeleteAgent($email);
                       }
                    }
                   
                }catch(Exception $err)
                {
                    Session::set("warning",$err->getMessage()); 
                }
            }
         }
          
          // create a database record here
       }  else {
            Session::set("warning", $agent->getError()); 
       }
        
         return $this->View($this->agentModelView,"Account","Index"); 
      
        
       
    }
    
    
    
    function VerifyUser($email,$verifiedCode)
    {
        
        $agentModel = new AgentModel();
         
        
        if($agentModel->IsFound($email,  AgentModel::BOTH))
         {
            
             if(!$agentModel->IsActive($email,AgentModel::BOTH))
             {
                 
                 // check if the code provided is validated
                 if($agentModel->IsVerificationCodeExist($email, $verifiedCode,AgentModel::BOTH))
                 {
                 
                     $agentModel->SetActive($email,1,AgentModel::BOTH);
                 }
                else {
                       Session::set("warning","Verification code is invalid");
                       return $this->View($agentModel->GetAccountEmail($email), "Agent", "Confirmation");
                 }
                
             }
             
            return $this->ReDirectTo("Agent", "LoginForm");
             
        } 
        
        
        else {
            
        {
            Session::set("warning","The email [$email] address provided does not exists you can registered it if you wants");
        }
       return $this->View($email, "Agent", "Confirmation");
    }
    }
    
    
    //helper methods
    
    private function _sendVerificationEmail($agent,$code,$attachment=null)
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
            if($attachment != null && file_exists($attachment))
            {
                $mail->addAttachment($attachment,"Your Barcode");
            }

            $mail->Subject = 'Welcome to flights.com[verification send]';
            
            //add the html contents
            $message=" <h2>Account Details</h2> <br>Dear ".$agent->lastname .",<br> "
                    . "<p style='text-indent: 30px;'> Welcome to flights below is your account informations : <br>"
                    . " Username : $agent->email <br> Password: $agent->password<br>"
                    . " Verification Code : $code"
                    . "<hr> Click on the below link to verify your account ".ContextManager::CreateLink("Verify my Account", "Agent", "Confirmation")
                    ."</p> <br> or copy and paste on the browser  this URL  ".HOST_NAME."?url=Agent&action=VerifyUser&code=$code <hr>"
                    . "<br>"
                    . " <p>Alternatively scan the barcode with your phone or any device to quickly verified your email,, the barcode image is attached with this message</p> ";
            $mail->msgHTML($message);
            $status=  $mail->send();
           
            return $status;
            
    }
    
    
    
    function Modify()
    {
        
         $checkList = Request::RequestParams("chkboxes");
         $buttonCancel= Request::RequestParams("btnCancel");
         $buttonModifer= Request::RequestParams("btnModifer");
        if(isset($checkList) && is_array($checkList)) 
        {
         if(isset($buttonCancel))
         {
             foreach($checkList as $key=>$checkbox)
             {
                 $this->deleteAgent($checkbox);
             }
             
         }
         else if(isset($buttonModifer))
         {
             foreach($checkList as $key=>$checkbox)
             {
                 $this->suspendAgent($checkbox);
             }
         }
       
        
        
        }//end if seet array
       
        $agentModel = new AgentModel();
        
        $this->agentModelView->agentList= $agentModel->GetUsers();
        return $this->View($this->agentModelView,"Account","Index");
    }
    
    
    private function suspendAgent($id)
    {
        $agentModel= new AgentModel();
        if($agentModel->IsActive($id, AgentModel::ID))
        {
            $agentModel->SuspendAgent($id,0);
        }
        
    }
    
    private function deleteAgent($id)
    {
          $agentModel= new AgentModel();
          
          if($agentModel->IsFound($id, AgentModel::ID))
          {
              $agentModel->DeleteAgent($id);
          }
    }
    
    
}
