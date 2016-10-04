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
<h3>release notes</h3>
<br><br>
<p style="font-family: sans-serif;"><strong>Verison:</strong> 1.2.0 Beta</p>
<p style="font-family: sans-serif;"><strong>Notes:</strong> This is the open beta of MyMuseum. The following are some of the things I am aware of and working to fix:</p>
<br>
<ul> <strong>Bugs</strong>
    <li>Occasionally, pictures downloaded from the internet do not upload (i.e. Google, Dropbox, etc). I have yet to find a reason for this, but it is the primary fix I am working on. Pictures taken locally with your phone or computer DO upload properly, though. So, until I figure this bug out, I would recommend taking pictures of your artifacts directly with your phone or computer and curating from that source to guarantee the pictures upload properly.</li>
    <li>Museums with a large number of artifacts may take a few seconds to load. I am working on image compression to decrease that load time.</li>
    <li>While this isn't a bug, it is a known issue...I am hosting this app on a shared server, and sometimes, if traffic is busy on that server, the app can hang when loading or uploading. I am exploring alternate options to resolve this (see last note).</li>
    <li>When you use Facebook's browser to access this app, photos cannot be taken and added from your camera...only from your gallery.</li>
</ul>
<ul>
    <strong>Needed Features</strong>
    <li>Adding the ability to search for museums to request tickets rather than just seeing a list of every museum available.</li>
    <li>Adding the ability for a museum to have a profile picture.</li>
    <li>Adding the ability to invite friends to curate their own museums with MyMuseum.</li>
    <li>Adding the ability to sort your artifacts in your museum.</li>
</ul>

<br>
<br>
<p style="font-family: sans-serif;"><strong>A very special "thank you!" to:</strong> Ed K. and Laura R.</p>

</div>

<div class="clearfix"></div>
<br>
<div class="text-center" style="margin-bottom: 5px;">
    Find another bug<br>or have a question?
    <br>
</div>
<div class="text-center">
<a href="http://www.codingerik.com/#contact" target="blank"><button class="btn btn-default btn-success" style="border: 1px solid lightgrey;width: 160px;">Contact Me</button></a>
</div>
<br>







<hr style="border: 0;
  clear:both;
  display:block;
  width: 200px;               
  background-color:lightgrey;
  height: 1px;
  ">
  <br>
<div class="text-center">
<a href="#about" class="exhibit-link" data-toggle="modal" style="text-decoration: none; color: whitesmoke;"><button class="btn btn-default btn-info" style="width: 160px;">
           What is this, again?
        </button></a>
</div>

<div class="exhibit-modal modal fade" id="about" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content" style="margin-top: -100px;">

            
            <div class="container">
               
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <div class="close-modal text-right" data-dismiss="modal"> 
                                <i class="fa fa-times"></i>
                            </div>
                            <br>
                            <h3>what is this?</h3>
                            <br>
                            <br>
                            <p style="font-family: sans-serif; text-align: left;">Remember as a kid when you would find something really cool? ...a rock...a bug...a small toy...
                                but to you, this "something" was worth more than <i>anything</i>. 
                                To keep it safe and available for future viewing, you'd bring it home 
                                and place it in a special treasure chest reserved only for those things most important to you... 
                                and, in essence, curated your own mini museum of curiosities.</p>

                            <p style="font-family: sans-serif; text-align: left;">As adults, we still have treasure chests filled with our most prized possessions. 
                                Completely worthless to others, these intrinsic-valued items are worth more to us than gold...
                                family heirlooms, personal memories, things our children have made...and while each of these items 
                                are safe in our homes, sometimes we'd like to have access to them all the time.</p>

                            <p style="font-family: sans-serif; text-align: left;">With this web app, it is a hope to allow you to have access to those treasures all the time. Use it
                                to create a museum. A museum of the pictures and descriptions of all those items you hold 
                                most dear. And unlike your physical musem, this one can be visited anytime...by you and others!</p>

                            <br>
                            <p style="font-family: sans-serif; text-align: left;">This is an online curation of that museum...YOUR Museum.</p>
                            <br>
                            <button type="button" class="btn btn-lg btn-default btn-file btn-info" data-dismiss="modal" style="border: 1px solid lightgrey;">Cool!</button>
                            <br><br>
                        </div>
                    </div>
          
            </div>
        </div>
</div>

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