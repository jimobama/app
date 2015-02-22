<?php



class AgentController  extends IController{
  
  
    function __construct() {
      
        include_once("models/AgentModel.php");
        include_once("modelviews/AgentModelView.php");
    }
    
    
    function Index()
    {
        
        return $this->View(null,"Agent","Index");
    }
       
    
    
    function Login($email, $password, $option =null)
    {
        $email =($email=="null")?null:$email;
        $password =($password=="null")?null:$password;
        $agentModel = new AgentModel();
       
        if($agentModel->IsLogin($email,$password))
        {
            // The user has successfully login
            Session::set("db_username", "$email");              
              $agent = new Agent();
              $agent->email=$email;
              $agent->password=$email;              
              return $this->ReDirectTo("Account","Index");
        }  else 
            {
            ContextManager::ValidationFor("warning","Invalid username or password\n");
        }
      
       
       return $this->View(null,"Agent","Login");  
    }
    function Confirmation()
    {
        
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
                 return $this->View($agent,"Agent","Index");
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
                    {  //Send email to the user here
                        //navigate to comfirmation page
                        return $this->View($agent,"Agent","Confirmation");  
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
}
