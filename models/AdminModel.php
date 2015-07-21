<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminModel
 *
 * @author Obaro
 */
class AdminModel extends IModel {

    private $__db = null;

    function __construct(Database $db = null) {
        if ($db == null) {
            $this->__db = new Database();
        }
        $this->__db = $db;
    }

    //put your code here#

    function assigned($newAdminID, $assignerID, $level = 2, $status = 1) {
        if ($this->__db == null)
            return false;
        $okay = false;
        if ($this->isAdmin($assignerID)) {


            $query = "Insert into tbl_admin (id,assigner_id,level,date_assigned,status)"
                    . "Values(:id,:assigner_id,:level,:date_assigned,:status)";

            $stmt = $this->__db->prepare($query);
            $stmt->bindValue(":id", $newAdminID);
            $stmt->bindValue(":assigner_id", $assignerID);
            $stmt->bindValue(":level", $level);
            $stmt->bindValue(":date_assigned", time());
            $stmt->bindValue(":status", $status);

            $rtv = $stmt->execute();
            if (!$rtv) {
                print_r($stmt->errorInfo());
            }
            if ($stmt->rowCount() > 0) {
                $okay = true;
            }
        } else {
            $this->setError("You cannot assigned another administrator an administrator privillages");
        }
        return $okay;
    }

    function isAdmin($id) {
        $okay = false;
        if ($this->__db != null) {

            $query = "Select id from tbl_admin where id=':id' and status > 1";
            $stmt = $this->__db->prepare($query);
            $stmt->bindValue(":id", $id);
            $rtv = $stmt->execute();
            if (!$rtv) {
                print_r($stmt->errorInfo());
            }
            if ($stmt->rowCount() > 0) {
                $okay = true;
            }
        }
        return $okay;
    }

    function demote($id, $level = 0) {
        $okay = false;
        if ($this->__db != null) {

            $query = "update tbl_admin set status=':status' (where id=':id' and status > 1)";
            $stmt = $this->__db->prepare($query);
            $stmt->bindValue(":id", $id);
            $rtv = $stmt->execute();
            if (!$rtv) {
                print_r($stmt->errorInfo());
            }
            if ($stmt->rowCount() > 0) {
                $okay = true;
            }
        }
        return $okay;
    }

}
