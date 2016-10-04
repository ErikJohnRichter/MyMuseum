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
       die("Sorry, there was an error. Please try again.");
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

    <link rel="shortcut icon" href="assets/myIcon.png">


    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Lobster|Comfortaa|Amatic+SC|Coming+Soon|Architects+Daughter' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

</head>

<body>

<nav class="navbar navbar-default navbar-fixed-top mainMobile">
    
    <div class="container">
        <div class="text-center">
           
            <h4>my museum</h4>
             
            <br>
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


<div class="text-center">
    <div class="mainMobile">

<h3>hello <?php echo strtolower(htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8')); ?>!</h3>
                         <br>
                         <br>
                            <form action="edit_account.php">
                                <input type="submit" class="btn btn-default btn-lg btn-success" value="Edit Account" style="width: 150px;">
                            </form>
                        
                        <br>
                        
                            <form action="logout.php">
                                <input type="submit" class="btn btn-default btn-lg btn-danger" value="Logout" style="width: 150px;">
                            </form>

                            <br>
                         
                            <hr style="border: 0;
                                      clear:both;
                                      display:block;
                                      width: 200px;               
                                      background-color:grey;
                                      height: 1px;
                                      margin-bottom: 30px;
                                      margin-top: 17px;
                                      ">
                            <form action="help.php">
                                <input type="submit" class="btn btn-default btn-lg btn-info" value="Release Notes" style="width: 150px;">
                            </form>
                            
                            <br>
                            <a href="http://www.codingerik.com/#contact" target="blank" style="margin-left: 3px;"><button class="btn btn-default btn-lg btn-warning" style="width: 150px;">Contact</button></a>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <a href="privacy_and_terms.php" style="margin-left: 3px;">Privacy</a>
                            
                            <br>
                            <br>
                    
                </div>
            </div>

</div>

    <footer class="mobile">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-12">
                    <span class="copyright">Made with <i class="fa fa-heart" style="color:red;"></i> in Milwaukee<br>&copy <a href="http://codingerik.com">CodingErik</a> 2016</span>
                </div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
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
