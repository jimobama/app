<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Flights</title>
        <meta name="description" content="description">
        <meta name="author" content="DevOOPS">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="styles/bootstrap.css" rel="stylesheet" type="text/css" /> 
        <link href="styles/bootstrap.min.css" rel="stylesheet" type="text/css" /> 
        <link href="styles/jquery-ui/jquery-ui.min.css" rel="stylesheet">		

        <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>                

        <link href="styles/style.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                        <script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
                        <script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!--Start Header-->
        <div id="screensaver">
            <canvas id="canvas"></canvas>
            <i class="fa fa-lock" id="screen_unlock"></i>
        </div>
        <div id="modalbox">
            <div class="devoops-modal">
                <div class="devoops-modal-header">
                    <div class="modal-header-name">
                        <span>Basic table</span>
                    </div>
                    <div class="box-icons">
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="devoops-modal-inner">
                </div>
                <div class="devoops-modal-bottom">
                </div>
            </div>
        </div>
        <header class="navbar">
            <div class="container-fluid expanded-panel">
                <div class="row">
                    <div id="logo" class="col-xs-12 col-sm-2">

                    </div>
                    <div id="top-panel" class="col-xs-12 col-sm-10">
                        <div class="row">
                            <div class="col-xs-8 col-sm-4">
                                <a href="#" class="show-sidebar">
                                    <i class="fa fa-bars"></i>
                                </a>
                                <div id="search">
                                    <input type="text" placeholder="search"/>
                                    <i class="fa fa-search"></i>
                                </div>
                            </div>

                            <?php require_once("menu.php") ?>

                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!--End Header-->
        <!--Start Container-->
        <div id="main" class="container-fluid">
            <?php ContextManager::RenderContext() ?>
        </div>

        <script src="scripts/devoops.js"></script>

    </body>
</html>
