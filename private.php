<?php 

    require("common.php"); 
     
   
    if(empty($_SESSION['user'])) 
    { 
        
        header("Location: index.php"); 
         
        
        die("Redirecting to index.php"); 
    } 

$query = " 
        SELECT 
            id, 
            username, 
             
            isFriendsWith,
            friendRequestFrom
        FROM users 
    "; 
$link = mysql_connect($host, $username, $password);
mysql_select_db($dbname);
$sql = "SELECT * FROM Users WHERE id='".$_SESSION['userid']."' ";
$result = mysql_query("$sql");

$link = mysql_connect($host, $username, $password);
mysql_select_db($dbname);
$sql = "SELECT COUNT(friendRequestFrom) FROM Users WHERE id='".$_SESSION['userid']."' ";
$notifyCount = mysql_query("$sql");
     
    try 
    { 
        // These two statements run the query against your database table. 
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) 
    { 
        // Note: On a production website, you should not output $ex->getMessage(). 
        // It may provide an attacker with helpful information about your code.  
       die("Failed to run query: Please click Back Button"); 
    } 
         
    // Finally, we can retrieve all of the found rows into an array using fetchAll 
    $rows = $stmt->fetchAll(); 
    
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
                                <a class="btn btn-default btn-file" href="memberlist.php">Find Museums</a>
                            </td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>

                            <?php include 'visitFriendsDropdown.php';?>
                           
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>

                            <td class="dropdown">
                                <!-- Drop down menu -->
                                <a class="dropdown-toggle btn btn-default btn-file" href="#" data-toggle="dropdown">Curate <strong class="caret"></strong></a>
                                <div class="dropdown-menu" style="padding: 15px; width: 200px;">
                                    <form action="SQLWrite.php" method="post" enctype="multipart/form-data"/>
                                        <table>
                                            <tr>
                                                <td><input type="text" id="Title" class="form-control" name="Title" placeholder="Artifact Name" style="margin-bottom: 5px;" /></td>
                                            </tr>
                                            <tr>
                                                <td><textarea type="text" rows="10" class="form-control" name="About" placeholder="About" style="margin-bottom: 5px;" /></textarea></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="btn btn-default btn-file btn-info">Get Photo<input name="Photo" id="files" accept="image/*" type="file" /></span>
                                                <output id="list"></output>

                                                <script>
                                                  function handleFileSelect(evt) {
                                                    var files = evt.target.files; // FileList object

                                                    // files is a FileList of File objects. List some properties.
                                                    var output = [];
                                                    for (var i = 0, f; f = files[i]; i++) {
                                                      output.push('<li><strong>Image Attached</strong> ',
                                                                  '</li>');
                                                    }
                                                    document.getElementById('list').innerHTML = '<ul>' + output.join('') + '</ul>';
                                                  }

                                                  document.getElementById('files').addEventListener('change', handleFileSelect, false);
                                                </script>
                                                </td>
                                            </tr>
                                            
                                            <td>&nbsp;</td>

                                            <tr>
                                                <td><input type="submit" class="btn btn-default btn-success btn-file" value="Add" onclick="this.disabled=true;this.value='Adding...';this.form.submit();"></td>
                                            </tr>
                                        </table>  
                                    </form>
                                </div>        
                            </td>

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
                            <td>|</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td class="dropdown">
                                <!-- Drop down menu -->
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="fa fa-question-circle"></i></a>
                                <div class="dropdown-menu dropdown-menu-right" style="padding: 15px;">
                                        <table align="center">
                                            <tr>
                                                <td><a href="help.php">Release Notes</a><br /></td>
                                            </tr>
                                            <tr><td>&nbsp;</td></tr>
                                            <tr>
                                                <td><a href="privacy_and_terms.php">Privacy Terms</a><br /></td>
                                            </tr>
                                        </table>
                                        
                                </div>        
                            </td>
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
                
        <div class="one">
            <table>
                <tr>
                    <td class="dropdown">
                        <!-- Drop down menu -->
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown" style="color: lightgrey;"><i class="fa fa-plus"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="padding: 15px; width: 200px;">
                            <form action="SQLWrite.php" method="post" enctype="multipart/form-data"/>
                                <table>
                                    <tr>
                                        <td><input type="text" id="Title" class="form-control" name="Title" placeholder="Artifact Name" style="margin-bottom: 5px;" /></td>
                                    </tr>
                                    <tr>
                                        <td><textarea type="text" rows="10" class="form-control" name="About" placeholder="About" style="margin-bottom: 5px;" /></textarea></td>
                                    </tr>
                                    <tr>
                                        <td><span class="btn btn-default btn-file btn-info">Get Photo<input type="file" name="Photo" id="filesMobile" accept="image/*"  /></span>
                                                <output id="listMobile"></output>

                                                <script>
                                                  function handleFileSelect(evt) {
                                                    var files = evt.target.files; // FileList object

                                                    // files is a FileList of File objects. List some properties.
                                                    var output = [];
                                                    for (var i = 0, f; f = files[i]; i++) {
                                                      output.push('<li><strong>Image Attached</strong> ',
                                                                  '</li>');
                                                    }
                                                    document.getElementById('listMobile').innerHTML = '<ul>' + output.join('') + '</ul>';
                                                  }

                                                  document.getElementById('filesMobile').addEventListener('change', handleFileSelect, false);
                                                </script>
                                                </td>
                                                
                                    </tr>
                                    
                                    <td>&nbsp;</td>

                                    <tr>
                                        <td><input type="submit" class="btn btn-default btn-success btn-file" value="Add" onclick="this.disabled=true;this.value='Adding...';this.form.submit();"></td>
                                    </tr>
                                </table>  
                            </form>
                        </div>        
                    </td>
        

                </tr>
            </table>
        </div>
        </div>
    </div>
        
    </div>


</nav>

<nav class="navbar navbar-default navbar-fixed-bottom mainMobile">
    <div class="nav navbar-nav" style="margin: 10px 5px;">
        <div class="container text-center">
            <div class="row">
                <div class="col-xs-3"><a href="private.php" style="color: red;"><i class="fa fa-university fa-2x"></i></a></div>
                <div class="col-xs-3"><a href="memberlist.php" style="color: grey;"><i class="fa fa-search fa-2x"></i></a></div>
                <div class="col-xs-3"><a href="visitFriendsDropdownMobile.php" style="color: grey;"><i class="fa fa-ticket fa-2x"></i></a></div>
                <div class="col-xs-3"><a href="accountSettingsMobile.php" style="color: grey;"><i class="fa fa-gear fa-2x"></i></a></div>
            </div>
        </div>   
    </div>
</nav>

<br class="mainPc">

<div class="grid-container">

<?php include 'SQLConnect.php';?>
<br>
<br>
</div>

<footer class="mainPc">
        

<br>
        <div class="container">
            <div class="row text-center">
                <div class="col-md-12">
                    <span class="copyright">Made with <i class="fa fa-heart" style="color:red;"></i> in Milwaukee&nbsp&nbsp|&nbsp&nbsp&copy <a href="http://codingerik.com">CodingErik</a> 2016</span>
                </div>
            </div>
            <br>
        </div>
    </footer>

<!--<a href="memberlist.php">Memberlist</a><br />-->
<!--<a href="edit_account.php">Edit Account</a><br />-->
<!--<a href="logout.php">Logout</a>-->

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
