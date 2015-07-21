<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Flights-> <?php echo $this->ViewBag("Title"); ?></title>  
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

            html,body{
                background-color:#fff;
                margin:0px;
                padding:0px;
            }

            div.container-fluid,div.container,div
            {
                overflow:hidden;
                border:0px solid #000;

            }
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

            .table.borderless, div.borderless, span.borderless{
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
                overflow: hidden;
            }
            .warning,warning
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
                width:25%;  
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

            .grid-layout:first-child.row{
                border:1px solid #000;
            }
            .bg_panel
            {   
                overflow: hidden;

                display:block;
                background-color:#eee;
            }
            .bg_panel .form
            {
                margin-left:0px;
                padding-left:0px;
            }

            .inline-fields.button{
                margin:0px 0px 10px 26%;
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
            span.right{
                position:relative;
                padding:0px;
                float:right;
            }

            .table.grid-layout-sm
            {
                font-size:12px;

            }
            .table.grid-layout-sm  tr th,.table.grid-layout-sm  tr th
            {
                font-size:9px;

            }

            .btn.btn-small
            {
                font-size:9px;

            }
            .form-group.inline-fields.checkbox label{
                display:block;
                border:0px solid #000;
                width:100%;
                padding:0px 0px 0px 25%;
            }
            .form-group.inline-fields.checkbox label input[type='checkbox']
            {
                position:relative;
                display:block;   

            }
            div.font-sm1.row{
                font-size:0.8em;
            }

            a.single-link-button.btn{
                margin:10px;
                position:relative;
                right:0px;
            }

            .title.bg-primary
            {
                background-color:#eee;
            }

            div.seperate-form{

                margin:0px 0 10px 0;
                box-shadow:0px 0px 1px #AAA;
                background-color:#fff;
            }

            .grid-layout div.row{
                margin:5px;
            }
            .grid-layout .mark-right{
                border-right:1px solid #aaa;
                display:block;
                overflow:hidden;
                background-color:#5193D6;
            }
            .grid-layout .mark-right > label{
                display:block;
                overflow:hidden;

            }
            div.seperate-form .form
            {
                padding:10px;

            }
            .panel.panel-heading{
                margin:0px;
            }
            div.changeble-main
            {
              
                background-size:cover;
                margin:0px;


            }
            div.changeble-main > div{
                opacity: 0.9;    
                margin-left:10px;

            }
            div.main.container-fluid{
                background-color:#fff;
                border:0px solid #000;
            }

            div.row-fluid > div.cell-right-2 ,div.row > div.cell-right-2{

                float:right;
            }    
        </style>

    </head>
    <body>



        <div class='container-fluid section main'>

            <!-- Header panel-->
            <?php require_once("_header.php") ?>

            <div class='panel panel-body changeble-main'>
                <?php ContextManager::RenderContext() ?>
            </div>

            <div class=''>
                &copy; 2015
            </div>

        </div>



    </body>
</html>