<!DOCTYPE html>
<html xmlns:og="http://ogp.me/ns#">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <title>Dashboard - MTM</title>
        
        <base href="<?= BASE_URL; ?>" />

        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/sb-admin.css" rel="stylesheet">
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
    </head>

    <body>
        <div id="wrapper">
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">SB Admin</a>
                </div>

                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li class="active"><a href="index.html"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                        <li><a href="property"><i class="fa fa-bar-chart-o"></i> Find Me A House</a></li>
                        <li><a href="low"><i class="fa fa-table"></i> Get Cheap Stuff</a></li>
                        <li><a href="watch"><i class="fa fa-desktop"></i> Wait For The Right One</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right navbar-user">
                        <li class="dropdown messages-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> Messages <span class="badge">7</span> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header">7 New Messages</li>
                                <li class="message-preview">
                                    <a href="#">
                                        <span class="avatar"><img src="http://placehold.it/50x50"></span>
                                        <span class="name">John Smith:</span>
                                        <span class="message">Hey there, I wanted to ask you something...</span>
                                        <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li class="message-preview">
                                    <a href="#">
                                        <span class="avatar"><img src="http://placehold.it/50x50"></span>
                                        <span class="name">John Smith:</span>
                                        <span class="message">Hey there, I wanted to ask you something...</span>
                                        <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li class="message-preview">
                                    <a href="#">
                                        <span class="avatar"><img src="http://placehold.it/50x50"></span>
                                        <span class="name">John Smith:</span>
                                        <span class="message">Hey there, I wanted to ask you something...</span>
                                        <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="#">View Inbox <span class="badge">7</span></a></li>
                            </ul>
                        </li>
                        <li class="dropdown alerts-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> Alerts <span class="badge">3</span> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Default <span class="label label-default">Default</span></a></li>
                                <li><a href="#">Primary <span class="label label-primary">Primary</span></a></li>
                                <li><a href="#">Success <span class="label label-success">Success</span></a></li>
                                <li><a href="#">Info <span class="label label-info">Info</span></a></li>
                                <li><a href="#">Warning <span class="label label-warning">Warning</span></a></li>
                                <li><a href="#">Danger <span class="label label-danger">Danger</span></a></li>
                                <li class="divider"></li>
                                <li><a href="#">View All</a></li>
                            </ul>
                        </li>
                        <li class="dropdown user-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li>
                                <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                                <li class="divider"></li>
                                <li><a href="#"><i class="fa fa-power-off"></i> Log Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <div id="page-wrapper">
                <?php include ROOT . '/app/views/' . $view . '.php'; ?>
            </div>

        </div>
        <!-- Bootstrap core JavaScript -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <!-- Page Specific Plugins -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
        <script src="js/morris/chart-data-morris.js"></script>
        <script src="js/tablesorter/jquery.tablesorter.js"></script>
        <script src="js/tablesorter/tables.js"></script>
    </body>
</html>