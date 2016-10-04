<?php 

require("common.php");


// Create connection
$conn = new mysqli($host, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    
    die("Sorry, there was an error. Please try again.");
} 

     
?> 

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>My Museum</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <link rel="shortcut icon" href="assets/myIcon6.png">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="assets/myIcon6.png" />


    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lobster|Comfortaa|Amatic+SC|Coming+Soon|Architects+Daughter' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

</head>

<body style="background-color: #efefef;">
    <div id="page-loader"><span class="page-loader-gif">Loading...</span></div>

<nav class="navbar navbar-default navbar-fixed-top mainPc" style="border-color: darkgrey;">
    <div class="container">
        <div class="two" style="margin-top: -8px;">
            <table>
                <tr>
                    <td><h4><img src="assets/myIcon7.png" style="margin: 3px 3px; width: 55px; height 55px; padding-top:5px; padding-right:6px;"></h4></td>
                    <td><h4><span style="font-size: 35px;">mymuseum</span></h4></td>
                </tr>
            </table>
        </div>
        
        <div class="navbar-inner form-group">
            <div class="container"><!-- Collapsable nav bar -->
                <div class="one">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"></a>
                <!-- Start of the nav bar content -->
                <div class="nav-collapse"><!-- Other nav bar content -->
                    <table>
                        <tr class="nav">
                            
                            <td>
                                <form action="private.php">
                                <td><input type="submit" class="btn btn-default btn-file" value="Back to My Museum"></td>
                            </form>
                            </td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>

                            <?php include 'visitFriendsDropdown.php';?>
                           
                        

                            

                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td> Hello <?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?>!</td>
                            <td>&nbsp;</td>
                            <form action="logout.php">
                                <td><input type="submit" class="btn btn-default btn-file" value="Logout"></td>
                            </form>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td class="dropdown">
                                <!-- Drop down menu -->
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="fa fa-cog"></i></a>
                                <div class="dropdown-menu dropdown-menu-right" style="padding: 15px;">
                                        <table align="center">
                                            <tr>
                                                <td><a href="edit_account.php">Edit Account</a><br /></td>
                                            </tr>
                                        </table>
                                        
                                </div>        
                            </td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>|</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                                <?php include 'notifications.php';?>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                </div>
                </div>
            </div>
        </div>
        
        <!--<div class="form-group one">
            <table>
                <br>
                <tr>
                    <form action="SQLWrite.php" method="post" enctype="multipart/form-data"/>        
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><input type="text" id="Title" class="form-control" name="Title" placeholder="Artifact Name" /></td>
                        <td>&nbsp;</td>
                        <td><textarea type="text" rows="1" class="form-control" name="About" placeholder="About" /></textarea></td>
                        <td>&nbsp;</td>
                        <td><span class="btn btn-default btn-file">Get Photo<input name="Photo" accept="image/jpeg" type="file" /></span></td>
                        <td>&nbsp;</td>
                        <td><input type="submit" class="btn btn-default btn-file" value="Add"></td>
                        <td>&nbsp;</td>
                        <td>| |</td>
                        <td>&nbsp;</td>
                            
                    </form>
                    <form action="logout.php">
                        <td><input type="submit" class="btn btn-default btn-file" value="Logout"></td>
                    </form>
                </tr>
            </table>
        </div>-->
    </div>
</nav>

<nav class="navbar navbar-default navbar-fixed-top mainMobile">
    
    <div class="container">

        <div class="text-center">
           <table align="center">
                <tr>
                    <td><h4>my museum</h4></td>
                    <?php include 'notifications.php';?>
                </tr>
            </table>
                
        <br>
        </div>
    </div>
        
    </div>


</nav>

<nav class="navbar navbar-default navbar-fixed-bottom mainMobile">
    <div class="nav navbar-nav" style="margin: 10px 5px;">
        <div class="container text-center">
            <div class="row">
                <div class="col-xs-3"><a href="private.php" style="color: grey;"><i class="fa fa-university fa-2x"></i></a></div>
                <div class="col-xs-3"><a href="memberlist.php" style="color: grey;"><i class="fa fa-search fa-2x"></i></a></div>
                <div class="col-xs-3"><a href="visitFriendsDropdownMobile.php" style="color: grey;"><i class="fa fa-ticket fa-2x"></i></a></div>
                <div class="col-xs-3"><a href="accountSettingsMobile.php" style="color: red;"><i class="fa fa-gear fa-2x"></i></a></div>
            </div>
        </div>   
    </div>
</nav>

<br class="mainPc">

<!--Shell editable inside these lines-->
<div class="col-lg-6 col-lg-offset-3">
<h3>privacy and terms</h3>
<br><br>

<p style="font-family: sans-serif;">Everything you curate, every picture and every description, can only be seen by you. If you choose, you may share your museum
    with others by requesting a ticket exchange with friends. If that friend accepts the exchange and gives you a ticket to visit
    their museum, they will also be given a ticket to your museum as well. At any time after this exchange, you may revoke their
    access to your museum and, in turn, your access to their's.</p>

<br>
<p style="font-family: sans-serif;">At no time will MyMuseum ever share your email or personal information with anyone. Any information required for signing up
    is deemed necessary for the use of the app. Additionally, on creation, login credentials are encrypted and stored with
    military-grade encryption protocols...not even MyMuseum is able to see them. If you forget your password, you will receive
    a unique link to reset it.</p>

<br>
<p style="font-family: sans-serif;">By using this site, you accept that, at anytime, MyMuseum may discontinue its service. If that happens, you will no longer have
    access to the app or your or your friends' museums. You will receive notice, by email, not less than 30 days prior to this
    happening, if it ever does. Additionally, until out of beta release, this app may contain bugs that produce results contrary to expected performance.
    By using this site, you are aware of this and acknowledge these bugs may affect your user-experience.<p>


</div>

<div class="clearfix"></div>
<br>

<div class="text-center">
<a href="private.php"><button class="btn btn-default btn-success" style="border: 1px solid lightgrey;width: 160px;">Back</button></a>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<!--Shell editable inside these lines-->


</body>
</html>

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.3.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/main.js"></script>
    <script src="js/masonry-docs.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/sweetalert.min.js"></script>


    <script>
  $(function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
  });
  </script>

</body>

</html> 