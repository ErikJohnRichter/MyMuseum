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
  echo '<div class="text-center">Sorry, there was an error connecting to the host. Please try again.</div>';
    /*die('Error: ' . mysql_error()); */
    /*dir('There was a problem when trying to connect to the host. Please contact Tech Support. Error: ' . mysql_error()); */   
}

$db_selected = mysql_select_db($dbname, $link);

if (!$link) {
  echo '<div class="text-center">Sorry, there was an error trying to connect to the database. Please try again.</div>';
    
    /*dir('There was a problem when trying to connect to the database. Please contact Tech Support. Error: ' . mysql_error()); */   
}

$Bio = nl2br(htmlspecialchars($_POST['Bio'], ENT_QUOTES));
$AboutMuseum = nl2br(htmlspecialchars($_POST['AboutMuseum'], ENT_QUOTES));

$sql = "UPDATE mymuseum.`profile-".$_SESSION['user']['username']."` SET museum='$AboutMuseum' WHERE id=1";
echo '<div class="col-lg-12 edit">';
echo '<h3>Your museum profile has been updated</h3>';
echo '<br><br>';
echo '<FORM METHOD="LINK" ACTION="private.php">
<INPUT TYPE="submit" class="btn btn-primary" VALUE="Return to your Exhibit">
</FORM>';
echo '</div>';

if (!mysql_query($sql)) {
    die("Sorry, there was an error. Please try again.");
    
    /*die('Error: ' . mysql_error()); */
}

?>

</body>
</html>