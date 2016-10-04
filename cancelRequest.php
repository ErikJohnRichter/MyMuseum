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

    <link rel="shortcut icon" href="assets/myIcon.png">


    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Lobster|Comfortaa|Amatic+SC|Coming+Soon|Architects+Daughter' rel='stylesheet' type='text/css'>

</head>
<body>


<?php
require("common.php"); 

$link2 = mysql_connect($host, $username, $password);

if (!$link2) {
    dir('There was a problem when trying to connect to the host. Please contact Tech Support. Error: ' . mysql_error());    
}

$db_selected = mysql_select_db($dbname, $link2);

if (!$link2) {
    dir('There was a problem when trying to connect to the database. Please contact Tech Support. Error: ' . mysql_error());    
}

$idCancelRequest = $_POST['idCancel'];
$UserNameCancel = $_POST['userNameCancel'];
$myUserIdCancel = $_POST['myUserIdCancel'];


$sql5 = "DELETE FROM mymuseum.`requestedfriends-".$_SESSION['user']['username']."` WHERE requestsTo = ".$idCancelRequest."";
mysql_query($sql5);

$sql6 = "DELETE FROM mymuseum.`friendrequest-".$UserNameCancel."` WHERE requestsFrom = ".$_SESSION['userid']."";
mysql_query($sql6);


echo '<div class="col-lg-12 edit">';
echo '<h3>You just cancelled your request to receive a ticket to '.$UserNameCancel.'&#39;s Museum</h3>';
echo '<br><h3>You may request a new ticket at any time.</h3>';
echo '<br><br>';
echo '<FORM METHOD="LINK" ACTION="memberlist.php">
<INPUT TYPE="submit" class="btn btn-primary" VALUE="Okay, thanks!">
</FORM>';
echo '</div>';

/*if (!mysql_query($sql)) {
    die('Error: ' . mysql_error()); 
}*/

?>

</body>
</html>