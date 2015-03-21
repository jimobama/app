<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlaneController
 *
 * @author Obaro
 */
class PlaneController extends IController{
    //put your code here
    private $modelView= null;
    private $db=null;
    function __construct() {        
        parent::__construct(new IModel(), new IView());
		include_once("entities/plane.php");
                include_once("models/PlaneModel.php");
                include_once("modelviews/PlaneModelView.php");
                
                $this->db= new Database();
                $this->db->createFields("planeID", "varchar(40)", "primary key");
                $this->db->createFields("noofseats", "int", "not null");
                $this->db->createFields("desc_note", "text", "");
                $this->db->createFields("name", "varchar(40)","not null");
                $this->db->createFields("status", "int","default 0");
                $this->db->createTable("tbl_plane");
              
                
                $this->modelView= new PlaneModelView();
    }
    
    function Index()
    {
         $this->ViewBag("Title", "Plane");
        return $this->View(null,"Plane","Index");
    }
	
	function Create($name,$seats,$description,$buttonPress)
	{      
		
		 $name=($name=="null")?null:$name;
		 $seats=($seats=="null")?null:$seats;
		 $description=($description=="null")?null:$description;
		 $buttonPress=($buttonPress=="null")?null:$buttonPress;
		 $plane = new Plane();
		 $plane->set($name,$seats,$description);
                  $this->modelView->plane=$plane;
                  
                   $this->modelView->planeModel= new PlaneModel($plane);
                 
                
               
              
		 if($plane->validated())
		 {
			
                        if(! $this->modelView->planeModel->IsExists())
                        {
                           
                             $this->modelView->planeModel->Add();
                           ContextManager::ValidationFor("warning","Successfully added");
                           
                           $this->modelView->plane=null;
                        }  else {
                             ContextManager::ValidationFor("warning","The current plane [$name] name already exists");
                        }
		 } 
                 else {
                     ContextManager::ValidationFor("warning",$plane->getError());
                   }
		 
		
		 return $this->View($this->modelView,"Plane","Index");
	}
        
        
        
        
     function Modify()
     {
        $checks = Request::RequestParams("chkplanes");
        $btnPressedEdit = Request::RequestParams("btnEdit");
        if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            $this->modelView->planeModel= new PlaneModel();
            if(isset($btnPressedEdit))
            {
                //edit only items
               if(sizeof($checks)==1)
               {
                 foreach($checks as $id)
                 {
                      $this->modelView->plane=$this->modelView->planeModel->GetPlaneById($id);                      
                       $this->modelView->plane->mode='edit';
                 }
                
                
               }
            }else 
            {
                foreach($checks as $id)
                 {
                   $this->modelView->planeModel->Delete($id) ;
                 }
               
            }
        }
        
        return $this->View($this->modelView,"Plane","Index");
     }
     
     
     
     function SaveChanges($id,$name,$seats,$description,$buttonPress)
     {
        $id=($id=="null")?null:$id;
        $name=($name=="null")?null:$name;
	$seats=($seats=="null")?null:$seats;
	$description=($description=="null")?null:$description;
	$buttonPress=($buttonPress=="null")?null:$buttonPress;
        
         $plane = new Plane();
	 $plane->set($name,$seats,$description);
         $plane->Id= $id;
         $plane->mode="edit";
         
         $this->modelView->plane=$plane;
         $this->modelView->planeModel= new PlaneModel($plane);
         if($this->modelView->plane->validated())
         {
             $this->modelView->planeModel->Update();
            
         }  else {
             ContextManager::ValidationFor("warning",$this->modelView->plane->getError());
         }
                  
         return $this->View($this->modelView,"plane", "index");
     }
}
