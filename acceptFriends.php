<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Mini Museum</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/main.css" rel="stylesheet">

    <link rel="shortcut icon" href="assets/myIcon.png">


    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Lobster|Comfortaa|Amatic+SC|Coming+Soon|Architects+Daughter' rel='stylesheet' type='text/css'>

</head>
<body>


<?php
require("common.php"); 

$link = mysql_connect($host, $username, $password);

if (!$link) {
  die("Sorry, there was an error. Please try again.");
    /*die('Error: ' . mysql_error()); */
    /*dir('There was a problem when trying to connect to the host. Please contact Tech Support. Error: ' . mysql_error()); */   
}

$db_selected = mysql_select_db($dbname, $link);

if (!$link) {
  die("Sorry, there was an error. Please try again.");
    
    /*dir('There was a problem when trying to connect to the database. Please contact Tech Support. Error: ' . mysql_error()); */   
}

$id = $_POST['id'];
$UserName = $_POST['user-Name'];
$myUserId = $_SESSION['userid'];


$sql1 = "INSERT INTO mymuseum.`friends-".$_SESSION['user']['username']."`(friends) VALUES ('$id')";
mysql_query($sql1);

$sql2 = "INSERT INTO mymuseum.`friends-".$UserName."`(friends) VALUES ('$myUserId')";
mysql_query($sql2); 

$sql3 = "DELETE FROM mymuseum.`friendrequest-".$_SESSION['user']['username']."` WHERE requestsFrom = ".$id."";
mysql_query($sql3);

$sql4 = "DELETE FROM mymuseum.`requestedfriends-".$UserName."` WHERE requestsTo = ".$myUserId."";
mysql_query($sql4);

/*echo $sql1;
echo'<br>';
echo $sql2;
echo'<br>';
echo $sql3;
echo'<br>';
echo $sql4;
echo'<br>';*/
echo '<div class="col-lg-12 edit">';
echo '<h3> You have given '.$UserName.' a ticket to your museum!</h3>';
echo '<br><br>';
echo '<FORM METHOD="LINK" ACTION="private.php">
<INPUT TYPE="submit" class="btn btn-primary" VALUE="Looking Forward To It!">
</FORM>';
echo '</div>';

/*if (!mysql_query($sql)) {
    die('Error: ' . mysql_error()); 
}*/

?>

</body>
</html>