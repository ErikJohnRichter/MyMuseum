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
$sql = "SELECT COUNT(friends) FROM mymuseum.`friends-".$myUsername."`";
$friendTotal = mysql_query("$sql");

$friendCount = mysql_fetch_row($friendTotal);

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
                <div class="col-xs-3"><a href="visitFriendsDropdownMobile.php" style="color: red;"><i class="fa fa-ticket fa-2x"></i></a></div>
                <div class="col-xs-3"><a href="accountSettingsMobile.php" style="color: grey;"><i class="fa fa-gear fa-2x"></i></a></div>
            </div>
        </div>   
    </div>
</nav>

<?php
if ($friendCount[0] != 0) {
echo'

    <div class="memberList">
    <h3>member at</h3> 
    <br>
        <table><tr> 
            <td>&nbsp;</td>
        </tr>';
            foreach($rows as $row):
                $myId = $_SESSION['userid'];
                if (in_array($row['id'], $friends)) {
                     
                    echo'<form action="visitFriends.php" method="post"/>';
                    echo'<tr>';
                    if ($row['id'] != 51) { /*51 in QA*/
                    echo'<td style="font-size: 16px;">'.$row['username'].'&#39;s</td>';
                    }
                    else {
                    echo'<td style="font-size: 16px;">'.$row['username'].'</td>';
                    }
                    echo'<td>&nbsp;</td>
                         <td>&nbsp;</td>';
                    echo'<td>
                        <input type="hidden" name="id" value="'.$row['id'].'"/>
                    </td>
                    <td>
                        <input type="hidden" name="userName" value="'.$row['username'].'"/>
                    </td>';
                    
                    echo'<td>
                        <input type="submit" class="btn btn-success btn-file" value="Visit Museum">
                    </td>';
                    echo'</tr>';
                    echo'<tr><td>&nbsp;</td></tr>';
                    
                    echo'</form>';
                    
                }
            endforeach;
            }
            else {
                 echo'
                <div class="memberList">
                    <table>';
                echo'<tr>
                <a class="btn btn-lg btn-success btn-file" href="memberlist.php">Request Tickets</a>
                ';
            }
            echo'</table>  
                </div>        
            <br>
            <br>
            <br>
            <br>
            ';

/*<tr>
    <td><input type="text" id="Friend" class="form-control" name="Friend" placeholder="Username" /></td>
    <td>&nbsp;</td>
    <td><input type="submit" class="btn btn-default btn-file" value="Visit"></td>                                              
</tr>*/
?>