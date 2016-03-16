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
    dir('There was a problem when trying to connect to the host. Please contact Tech Support. Error: ' . mysql_error());    
}

$db_selected = mysql_select_db($dbname, $link);

if (!$link) {
    dir('There was a problem when trying to connect to the database. Please contact Tech Support. Error: ' . mysql_error());    
}

$id = $_POST['id'];
$UserName = $_POST['userName'];
$myUserId = $_POST['myUserId'];


$sql = "INSERT INTO mymuseum.`requestedfriends-".$_SESSION['user']['username']."`(requestsTo) VALUES ('$id')";
mysql_query($sql); 

$sql = "INSERT INTO mymuseum.`friendrequest-".$UserName."`(requestsFrom) VALUES ('$myUserId')";
mysql_query($sql); 


echo '<div class="col-lg-12 edit">';
echo '<h3> You have requested a ticket to visit '.$UserName.'&#39;s Museum!</h3>';
echo '<br><br>';
echo '<FORM METHOD="LINK" ACTION="memberlist.php">
<INPUT TYPE="submit" class="btn btn-primary" VALUE="Looking Forward To It!">
</FORM>';
echo '</div>';

/*if (!mysql_query($sql)) {
    die('Error: ' . mysql_error()); 
}*/

?>

</body>
</html>