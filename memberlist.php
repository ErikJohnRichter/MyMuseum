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
            email, 
            isFriendsWith,
            friendRequestFrom,
            requestedFriend

        FROM users 
    "; 
     
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
        die("Failed to run query: " . $ex->getMessage()); 
    } 
         
    // Finally, we can retrieve all of the found rows into an array using fetchAll 
    $rows = $stmt->fetchAll(); 

$link = mysql_connect($host, $username, $password);
mysql_select_db($dbname);
$myUsername = $_SESSION['user']['username'];
$sql = "SELECT `friends` FROM mymuseum.`friends-".$myUsername."`";
$result1 = mysql_query("$sql");

$friends = array();
while ($row = mysql_fetch_assoc($result1)) {
    $friends[] = $row['friends'];
}

$link = mysql_connect($host, $username, $password);
mysql_select_db($dbname);
$myUsername = $_SESSION['user']['username'];
$sql = "SELECT `requestsTo` FROM mymuseum.`requestedfriends-".$myUsername."`";
$result2 = mysql_query("$sql");

$friendRequestsTo = array();
while ($row = mysql_fetch_assoc($result2)) {
    $friendRequestsTo[] = $row['requestsTo'];
}

$link = mysql_connect($host, $username, $password);
mysql_select_db($dbname);
$myUsername = $_SESSION['user']['username'];
$sql = "SELECT `requestsFrom` FROM mymuseum.`friendrequest-".$myUsername."`";
$result3 = mysql_query("$sql");

$friendRequestsFrom = array();
while ($row = mysql_fetch_assoc($result3)) {
    $friendRequestsFrom[] = $row['requestsFrom'];
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

    <link rel="shortcut icon" href="assets/myIcon.png">


    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Lobster|Comfortaa|Amatic+SC|Coming+Soon|Architects+Daughter' rel='stylesheet' type='text/css'>

</head>

<body>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="two">
            <table>
                <tr>
                    <td><h4>my museum</h4></td>
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
                                <a class="btn btn-default btn-file" href="private.php">Home</a>
                            </td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td class="dropdown">
                                <!-- Drop down menu -->
                                <a class="dropdown-toggle btn btn-default btn-file" href="#" data-toggle="dropdown">Visit Museums <strong class="caret"></strong></a>
                                <div class="dropdown-menu" style="padding: 15px 15px 0px; width: 100px;">
                                    
                                        <table>
                                            <?php include 'visitFriendsDropdown.php';?>
                                        </table>  
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
                                <div class="dropdown-menu dropdown-menu-right" style="padding: 15px; width: 50px;">
                                        <table>
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

<br>
<?php
echo'<div class="memberList">';
echo'<h3>other museums</h3> 
<br>';
    echo '<table> 
        <tr> 
            <td>&nbsp;</td>
        </tr>';
        foreach($rows as $row):
            $myId = $_SESSION['userid'];
            if ($row['id'] != $_SESSION['userid']) {
            echo'<tr>';
                echo'<td>'.$row['username'].'</td>';
                echo'<td>&nbsp;</td>
                     <td>&nbsp;</td>';
                if (in_array($row['id'], $friends)) {
                echo'<form action="visitFriends.php" method="post"/>';
                echo'<td>
                    <input type="hidden" name="id" value="'.$row['id'].'"/>
                </td>
                <td>
                    <input type="hidden" name="userName" value="'.$row['username'].'"/>
                </td>
                <td>
                    <input type="hidden" name="myUserId" value="'.$_SESSION['userid'].'"/>
                </td>';
                echo'<td>
                    <input type="submit" class="btn btn-primary btn-file" value="Visit Museum">
                </td>';
                echo'</form>';
                }
                else if (in_array($row['id'], $friendRequestsTo)) {
                echo'<form action="acceptFriends.php" method="post"/>';
                echo'<td>
                    <input type="hidden" name="id" value="'.$row['id'].'"/>
                </td>
                <td>
                    <input type="hidden" name="user-Name" value="'.$row['username'].'"/>
                </td>
                <td>
                    <input type="hidden" name="myUserId" value="'.$_SESSION['userid'].'"/>
                </td>';
                echo'<td>
                    <div class="btn btn-warning btn-file disabled">Awaiting Ticket</div>
                </td>';
                echo'</form>';
                }
                else if (in_array($row['id'], $friendRequestsFrom)) {
                echo'<form action="acceptFriends.php" method="post"/>';
                echo'<td>
                    <input type="hidden" name="id" value="'.$row['id'].'"/>
                </td>
                <td>
                    <input type="hidden" name="user-Name" value="'.$row['username'].'"/>
                </td>
                <td>
                    <input type="hidden" name="myUserId" value="'.$_SESSION['userid'].'"/>
                </td>';
                echo'<td>
                    <input type="submit" class="btn btn-warning btn-file" value="Give Ticket">
                </td>';
                echo'</form>';
                }
                else{
                    echo'<form action="requestFriend.php" method="post"/>';
                echo'<td>
                    <input type="hidden" name="id" value="'.$row['id'].'"/>
                </td>
                <td>
                    <input type="hidden" name="userName" value="'.$row['username'].'"/>
                </td>
                <td>
                    <input type="hidden" name="myUserId" value="'.$_SESSION['userid'].'"/>
                </td>';
                echo'<td>
                    <input type="submit" class="btn btn-success btn-file" value="Request Ticket">
                </td>';
                echo'</form>';
                }
            echo'</tr>';
            echo'<tr><td>&nbsp;</td></tr>';
            }
            
        endforeach; 
        
    echo'</table> 
<br>
<br>';
echo '<FORM METHOD="LINK" ACTION="private.php">
<INPUT TYPE="submit" class="btn btn-primary" VALUE="Return to your Exhibit">
</FORM>';
echo'</div>';
?>
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
