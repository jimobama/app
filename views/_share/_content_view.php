<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flights-> <?php echo  $this->ViewBag("Title"); ?></title>  
      <link href="styles/jquery-ui/jquery-ui.css" rel="stylesheet" type="text/css" /> 
      <link href="styles/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css" />
     <link href="styles/bootstrap.css" rel="stylesheet" type="text/css" /> 
     <link href="styles/bootstrap.min.css" rel="stylesheet" type="text/css" />       
     
    <script src="scripts/lib/jquery.js"></script>
    <script src="scripts/lib/jquery-1.10.2.min.js"></script>
    <script src="scripts/lib/bootstrap.min.js"></script>
     <script src="styles/jquery-ui/jquery-ui.js"></script>
     <script src="styles/jquery-ui/jquery-ui.min.js"></script>
      <link href="styles/site.css" rel="stylesheet" type="text/css" /> 
     
    
     <style>
         .top-header{
             background-color:#ac2925;
             border-radius:0px;
             color:#000;
         }
          .top-header ul li a
          {
              color:#EFEFEF;
          }
          .top-header ul li a:hover{
              background-color:#ac2925;
              
          }
         .top-search-listitem
         {
            
         }
         .top-search-listitem input,.top-search-listitem button{
             border:0px ;
         }
        .top-header .top-search-listitem .top-search
         {
             width:350px;
             
              
         }
         
 .form-wrapper
{
	width:50%;
	margin:10px auto;
}

.table.borderless{
    border:0px;
}
.table.borderless th,.table.borderless td{
    border:0px;
}
.form-5-sm.form-wrapper 
{
    width:75%;
}

.form-4-sm.form-wrapper 
{
    width:35%;
}
.form-3-sm.form-wrapper 
{
    width:25%;
}

.title{
    padding:10px;
    margin-bottom:10px;
    border-bottom:1px solid #5193D6;
}
.warning
{
    font-size:12px;
    display:block;
    color:#D15E5E;
    text-align:center;
    font-style:italic;
}

.small-nav
{
    font-size:0.82em;
}
.nav-list.btn-primary:hover
{
    color:black;
}
.nav-list.btn-warning:hover{
    color:red;
}
   
     
.inline-fields{
   display:block;  
  margin:1px;
  padding:1px;
}

.inline-fields label
{
   float:left;  
   margin:0px 3px 0px 10px;
   padding:1px;

   
}

.inline-fields label:first-child 
{
   float:left;
   width:122px;  
   padding:1px;
 
}

.inline-fields.sm-1 > input, .inline-fields.sm-1 > select ,.inline-fields.sm-1 > textarea {
    
    float:left;
    width:66.5%;
}

.inline-fields.sm-2 > input, .inline-fields.sm-2 > select, .inline-fields.sm-2 > textarea {
    
    float:left;
    width:20%;
}

.form .date-control{
    padding:1px;
    display:block;
}
.form .date-control > input[type='text'],.form .date-control > select
{
    margin:0px 15px  0px 0px  ;
}

.search-panel
{   
    overflow: hidden;
    
    display:block;
    margin:0px 0px 0px 10px;
    background-color:#eee;
}
.search-panel .form
{
 margin-left:0px;
 padding-left:0px;
}

.inline-fields.button{
    margin:0px 0px 10px 120px;
}


.inline-fields .text-sm-1
{
    width:100px;
    border:1px solid #000;
}

.title.border-sm-1
{
  
   margin-bottom:10px;
}

.table.ob-table{
    
    border:1px solid 000;
}
.panel-body{
    border:0px;
}
.panel-footer.footer-ob{
    background-color:#EFEFEF;
    border-radius:0px;
    height:200px;
}
.wrapper-with-border
{
    border:1px solid #eee;
    padding:1px;
}
 </style>
         
</head>
<body>
 


    
    <div class='container-fluid'>
       
        <!-- Header panel-->
       <?php require_once("_header.php") ?>
        
        <div class='panel panel-body'>
           <?php ContextManager::RenderContext() ?>
        </div>
        <div class='panel panel-footer footer-ob'>
            
        </div>
        
    </div>
        
        

</body>
</html>