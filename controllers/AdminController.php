<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminController
 *
 * @author Obaro
 */
class AdminController extends IController {

    //put your code here

    protected $model = null;
    private $viewmodel = null;
    private $db = null;

    public function __construct(\IModel $amodel, \IView $aview) {
        parent::__construct($amodel, $aview);
        require_once("models/AdminModel.php");
        require_once("modelviews/AdminModelView.php");
        $this->model = new AdminModel();
        $this->viewmodel = new AdminModelView();
        $this->db = new Database();
        //check if this person is an administrator from level 3 upwards
        $this->createAdministrator();
    }

    private function createAdministrator() {
        $this->db->createFields("id", "varchar(40)", "not null primary key");
        $this->db->createFields("level", "int", "not null");
        $this->db->createFields("assigner_id", "varchar(40)", "not null");
        $this->db->createFields("date_assigned", "varchar(50)", "not null");
        $this->db->createFields("status", "int", "default 0");
        $this->db->createTable("tbl_admin");
    }

}
