<?php

class PlaneModel extends IModel {

    //put your code here
    private $plane = null;
    private $db = null;

    function __construct(Plane $plane = null) {

        $this->plane = $plane;
        $this->db = new Database();
    }

    public function IsExists() {
        if ($this->db != null) {
            $query = "select *from tbl_plane where name=:name ";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(":name", strtolower(trim($this->plane->name)));

            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return true;
            }
        }

        return false;
    }

    public function IsIDExists($id) {
        if ($this->db != null) {
            $query = "select *from tbl_plane where name=:id or planeID=:id ";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(":id", strtolower(trim($id)));

            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return true;
            }
        }

        return false;
    }

    public function Add() {

        if ($this->plane != null && $this->plane->validated()) {
            $query = "Insert into tbl_plane (planeID,noofseats,desc_note,name)"
                    . "values(:planeID,:noofseats,:desc,:name)";
            $stmt = $this->db->prepare($query);

            $stmt->bindValue(":planeID", trim($this->plane->Id));
            $stmt->bindValue(":noofseats", trim($this->plane->seats));
            $stmt->bindValue(":desc", trim($this->plane->desc));
            $stmt->bindValue(":name", strtolower(trim($this->plane->name)));

            $stmt->execute();


            if ($stmt->rowCount() > 0) {
                return true;
            }
        }

        return false;
    }

    public function GetAllPlanes($name = '') {
        $arr = new ArrayIterator();
        if ($this->db != null) {


            $query = "select *from tbl_plane order by name";
            if ($name != "" && $name != null) {
                $query = "select *from tbl_plane where name ='$name' order by name";
            }
            $stmt = $this->db->prepare($query);

            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
                    $plane = new Plane();
                    $plane->Id = $row["planeID"];
                    $plane->desc = $row["desc_note"];
                    $plane->seats = $row["noofseats"];
                    $plane->name = $row["name"];
                    $arr->append($plane);
                }
            }
        }

        return $arr;
    }

    function GetPlaneById($id) {
        $plane = new Plane();
        if ($this->IsIDExists($id)) {
            $query = "select *from tbl_plane where name=:id or planeID=:id ";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(":id", strtolower(trim($id)));
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $plane->Id = $row["planeID"];
            $plane->desc = $row["desc_note"];
            $plane->name = $row["name"];
            $plane->seats = $row["noofseats"];
        }
        return $plane;
    }

    function Update() {
        if ($this->plane != null) {
            $query = "update tbl_plane set  name=:name,desc_note=:desc_note,noofseats=:noofseats "
                    . " where planeID=:id ";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(":name", strtolower(trim($this->plane->name)));
            $stmt->bindValue(":desc_note", strtolower(trim($this->plane->desc)));
            $stmt->bindValue(":noofseats", strtolower(trim($this->plane->seats)));
            $stmt->bindValue(":id", strtolower(trim($this->plane->Id)));
            $stmt->execute();

            print_r($stmt->errorInfo());
            if ($stmt->rowCount() > 0) {
                return true;
            }
        }

        return false;
    }

    function Delete($id) {
        if ($this->IsIDExists($id)) {
            $query = "delete from tbl_plane where name=:id or planeID=:id ";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(":id", strtolower(trim($id)));
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return true;
            }
        }

        return false;
    }

    function GetName($id) {
        if ($this->IsIDExists($id)) {
            $query = "select *from tbl_plane where planeID=:id ";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(":id", trim($id));
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return $row["name"];
            }
        }
        return "...";
    }

    function getHighestPrice($id) {
        if ($this->IsIDExists($id)) {
            $query = "select max(price) as maxprice from tbl_seat where planeID=:id ";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(":id", trim($id));
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return $row["maxprice"];
            }
        }
        return "...";
    }

    function getLowerPrice($id) {
        if ($this->IsIDExists($id)) {
            $query = "select min(price) as minprice from tbl_seat where planeID=:id ";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(":id", trim($id));
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return $row["minprice"];
            }
        }
        return "...";
    }

}
