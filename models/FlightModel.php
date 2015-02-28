<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FlightModel
 *
 * @author Obaro
 */
class FlightModel extends IModel {
    //put your code here
    private $flight=null;
    private $db=null;
    private $error=null;
    function __construct(Flight $flight=null) {
        parent::__construct();
        $this->flight=$flight;
        $this->db= new Database();
    }
    
    public function Rollback($id=null)
    {
        
    }
    
    
  public function AddFlight()
    {
        if($this->flight !=null && $this->flight->validate())
        {
            if($this->db !=null)
            {
                //add the flight to database
                $query = "insert into tbl_flight (from_where,to_where,landingDate,BoardDate,LandingTime,BoardingTime,noofstop,price,id,seats)"
                        . "Values(:from,:to,:landingDate,:BoardDate,:LandingTime,:BoardingTime,:noofstop,:price,:id,:seats)";
      
                
                $stmt= $this->db->prepare($query);
                $stmt->bindValue(":id", $this->flight->Id);
                $stmt->bindValue(":from", $this->flight->from);
                $stmt->bindValue(":to", $this->flight->to);
                $stmt->bindValue(":landingDate", $this->flight->landindDate);
                $stmt->bindValue(":BoardDate", $this->flight->deptureDate);
                $stmt->bindValue(":LandingTime", $this->flight->Landingtime);
                $stmt->bindValue(":BoardingTime", $this->flight->boardingTime);
                 $stmt->bindValue(":noofstop", $this->flight->stops);
                $stmt->bindValue(":price", $this->flight->ticketPrice);
               $stmt->bindValue(":seats", $this->flight->seats);
                try
                {
                    $stmt->execute();
                   
                    if($stmt->rowCount() > 0)
                    {     
                        return $this->flight->Id;
                    }
                    
                      
                }
                catch(PDOException $err)
                {
                  
                    $this->error = $err->getMessage();
                }
            }
        }
        
        return null;
    }
   
    
    
    //Check if the current flight exist
    
   public function isExists($from,$to,$depaturetime)
    {
       if($this->db !=null) 
       {
           
           $query="select *from tbl_flight where from_where=:from and to_where=:to and BoardingTime=:boardtime";
           $stmt= $this->db->prepare($query);
           $stmt->bindValue(":from",$from);
           $stmt->bindValue(":to",$to);
           $stmt->bindValue(":boardtime",$depaturetime);
           
           $stmt->execute();
        
           if($stmt->rowCount()>0)
           {
               return true;
           }
       }
       return false;
    }
    
   function  GetAllFlights()
    {
        
       if($this->db !=null)
            {
             $query = "select * from tbl_flight  where  id !='null'";
             $stmt= $this->db->prepare($query);                    
             $stmt->execute(); 
            
             
           $arry= new ArrayIterator();
           $counter=0;
           while($row = $stmt->fetch(PDO::FETCH_BOTH))
             {
                            
              
               $flight = new Flight();
              $flight->Id=$row["id"];
              $flight->Landingtime=$row["LandingTime"];              
              $flight->boardingTime= $row["BoardingTime"];
              $flight->deptureDate= $row["BoardDate"];
              $flight->from=$row["from_where"];
              $flight->landindDate=$row["landingDate"]; 
              $flight->stops=$row["noofstop"];
              $flight->ticketPrice=$row["price"];
              $flight->to=$row["to_where"];
              $flight->seats=$row["seats"]; 
             $flight->status=$row["status"]; 
              $arry->offsetSet($counter,$flight);
             $counter++;
                          
             }
           
             return $arry;
            
            }
      
        
         return null;
    }
    
    
    public function GetFlightById($indexID)
    {
        if($this->db !=null)
        {
             $query = "select * from tbl_flight  where  id= :id";
             $stmt= $this->db->prepare($query);   
             $stmt->bindValue(":id", $indexID);
             $stmt->execute(); 
             
             if($stmt->rowCount()>0)
             {
                 $row= $stmt->fetch(PDO::FETCH_ASSOC);
                 $flight= new Flight();
                  $flight->Id=$row["id"];
                  $flight->Landingtime=$row["LandingTime"];              
                  $flight->boardingTime= $row["BoardingTime"];
                  $flight->deptureDate= $row["BoardDate"];
                  $flight->from=$row["from_where"];
                  $flight->landindDate=$row["landingDate"]; 
                  $flight->stops=$row["noofstop"];
                  $flight->ticketPrice=$row["price"];
                  $flight->to=$row["to_where"];
                  $flight->seats=$row["seats"]; 
                 $flight->status=$row["status"]; 
                 
                 return $flight;
                 
             }
        }
        
        return null;
    }
    
    
    public function DeleteFlight($flightID)
    {
        $flightID= trim($flightID);
       
        if($this->IsExistId($flightID))
        {
           
            $query= "delete from tbl_flight where id =:id";
            $stmt= $this->db->prepare($query);
            $stmt->bindValue(":id", $flightID);
            $stmt->execute();
        }
    }
    
    public function IsExistId($flightID)
    {
       $flightID= trim($flightID);
        if($this->db !=null)
        {
            $query= "select * from tbl_flight  where  id= :id";
            $stmt= $this->db->prepare($query);
            $stmt->bindValue(":id", $flightID);
            $stmt->execute();           
            if($stmt->rowCount()>0)
            {
                return true;
            }
        }
        
        return false;
    }
    
    public function UpdateFlight($id,Flight $flight)
    {
        if($this->IsExistId($id))
        {
            $query ="update tbl_flight set id=:id , from_where =:from , to_where =:to, landingDate =:landingDate,"
                    . "BoardDate =:BoardDate, LandingTime=:LandingTime,	BoardingTime=:BoardingTime,noofstop=:noofstop,	price=:price";
                   
            
            $stmt= $this->db->prepare($query);
            $stmt->bindValue(":id",$flight->Id);
            $stmt->bindValue(":from",$flight->from);
            $stmt->bindValue(":to",$flight->to);
             $stmt->bindValue(":landingDate",$flight->landindDate);
             $stmt->bindValue(":BoardDate",$flight->deptureDate);
             $stmt->bindValue(":LandingTime",$flight->Landingtime);
             $stmt->bindValue(":BoardingTime",$flight->boardingTime);
             $stmt->bindValue(":noofstop",$flight->stops);
             $stmt->bindValue(":price",$flight->ticketPrice);
             
             $stmt->execute();
             if($stmt->rowCount()>0)
             {
                 return true;
             }
        }
        
        return false;
    }
    
    
    function GetAllDistinctFlights()
    {
         if($this->db !=null)
            {
             $query = "select *  from tbl_flight  where  id !='null' group by from_where,to_where";
             $stmt= $this->db->prepare($query);                    
             $stmt->execute(); 
            
             
           $arry= new ArrayIterator();
           $counter=0;
           while($row = $stmt->fetch(PDO::FETCH_BOTH))
             {
                            
              
               $flight = new Flight();
              $flight->Id=$row["id"];
              $flight->Landingtime=$row["LandingTime"];              
              $flight->boardingTime= $row["BoardingTime"];
              $flight->deptureDate= $row["BoardDate"];
              $flight->from=$row["from_where"];
              $flight->landindDate=$row["landingDate"]; 
              $flight->stops=$row["noofstop"];
              $flight->ticketPrice=$row["price"];
              $flight->to=$row["to_where"];
              $flight->seats=$row["seats"]; 
             $flight->status=$row["status"]; 
              $arry->offsetSet($counter,$flight);
             $counter++;
                          
             }
           
             return $arry;
            
            }
      
        
         return null;
    }
    public function GetError()
    {
        return $this->error;
    }
}
