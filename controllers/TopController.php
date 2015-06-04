<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TopController
 *
 * @author Obaro
 */
class TopController extends IController {
    //put your code here
    
    private $db=null;
    
    function __construct() {
        $this->db= new Database();
        $this->db->createFields("agentID", "varchar(40)", "primary key");
         $this->db->createFields("amount", "varchar(40)", "default 0.0");
         $this->db->createFields("date_make", "varchar(40)", "not null");
         $this->db->createFields("last_payment", "varchar(40)", "");
         $this->db->createFields("status","int","");         
         $this->db->createTable("tbl_topdetails");
    }
    
    function Index()
    {
        return $this->View(null, "Home", "Index");
    }
}
