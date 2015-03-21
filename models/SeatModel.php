<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SeatModel
 *
 * @author Obaro
 */
class SeatModel {
    //put your code here
    
  private  $seat=null;
  private $db=null;
    function __construct(Seat $seat=null) {
     $this->seat = $seat;  
     $this->db= new Database();
    }
    
    
    function IsExists()
    {
        if($this->db !=null && $this->seat !=null)
        {
            $query = "select *from tbl_seat where (seatID=:id OR seatNo=:number) and planeID=:planeId";
            $stmt= $this->db->prepare($query);
            $stmt->bindValue(":id",$this->seat->id);
             $stmt->bindValue(":number",$this->seat->seatNo);
             $stmt->bindValue(":planeId",$this->seat->planeID);
            $status= $stmt->execute();
            if(!$status){
                print_r($stmt->errorInfo());
            }
            if($stmt->rowCount()>0)
            {
                return true;
            }
           
        }
        
        return false;
    }
    
    
    function Add()
    {
       if($this->db !=null && $this->seat !=null)
        {
            $query = "insert into tbl_seat (planeID,seatNo,type,price,desc_note,seatID)"
                    . "values(:planeID,:seatNo,:type,:price,:desc,:seatID)";
            $stmt= $this->db->prepare($query);
            $stmt->bindValue(":planeID",$this->seat->planeID );  
            $stmt->bindValue(":seatNo",$this->seat->seatNo );  
            $stmt->bindValue(":type",$this->seat->type);  
            $stmt->bindValue(":price",$this->seat->rate );  
            $stmt->bindValue(":desc",$this->seat->desc );  
            $stmt->bindValue(":seatID",$this->seat->id );  
            
            $stmt->execute();
            
            //print_r($stmt->errorInfo());
            if($stmt->rowCount()>0)
            {
                return true;
            }
            
        }
      return false;   
    }
    
    
   function All()
   {
       $arr= new ArrayIterator();
      if($this->db !=null)
        { 
           $query = "select *from tbl_seat ";
           $stmt= $this->db->prepare($query);
           $stmt->execute();
            if($stmt->rowCount()>0)
            {
                while($row= $stmt->fetch(PDO::FETCH_ASSOC))
                {
                  //get all the rows
                    $seat = new Seat();
                    $seat->desc= $row["desc_note"];
                    $seat->id= $row["seatID"];
                    $seat->planeID= $row["planeID"];
                    $seat->rate= $row["price"];
                    $seat->seatNo= $row["seatNo"];
                    $seat->type= $row["type"];
                    $arr->append($seat);
                      
                }
            }
                   
        }
        
        return $arr;
  }
   
   function IsIdExists($id)
    {
        if($this->db !=null )
        {
            $query = "select *from tbl_seat where seatID=:id ";
            $stmt= $this->db->prepare($query);
            $stmt->bindValue(":id",trim($id));
             
            $stmt->execute();
            if($stmt->rowCount()>0)
            {
                return true;
            }
           
        }
        
        return false;
    }
    
  function Delete($id)
  {
     if($this->IsIdExists($id))
      {
          
      $query = "delete from tbl_seat where seatID=:id ";  
      $stmt= $this->db->prepare($query);
      $stmt->bindValue(":id",trim($id));
      $stmt->execute();
             
      }
  }
  
  
  function Get($id)
  {
       $seat=new Seat();
      if($this->IsIdExists($id))
       {
       
      $query = "select *from tbl_seat where seatID=:id ";  
      $stmt= $this->db->prepare($query);
      $stmt->bindValue(":id",trim($id));
      $stmt->execute();
     
        if($stmt->rowCount()>0)
        {
           $row = $stmt->fetch(PDO::FETCH_ASSOC); 
            $seat->desc= $row["desc_note"];
             $seat->id= $row["seatID"];
        $seat->planeID= $row["planeID"];
        $seat->rate= $row["price"];       
        $seat->seatNo= $row["seatNo"]; 
        $seat->type= $row["type"]; 
        }
       
       
       
       }
      
      return $seat;
  }
 
}
