<?php

//Host details
define ("HOST_NAME","http://localhost/Flights/");
//SMTP SERVER INFORMATIONS
define ("SMTP_HOST","smtp.gmail.com");
define ("SMTP_PASSORD","123456php");
define ("SMTP_EMAIL_ACCOUNT","phpticket123@gmail.com");
define ("SMTP_PORT",587);


define("DEFAULT_LOAD_CONTROLLER", "Home");
define("DEFAULT_ACTION","Index");
define ("URL","?url");
//View constants
define ("VIEW","views/");
define("DEFAULT_TEMPLATE",VIEW."_share/_content_view.php");
define("DEFAULT_ERROR_VIEW",VIEW."_share/_error.php");

//Controllers

define ("CONTROLLER_PATH","controllers/");
define ("CONTROLLER_SUFIX","Controller");

//Barcode store locations;
define("BARCODE_PATH","Images/barcodes/");