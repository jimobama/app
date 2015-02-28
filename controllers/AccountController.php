<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AccountController
 *
 * @author Obaro
 */
class AccountController extends IController {
    //put your code here
    private $agentViewModel=null;
    function __construct() {
        parent::__construct(new IModel(), new IView());
        include_once("models/AgentModel.php");
        include_once("modelviews/AgentModelView.php");
        $this->agentViewModel= new AgentModelView();
    }
    
   public  function Index()
    {
       if(Session::get("db_username")!=null)
       {
        $this->ViewBag("Title","Account");
        $agentModel= new AgentModel();
        $UserList =  $agentModel->GetUsers();
        $this->agentViewModel->agentList=$UserList;
        
        return  $this->View($this->agentViewModel,"Account","Index");
       }
       return $this->ReDirectTo("Home", "Index");
    }
    
   public  function Success()
    {
        return "Account main";
    }
    
    public function Logout()
    {
        Session::delete("db_username");
        Session::destroy();      
        return $this->ReDirectTo("Home","Index");
    }
}
