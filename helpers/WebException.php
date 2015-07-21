<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WebException
 *
 * @author jimobama
 */
class WebException extends Exception {

    public function __construct($message, $code, $previous) {
        parent::__construct($message, $code, $previous);
    }

}

?>
