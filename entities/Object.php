<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TObjects
 *
 * @author jimobama
 * what to make such that all my objects have the following methods
 */
abstract class Object {

    private $error = "";

    abstract function __construct();

    function __destruct() {
        
    }

    function toString() {
        return "";
    }

    protected function setError($err) {
        if (trim($err) == "")
            return null;
        $this->error = $err;
    }

    public function getError() {
        return $this->error;
    }

    abstract function validated();
}

?>
